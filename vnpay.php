<?php

require('./wp-blog-header.php');
 
require_once("./payment-config.php");

$user = wp_get_current_user();

if(!$user->exists()){
    return;
}
 
$order_type = $_POST['order_type'];
$type = $_POST['type'];


$vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = 'Thanh toán cho gói '.$order_type;


$options = Array();

if($type != 'premium' && $type != 'standard'){
    $returnData = array('type' => 'failed'
    , 'message' => 'Loại thanh toán không hợp lệ' );
    
echo json_encode($returnData);
exit;
}


if($order_type != 'trial' && $order_type != 'month' && $order_type != 'year'){
    $returnData = array('type' => 'failed'
    , 'message' => 'Loại thanh toán không hợp lệ' );
    
echo json_encode($returnData);
exit;
}


$amount = 0;
if($type == 'premium' && $order_type == 'trial'){
    $amount = get_option('trial_premium_1_month');
}
if($type == 'premium' && $order_type == 'month'){
    $amount = get_option('premium_1_month') * 6;
}
if($type == 'premium' && $order_type == 'year'){
    $amount = get_option('premium_1_year');
}
if($type == 'standard' && $order_type == 'trial'){
    $amount = get_option('trial_standard_1_month');
}
if($type == 'standard' && $order_type == 'month'){
    $amount = get_option('standard_1_month');
}
if($type == 'standard' && $order_type == 'year'){
    $amount = get_option('standard_1_year');
}


if($amount == 0){
    $returnData = array('type' => 'failed'
    , 'message' => 'Loại thanh toán không hợp lệ' );
    
echo json_encode($returnData);
exit;
}


$vnp_Amount = $amount * 23000 * 100;
$vnp_Locale =   'vn';
// $vnp_BankCode = $_POST['bank_code'] || '';
$vnp_BankCode =  '';

$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];


$inputData = array(
    "vnp_Version" => "2.0.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

// var_dump($inputData);
// exit;

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . $key . "=" . $value;
    } else {
        $hashdata .= $key . "=" . $value;
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}



update_field('key_payment',$vnp_TxnRef .'_'.$user->ID.'_'.$type.'_'.$order_type, 'user_'.$user->ID);
$fields =  get_fields('user_'.$user->ID); 


$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
   	$vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
    $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
} 


$returnData = array(
    'status'=> 200,
    'type' => 'success',
    'url'=>$vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash,
);

echo json_encode($returnData);

// header("Location: ".$vnp_Url);
http_response_code(200);
header("Status: 200");
header( "HTTP/1.1 200 OK" );
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}





exit;


