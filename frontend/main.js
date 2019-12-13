var guess_count = 0; 
var correct = null;

function win(){
    var guess_button = document.getElementById("guess");
    guess_button.setAttribute("class", "ts disabled button");

    var win_messenge = document.getElementById("correct_messenge");
    win_messenge.setAttribute("style","");
}

function restart(){
    window.correct = null;
    var guess_button = document.getElementById("guess");
    guess_button.setAttribute("class", "ts positive button");

    var win_messenge = document.getElementById("correct_messenge");
    win_messenge.setAttribute("style","display:none");

    var log = document.getElementById("log");
    for(var i=0; i<=log.childElementCount;i++){
        log.removeChild(log.lastChild);
    }
    var times = document.getElementById("value");
    times.innerHTML = "0";
}

function get_random(){
    var a, b, c, d;
    do{
        a = (Math.floor(Math.random() * 10)).toString();
        b = (Math.floor(Math.random() * 10)).toString();
        c = (Math.floor(Math.random() * 10)).toString();
        d = (Math.floor(Math.random() * 10)).toString();
    }while(a==b||b==c||c==d||d==a||a==c||b==d||a==0)
    return (a + b + c + d);
}

function get_A_B(input, correct){
    var d1 = input[1];
    var d2 = input[2];
    var d3 = input[3];
    var d4 = input[4];

    var a = correct[1];
    var b = correct[2];
    var c = correct[3];
    var d = correct[4];

    var num_A = 0;
    var num_B = 0;

    if (d1 == a){
        num_A++;
    }
    if (d2 == b){
        num_A++;
    }
    if (d3 == c){
        num_A++;
    }
    if (d4 == d){
        num_A++;
    }

    if(d1==b||d1==c||d1==d){
        num_B++;
    }
    if(d2==a||d2==c||d2==d){
        num_B++;
    }
    if(d3==b||d3==a||d3==d){
        num_B++;
    }
    if(d4==b||d4==c||d4==a){
        num_B++;
    }

    return [num_A, num_B];
}

function user_input(){
    var input = document.getElementById("input").value;
    var a = input[0];
    var b = input[1];
    var c = input[2];
    var d = input[3];

    if (input=="" || 1000 > parseInt(input) || parseInt(input) > 10000
    ||a==b||b==c||c==d||d==a||a==c||b==d||a==0){
        alert("輸入格式不正確!");
        return;
    }
    if(window.correct == null){
        window.correct = get_random();
    }
    var result = get_A_B(input, window.correct);
    if(result[0] == 4){
        win();
    }else{
        var times = document.getElementById("value");
        times.innerHTML = parseInt(times.innerHTML) + 1;

        var div = document.createElement("div");
        div.setAttribute("class", "item");
        div.innerHTML = input + "的結果是" 
                        + result[0] + "A" + result[1] + "B";
        document.getElementById("log").prepend(div);
    }
    

}



