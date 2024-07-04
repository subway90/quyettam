<?php
# [ADD TO CART]
if(isset($_POST['addCart'])) {
    $idProduct = $_POST['addCart'];
    $quantityMax = pdo_query_value('SELECT quantity FROM products WHERE id ='.$idProduct);

    if($_SESSION['account']) {
        $rowCart = pdo_query_one(
            'SELECT id,quantity FROM carts WHERE idUser='. $_SESSION['account']['id'] .' AND idProduct ='. $idProduct
        );
        if($rowCart) {
            if($rowCart['quantity'] < $quantityMax) edit_quantity_cart($rowCart['id'],'+',1);
            else alert('Đã đạt giới hạn số lượng sản phẩm !');
        }else add_cart($_SESSION['account']['id'],$idProduct);

    }else {
        $rowCart = checkCart($idProduct);
        if($rowCart === -1) {
            $_SESSION['cart'][] = [
                'id' => $idProduct,
                'quantity' => 1
            ];
        }else {
            if($_SESSION['cart'][$rowCart]['quantity'] < $quantityMax) $_SESSION['cart'][$rowCart]['quantity']++;
            else alert('Đã đạt giới hạn số lượng sản phẩm !');
        }
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