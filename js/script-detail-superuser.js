function addActived(){
    var x = document.getElementById("add-active");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
    document.getElementById("add").style.display = "none"
}

function addCanceled(){
    var x = document.getElementById("add-active");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
    document.getElementById("add").style.display = "block"
}