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
        var checked = $("radio:checked").get(0);
        var RID = checked.getAttribute("id");
        var times = $("input[name='times']").val();
        var user = readcookie("user");
        var jwt = readcookie("jwt");

        var data = { "user": user, "jwt": jwt, "SID": SID, "RID": RID, "times": times };
        animate_havadata("apply_jinde.php", data);
    }

    static apply_early_jinde() {
        var time = $("input[name='teacher_time']").val();
        var timeID = time.getAttribute("id");
        var number = $("input[name='number']").val();
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt, "timeID": timeID, "number": number };
        animate_havadata("apply_early_jinde.php", data);
    }

    static student_apply_early_jinde() {
        var time = $("input[name='student_time']").val();
        var timeID = time.getAttribute("id");
        var number = $("input[name='jinde_number']").val();
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt, "timeID": timeID, "number": number };
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
        var data = { "user": user, "jwt": jwt, "name": [], "times": [] };
        var checked = $("checkbox:checked").get();
        for (var i = 0; i < checked.length; i++) {
            var nowrow = checked[i].parentElement.parentElement.parentElement;
            var name = nowrow.cells[1];
            var times = nowrow.cells[2];
            data["name"].push(name);
            data["times"].push(times);
        }

        animate_havadata("check_early_jinde.php", data);
    }

    static huge_check_jinde() {
        var jwt = readcookie("jwt");
        var user = readcookie("user");
        var data = { "user": user, "jwt": jwt, "name": [], "times": [] };
        var name = $("input[name='who']").val();
        var times = $("input[name='how']").val();
        for (var i = 0; i < name.length; i++) {
            if (name[i] !== "" && times[i] !== "") {
                data["name"].push(name[i]);
                data["times"].push(times[i]);
            }
        }

        animate_havadata("check_early_jinde.php", data);
    }

    static check_jinde() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt };
        animate_havadata("check_jinde.php", data);
    }

    static upload_jinde() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        const fileUploader = document.querySelector('#file-uploader');
        var result = null;
        if (fileUploader.files !== "") {
            var reader = new FileReader();

            reader.onload = function() {
                result = csv_input(reader.result);
            }
            reader.readAsText(fileUploader.files[0]);

            var data = { "user": user, "jwt": jwt, "time": result, "SID": result };
            animate_havadata("upload_jinde.php", data);
        } else {
            alert("尚未選擇檔案!");
        }
    }

    static output_jinde() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = { "user": user, "jwt": jwt };
        animate_havadata("output_jinde.php", data);
    }
}