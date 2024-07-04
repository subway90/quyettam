<?php
if($_SESSION['account']) header('Location:'.URL);
$user = '';
$remember = 'checked';
# [LOGIN]
if(isset($_POST['login'])) {
    isset($_POST['remember']) ? $remember = 'checked' : $remember = '';
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if($user) {
        if($pass) {
            $account = get_one_account_by_username($user);
            if($account) {
                if($account['pass'] === md5($pass)) {
                    if($remember) {
                        TOKEN:
                        $token_user = create_token(10);
                        if(!check_token_user_exits($token)) setcookie('remember',$token_user,time()+86400*365*2);
                        else goto TOKEN;
                        pdo_execute('UPDATE accounts SET tokenRemember = "'.$token_user.'" WHERE id = '.$account['id']);
                    }
                    $_SESSION['account'] = $account;
                    header('Location:'.URL);
                }else alert('Mật khẩu không chính xác');
            }else alert('Tài khoản không tồn tại');
        }else alert('Vui lòng nhập mật khẩu');
    }else alert('Vui lòng nhập tài khoản');
}
# [DATA]
$data = [
    'user' => $user,
    'remember' => $remember,
];
# [RENDER VIEW]
view('Đăng nhập','login',$data);