class process {
    constructor() {
        this.status = null;
        this.direction = null;
        this.data = null;
    }

    freshdata(data) {
        this.data = data;
    }

    login() {
        var member = this.data["member"];
        document.getElementById('selectionpage').setAttribute("style", "display:none");
        document.getElementById('studentpage').setAttribute("style", "display:none");
        switch (member) {
            case "student":
                var jindetimes = this.data["applytime"].length;
                var table = document.getElementById('student');

                while (table.rows.length - 1) {
                    table.deleteRow(table.rows.length - 1);
                }

                var red_jinde = 0;
                var jingaotimes = 0;
                for (var i = 0; i < jindetimes; i++) {
                    var num = table.rows.length;
                    var tr = table.insertRow(num);
                    if (this.data["reason"][i] === "遲到") {
                        tr.setAttribute("class", "positive")
                    } else {
                        tr.setAttribute("class", "negative")
                        red_jinde++;
                    }

                    var td = tr.insertCell(tr.cells.length);
                    td.innerHTML = this.data["applytime"][i];

                    var td = tr.insertCell(tr.cells.length);
                    td.innerHTML = this.data["reason"][i];
                }

                if (red_jinde >= 3) {
                    jindetimes = jindetimes - red_jinde;
                    jingaotimes = 1;
                    if (red_jinde >= 5) {
                        jingaotimes = 2;
                    }
                }

                document.getElementById('jindetimes').innerHTML = jindetimes;
                document.getElementById('jingaotimes').innerHTML = jingaotimes;

                document.cookie = "user=" + this.data["user"];
                document.cookie = "jwt=" + this.data["jwt"];
                document.getElementById('logined').setAttribute("style", "-1");
                document.getElementById('show_user').innerHTML = "";
                document.getElementById('show_user').append(this.data["user"]);


                this.direction = "student_apply_early_jinde";
                this.status = "loginsuccess";
                break;

            case "teacher":
                var level = this.data["level"];
                if (level == 3) {
                    document.getElementById('high').setAttribute("style", "display:block");
                    document.getElementById('middle').setAttribute("style", "display:block");
                    document.getElementById('low').setAttribute("style", "display:block");
                } else if (level == 2) {
                    document.getElementById('high').setAttribute("style", "display:none");
                    document.getElementById('middle').setAttribute("style", "display:block");
                    document.getElementById('low').setAttribute("style", "display:block");
                } else if (level == 1) {
                    document.getElementById('high').setAttribute("style", "display:none");
                    document.getElementById('middle').setAttribute("style", "display:none");
                    document.getElementById('low').setAttribute("style", "display:block");
                } else if (level == 0) {
                    document.getElementById('high').setAttribute("style", "display:none");
                    document.getElementById('middle').setAttribute("style", "display:none");
                    document.getElementById('low').setAttribute("style", "display:none");
                }
                document.cookie = "user=" + this.data["user"];
                document.cookie = "jwt=" + this.data["jwt"];
                document.getElementById('logined').setAttribute("style", "-1");
                document.getElementById('show_user').innerHTML = "";
                document.getElementById('show_user').append(this.data["user"]);

                this.direction = "selection";
                this.status = "loginsuccess";
                console.log(document.cookie);
                break;

        }
    }

    reason_inform() {
        var reason_number = this.data["reason"]["name"].length;
        var checkbox = document.getElementById('reason');
        checkbox.innerHTML = "";

        for (var i = 0; i < reason_number; i++) {
            var label = document.createElement("LABEL");
            var boxes = document.createElement("DIV");
            boxes.setAttribute("class", "ts radio checkbox");

            var input = document.createElement("INPUT");
            input.setAttribute("type", "radio");
            input.setAttribute("name", "reason");

            input.setAttribute("id", this.data["reason"]["RID"][i]);

            label.setAttribute("for", this.data["reason"]["RID"][i]);
            label.innerHTML = "";
            label.innerHTML = this.data["reason"]["name"][i];

            boxes.appendChild(input);
            boxes.appendChild(label);

            checkbox.appendChild(boxes);
        }
        this.direction = "apply_jinde";
        this.status = null;
    }

    apply_jinde() {
        this.status = "applysuccess";
        this.direction = "selection";
    }

    apply_early_jinde() {
        this.status = "applysuccess";
        this.direction = "selection";
    }

    student_apply_early_jinde() {
        var spage = document.getElementById('success');
        spage.innerHTML = "";
        if (this.data["failed_times"] !== 0) {
            spage.innerHTML += this.data["failed_times"] + "隻申請失敗, 可能該處室名額為滿, <br>或你申請太多隻了<br>"
        }
        if (this.data["success_location"] !== "") {
            spage.innerHTML += "成功申請! 地點:" + this.data["success_location"];
        }
        this.status = "studentsuccess";
        this.direction = "student_apply_early_jinde";
    }

    check_inform() {
        var table = document.getElementById('teacher');

        while (table.rows.length - 1) {
            table.deleteRow(table.rows.length - 1);
        }
        var checknumber = this.data["SID"].length;
        for (var i = 0; i < checknumber; i++) {
            var div = document.createElement("DIV");
            div.setAttribute("class", "ts toggle checkbox");

            var input = document.createElement("INPUT");
            var label = document.createElement("LABEL");

            input.setAttribute("id", this.data["EID"][i]);
            input.setAttribute("type", "checkbox");

            label.setAttribute("for", this.data["EID"][i]);

            div.appendChild(input);
            div.appendChild(label);

            var num = table.rows.length;
            var tr = table.insertRow(num);

            var td = tr.insertCell(tr.cells.length);
            td.setAttribute("class", "collapsing");
            td.appendChild(div);

            var td = tr.insertCell(tr.cells.length);
            td.innerHTML = this.data["SID"][i];


        }
        this.direction = "check_early_jinde";
        this.status = null;
    }

    check_early_jinde() {
        this.status = "applysuccess";
        this.direction = "selection";
    }

    backstage(){
        this.status = "applysuccess";
        this.direction = "selection";
    }

    backstage_search() {
        var jindetimes = this.data["applytime"].length;
        var table = document.getElementById('backstage_data');

        var SID = document.getElementById("backstage_SID");
        SID.innerHTML = this.data["SID"];

        while (table.rows.length - 1) {
            table.deleteRow(table.rows.length - 1);
        }

        var red_jinde = 0;
        var jingaotimes = 0;
        for (var i = 0; i < jindetimes; i++) {
            var div = document.createElement("DIV");
            div.setAttribute("class", "ts toggle checkbox");

            var input = document.createElement("INPUT");
            var label = document.createElement("LABEL");

            input.setAttribute("id", this.data["JID"][i]);
            input.setAttribute("type", "checkbox");

            label.setAttribute("for", this.data["JID"][i]);

            div.appendChild(input);
            div.appendChild(label);

            var num = table.rows.length;
            var tr = table.insertRow(num);
            if (this.data["reason"][i] === "遲到") {
                tr.setAttribute("class", "positive")
            } else {
                tr.setAttribute("class", "negative")
                red_jinde++;
            }

            var td = tr.insertCell(tr.cells.length);
            td.innerHTML = this.data["applytime"][i];

            var td = tr.insertCell(tr.cells.length);
            td.innerHTML = this.data["reason"][i];

            var td = tr.insertCell(tr.cells.length);
            td.setAttribute("class", "collapsing");
            td.appendChild(div);
        }

        if (red_jinde >= 3) {
            jindetimes = jindetimes - red_jinde;
            jingaotimes = 1;
            if (red_jinde >= 5) {
                jingaotimes = 2;
            }
        }

        document.getElementById('backstage_jindetimes').innerHTML = jindetimes;
        document.getElementById('backstage_jingaotimes').innerHTML = jingaotimes;
    
        this.direction = "backstage";
        this.status = null;
    }

    huge_check_jinde() {
        var spage = document.getElementById('success');
        spage.innerHTML = "";
        if (this.data["failed_SID"].length != 0 || this.data["non_jinde_SID"].length != 0) {
            for (var i = 0; i < this.data["failed_SID"].length; i++) {
                spage.innerHTML += this.data["failed_SID"][i] + "查無此班級座號XDD<br>";
            }
            for (var i = 0; i < this.data["non_jinde_SID"].length; i++) {
                spage.innerHTML += this.data["non_jinde_SID"][i] + "這隻班級座號多銷" + this.data["non_jinde_times"][i] + "喔!<br>";
            }
            this.status = "studentsuccess";
        } else {
            this.status = "applysuccess";
        }
        this.direction = "selection";

    }

    upload_jinde() {
        this.status = "applysuccess";
        this.direction = "selection";
    }

    output_jinde() {
        var data = new Blob([this.data["file"]], { type: 'text/csv;charset=utf-8' });
        saveAs(data, "進德名單.csv");
        this.status = "applysuccess";
        this.direction = "selection";
    }


    //待上傳
}
