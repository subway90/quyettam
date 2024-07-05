<?php
$total = 0;
$payment_method = 1;
$message = '';
$show_invoice = 'hide';
$array_product_in_cart = [];
// $show_invoice = 'onload';

# [UPDATE QUANTITY]

# Tăng số lượng
if(isset($_POST['plus'])) {
    //['ID LOCATION'/'ID']
    # Số lượng giới hạn
    # Đã đăng nhập
    if($_SESSION['account']) edit_quantity_cart(explode('/',$_POST['plus'])[1],'+',1);
    # Chưa đăng nhập
    else $_SESSION['cart'][$i]['quantity']++;
}

# [LIST CART]
$list_cart = list_cart();
if($list_cart) {
    for ($i=0; $i < count($list_cart); $i++) {
        $row_product = get_one_product_by_id($list_cart[$i]['id']);
        $array_product_in_cart[] = [
            'id' => $row_product['id'],
            'name' => $row_product['name'],
            'imgDefault' => $row_product['imgDefault'],
            'price' => $row_product['price'],
            'quantity' => $list_cart[$i]['quantity'],
            'quantityMax' => $row_product['quantity'],
        ];
        $total += $row_product['price'] * $list_cart[$i]['quantity'];
    }
}

# [INFO]
if($_SESSION['account']) {
    extract($_SESSION['account']);
}else $fullName = $phone = $email = $address = '';

# [INVOICE]
if(isset($_POST['createInvoice'])) {
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $address = $_POST['address'];
    $fullName = $_POST['fullName'];
    $payment_method = $_POST['payment_method'];
    $show_invoice = 'onload';
}

# [VOUCHER]
if(isset($_POST['voucher']) && $_POST['voucher']) alert('Mã giảm giá không chính xác');

# [DATA]
$data = [
    'array_product_in_cart' => $array_product_in_cart,
    'total' => $total,
    'show_invoice' => $show_invoice,
    'info_name' => $fullName,
    'info_email' => $email,
    'info_phone' => $phone,
    'info_address' => $address,
    'message' => $message,
    'payment_method' => $payment_method
];

# [RENDER VIEW]
view('Giỏ hàng','cart',$data);