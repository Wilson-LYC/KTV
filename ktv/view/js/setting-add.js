function addUser(){
    var name = document.getElementById('name').value;
    var password = document.getElementById('password').value;
    var index = document.getElementById('group').selectedIndex;
    var groupId = document.getElementById('group').options[index].value;
    //发送请求
    $.ajax({
        url: "/ktv/service/AddUserService.php",
        type: "POST",
        data: {
            name: name,
            password: password,
            groupId: groupId
        },success: function (data) {
            if(data === "200"){
                alert("添加成功");
            }else{
                alert("添加失败");
            }
        }
    });
}
function checkUserName(){
    var name = document.getElementById('name').value;
    var error= document.getElementById('username-error');
    var submitBt=document.getElementById('add-submit');
    $.ajax({
        url: "/ktv/service/CheckUserNameService.php",
        type: "POST",
        data: {
            name: name
        },success: function (data) {
            if(data === "200"){
                error.innerHTML = "用户名可用，创建后不可修改";
                submitBt.disabled=false;
            }else{
                error.innerHTML = "用户名已存在，请更换";
                submitBt.disabled=true;
            }
        }
    });
}
function addRoomType(){
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var capacity = document.getElementById('capacity').value;
    var annotation = document.getElementById('annotation').value;
    //发送请求
    $.ajax({
        url: "/ktv/service/AddRoomTypeService.php",
        type: "POST",
        data: {
            name: name,
            price: price,
            capacity: capacity,
            annotation: annotation
        },success: function (data) {
            if(data === "200"){
                alert("添加成功");
            }else{
                alert("添加失败");
            }
        }
    });
}
function addRoom(){
    var name = document.getElementById('name').value;
    var floor = document.getElementById('floor').value;
    var index = document.getElementById('typeId').selectedIndex;
    var typeId = document.getElementById('typeId').options[index].value;
    var annotate = document.getElementById('annotate').value;
    //发送请求
    $.ajax({
        url: "/ktv/service/AddRoomService.php",
        type: "POST",
        data: {
            name: name,
            floor: floor,
            typeId: typeId,
            annotate: annotate
        },success: function (data) {
            if(data === "200"){
                alert("添加成功");
            }else{
                alert("添加失败");
            }
        }
    });
}
function addCategory(){
    var name = document.getElementById('name').value;
    var annotate = document.getElementById('annotate').value;
    //发送请求
    $.ajax({
        url: "/ktv/service/AddCategoryService.php",
        type: "POST",
        data: {
            name: name,
            annotate: annotate
        },success: function (data) {
            if(data === "200"){
                alert("添加成功");
            }else{
                alert("添加失败");
            }
        }
    });
}

function addCommodity(){
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var unit=document.getElementById('unit').value;
    var index = document.getElementById('cateId').selectedIndex;
    var cateId = document.getElementById('cateId').options[index].value;
    var annotate = document.getElementById('annotate').value;
    var inventory = document.getElementById('inventory').value;
    $.ajax({
        url: "/ktv/service/AddCommodityService.php",
        type: "POST",
        data: {
            name: name,
            price: price,
            unit: unit,
            cateId: cateId,
            annotate: annotate,
            inventory: inventory
        }
        ,success: function (data) {
            if(data === "200"){
                alert("添加成功");
            }else{
                alert("添加失败");
            }
        }
    });
}