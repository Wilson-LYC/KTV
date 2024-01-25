//user
function openUserDetail(id){
    var url= "/ktv/view/setting/detail/user.php?id="+id;
    window.location.href=url;
}
function resetListUserSearch(){
    var url= "/ktv/view/setting/list/user.php";
    window.location.href=url;
}
function deleteUser(id){
    if(confirm("确定要删除吗？")){
        //判断管理员人数是否大于1
        $.ajax({
           url: "/ktv/service/CheckUserAdminCountService.php",
            type: "GET",
            success: function (data) {
                if(data === "400"){
                    alert("管理员人数不能少于1人，不能删除");
                    return;
                }
                else {
                    $.ajax({
                        url: "/ktv/service/DeleteUserService.php",
                        type: "POST",
                        data: {
                            id: id
                        },success: function (data) {
                            if(data === "200"){
                                alert("删除成功");
                                window.location.reload();
                            }else{
                                alert("删除失败");
                            }
                        }
                    });
                }
            }
        });
    }
}

//roomtype
function openRoomTypeDetail(id){
    var url= "/ktv/view/setting/detail/roomtype.php?id="+id;
    window.location.href=url;
}
function deleteRoomtype(id){
    if(confirm("确定要删除吗？")){
        var aid="roomnum-"+id;
        var num=document.getElementById(aid).innerHTML;
        if(num>0){
            alert("该类型下有"+num+"个房间，不能删除");
            return;
        }
        $.ajax({
            url: "/ktv/service/DeleteRoomTypeService.php",
            type: "POST",
            data: {
                id: id
            },success: function (data) {
                if(data === "200"){
                    alert("删除成功");
                    window.location.reload();
                }else{
                    alert("删除失败");
                }
            }
        });
    }
}
function resetListRoomTypeSearch(){
    var url= "/ktv/view/setting/list/roomtype.php";
    window.location.href=url;
}
//room
function openRoomDetail(id){
    var url= "/ktv/view/setting/detail/room.php?id="+id;
    window.location.href=url;
}
function deleteRoom(id){
    if(confirm("确定要删除吗？")){
        var aid="state-"+id;
        var state=document.getElementById(aid).innerHTML;
        if(state==="使用中"){
            alert("该房间正在使用中，不能删除");
            return;
        }
        $.ajax({
            url: "/ktv/service/DeleteRoomService.php",
            type: "POST",
            data: {
                id: id
            },success: function (data) {
                if(data === "200"){
                    alert("删除成功");
                    window.location.reload();
                }else{
                    alert("删除失败");
                }
            }
        });
    }
}
function resetListRoomSearch(){
    var url= "/ktv/view/setting/list/room.php";
    window.location.href=url;
}
//category
function openCategoryDetail(id){
    var url= "/ktv/view/setting/detail/category.php?id="+id;
    window.location.href=url;
}
function deleteCategory(id){
    if(confirm("确定要删除吗？")){
        var aid="num-"+id;
        var num=document.getElementById(aid).innerHTML;
        if(num>0){
            alert("该类型下有"+num+"个商品，不能删除");
            return;
        }
        $.ajax({
            url: "/ktv/service/DeleteCategoryService.php",
            type: "POST",
            data: {
                id: id
            },success: function (data) {
                if(data === "200"){
                    alert("删除成功");
                    window.location.reload();
                }else{
                    alert("删除失败");
                }
            }
        });
    }
}

//commodity
function openCommodityDetail(id){
    var url= "/ktv/view/setting/detail/commodity.php?id="+id;
    window.location.href=url;
}
function deleteCommodity(id){
    if(confirm("确定要删除吗？")){
        $.ajax({
            url: "/ktv/service/DeleteCommodityService.php",
            type: "POST",
            data: {
                id: id
            },success: function (data) {
                if(data === "200"){
                    alert("删除成功");
                    window.location.reload();
                }else{
                    alert("删除失败");
                }
            }
        });
    }
}
function resetListCommoditySearch(){
    var url= "/ktv/view/setting/list/commodity.php";
    window.location.href=url;
}

//order
function openOrderDetail(id){
    var url= "/ktv/view/setting/detail/order.php?id="+id;
    window.location.href=url;
}
function deleteOrder(id,flag){
    if(confirm("确定要删除吗？")){
        if(flag===0){
            alert("该订单未结账，不能删除");
            return;
        }
        else {
            $.ajax({
                url: "/ktv/service/DeleteOrderService.php",
                type: "POST",
                data: {
                    id: id
                },success: function (data) {
                    if(data === "200"){
                        alert("删除成功");
                        window.location.reload();
                    }else{
                        alert("删除失败");
                    }
                }
            });
        }
    }
}
function resetListOrderSearch(){
    var url= "/ktv/view/setting/list/order.php";
    window.location.href=url;
}