class webdata {
    static login() {
        var user = $("input[name='user']");
        var password = $("input[name='password']");

        var data = ["user" = user, "password" = password];
        animate_havedata("login.php", data);
    }

    static reason_infrom() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = ["user" = user, "jwt" = jwt];

        animate_havedata("reason_inform.php", data);
    }

    static apply_jinde() {
        var SID = $("input[name='SID']");
        var checked = $("radio:checked");
        var RID = checked.getAttribute("id");
        var times = $("input[name='times']");
        var user = readcookie("user");
        var jwt = readcookie("jwt");

        var data = ["user" = user, "jwt" = jwt, "SID" = SID, "RID" = RID, "times" = times, ];
        animate_havadata("apply_jinde.php", data);
    }

    static apply_early_jinde() {
        var time = $("input[name='time']");
        var timeID = time.getAttribute("id");
        var number = $("input[name='number']");
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = ["user" = user, "jwt" = jwt, "timeID" = timeID, "number" = number];
        animate_havadata("apply_early_jinde.php", data);
    }

    static check_inform() {
        var user = readcookie("user");
        var jwt = readcookie("jwt");
        var data = ["user" = user, "jwt" = jwt];
        animate_havadata("check_inform.php", data);
    }

    static check_early_jinde() {
        var jwt = readcookie("jwt");
        var user = readcookie("user");
        var data = ["user" = user, "jwt" = jwt, "name" = {}, "times" = {}];
        var checked = $("checkbox:checked");
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
        var data = ["user" = user, "jwt" = jwt, "name" = {}, "times" = {}];
        var name = $("input[name='who']");
        var times = $("input[name='how']");
        for (var i = 0; i < name.length; i++) {
            if (name[i] !== null && times[i] !== null) {
                data["name"].push(name[i]);
                data["times"].push(times[i]);
            }
        }

        animate_havadata("check_early_jinde.php", data);
    }

    //上傳及下載頁面待補充
}