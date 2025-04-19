let btn = document.querySelector("#btn");
btn.addEventListener("click",function(event){
    let number = document.querySelector("#pass");
    let warn = document.querySelector("#warn");
    if(number.value.length>10 || number.value.length<10){
        event.preventDefault();
        warn.style.display = "block";
    }
    else{
        warn.style.display = "none";
    }

})
