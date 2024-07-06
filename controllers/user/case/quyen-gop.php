<?php
$status = $amount = 0;
$result_status = '';
$success = false;

# [BANNER]
$array_top_donate = 1;
$banner = '<span class="px-5 border-start border-end">
            <strong class="text-warning">[TOP 1]</strong> Vinh danh bạn <strong class="text-danger">Minh Hiếu</strong> đã quyên góp <strong class="text-danger">100,000 <sup>vnđ</sup></strong>
        </span>';


# [RETURN]
if (isset($arrayURL[1]) && $arrayURL[1] === 'success') {
    # [VNPAY CODE]
    // xử lí
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

    // kết quả giao dịch
    if ($secureHash == $vnp_SecureHash) {
        if ($_GET['vnp_ResponseCode'] == '00') {
            $status = 1;
            $result_status = '<span class="text-success">Giao dịch thành công</span>';
        }else {
            $status = 2;
            $result_status = '<span class="text-danger">Giao dịch không thành công</span>';
        }
    }else view_404('user'); //giao dịch không hợp lệ
    
    # [SAVE IN DATABSE]

    if($status) {
        // mã token GD
        $token = $_GET['vnp_TxnRef'];
        // kiểm tra donate đã có trên DB chưa
        $check = get_one_donate($token);
        // nếu chưa có -> thực hiện save
        if(!$check) {
            // loại giao dịch [1: vnpay, 2:momo]
            $type = 1;
            // id user
            if($_SESSION['account']) $idUser = $_SESSION['account']['id'];
            else $idUser = 0;
            // name donate
            $name = $_SESSION['name_donate'];
            // fields
            $amount = $_GET['vnp_Amount']/100;
            $message = $_GET['vnp_OrderInfo'];
            $resCode = $_GET['vnp_ResponseCode'];
            $vnpayCode = $_GET['vnp_TransactionNo'];
            $bankCode = $_GET['vnp_BankCode'];
            $timePay =  $_GET['vnp_PayDate'];
            // save DB
            pdo_execute (
                'INSERT INTO donates (token,idUser,name,amount,message,type,resCode,vnpayCode,bankCode,timePay,status)
                    VALUES ("'.$token.'",'.$idUser.',"'.$name.'",'.$amount.',"'.$message.'",'.$type.',"'.$resCode.'","'.$vnpayCode.'","'.$bankCode.'","'.$timePay.'" ,'.$status.')'
            );
        }
    }
    // bật view success
    $success = true;
}

# [CREATE VNPAY]
if (isset($_POST['createVnpay'])) {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // họ và tên
    if($_POST['name']) {
        $_SESSION['name_donate'] = $_POST['name'];
        // số tiền donate
        if(isset($_POST['chooseAmount'])) {
            if($_POST['chooseAmount']) $amount = $_POST['chooseAmount'];
            else $amount = $_POST['chooseAmountOther'];
            $continue = true;
        }else {
            alert('Vui lòng chọn số tiền quyên góp !');
            $continue = false;
        };
    }else {
        alert('Vui lòng nhập họ và tên của bạn !');
        $continue = false;
    }
    

    if($continue) {
        // cấu hình vnpay
        $vnp_TxnRef = create_token_donate(); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $amount; // Số tiền thanh toán
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán [vn/en]
        $vnp_BankCode = ''; //Mã phương thức thanh toán ['','VNPAYQR','VNBANK','INTCARD']
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
}

# [DATA]
$data = [
    'banner' => $banner,
    'success' => $success,
    'result_status' => $result_status,
    'name' => $_SESSION['name_donate'],
];

# [VIEW]
view('Quyên góp', 'donate', $data);