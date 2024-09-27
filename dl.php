<?php
include 'mysql.php';
// 创建连接
$conn = new mysqli($host, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 检查是否通过URL传递了url参数
if (isset($_GET['url'])) {
    $normal = $conn->real_escape_string($_GET['url']);

    // 生成8位随机字符串
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shorten = '';
    for ($i = 0; $i < 8; $i++) {
         $shorten .= $characters[rand(0, strlen($characters) - 1)];
}

    // 插入数据到数据库
    $sql = "INSERT INTO main (normal, shorten, time, click) VALUES ('$normal', '$shorten', NOW(), 0)";

    if ($conn->query($sql) === TRUE) {
        echo "新记录插入成功";
        echo "<br>短链编码: " . $shorten; // 输出生成的shorten值
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "No URL provided.";
}

$conn->close();
?>