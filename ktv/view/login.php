<html>
<head>
    <title>登录</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/login.js"></script>
</head>
<body>
    <div class="container">
        <div class="title">
            <div class="logo">
                <img src="/ktv/public/img/logo.png">
            </div>
            <div class="title-text">
                <p>KTV包房管理系统</p>
            </div>
        </div>
        <div class="from" onsubmit=login()>
            <form>
                <input type="text" class="filed" id="username" placeholder="用户名">
                <input type="password" class="filed" id="password" placeholder="密码">
                <input type="submit" class="submit" id="submit" value="登录">
            </form>
        </div>
    </div>
</body>
</html>