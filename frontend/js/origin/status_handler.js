function status_handler(status, direction) {
    var spage = document.getElementById('success');
    var epage = document.getElementById('err');
    if (status === "loginsuccess") {
        spage.innerHTML = "登入成功！";
        animate_nondata(direction, "success");
    } else if (status === "applysuccess") {
        spage.innerHTML = "資料發送成功！";
        animate_nondata(direction, "success");
    } else {
        epage.innerHTML = status;
        animate_nondata(direction, "err");
    }
}