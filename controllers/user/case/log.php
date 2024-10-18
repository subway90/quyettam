<?php
# [HANDLE DATA]
#AUTHOR
$admin = false;
if($_SESSION['account'] && $_SESSION['account']['role'] === 1) $admin = true;
# REFRESH
if(isset($_POST['refresh_data'])) if($admin) pdo_execute('DELETE FROM xss_log');
# DISTINCT
$distinct = false;
if(isset($_POST['distinct_data'])) $distinct = pdo_query('SELECT DISTINCT address, content FROM xss_log ORDER BY id DESC');
# DEFAULT
if(isset($_POST['default_data'])) $distinct = false;
#INSERT
if(isset($_GET['content']) && $_GET['content']) {
    pdo_execute(
        'INSERT INTO `xss_log` (`address`, `content`) VALUES ("' .$_GET['address']. '","' .$_GET['content']. '")'
    );
}

# SELECT
$list_data_log = pdo_query(
    'SELECT * FROM xss_log ORDER BY id DESC'
);

# [ASSIGN DATA]
$data = [
    'list_data_log' => $list_data_log,
    'distinct' => $distinct,
    'admin' => $admin,
];

# [RENDER VIEW]
view('Log data','log',$data);