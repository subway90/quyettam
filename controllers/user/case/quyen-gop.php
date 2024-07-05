<?php

# RETURN
if (isset($arrayURL[1]) && $arrayURL[1] === 'success') {
    # [VNPAY CODE]
    $vnp_SecureHash = $_GET['vnp_SecureHash'];

    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);

    $hashData = "";
    $i = 0;
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    // $result_status [changed by subway90]
    if ($secureHash == $vnp_SecureHash) {
        if ($_GET['vnp_ResponseCode'] == '00')
            $result_status = '<span class="text-success">Giao dịch thành công</span>';
        else
            $result_status = '<span class="text-danger">Giao dịch không thành công</span>';
    } else
        $result_status = '<span class="text-warning">Giao dịch không hợp lệ</span>';

    # [DATA]
    $data = [
        'success' => true,
        'secureHash' => $secureHash,
        'vnp_SecureHash' => $vnp_SecureHash,
        'result_status' => $result_status,
    ];
    # [VIEW]
    view('Quyên góp', 'donate', $data);
}

# CREATE VNPAY
if (isset($_POST['createVnpay'])) {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    /**
     * 
     *
     * @author CTT VNPAY
     */

    $vnp_TxnRef = time(); //Mã giao dịch thanh toán tham chiếu của merchant
    $vnp_Amount = $_POST['amount']; // Số tiền thanh toán
    $vnp_Locale = $_POST['language']; //Ngôn ngữ chuyển hướng thanh toán
    $vnp_BankCode = $_POST['bankCode']; //Mã phương thức thanh toán
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount * 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $expire
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    header('Location: ' . $vnp_Url);
    die();
}



view('Quyên góp', 'donate', null);