<?php

include_once("conn.php")

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            die("用户名和密码不能为空");
        }
        $stmt = $pdo->prepare("SELECT id, username, password, salt FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("用户不存在");
        }

        //fix: 老用户默认8位数字密码，太弱了，添加盐进行增强
        $saltedPassword = md5($password) . md5($user['salt']);
        $finalHash = md5($saltedPassword);
        if ($user['password'] ==  $finalHash){
            echo "登录成功！欢迎 " . htmlspecialchars($user['username']);
        } else {
            echo "密码错误";
        }
    }
} catch (PDOException $e) {
    die("数据库连接失败: " . $e->getMessage());
}
?>

<!-- 登录表单 -->
<form method="post" action="">
    <label>用户名：<input type="text" name="username" required></label><br>
    <label>密码：<input type="password" name="password" required></label><br>
    <button type="submit">登录</button>
</form>