<?php
require_once '../../models/user/product.php';

# [ADD TO CART]
if(isset($_POST['addCart'])) {
    $_SESSION['showCanvasCart'] = true;
}

$data['list_product'] = get_all_product();
# [RENDER VIEW]
view(
    'Mua sản phẩm',
    'product',
    $data
);