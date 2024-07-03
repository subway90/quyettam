<?php
require_once '../../models/user/product.php';

# [DATA]
$slug = $arrayURL[1];
$data['product'] = get_one_product_by_slug($slug);
if(!$data['product']) {
    view_404('user');
    exit;
}
# [RENDER VIEW]
view($data['product']['name'],'detail',$data);