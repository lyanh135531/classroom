$(document).ready(function () {

    $("#signup-submit").click(function(){
        var name = $("#name").val();
        var email = $("#email").val();
        var pass = $("#pass").val();
        var faculty = $("#faculty").val();
        var phone = $("#phone").val();

        if (name === ""){            
            $(".errorName").html("Vui lòng nhập họ và tên");
            $("#name").focus();
            return false;
        }
        if (email === "") {
            $(".errorEmail").html("Vui lòng nhập email");
            $("#email").focus();
            return false;
        }
        if (IsEmail(email)==false) {
            $(".errorEmail").html("Vui lòng sử dụng địa chỉ email");
            $("#email").focus();
            return false;
        }
        if (pass === "") {
            $(".errorPass").html("Vui lòng nhập mật khẩu");
            $("#pass").focus();
            return false;
        }
        if (pass.length < 6) {
            $(".errorPass").html("Mật khẩu phải từ 6 đến 20 ký tự");
            $("#pass").focus();
            return false;
        }
        if (faculty === "") {
            $('.errorFaculty').html("Vui lòng nhập khoa đang học/công tác");
            $("#faculty").focus();
            return false;
        }
        if (phone === "") {
            $('.errorPhone').html("Vui lòng nhập số điện thoại");
            $("#phone").focus();
            return false;
        }

        return true;
   });

    $("#signin-submit").click(function (e) {
        var email = $("#email").val();
        var pass = $("#pass").val();

        if (email === "") {
            $(".errorEmail").html("Vui lòng nhập email");
            $("#email").focus();
            return false;
        }
        if (IsEmail(email)==false) {
            $(".errorEmail").html("Vui lòng sử dụng địa chỉ email");
            $("#email").focus();
            return false;
        }
        if (pass === "") {
            $(".errorPass").html("Vui lòng nhập mật khẩu");
            $("#pass").focus();
            return false;
        }
        if (pass.length < 6) {
            $(".errorPass").html("Mật khẩu phải từ 6 đến 20 ký tự");
            $("#pass").focus();
            return false;
        }

        return true;
   });

    $("#create-class-submit").click(function(){
        var nameclass = $("#nameclass").val();
        var subject = $("#subject").val();
        var room = $("#room").val();
        var period = $("#period").val();

        if (nameclass === ""){            
            $(".errornameclass").html("Vui lòng nhập tên lớp");
            $("#nameclass").focus();
            return false;
        }
        if (subject === "") {
            $(".errorsubject").html("Vui lòng nhập môn học");
            $("#subject").focus();
            return false;
        }
        if (room === "") {
            $(".errorroom").html("Vui lòng nhập phòng học");
            $("#room").focus();
            return false;
        }
        if (period === "") {
            $('.errorperiod').html("Vui lòng nhập tổng số tiết");
            $("#period").focus();
            return false;
        }

        return true;
    });

    $("#create-student-submit").click(function(){
        var mssv = $("#mssv").val();
        var surname = $("#surname").val();
        var name = $("#name").val();
        var email = $("#email").val();

        if (mssv === ""){            
            $(".errormssv").html("Vui lòng nhập mã số sinh viên");
            $("#mssv").focus();
            return false;
        }
        if (surname === "") {
            $(".errorsurname").html("Vui lòng nhập họ và chữ lót");
            $("#surname").focus();
            return false;
        }
        if (name === "") {
            $(".errorname").html("Vui lòng nhập tên");
            $("#name").focus();
            return false;
        }
        if (email === "") {
            $('.erroremail').html("Vui lòng nhập email");
            $("#email").focus();
            return false;
        }

        return true;
    });

    $(".form-control").keypress(function () { 
        $(".errorName").html("");
        $(".errorEmail").html("");
        $(".errorPass").html("");
        $(".errorFaculty").html("");
        $(".errorPhone").html("");
        $(".errorPassset").html("");
        $(".errorPassconfirm").html("");
        $(".errornameclass").html("");
        $(".errorsubject").html("");
        $(".errorroom").html("");
        $(".errorperiod").html("");
        $(".errormssv").html("");
        $(".errorsurname").html("");
        $(".errorname").html("");
        $(".erroremail").html("");


    });
   
   $("#errorChange").hide();

   $("#newpass-submit").click(function(){

        var pass = $("#pass").val();
        var passConfirm = $("#passConfirm").val();

        if (pass === "") {
            $(".errorPassset").html("Vui lòng nhập mật khẩu");
            $("#pass").focus();
            return false;
        }
        if (pass.length < 6) {
            $(".errorPassset").html("Mật khẩu phải từ 6 đến 20 ký tự");
            $("#pass").focus();
            return false;
        }
        if (passConfirm != pass) {
            $(".errorPassconfirm").html("Mật khẩu không khớp");
            $("#passConfirm").focus();
            return false;
        }
        if (passConfirm === pass) {
            $("#errorChange").show();
            return false;
        }

        return false;
    });

    $("#collapsibleNavbar").mouseleave(function(){
        if ($(".navbar-toggler").click()){
            $("#collapsibleNavbar").show();
        }else {
            $("#collapsibleNavbar").hide();
        }
    });


   
});


function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(gmail.com)/;
    if (!regex.test(email)) {
        return false;
    }
    else {
        return true;
    }
}

