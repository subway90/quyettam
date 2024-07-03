<?php
# [ADD TO CART]
if(isset($_POST['addCart'])) {
    $idProduct = $_POST['addCart'];
    $quantityMax = pdo_query_value('SELECT quantity FROM products WHERE id ='.$idProduct);
    $_SESSION['showCanvasCart'] = true;
    $rowCart = checkCart($idProduct);
    if($rowCart === -1) {
        $_SESSION['cart'][] = [
            'id' => $idProduct,
            'quantity' => 1
        ];
    }else {
        if($_SESSION['cart'][$rowCart]['quantity'] < $quantityMax) $_SESSION['cart'][$rowCart]['quantity']++;
    }
    # show canvas
    $_SESSION['showCanvasCart'] = true;
}

if(isset($_POST['removeCart'])) {
    $rowCart = $_POST['removeCart'];
    array_splice($_SESSION['cart'],$rowCart,1);
    # show canvas
    $_SESSION['showCanvasCart'] = true;
}


$data['list_product'] = get_all_product();
# [RENDER VIEW]
view(
    'Mua sản phẩm',
    'product',
    $data
);