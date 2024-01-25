function logout() {
    $.ajax({
        url: "/ktv/service/LogoutService.php",
        type: "POST",
        success: function (data) {
            if (data === "200") {
                window.location.href = "/ktv/view/login.php";
            } else {
                alert("退出失败");
            }
        },
        error: function (data) {
            alert("Error");
        }
    });
}