<?php
$status = $amount = 0;
$result_status = $code_bank = $banner = $qr_name = $qr_amount = $qr_image = $qr_content = $qr_token = $qr_info_host = $result_method = '';
$choose_pay = false;
$continue = $success = $qr_method = $vnpay_method = $momo_method = $array_bank_vietqr = $qr_show = $qr_check = $result_momo = false;
$array_method = ['qr', 'vnpay', 'momo'];

# [BOOL VIEW CHOOSE PAY]
if(!isset($arrayURL[1])) $choose_pay = true;

# [RETURN - STATUS]
if (isset($arrayURL[2]) && $arrayURL[2] === 'check') {
    if (in_array($arrayURL[1], $array_method)) {
        $result_method = $arrayURL[1];
        # [VNPAY RESULT]    
        if ($result_method === 'vnpay') {
            if (isset($_GET['vnp_SecureHash']) && $_GET['vnp_SecureHash']) {
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
                    } else {
                        $status = 2;
                        $result_status = '<span class="text-danger">Giao dịch không thành công</span>';
                    }
                } else
                    view_404('user'); //giao dịch không hợp lệ

                // lưu vào DB
                if ($status) {
                    // mã token GD
                    $token = $_GET['vnp_TxnRef'];
                    // kiểm tra donate đã có trên DB chưa
                    $check = get_one_donate($token);
                    // nếu chưa có -> thực hiện save
                    if (!$check) {
                        // loại giao dịch [1: vnpay, 2:momo]
                        $type = 1;
                        // id user
                        if ($_SESSION['account'])
                            $idUser = $_SESSION['account']['id'];
                        else
                            $idUser = 0;
                        // name donate
                        $name = $_SESSION['name_donate'];
                        // fields
                        $amount = $_GET['vnp_Amount'] / 100;
                        $message = $_GET['vnp_OrderInfo'];
                        $resCode = $_GET['vnp_ResponseCode'];
                        $vnpayCode = $_GET['vnp_TransactionNo'];
                        $bankCode = $_GET['vnp_BankCode'];
                        $timePay = $_GET['vnp_PayDate'];
                        // save DB
                        pdo_execute(
                            'INSERT INTO donates (token,idUser,name,amount,message,type,resCode,vnpayCode,bankCode,timePay,status)
                                VALUES ("' . $token . '",' . $idUser . ',"' . $name . '",' . $amount . ',"' . $message . '",' . $type . ',"' . $resCode . '","' . $vnpayCode . '","' . $bankCode . '","' . $timePay . '" ,' . $status . ')'
                        );
                    }
                }
                // bật view success
                $success = true;
            } else
                view_404('user');
        }
        # [MOMO RESULT]
        if ($result_method === 'momo') {
            // bools view
            $result_momo = true;

            //request
            $partnerCode = $_GET["partnerCode"];
            $orderId = $_GET["orderId"];
            $requestId = $_GET["requestId"];
            $amount = $_GET["amount"];
            $orderInfo = $_GET["orderInfo"];
            $orderType = $_GET["orderType"];
            $transId = $_GET["transId"];
            $resultCode = $_GET["resultCode"];
            $message = $_GET["message"];
            $payType = $_GET["payType"];
            $responseTime = $_GET["responseTime"];
            $extraData = $_GET["extraData"];
            $resultCode = $_GET["resultCode"];
            $m2signature = $_GET["signature"]; //MoMo signature
            //Checksum
            $rawHash = "accessKey=" . MOMO_ACCESS_KEY . "&amount=" . $amount . "&extraData=" . $extraData . "&message=" . $message . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&orderType=" . $orderType . "&partnerCode=" . $partnerCode . "&payType=" . $payType . "&requestId=" . $requestId . "&responseTime=" . $responseTime . "&resultCode=" . $resultCode . "&transId=" . $transId;
            //Signature Verify
            $partnerSignature = hash_hmac("sha256", $rawHash, MOMO_SECRET_KEY);
            //status
            if ($m2signature == $partnerSignature) {
                if ($resultCode == '0') {
                    $status = 1;
                } else {
                    $status = 2;
                }
            }else view_404('user');
            $abc = 'Test data() thành công';
            # DATA
            $data = [
                'orderId' => $orderId,
                'amount' => $amount,
                'orderType' => $orderType,
                'requestId' => $requestId,
                'abc' => $abc,
            ];
        }
    }
}


# [CHOOSE METHOD PAY]
if (isset($arrayURL[1]) && $arrayURL[1] &&(!isset($arrayURL[2]))) {
    $type_method_pay = $arrayURL[1];
    if (in_array($type_method_pay, $array_method)) {
        if ($type_method_pay === 'qr')
            $qr_method = true;
        if ($type_method_pay === 'vnpay')
            $vnpay_method = true;
        if ($type_method_pay === 'momo')
            $momo_method = true;
        $choose_pay = false;
    }
}
# [CREATE VNPAY]
if (isset($_POST['createVnpay'])) {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // họ và tên
    if ($_POST['name']) {
        $_SESSION['name_donate'] = $_POST['name'];
        // số tiền donate
        if (isset($_POST['chooseAmount'])) {
            if ($_POST['chooseAmount'])
                $amount = $_POST['chooseAmount'];
            else
                $amount = $_POST['chooseAmountOther'];
            $continue = true;
        } else
            alert('Vui lòng chọn số tiền quyên góp !');
    } else
        alert('Vui lòng nhập họ và tên của bạn !');

    if ($continue) {
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
if (isset($_POST['createQR'])) {
    // họ và tên
    if ($_POST['name']) {
        $_SESSION['name_donate'] = $_POST['name'];
        // số tiền donate
        if (isset($_POST['chooseAmount'])) {
            if ($_POST['chooseAmount'])
                $amount = $_POST['chooseAmount'];
            else
                $amount = $_POST['chooseAmountOther'];
            $continue = true;
        } else
            alert('Vui lòng chọn số tiền quyên góp !');
    } else
        alert('Vui lòng nhập họ và tên của bạn !');

    if ($continue) {
        $qr_bank_name_host = 'Ngân hàng TMCP Việt Á';
        $qr_bank_code_host = 'VietABank';
        $qr_bank_id_host = '00189182';
        $qr_bank_user_host = 'NGUYEN MINH HIEU';
        $qr_info_host = $qr_bank_name_host . ' | ' . $qr_bank_code_host . ' | số TK : ' . $qr_bank_id_host . ' | chủ TK : ' . $qr_bank_user_host;
        $qr_token = create_token(6);
        $qr_amount = $amount;
        $qr_name = $_SESSION['name_donate'];
        $qr_content = 'QT' . $qr_token . ' ' . remove_mark_string($qr_name) . ' ung ho ' . $qr_amount . ' VND';
        $qr_image = 'https://img.vietqr.io/image/vietabank-00189182-print.png?amount=' . $amount . '&addInfo=' . $qr_content . '&accountName=Nguyen Minh Hieu';
        $qr_method = false;
        $qr_show = true;
    }
}

# [CREATE MOMO PAY]
if (isset($_POST['createMomo'])) {
    // họ và tên
    if ($_POST['name']) {
        $_SESSION['name_donate'] = $_POST['name'];
        // số tiền donate
        if (isset($_POST['chooseAmount'])) {
            if ($_POST['chooseAmount'])
                $amount = $_POST['chooseAmount'];
            else
                $amount = $_POST['chooseAmountOther'];
            $continue = true;
        } else
            alert('Vui lòng chọn số tiền quyên góp !');
    } else
        alert('Vui lòng nhập họ và tên của bạn !');

    // api momo
    if (1==2) {
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data)
                )
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }

        // configs
        $endpoint = MOMO_ENDPOINT;
        $partnerCode = MOMO_PARTNER_CODE;
        $accessKey = MOMO_ACCESS_KEY;
        $secretKey = MOMO_SECRET_KEY;
        $redirectUrl = MOMO_REDIRECT_URL;
        $orderId = create_token_donate(); // mã hóa đơn [token row]
        $orderInfo = 'QT.MOMO.' . $orderId . ' - ' . $_SESSION['name_donate'] . ' ung ho ' . $amount . ' VND'; // nội dung thanh toán
        $ipnUrl = MOMO_IPN_URL;
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        // before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        header('Location:' . $jsonResult['payUrl']);
    }
}

# [QR CHECK]
if ($qr_check) {
    if (isset($arrayURL[3]) && $arrayURL[3]) {
        $token_check_qr = str_replace(['"', "'"], '', $arrayURL[3]);
        $result_check_qr = get_one_donate($token_check_qr);
        if ($result_check_qr)
            echo 'Đang cập nhật';
        else
            alert('Giao dịch của bạn không tồn tại');
    } else
        view_404('user');
}

# [BANNER]
$array_top_donate = pdo_query(
    'SELECT name, SUM(amount) amount  FROM donates 
    WHERE status = 1
    GROUP BY name
    ORDER BY amount DESC 
    LIMIT 5'
);
for ($i = 1; $i <= count($array_top_donate); $i++) {
    extract($array_top_donate[$i - 1]);
    $banner .= '
    <span class="px-5 border-start border-end">
            <strong class="text-warning">[TOP ' . $i . ']</strong> 
            Vinh danh bạn <strong class="text-danger">' . $name . '</strong> 
            đã quyên góp <strong class="text-danger">' . number_format($amount) . ' <sup>vnđ</sup></strong>
    </span>
    ';
}

# [DATA]
$data += [
    'banner' => $banner,
    'choose_pay' => $choose_pay,
    'qr_method' => $qr_method,
    'vnpay_method' => $vnpay_method,
    'momo_method' => $momo_method,
    'success' => $success,
    'result_status' => $result_status,
    'name' => $_SESSION['name_donate'],
    #qr created
    'qr_show' => $qr_show,
    'qr_name' => $qr_name,
    'qr_amount' => $qr_amount,
    'qr_image' => $qr_image,
    'qr_content' => $qr_content,
    'qr_token' => $qr_token,
    'qr_info_host' => $qr_info_host,
    # show result
    'result_momo' => $result_momo,
];

# [VIEW]
view('Quyên góp', 'donate',$data);