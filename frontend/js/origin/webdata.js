class webdata {
    static login() {
        var user = $("input[name='user']").val();
        var password = $("input[name='password']").val();

        var data = { "user": user, "password": password };
        animate_havadata("login.php", data);
    }

    static reason_infrom() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt };

        animate_havadata("reason_inform.php", data);
    }

    static apply_jinde() {
        var SID = $("input[name='SID']").val();
        var checked = $("input[name='reason']:checked").get(0);
        var RID = checked.getAttribute("id");
        var times = $("input[name='times']").val();
        var user = readcookie("user");
        var jwt = readcookie("jwt");

        var data = { "user": user, "jwt": jwt, "SID": SID, "RID": RID, "times": times };
        animate_havadata("apply_jinde.php", data);
    }

    static apply_early_jinde() {
        var timeID = $("#teacher_time").val();
        var weekID = $("#teacher_week").val();
        var number = $("input[name='number']").val();
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt, "timeID": timeID, "weekID": weekID, "number": number };
        animate_havadata("apply_early_jinde.php", data);
    }

    static student_apply_early_jinde() {
        var timeID = $("#student_time").val();
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt, "timeID": timeID };
        animate_havadata("student_apply_early_jinde.php", data);
    }

    static check_inform() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt };
        animate_havadata("check_inform.php", data);
    }

    static check_early_jinde() {
        var jwt = readcookie("jwt");
        var user = readcookie("user");
        var data = { "user": user, "jwt": jwt, "SID": [], "EID": [] };
        var checked = $("input[type='checkbox']:checked").get();
        for (var i = 0; i < checked.length; i++) {
            var what_table = checked[i].parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
            if (what_table != "teacher"){
                continue;
            }
            var nowrow = checked[i].parentElement.parentElement.parentElement;
            var SID = nowrow.cells[1].textContent;
            var EID = checked[i].getAttribute("id");
            data["SID"].push(SID);
            data["EID"].push(EID);
        }

        animate_havadata("check_early_jinde.php", data);
    }

    static huge_check_jinde() {
        var jwt = readcookie("jwt");
        var user = readcookie("user");
        var data = { "user": user, "jwt": jwt, "SID": [], "times": [] };
        var SID = $("input[name='who']").get();
        var times = $("input[name='how']").get();
        for (var i = 0; i < SID.length; i++) {
            if (SID[i].value !== "" && times[i].value !== "") {
                data["SID"].push(SID[i].value);
                data["times"].push(times[i].value);
            }
        }

        animate_havadata("huge_check_jinde.php", data);
    }

    static backstage_search() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var class_number = $("input[name='class_number']").val();
        var data = { "user": user, "jwt": jwt , "class_number": class_number };
        animate_havadata("backstage_search.php", data);
    }

    static backstage(){
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt, "JID": []};
        var checked = $("input[type='checkbox']:checked").get();
        for (var i = 0; i < checked.length; i++) {
            var what_table = checked[i].parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute("id");
            if (what_table != "backstage_data"){
                continue;
            }
            var JID = checked[i].getAttribute("id");
            data["JID"].push(JID);
        }

        animate_havadata("backstage.php", data);
    }

    static upload_jinde() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var form = document.getElementById('upload_jinde').files[0];
        var reader = new FileReader();
        var data = {};
        reader.onload = function(){
            data = {"user":user, "jwt":jwt, "file":reader.result};
        }
        reader.readAsDataURL(form);
        animate_havadata("upload_jinde.php", data);
        
    }

    static output_jinde() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt };
        animate_havadata("output_jinde.php", data);
    }
}