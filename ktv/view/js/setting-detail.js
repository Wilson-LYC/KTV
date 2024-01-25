function updateUser(){
    var id=document.getElementById("id").value;
    var name=document.getElementById("name").value;
    var password=document.getElementById("password").value;
    var index = document.getElementById('group').selectedIndex;
    var groupId=document.getElementById('group').options[index].value;
    //发送请求
    $.ajax({
        url: "/ktv/service/UpdateUserService.php",
        type: "POST",
        data: {
            id: id,
            name: name,
            password: password,
            groupId: groupId
        },success: function (data) {
            if(data === "200"){
                alert("修改成功");
            }else{
                alert("修改失败");
            }
        }
    });
}
function updateRoomType(){
    var id=document.getElementById("id").value;
    var name=document.getElementById("name").value;
    var price=document.getElementById("price").value;
    var capacity=document.getElementById("capacity").value;
    var annotate=document.getElementById("annotate").value;
    //发送请求
    $.ajax({
        url: "/ktv/service/UpdateRoomTypeService.php",
        type: "POST",
        data: {
            id: id,
            name: name,
            price: price,
            capacity: capacity,
            annotate: annotate
        },success: function (data) {
            if(data === "200"){
                alert("修改成功");
            }else{
                alert("修改失败");
            }
        }
    });
}
function updateRoom(){
    var id=document.getElementById("id").value;
    var name = document.getElementById('name').value;
    var floor = document.getElementById('floor').value;
    var index = document.getElementById('typeId').selectedIndex;
    var typeId = document.getElementById('typeId').options[index].value;
    var annotate = document.getElementById('annotate').value;
    //发送请求
    $.ajax({
        url: "/ktv/service/UpdateRoomService.php",
        type: "POST",
        data: {
            id: id,
            name: name,
            floor: floor,
            typeId: typeId,
            annotate: annotate
        },success: function (data) {
            if(data === "200"){
                alert("修改成功");
            }else{
                alert("修改失败");
            }
        }
    });
}

function updateCategory(){
    var id=document.getElementById("id").value;
    var name = document.getElementById('name').value;
    var annotate = document.getElementById('annotate').value;
    //发送请求
    $.ajax({
        url: "/ktv/service/UpdateCategoryService.php",
        type: "POST",
        data: {
            id: id,
            name: name,
            annotate: annotate
        },success: function (data) {
            if(data === "200"){
                alert("修改成功");
            }else{
                alert("修改失败");
            }
        }
    });
}
function updateCommodity(){
    var id=document.getElementById("id").value;
    var name = document.getElementById('name').value;
    var index = document.getElementById('cateId').selectedIndex;
    var cateId = document.getElementById('cateId').options[index].value;
    var price = document.getElementById('price').value;
    var unit=document.getElementById('unit').value;
    var inventory=document.getElementById('inventory').value;
    var annotate = document.getElementById('annotate').value;
    //发送请求
    $.ajax({
        url: "/ktv/service/UpdateCommodityService.php",
        type: "POST",
        data: {
            id: id,
            name: name,
            cateId: cateId,
            price: price,
            unit: unit,
            inventory: inventory,
            annotate: annotate
        },success: function (data) {
            if(data === "200"){
                alert("修改成功");
            }else{
                alert("修改失败");
            }
        }
    });
}