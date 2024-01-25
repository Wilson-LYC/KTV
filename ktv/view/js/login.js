function login(){
    var name = $("#username").val();
    var password = $("#password").val();
    //如果用户名或密码为空
    if(username === "" || password === ""){
        alert("用户名或密码不能为空");
        return;
    }
    $.ajax({
        url: "/ktv/service/LoginService.php",
        type: "POST",
        data: {
            name: name,
            password: password
        },
        success: function (data) {
            if(data === "200"){
                window.location.href = "/ktv/index.php";
            }else{
                alert("用户名或密码错误");
            }
        },
        error: function (data) {
            alert("登录失败");
        }
    });
}