<?php 
/**
 * Hàm này dùng để tạo mới token donate
 */
function create_token_donate() {
    CTD:
    $token = create_token(10);
    $check = pdo_query_one(
        'SELECT status FROM donates WHERE token ="'.$token.'"'
    );
    if(!$check) return $token;
    else goto CTD;
}

/**
 * Hàm này dùng để lấy 1 dòng donate bởi token, trả về TRUE (array) nếu tồn tại, trả về FALSE (bool) nếu không tồn tại
 * @param string $token mã token của dòng donate cần lấy
 */
function get_one_donate ($token) {
    $check = pdo_query_one(
        'SELECT status FROM donates WHERE token ="'.$token.'"'
    );
    if($check) return $check;
    else return false;
}