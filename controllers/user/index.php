<?php
# [FILES]
require_once '../../configs/config.php';
require_once '../../models/database.php';
require_once '../../models/function.php';

# [CASE]

if(isset($_GET['act']) && $_GET['act']) {
    $arrayURL = explode('/',$_GET['act']);
    $act=$arrayURL[0];
    if(file_exists('case/'.$act.'.php')) require_once 'case/'.$act.'.php';
    else return view_404('user');
}else {
    echo 'trang chủ [ELSE]';
}