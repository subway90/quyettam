<?php
require_once '../../models/user/product.php';

$data['list_product'] = get_all_product();
# [RENDER VIEW]
view(
    'Mua sản phẩm',
    'product',
    $data
);