<?php
/**
 * Hàm này để chỉnh sửa số lượng sản phẩm trong giỏ hàng
 * @param $idCart ID CART
 * @param $type "+" hoặc "-"
 * @param $quantity Số lượng cần thay đổi
 */
function edit_quantity_cart($idCart,$type,$quantity) {
    if(in_array($type,['+','-'])) {
        pdo_execute(
            'UPDATE carts SET quantity = quantity '. $type . $quantity .' WHERE id ='. $idCart
        );
    }else die('$type không hợp lệ ( "+" hoặc "-" )');
}
/**
 * Hàm này để thêm 1 dòng mới vào giỏ hàng
 * @param $idUser id tài khoản
 * @param $idProduct id sản phẩm
 */
function add_cart($idUser,$idProduct) {
    pdo_execute(
        'INSERT INTO carts (idUser,idProduct,quantity) VALUES ('. $idUser .','. $idProduct .',1)'
    );
}