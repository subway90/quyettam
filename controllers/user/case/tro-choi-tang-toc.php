<?php
$name = $result = $reason_band = '';
$success_result = $admin = false;
if(isset($_COOKIE['ttt'])) $success_result = true;
if($_SESSION['account'] && $_SESSION['account']['role'] === 1) $admin = true;

# [SUBMIT SETTING]
if(isset($_POST['status_result_show'])) {
    if($admin) pdo_execute('UPDATE setting_game SET status_result = 2');
}
if(isset($_POST['status_result_hide'])) {
    if($admin) pdo_execute('UPDATE setting_game SET status_result = 1');
}
if(isset($_POST['status_active_true'])) {
    if($admin) pdo_execute('UPDATE setting_game SET status_active = 1');
}
if(isset($_POST['status_active_false'])) {
    if($admin) pdo_execute('UPDATE setting_game SET status_active = 2');
}
if(isset($_POST['refresh'])) {
    if($admin) pdo_execute('UPDATE result_game SET status = 3');
}

# [SETTING]
$setting_game = pdo_query_one(
    'SELECT * FROM setting_game'
);
$data += [
    'admin' => $admin,
    'status_result' => $setting_game['status_result'],
    'status_active' => $setting_game['status_active'],
];

# [SUBMIT]
if(isset($_POST['submit']) && $setting_game['status_active'] == '1') {
    $name = str_replace(["'",'"','<','>','='],'',$_POST['name']);
    $result = str_replace(["'",'"','<','>','='],'',$_POST['result']);
    if($name) {
        if($result) {
            $token = create_token(6);
            setcookie('ttt',$token,time()+86400*365*2);
            pdo_execute(
                'INSERT INTO result_game (token,name,value) VALUES ("'. $token .'","'. $name .'","'. $result .'")'
            );
            header('Location:'.URL.'tro-choi-tang-toc');
        }else alert('Bạn chưa điền nội dung đáp án !');
    }else alert('Bạn chưa nhập họ và tên !');
}

# [TABLE RESULT]
if(isset($arrayURL[1]) && $arrayURL[1] === 'bang-ket-qua') {
    $list_result = pdo_query(
        'SELECT * FROM result_game WHERE status < 3 ORDER BY date_create ASC'
    );
    $data += [
        'list_result' => $list_result,
        'reason_band' => $reason_band,
    ];
    view('Bảng kết quả','bang-ket-qua',$data);
    exit;
}

# [DATA]
$data += [
    'name' => $name,
    'result' => $result,
    'success_result' => $success_result,
];

# [VIEW]
view('Trò chơi tăng tốc','tro-choi-tang-toc',$data);