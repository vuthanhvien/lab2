<?php
        require_once("./payment-config.php");
        require('./wp-blog-header.php');

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        $secureHash = hash('sha256',$vnp_HashSecret . $hashData);

        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                // echo "GD Thanh cong";
            } else {
                echo "GD Khong thanh cong";
                exit;
            }
        } else {
            echo "Chu ky khong hop le";
            exit;
        }

        
        $key = $_GET['vnp_TxnRef'];

        $user = wp_get_current_user();
        $fields =  get_fields('user_'.$user->ID); 

        if($fields['key_payment']){
            $key_payment =  explode('_', $fields['key_payment']);
        if($key ==  $key_payment[0]){


            $current = date('Y-m-d');
    
            if($key_payment[2] == 'standard'){
                $current = $fields['date_end_standard'];
            }
            
            if($key_payment[2] == 'premium'){
                $current = $fields['date_end_premium'];
            }
            
            if($key_payment[3] == 'trial'){
                $current = strtotime( "+1 month", strtotime( $current ) );
            }
            if($key_payment[3] == 'month'){
                $current = strtotime( "+6 month", strtotime( $current ) );
            }
            if($key_payment[3] == 'year'){
                $current =   strtotime( "+1 year", strtotime( $current ) );
            }
            $current = date('Y-m-d', $current);
            
            if($key_payment[2] == 'standard'){
                update_field('date_end_standard',$current, 'user_'.$user->ID);
            }
            
            if($key_payment[2] == 'premium'){
                update_field('date_end_premium',$current, 'user_'.$user->ID);
            }
            update_field('key_payment','', 'user_'.$user->ID);
            $isDone =true;
    
        }else{
            $isDone =false;

        }
    }else{
            $isDone =false;

        }
      
        if(  !$isDone ){
            echo '<p>Url không chính xác hoặc hết hạn </p>';

        }else{
        ?>
        <!--Begin display -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">Thanh toán hoàn thành</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?php echo $_GET['vnp_Amount'] ?></label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label>
                        <?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "GD Thanh cong";
                            } else {
                                echo "GD Khong thanh cong";
                            }
                        } else {
                            echo "Chu ky khong hop le";
                        }
                        ?>

                    </label>
                </div> 
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY 2015</p>
            </footer>
        </div>  
<?php } ?> 
