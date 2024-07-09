<?php
session_start();
ob_start();

# [VARIABLES]
$data = [];

# [SESSIONS]
if(!isset($_SESSION['showCanvasCart'])) $_SESSION['showCanvasCart'] = '';
if(!isset($_SESSION['account'])) $_SESSION['account'] = [];
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if(!isset($_SESSION['name_donate'])) $_SESSION['name_donate'] = '';
# [FILES]
require_once '../../configs/config.php';
require_once '../../configs/vnpay.php';
require_once '../../configs/momo.php';
require_once '../../models/database.php';
require_once '../../models/function.php';
require_once '../../models/user/cart.php';
require_once '../../models/user/account.php';
require_once '../../models/user/header.php';
require_once '../../models/user/product.php';
require_once '../../models/user/donate.php';

# [AUTO LOGIN]
if(isset($_COOKIE['remember'])) auto_login_by_token($_COOKIE['remember']);

# [CASES]
if(isset($_GET['act']) && $_GET['act']) {
    $arrayURL = explode('/',$_GET['act']);
    $act=$arrayURL[0];
    if(file_exists('case/'.$act.'.php')) require_once 'case/'.$act.'.php';
    else return view_404('user');
}else {
    require_once 'case/trang-chu.php';
}