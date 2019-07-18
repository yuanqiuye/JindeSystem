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
            if (get["err"] !== null) {
                //待處理 errhandler
            } else {
                switch (get["type"]) {
                    case "login":
                        dowhat.login();
                        break;
                }
            }
        },
        statusCode: {
            403: function(response) {
                //待處理
            }
        }
    });

}