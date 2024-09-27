<?php
include 'mysql.php';
// 创建PDO实例并连接到数据库
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // 设置PDO错误模式为异常
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// 获取URL中的path参数
$path = isset($_GET['path']) ? $_GET['path'] : '';

// 准备SQL语句和绑定参数
$sql = "SELECT normal FROM main WHERE shorten = :shorten";
$stmt = $pdo->prepare($sql);

// 绑定参数并执行查询
$stmt->bindParam(':shorten', $path);
$stmt->execute();

// 获取查询结果
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// 检查是否找到记录并处理结果
if ($result) {
    // 如果找到了记录，设置重定向的 URL
    $redirectUrl = $result['normal'];
} else {
    // 如果没有找到记录，设置重定向到404页面的 URL
    $redirectUrl = "/404.html";
}
// 关闭数据库连接
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <script>
        // 设置延迟时间为3000毫秒（3秒）
        function delayedRedirect() {
            setTimeout(function() {
                window.location.href = "<?= htmlspecialchars($redirectUrl) ?>";
            }, 3000);
        }
    </script>
</head>
<body onload="delayedRedirect();">
    <h1>欢迎使用短链服务</h1>
    <p>3秒后自动跳转，请稍后......</p>

</body>
</html>