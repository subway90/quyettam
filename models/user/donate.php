<?php 
/**
 * Hàm này dùng để tạo mới token donate
 */
function create_token_donate() {
    CTD:
    $token = create_token(10);
    $check = pdo_query_one(
        'SELECT status FROM donates WHERE token ="'.$token.'"'
    );
    if(!$check) return $token;
    else goto CTD;
}

/**
 * Hàm này dùng để lấy 1 dòng donate bởi token, trả về TRUE (array) nếu tồn tại, trả về FALSE (bool) nếu không tồn tại
 * @param string $token mã token của dòng donate cần lấy
 */
function get_one_donate ($token) {
    $check = pdo_query_one(
        'SELECT status FROM donates WHERE token ="'.$token.'"'
    );
    if($check) return $check;
    else return false;
}

/**
 * Hàm này dùng để trả về API LIST BANK của VietQR
 * Trả về TRUE (array) nếu api active, trả về FALSE (bool) nếu api not active
 * data array : ["code","name"]
 */
function list_bank_viet_qr() {
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
       
        // Tạo mảng chứa các object có code và name
        $array_code_bank = array_map(function($item) {
            return [
                'code' => $item['code'],
                'name' => $item['name'],
                'shortName' => $item['shortName'],
            ];
        }, $data['data']);
    }

    // Đóng kết nối cURL
    curl_close($curl);
    
    if($error) return false;
    else return $array_code_bank;
}