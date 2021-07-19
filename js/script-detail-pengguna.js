function buyActived(){
    var x = document.getElementById("buy-active");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
    document.getElementById("buy").style.display = "none"
}

function buyCanceled(){
    var x = document.getElementById("buy-active");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
    document.getElementById("buy").style.display = "block"
}

function countP(x){
    var count = document.getElementById("count-box").value;
    count = parseInt(count)+1;
    document.getElementById("count-box").value = count.toString();
    var price = count * x;
    document.getElementById("total-price").innerHTML = "Rp" + price.toString(); 
}

function countM(x){
    var count = document.getElementById("count-box").value;
    if(parseInt(count) > 0){
        count = parseInt(count)-1;
        document.getElementById("count-box").value = count.toString();  
        var price = count * x;
        document.getElementById("total-price").innerHTML = "Rp" + price.toString(); 
    }
}