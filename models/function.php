<?php

/**
 * Load view từ views/user
 * @param string $title Tiêu đề trang
 * @param string $page Tên file view cần load
 */
function view($title,$page) {
    if(file_exists('../../views/user/'.$page.'.php')) {
        require_once '../../views/user/layout/header.php';
        require_once '../../views/user/'.$page.'.php';
        require_once '../../views/user/layout/footer.php';
    }else {
        die('Trang view <strong>'.$page.'.php</strong> chưa được tạo.<br> <strong>path : ../../views/user/'.$page.'.php</strong> in folder VIEWS');
    }
}
