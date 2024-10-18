<?php
# [HANDLE DATA]

#AUTHOR
$admin = false;
if($_SESSION['account'] && $_SESSION['account']['role'] === 1) $admin = true;


# REFRESH
if(isset($_POST['refresh_data'])) if($admin) pdo_execute('DELETE FROM xss_comment');
# INSERT
if(isset($_GET['name']) && $_GET['name']) {
    if(isset($_GET['content']) && $_GET['content']) {
        $sql = 'INSERT INTO `xss_comment` (`name`, `content`) VALUES ("' .$_GET['name']. '","' .$_GET['content']. '")';
        pdo_execute(
            $sql
        );
        header("Location: ".URL."test-area");
    }
}

# SELECT
$list_comment = pdo_query(
    'SELECT * FROM xss_comment ORDER BY create_at DESC'
);



# [ASSIGN DATA]
$data = [
    'your_ip' => get_ip(),
    'list_cmt' => $list_comment,
    'count_cmt' => count($list_comment),
];

# [RENDER VIEW]
view('Khu vực kiểm thử', 'test', $data);