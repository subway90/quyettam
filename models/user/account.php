<?php
/**
 * Hàm này dùng để lấy dữ liệu 1 dòng của account theo username
 * @param string $username username cần lấy
 */
function get_one_account_by_username($username) {
    return pdo_query_one(
        'SELECT * FROM accounts WHERE user ="'.$username.'"'
    );
}
/**
 * Hàm này kiểm tra token vừa tạo đã tồn tại chưa, trả về true nếu tồn tại (ID), ngược lại trả về false nếu không tồn tại
 * @param string $token token cần kiểm tra
 */
function check_token_user_exits($token) {
    return pdo_query_one(
        'SELECT id FROM accounts WHERE tokenRemember ="'.$token.'"'
    );
}