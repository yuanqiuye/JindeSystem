let insertStr = (soure, start, newStr) => {
    return soure.slice(0, start) + newStr + soure.slice(start)
}

function csv_input(text) {
    var SID = [];
    var time = [];
    var result = $.csv.toArrays(text);
    for (var i = 0; i < result.length; i++) {
        if (result[i][0].length === 8) {
            var timefix = result[i][0];
            timefix = insertStr(timefix, 4, "-");
            timefix = insertStr(timefix, 7, "-");
            time.push(timefix);
            SID.push(result[i][2]);
        }
    }
    return time;
}