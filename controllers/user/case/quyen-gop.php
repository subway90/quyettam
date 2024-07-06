<?php
$status = $amount = 0;
$result_status = $code_bank = $banner = $qr_name = $qr_amount = $qr_image = $qr_content = $qr_token = $qr_info_host = '';
$choose_pay = true;
$continue = $success = $qr_method = $vnpay_method = $momo_method = $array_bank_vietqr = $qr_show = $qr_check = false;

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

# [CHOOSE METHOD PAY]
if(isset($arrayURL[1]) && $arrayURL[1]) {
    $type_method_pay = $arrayURL[1];
    if($type_method_pay === 'qr') {
        if(isset($arrayURL[2]) && $arrayURL[2] == 'check') {
            $qr_check = true;
        }else $qr_method = true;
        $choose_pay = false;
    }
    if($type_method_pay === 'vnpay') {
        $vnpay_method = true;
        $choose_pay = false;
    }
    if($type_method_pay === 'momo') {
        $momo_method = true;
        $choose_pay = false;
    }
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
    }else alert('Vui lòng nhập họ và tên của bạn !');

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

# [CREATE QR PAY]
if(isset($_POST['createQR'])) {
    // họ và tên
    if($_POST['name']) {
        $_SESSION['name_donate'] = $_POST['name'];
        // if($_POST['code_bank']) {
            // $code_bank = $_POST['code_bank'];
            // số tiền donate
            if(isset($_POST['chooseAmount'])) {
                if($_POST['chooseAmount']) $amount = $_POST['chooseAmount'];
                else $amount = $_POST['chooseAmountOther'];
                $continue = true;
            }else {
                alert('Vui lòng chọn số tiền quyên góp !');
                $continue = false;
            };
        // }else alert('Vui lòng chọn ngân hàng của bạn !');
    }else alert('Vui lòng nhập họ và tên của bạn !');

    if($continue) {
        $qr_bank_name_host = 'Ngân hàng TMCP Việt Á';
        $qr_bank_code_host = 'VietABank';
        $qr_bank_id_host = '00189182';
        $qr_bank_user_host = 'NGUYEN MINH HIEU';
        $qr_info_host = $qr_bank_name_host.' | '.$qr_bank_code_host.' | số TK : '.$qr_bank_id_host.' | chủ TK : '.$qr_bank_user_host;
        $qr_token = create_token(6);
        $qr_amount = $amount;
        $qr_name = $_SESSION['name_donate'];
        $qr_content = 'QT'.$qr_token.' '.remove_mark_string($qr_name).' ung ho '.$qr_amount.' VND';
        $qr_image = 'https://img.vietqr.io/image/vietabank-00189182-print.png?amount='.$amount.'&addInfo='.$qr_content.'&accountName=Nguyen Minh Hieu';
        $qr_method = false;
        $qr_show = true;
    }
}

# [QR CHECK]
if($qr_check) {
    if(isset($arrayURL[3]) && $arrayURL[3]) {
        $token_check_qr = str_replace(['"',"'"],'',$arrayURL[3]);
        $result_check_qr = get_one_donate($token_check_qr);
        if($result_check_qr) echo 'Đang cập nhật';
        else alert('Giao dịch của bạn không tồn tại');
    }else view_404('user');
}

# [BANNER]
$array_top_donate = pdo_query(
    'SELECT name, SUM(amount) amount  FROM donates 
    WHERE status = 1
    GROUP BY name
    ORDER BY amount DESC 
    LIMIT 5'
);
for ($i=1; $i <= count($array_top_donate ); $i++) {
    extract($array_top_donate[$i-1]);
    $banner .= '
    <span class="px-5 border-start border-end">
            <strong class="text-warning">[TOP '.$i.']</strong> 
            Vinh danh bạn <strong class="text-danger">'.$name.'</strong> 
            đã quyên góp <strong class="text-danger">'.number_format($amount).' <sup>vnđ</sup></strong>
    </span>
    ';
}

# [DATA]
$data = [
    'banner' => $banner,
    'choose_pay' => $choose_pay,
    'qr_method' => $qr_method,
    'vnpay_method' => $vnpay_method,
    'momo_method' => $momo_method,
    'success' => $success,
    'result_status' => $result_status,
    'name' => $_SESSION['name_donate'],
    'qr_show' => $qr_show,
    'qr_name' => $qr_name,
    'qr_amount' => $qr_amount,
    'qr_image' => $qr_image,
    'qr_content' => $qr_content,
    'qr_token' => $qr_token,
    'qr_info_host' => $qr_info_host,
];

# [VIEW]
view('Quyên góp', 'donate', $data);