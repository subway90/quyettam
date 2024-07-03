<?php

/**
 * Load view từ views/user
 * @param string $title Tiêu đề trang
 * @param string $page Tên file view cần load
 * @param $data Mảng dữ liệu
 */
function view($title,$page,$data) {
    if(file_exists('../../views/user/'.$page.'.php')) {
        if(!empty($data)) extract($data);
        require_once '../../views/user/layout/header.php';
        require_once '../../views/user/'.$page.'.php';
        require_once '../../views/user/layout/footer.php';
    }else {
        die('Trang view <strong>'.$page.'.php</strong> chưa được tạo.<br> <strong>path : ../../views/user/'.$page.'.php</strong> in folder VIEWS');
    }
}

/**
 * Hiển thị trang 404
 * @param $type string [user] hoặc [admin]
 */
function view_404($type) {
    if($type === 'user') {
        require_once '../../views/user/layout/header.php';
        require_once '../../views/user/404.php';
        require_once '../../views/user/layout/footer.php';
    }
    else if($type === 'user') {
        require_once '../../views/user/layout/header.php';
        require_once '../../views/user/404.php';
        require_once '../../views/user/layout/footer.php';
    }else die('$type not valid');
}

/**
 * Hiển thị thứ, ngày tháng năm
 */
function date_now() {
    $nameToday = [1 => 'Thứ Hai',2 => 'Thứ Ba',3 => 'Thứ Tư',4 => 'Thứ Năm',5 => 'Thứ Sáu',6 => 'Thứ Bảy',7 => 'Chủ Nhật'];
    return $nameToday[date('N')].', ngày '.date('d/m/Y');
}