<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'min87586_dev' );

/** Username của database */
define( 'DB_USER', 'min87586_admin' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '12345678@X' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '49)KVP_eMk)oX_]]DOTY~-1_M0H#Az#D]w&FJ-Le+p6;n8`)EVf^i^Z^?UQj2#=@' );
define( 'SECURE_AUTH_KEY',  'TEg5gvv)|bqbZs.fJwP7ZdJ*l33[]WuE^<X;`HT$s)0PFr^}eBgm.I 7cidk&62t' );
define( 'LOGGED_IN_KEY',    'bgaTM@LkAc3{397IwUZw_;|1%oyiCH5e5hyB-6qy/0o?%kZ)}yGZ9yjS+6$)_Y4U' );
define( 'NONCE_KEY',        '~O4g Y@j13h8ndfe2q8Kw]ElW1K$n(ZUV_l^B0[q0!}tQ[`Xb&Mj9h4/TsA,U*K6' );
define( 'AUTH_SALT',        'JLK$j*tFZmF#^)j&7KRAvcRm&^4$BojJE[L)qd()O=G%I,A .)(nhs@B)8P@H~~o' );
define( 'SECURE_AUTH_SALT', '*8ThBP;6qB 487r@(tuF5x`Jn.Mk1aN0MH/cfeOuh,A.+?]RLCyuK;=!DO1swIE)' );
define( 'LOGGED_IN_SALT',   'sXhwK4o25_I[d^bo=<&-P}:LyxMp;v9_*!+onHCz:Ex7i|5l*/jR)cdIp,<-C+~9' );
define( 'NONCE_SALT',       '@y_ P`6hy^%#6!m+VzOq`lR0;lSPKWs A auqZGgj`a;Km$]:QbEaQgoXDH[nxfa' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

define('FS_METHOD','direct');

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
