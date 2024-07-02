<?php
# [FILES]
require_once '../../configs/config.php';
require_once '../../models/database.php';
require_once '../../models/function.php';

# [CASE]

if(isset($_GET['act']) && $_GET['act']) {
    $arrayURL = explode('/',$_GET['act']);
    $act=$arrayURL[0];
    switch ($act) {
        case 'trang-chu':
            require_once 'case/home.php';
            break;
        case 've-chung-toi':
            echo 'về chúng tôi';
            break;
        default:
            echo '404 not found';
            break;
    }
}else {
    echo 'trang chủ [ELSE]';
}