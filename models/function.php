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
        require_once '../../models/user/header.php';
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
    $page = '';
    if($type === 'user') {
        require_once '../../models/user/header.php';
        require_once '../../views/user/layout/header.php';
        require_once '../../views/user/404.php';
        require_once '../../views/user/layout/footer.php';
    }
    else if($type === 'admin') {
        require_once '../../models/user/header.php';
        require_once '../../views/user/layout/header.php';
        require_once '../../views/user/404.php';
        require_once '../../views/user/layout/footer.php';
    }else die('$type not valid');
}

function alert($content) {
    echo '<script>alert("'.$content.'")</script>';
}

/**
 * Hàm tạo token ngẫu nhiên theo độ dài tùy ý trong phạm vi [a-z][A-Z][0-9]
 * @param int $length độ dài kí tự token (0-100)
 */
function create_token($length){
    if($length <= 0) return "[ERROR] length not valid";
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, $length);
}

/**
 * Hàm này dùng để loại bỏ dấu của chuỗi
 * @param string $input Chuỗi cần loại bỏ dấu
 */
function remove_mark_string($input) {
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#', #1
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',#2
        '#(ì|í|ị|ỉ|ĩ)#',#3
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',#4
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',#5
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',#6
        '#(đ)#',#7
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',#8
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',#9
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',#10
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',#11
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',#12
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',#13
        '#(Đ)#',#14
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',#1
        'e',#2
        'i',#3
        'o',#4
        'u',#5
        'y',#6
        'd',#7
        'A',#8
        'E',#9
        'I',#10
        'O',#11
        'U',#12
        'Y',#13
        'D',#14
        '-',#15
    );
    $input = preg_replace($search, $replace, $input);
    $input = preg_replace('/(-)+/', ' ', $input);
    return $input;
}