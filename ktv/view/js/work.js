function checkinForm(id){
    var url = "/ktv/view/work/checkin.php?id="+id;
    window.location.href=url;
}
function checkinSubmit(){
    var roomId=document.getElementById("roomId").value;
    var userId=document.getElementById("userId").value;
    var begTime=document.getElementById("begTime").value;
    var cusName=document.getElementById("cusName").value;
    var cusPhone=document.getElementById("cusPhone").value;
    $.ajax({
        url: "/ktv/service/CheckRoomStateService.php",
        type: "POST",
        data: {
            roomId: roomId
        }
    }).done(function (data) {
        if(data === "400"){
            alert("该房间已使用");
        }
        else {
            $.ajax({
                url: "/ktv/service/CheckinService.php",
                type: "POST",
                data: {
                    roomId: roomId,
                    userId: userId,
                    begTime: begTime,
                    cusName: cusName,
                    cusPhone: cusPhone
                },
                success: function (data) {
                    if(data === "200"){
                        alert("办理成功");
                    }else{
                        alert("办理失败");
                    }
                }
            });
        }
    });
}
function detailForm(id){
    var url = "/ktv/view/work/detail.php?id="+id;
    window.location.href=url;
}
function buyCommForm(orderId,roomId){
    var url= "/ktv/view/work/buy.php?orderId="+orderId+"&roomId="+roomId;
    window.location.href=url;
}
function buyCommSubmit(){
    var orderId=document.getElementById("orderId").value;
    var index=document.getElementById("commId").selectedIndex;
    var commId=document.getElementById("commId").options[index].value;
    var num=document.getElementById("num").value;
    var roomId=document.getElementById("roomId").value;
    $.ajax({
        url: "/ktv/service/BuyCommService.php",
        type: "POST",
        data: {
            orderId: orderId,
            commId: commId,
            num: num
        },success: function (data) {
            if(data === "200"){
                alert("购买成功");
                window.location.href="/ktv/view/work/detail.php?id="+roomId;
            }else{
                alert("购买失败");
            }
        }
    });
}
function checkCommNum(){
    var commId=document.getElementById("commId").value;
    var inventory=document.getElementById("inventory");
    var num=document.getElementById("num");
    $.ajax({
        url: "/ktv/service/CheckCommNumService.php",
        type: "POST",
        data: {
            commId: commId
        },
        success: function (data) {
            inventory.value=data;
            num.max=data;
        }
    });
}
function commDetailForm(orderId,roomId,commId){
    var url= "/ktv/view/work/comm.php?orderId="+orderId+"&roomId="+roomId+"&commId="+commId;
    window.location.href=url;
}
function CommDetailSubmit(){
    var orderId=document.getElementById("orderId").value;
    var commId=document.getElementById("commId").value;
    var num=document.getElementById("num").value;
    var oldNum=document.getElementById("oldNum").value;
    var roomId=document.getElementById("roomId").value;
    if (num === oldNum){
        alert("未修改");
        window.close();
        window.open("/ktv/view/work/detail.php?id="+roomId);
        return;
    }
    $.ajax({
        url: "/ktv/service/CheckCommNumService.php",
        type: "POST",
        data: {
            commId: commId
        },
        success: function (data) {
            if(parseInt(data) < num){
                alert("库存不足");
            }else{
                $.ajax({
                    url: "/ktv/service/UpdateCommBuyService.php",
                    type: "POST",
                    data: {
                        orderId: orderId,
                        commId: commId,
                        updateNum: num-oldNum
                    },success: function (data) {
                        if(data === "200"){
                            alert("修改成功");
                            window.location.href="/ktv/view/work/detail.php?id="+roomId;
                        }else{
                            alert("修改失败");
                        }
                    }
                });
            }
        }
    });
}

function checkoutForm(id){
    var url = "/ktv/view/work/checkout.php?id="+id;
    window.location.href=url;
}
function jsMo(){

    var needPay=document.getElementById("needPay");

    var totalPay=document.getElementById("totalPay").value;

    var discount=document.getElementById("discount").value;
    var a=parseFloat(totalPay)*parseFloat(discount);
    needPay.value=a.toFixed(2);
}
function checkoutSubmit(){
    var orderId=document.getElementById("orderId").value;
    var endT=document.getElementById("endT").value;
    var totalPay=document.getElementById("totalPay").value;
    var discount=document.getElementById("discount").value;
    var actualPay=document.getElementById("actualPay").value;
    var annotate=document.getElementById("annotate").value;
    $.ajax({
        url: "/ktv/service/CheckoutService.php",
        type: "POST",
        data: {
            orderId: orderId,
            endT: endT,
            totalPay: totalPay,
            discount: discount,
            actualPay: actualPay,
            annotate: annotate
        },success: function (data) {
            if(data === "200"){
                alert("结账成功");
                window.location.href="/ktv/view/work/index.php";
            }else{
                alert("结账失败");
            }
        }
    });
}

function resetSearch(){
    var url = "/ktv/view/work/index.php";
    window.location.href=url;
}