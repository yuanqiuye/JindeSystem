$(document).ready(function() {

    $("#back").on('click', function() {
        if (dowhat.data['member'] == "student") {
            animate_nondata("student", null);
        } else {
            animate_nondata("selection", null);
        }
    });

    $("#logout").on('click', function() {
        $("#logined").hide();
        document.cookie = "user=-1";
        document.cookie = "jwt=-1";
        animate_nondata("login", null);
    });

    $("#login").on('click', function() {
        var user = $("input[name='user']").val();
        var password = $("input[name='password']").val();
        if (user === "" || password === "") {
            alert("輸入不能為空！");
        } else {
            webdata.login();
        }
    });

    $("#apply_early_jinde").on('click', function() {
        animate_nondata("apply_early_jinde", null);
    });

    $("#check_early_jinde").on('click', function() {
        webdata.check_inform();
    });

    $("#apply_jinde").on('click', function() {
        webdata.reason_infrom();
    });

    $("#huge_check_jinde").on('click', function() {
        animate_nondata("huge_check_jinde", null);
    });

    $("#upload").on('click', function() {
        animate_nondata("upload", null);
    });

    $("#download").on('click', function() {
        animate_nondata("download", null);
    });

    $("#send_apply_jinde").on('click', function() {
        var SID = $("input[name='SID']").val();
        var checked = $("radio:checked").val();
        var times = $("input[name='times']").val();
        if (SID === "" || checked === "" || times == "" || parseInt(times) < 0) {
            alert("欄位不能為空!");
        } else {
            webdata.apply_jinde();
        }
    });

    $("#send_apply_early_jinde").on('click', function() {
        var times = $("input[name='number']").val();
        if (times == "" || parseInt(times) < 0) {
            alert("欄位不能為空!");
        } else {
            webdata.apply_early_jinde();
        }
        //檢查
    });

    $("#send_check_early_jinde").on('click', function() {
        webdata.check_early_jinde();
    });

    $("#increase").on('click', function() {
        var table = document.getElementById('huge_check');
        var num = table.rows.length;
        var tr = table.insertRow(num);
        tr.innerHTML = "<td><input name='who'></input></td><td><input name='how'></input></td>"
    });

    $("#decrease").on('click', function() {
        var table = document.getElementById('huge_check');
        var num = table.rows.length;
        if (num - 2 <= 0) {
            alert("行數至少要有一列");
        } else {
            table.deleteRow(table.rows.length - 1);
        }
    });

    $("#send_huge_check_jinde").on('click', function() {
        webdata.huge_check_jinde();
    });

    $("#send_upload").on('click', function() {
        webdata.upload_jinde();
    });

    $("#send_download").on('click', function() {
        webdata.output_jinde();
    });

    $("#student_apply_early_jinde").on('click', function() {
        animate_nondata("student_apply_early_jinde", null);
    });


    $("#send_student_apply_early_jinde").on('click', function() {

        var Today = new Date();

        if (Today.getDay() > 3 || Today.getDay() < 1 || Today.getHours() <= 7 || Today.getHours() >= 11) {
            alert("已超時，請在當日11:00以前登記完畢");
        } else {

            webdata.student_apply_early_jinde();

        }
        //給你寫檢查
    });
});
