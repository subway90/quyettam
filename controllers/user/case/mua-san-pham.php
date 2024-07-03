<?php
# [ADD TO CART]
if(isset($_POST['addCart'])) {
    $idProduct = $_POST['addCart'];
    $_SESSION['showCanvasCart'] = true;
    $rowCart = checkCart($idProduct);
    if($rowCart === -1) {
        $_SESSION['cart'][] = [
            'id' => $idProduct,
            'quantity' => 1
        ];
    }else {
        $_SESSION['cart'][$rowCart]['quantity']++;
    }
}

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