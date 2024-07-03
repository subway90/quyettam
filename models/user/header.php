<?php

/**
 * Hiển thị thứ, ngày tháng năm
 */
function date_now() {
    $nameToday = [1 => 'Thứ Hai',2 => 'Thứ Ba',3 => 'Thứ Tư',4 => 'Thứ Năm',5 => 'Thứ Sáu',6 => 'Thứ Bảy',7 => 'Chủ Nhật'];
    return $nameToday[date('N')].', ngày '.date('d/m/Y');
}

/**
 * Dùng để hiển thị Canvas giỏ hàng nếu $_SESSION['showCanvasCart'] TRUE
 */
function showCanvasCart() {
    if($_SESSION['showCanvasCart']) {
        unset($_SESSION['showCanvasCart']);
        return 'show';
    }
}