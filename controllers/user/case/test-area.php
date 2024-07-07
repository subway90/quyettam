<?php

// Sử dụng thư viện cURL để gửi yêu cầu HTTP
$curl = curl_init();
$error = false;
// Thiết lập URL và các tùy chọn cURL
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.vietqr.io/v2/banks',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
)
);

// Gửi yêu cầu và lấy phản hồi
$response = curl_exec($curl);

// Kiểm tra lỗi, nếu có
if (curl_errno($curl)) {
    $error = true;
    echo 'Lỗi cURL: ' . curl_error($curl);
} else {
    // Giải mã JSON thành mảng PHP
    $data = json_decode($response, true);

    // Tạo mảng chỉ chứa các giá trị 'code'
    // $array_code_bank = array_column($data['data'], 'code');

    // In ra mảng
    // print_r($array_code_bank);

    // Tạo mảng chứa các object có code và name
    $array_code_bank = array_map(function($item) {
        return [
            'code' => $item['code'],
            'name' => $item['name'],
        ];
    }, $data['data']);
}

// Đóng kết nối cURL
curl_close($curl);
# [DATA]
$data = [
    'error' => $error,
    'array_code_bank' => $array_code_bank,
];

# [RENDER VIEW]
view('Khu vực kiểm thử', 'test', $data);