$(function() {

    $(".node1 #account").bind("input propertychange", function () {
        $.post("existUser.php", {
            account : $(".node1 #account").val()
        }, function (data) {
            if(data == "success") {
                $("#exist").html("√");
            } else {
                $("#exist").html("×");
            }
        })
    })


    $("#bt").click(function () {
        var choic = $(".node1").css("display");
        if (choic == "none") {
            $(".node3 p").html('已有账号，请');
            $("#bt").html("登陆");
            $(".node1").css("display","block");
            $(".node2").css("display","none");
        } else {
            $(".node3 p").html('未有账号，请');
            $("#bt").html("注册");
            $(".node2").css("display","block");
            $(".node1").css("display","none");
        }
        return false;
    })

    $("#register").click(function () {
        var contact = $.trim($(".node1 #contact").val());
        var name = $.trim($(".node1 #name").val());
        var account = $.trim($(".node1 #account").val());
        var password = $.trim($(".node1 #password").val());

        if (contact.length == 0 || name.length == 0 || account == 0 || password == 0) {
            $(".node1 .message").html("*各项不能为空*");
        } else {
            $.post("register.php",{
                contact : contact ,
                name : name,
                account : account , 
                password : password
            }, function (data) {
                if (data.status == "success") {
                    window.location.href = "./user/?user=" + account;
                    console.log("ok");
                } else {
                    $(".node1 .message").html(data.error);
                }

            }, "json");
        }
    })

    $("#login").click(function () {
        var account = $(".node2 #account").val();
        var password = $(".node2 #password").val();
        $.post("login.php", {
            account : account,
            password : password
        }, function (data) {
            if (data.status == "success") {
                window.location.href = "./user/?user=" + account;
            } else {
                $(".node2 .message").html(data.error);
            }
        }, "json");
    })
});