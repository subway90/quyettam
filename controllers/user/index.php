<?php
# [FILES]
require_once '../../configs/config.php';
require_once '../../models/database.php';
require_once '../../models/function.php';
require_once '../../models/user/header.php';
require_once '../../models/user/product.php';


# [FUNCTIONS]
session_start();
ob_start();

# [VARIBLES]


# [SESSIONS]
if(!isset($_SESSION['showCanvasCart'])) $_SESSION['showCanvasCart'] = '';
if(!isset($_SESSION['user'])) $_SESSION['user'] = [];
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];


# [CASES]
if(isset($_GET['act']) && $_GET['act']) {
    $arrayURL = explode('/',$_GET['act']);
    $act=$arrayURL[0];
    if(file_exists('case/'.$act.'.php')) require_once 'case/'.$act.'.php';
    else return view_404('user');
}else {
    require_once 'case/trang-chu.php';
}