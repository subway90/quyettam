<?php
$username = '';
$remember = 'checked';

# [DATA]
$data = [
    'username' => $username,
    'remember' => $remember,
];
# [RENDER VIEW]
view('Đăng nhập','login',$data);