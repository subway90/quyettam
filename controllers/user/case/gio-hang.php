<?php
# [DATA]
$data = [
    'list_cart' => $_SESSION['cart'],
];

# [RENDER VIEW]
view('Giỏ hàng','cart',$data);