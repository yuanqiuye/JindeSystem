$("#back").on('click', function() {
    animate_nondata("selection", null);
});

$("#logout").on('click', function() {
    $("#logined").hide();
    document.cookie = "user=-1";
    document.cookie = "jwt=-1";
    animate_nondata("login", null);
});

$("#login").on('click', function() {
    var user = $("input[name='user']");
    var password = $("input[name='password']");
    if (user.value === null || password.value === null) {
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
    animate_nondata("upload", null);
});

$("#send_apply_jinde").on('click', function() {
    var SID = $("input[name='SID']");
    var checked = $("radio:checked");
    var times = $("input[name='times']");
    if (SID === null || checked === null || times == null || times < 0) {
        alert("欄位不能為空!");
    } else {
        webdata.apply_jinde();
    }
});

$("#send_apply_early_jinde").on('click', function() {
    var times = $("input[name='number']");
    if (times == null || times < 0) {
        alert("欄位不能為空!");
    } else {
        webdata.apply_early_jinde();
    }
});

$("#send_check_early_jinde").on('click', function() {
    webdata.check_early_jinde();
});

$("#increase").on('click', function() {
    var table = document.getElementById('huge_check');
    var num = table.rows.length;
    var tr = table.insertRow(num);
    tr.innerHTML = "<td><input name='who'></input></td>td><input name='how'></input></td>"
});

$("#decrease").on('click', function() {
    var table = document.getElementById('huge_check');
    var num = table.rows.length;
    if (num - 1 <= 0) {
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
    webdata.upload_jinde();
});

$("#student_apply_early_jinde").on('click', function() {
    animate_nondata("student_apply_early_jinde", null);
});

$("#send_student_apply_early_jinde").on('click', function() {
    var times = $("input[name='jinde_number']");
    if (times !== null || 3 > times > 0) {
        webdata.student_apply_early_jinde();
    } else {
        alert("欄位不能為空!");
    }
});