<?php
/**
 * lấy tất cả sảsn phẩm với điều kiện sản phẩm đang hiện
 */
function get_all_product() {
    return pdo_query(
        'SELECT * FROM products WHERE status = 1'
    );
}
/**
 * @param string $slug slug của sản phẩm
 * lấy tất cả sản phẩm với điều kiện sản phẩm đang hiện và tại vị trí có slug = $slug
 */
function get_one_product_by_slug($slug) {
    return pdo_query_one(
        'SELECT * FROM products WHERE status = 1 AND slug ="'.$slug.'"'
    );
}
/**
 * @param string $id id của sản phẩm
 * lấy tất cả sản phẩm với điều kiện sản phẩm đang hiện và tại vị trí có id = $id
 */
function get_one_product_by_id($id) {
    return pdo_query_one(
        'SELECT * FROM products WHERE status = 1 AND id = '.$id
    );
}
/**
 * Trả về giá trị -1 nếu không trùng, trả về giá trị từ 0 trở lên nếu trùng (trả về vị trí)
 */
function checkCart($id){
    for($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++){
        if($_SESSION['cart'][$i]['id'] == $id) return $i; //nếu ID input trùng ID đã có trong CART -> trả về vị trí của SP trùng đó trong CART
    }return -1;
}