function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

function isCSV(filename) {
    var ext = getExtension(filename);
    if (ext === "csv") {
        return true;
    }
    return false;
}

function buildConfig() {
    return {
        delimiter: "", // auto-detect
        newline: "", // auto-detect
        quoteChar: '"',
        escapeChar: '"',
        header: false,
        transformHeader: undefined,
        dynamicTyping: false,
        preview: 0,
        encoding: "",
        worker: false,
        comments: false,
        step: undefined,
        complete: completeFn,
        error: errorFn,
        download: false,
        downloadRequestHeaders: undefined,
        skipEmptyLines: false,
        chunk: undefined,
        fastMode: undefined,
        beforeFirstChunk: undefined,
        withCredentials: undefined,
        transform: undefined,
        delimitersToGuess: [',', '\t', '|', ';', Papa.RECORD_SEP, Papa.UNIT_SEP]
    };
}

function completeFn(results) {
    var user = readcookie("user");
    var jwt = readcookie("jwt");
    var upload_type = $("#upload_type").val();
    switch (upload_type) {
        case ("late"):
            //檢查和animated_data都放這邊
            console.log(results.data[0].length);
            console.log(results.data);
            if (results.data[0][0] != "日期" &&
                results.data[0][3] != "放學刷卡" &&
                results.data[0].length != 4) {
                alert("格式不正確喔！");
                return null;
            }
            case ("did_wrong"):
                console.log(results.data[0].length);
                console.log(results.data);
                if (results.data[0][0] != "刷備卡" &&
                    results.data[0][17] != "其他" &&
                    results.data[0].length != 18) {
                    alert("格式不正確喔！");
                    return null;
                }
                case ("leave_call"):
                    console.log(results.data[0].length);
                    console.log(results.data);
                    if (results.data[0][0] != "學號" &&
                        results.data[0][1] != "日期" &&
                        results.data[1][1].length != 8) {
                        alert("格式不正確喔！");
                        return null;
                    }
                    var data = {
                        "user": user,
                        "jwt": jwt,
                        "upload_type": upload_type,
                        "results": results.data
                    };
                    animate_havadata("csv_upload.php", data);
    }
}

function errorFn(err, file) {
    alert("發生錯誤ww");
    console.log("ERROR:", err, file);
}