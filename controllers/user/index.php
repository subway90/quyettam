<?php
# [FILES]
require_once '../../configs/config.php';
require_once '../../models/database.php';
require_once '../../models/function.php';

# [VARIBLES]

# [SESSIONS]
if(!isset($_SESSION['showCanvasCart'])) $_SESSION['showCanvasCart'] = '';
if(!isset($_SESSION['user'])) $_SESSION['user'] = [];


# [CASES]
if(isset($_GET['act']) && $_GET['act']) {
    $arrayURL = explode('/',$_GET['act']);
    $act=$arrayURL[0];
    if(file_exists('case/'.$act.'.php')) require_once 'case/'.$act.'.php';
    else return view_404('user');
}else {
    require_once 'case/trang-chu.php';
}