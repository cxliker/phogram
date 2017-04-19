$(function () {
    $("#profile .more").click(function () {
        $("#full-screen .manager").css("display","table-cell");
    })

    $("#full-screen #cancle").click(function () {
        $("#full-screen .manager").css("display","none");
    })

    $("#full-screen #post").click(function () {
        $("#full-screen .manager").css("display","none");
        $("#full-screen .post-box").css("display","table-cell");
    })
})