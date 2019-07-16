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
        member = this.data["member"];
        switch (memeber) {
            case "student":
                var jindetimes = this.data["jindeapplytime"].length;
                var table = document.getElementById('student');

                document.getElementById('student').innerHTML = jindetimes;
                for (var i = 0; i < jindetimes; i++) {
                    var num = table.rows.length;
                    var tr = table.insertRow(num);

                    td = tr.insertCell(tr.cells.length);
                    td.innerHTML = this.data["jindeapplytime"][i];

                    td = tr.insertCell(tr.cells.length);
                    td.innerHTML = this.data["reason"][i];
                }
                document.cookie = "user:" + this.data["user"];
                document.cookie = "jwt:" + this.data["jwt"];

                this.direction = "student";
                this.status = "loginsuccess";
                break;
            case "teacher":
                var level = this.data["level"];
                if (level === "middle") {
                    var nop = document.getElementById('high');
                    nop.setAttribute("style", "display:none");
                } else {
                    var nop = document.getElementById('high');
                    nop.setAttribute("style", "display:none");

                    var nop = document.getElementById('middle');
                    nop.setAttribute("style", "display:none");
                }
                document.cookie = "user:" + this.data["user"];
                document.cookie = "jwt:" + this.data["jwt"];

                this.direction = "selection";
                this.status = "loginsuccess";
                break;
        }
    }

    reason_inform() {
        var reason_number = data["reason"]["name"].length;
        var checkbox = document.getElementById('reason');

        var boxes = document.createElement("DIV");
        boxes.setAttribute("class", "ts radio checkbox");

        var input = document.createElement("INPUT");
        input.setAttribute("type", "radio");

        var label = document.createElement("LABEL");

        for (var i = 0; i < reason_number; i++) {
            input.setAttribute("id", this.data["reason"]["RID"][i]);

            label.setAttribute("for", this.data["reason"]["RID"][i]);
            label.innerHTML = this.data["reason"]["name"];

            boxes.appendChild(input);
            boxes.appendChild(label);

            checkbox.appendChild(boxes);
        }
        this.direction = "apply_jinde";
    }

    apply_jinde() {
        this.status = "applysuccess";
        this.direction = "selection";
    }

    apply_early_jinde() {
        this.status = "applysuccess";
        this.direction = "selection";
    }

    check_inform() {
        var table = document.getElementById('teacher');
        var check_number = this.data["SID"].length;

        var div = document.createElement("DIV");
        div.setAttribute("class", "ts toggle checkbox");

        var input = document.createElement("INPUT");
        var label = document.createElement("LABEL");

        for (var i = 0; i < checknumber; i++) {

            input.setAttribute("id", i);
            label.setAttribute("for", i);
            div.appendChild(input);
            div.appendChild(label);

            var num = table.rows.length;
            var tr = table.insertRow(num);

            td = tr.insertCell(tr.cells.length);
            td.setAttribute("class", "collapsing");
            td.appendChild(div);

            td = tr.insertCell(tr.cells.length);
            td.innerHTML = this.data["SID"][i];

            td = tr.insertCell(tr.cells.length);
            td.innerHTML = this.data["times"][i];
        }
        this.direction = "check_early_jinde";
    }

    //待繼續(am 0:21)
}