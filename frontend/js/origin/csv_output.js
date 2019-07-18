function csv_output(data) {
    var textdata = null;
    var classes = data["class"];
    for (var key in classes) {
        var SID = classes[key]["SID"];
        var name = classes[key]["name"];
        textdata += key + "\r\n";
        for (var i = 0; i < SID.length; i++) {
            textdata += SID[i] + "," + name[i] + "\r\n";
        }
    }
    var data = new Blob([textdata], { type: 'text/csv;charset=utf-8' });

    saveAs(data, "進德名單.csv");

}