dowhat = new process();

function callserver(url, send) {
    var request = JSON.stringify(send);
    var destination = "172.24.75.86:8787/JindeSystem/backend/php";

    $.ajax({
        type: "POST",
        async: false,
        dataType: "json",
        url: destination + url,
        contentType: 'application/json; charset=UTF-8',
        data: send,
        success: function(get) {
            dowhat.freshdata(get);
            if (get["err"] !== "") {
                status_handler(get["err"], "err");
            } else {
                switch (get["type"]) {
                    case "login":
                        dowhat.login();
                        break;
                    case "reason_inform":
                        dowhat.reason_inform();
                        break;
                    case "apply_jinde":
                        dowhat.apply_jinde();
                        break;
                    case "apply_early_jinde":
                        dowhat.apply_early_jinde();
                        break;
                    case "check_inform":
                        dowhat.check_inform();
                        break;
                    case "check_early_jinde":
                        dowhat.check_early_jinde();
                        break;
                    case "huge_check_jinde":
                        dowhat.huge_check_jinde();
                        break;
                    case "output_jinde":
                        dowhat.output_jinde();
                        break;
                    case "upload_jinde":
                        dowhat.upload_jinde();
                        break;
                    case "student_apply_early_jinde":
                        dowhat.student_apply_early_jinde();
                        break;
                }
            }
        },
        err: function(oResult, textStatus, errorThrown) {
            animate_nondata("login", "403");
        },
        statusCode: {
            403: function(response) {
                animate_nondata("login", "403");
            },
            304: function(response) {
                animate_nondata("login", "403");
            }
        }
    });

}