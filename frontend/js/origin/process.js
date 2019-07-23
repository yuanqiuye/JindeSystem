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
        switch (member) {
            case "student":
                var jindetimes = this.data["applytime"].length;
                var table = document.getElementById('student');

                document.getElementById('jindetimes').innerHTML = jindetimes;
                while (table.rows.length - 1) {
                    table.deleteRow(table.rows.length - 1);
                }
                for (var i = 0; i < jindetimes; i++) {
                    var num = table.rows.length;
                    var tr = table.insertRow(num);

                    var td = tr.insertCell(tr.cells.length);
                    td.innerHTML = this.data["applytime"][i];

                    var td = tr.insertCell(tr.cells.length);
                    td.innerHTML = this.data["reason"][i];
                }
                document.cookie = "user=" + this.data["user"];
                document.cookie = "jwt=" + this.data["jwt"];
                document.getElementById('logined').setAttribute("style", "-1");

                this.direction = "student";
                this.status = "loginsuccess";
                break;
            case "teacher":
                var level = this.data["level"];
                if (level === "2") {
                    var nop = document.getElementById('high');
                    nop.setAttribute("style", "display:none");
                } else if (level === "1") {
                    var nop = document.getElementById('high');
                    nop.setAttribute("style", "display:none");

                    var nop = document.getElementById('middle');
                    nop.setAttribute("style", "display:none");
                }
                document.cookie = "user=" + this.data["user"];
                document.cookie = "jwt=" + this.data["jwt"];
                document.getElementById('logined').setAttribute("style", "-1");

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
            label.innerHTML = this.data["reason"]["name"];

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
            spage.innerHTML += this.data["failed_times"] + "隻申請失敗, 可能該處室名額為滿, \n或你申請太多隻了\n"
        }
        if (this.data["success_location"] !== "") {
            spage.innerHTML += "成功申請! 地點:" + this.data["success_location"];
        }
        this.status = "studentsuccess";
        this.direction = "student";
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

    huge_check_jinde() {
        if (this.data["failed_times"] !== 0) {
            spage.innerHTML += this.data["failed_times"] + "隻消除失敗, 可能查無此學號, 或根本沒那麼多隻可以消XDD\n"
        }
        this.status = "applysuccess";
        this.direction = "selection";
    }

    upload_jinde() {
        this.status = "applysuccess";
        this.direction = "selection";
    }

    output_jinde() {
        csv_output(this.data);
        this.direction = "selection";
        this.status = null;
    }


    //待上傳
}