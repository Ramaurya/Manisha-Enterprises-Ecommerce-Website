let button = document.querySelector("#btn");
// button.addEventListener("click",function(event){
//     let checkbox = document.querySelector("#check");
//     let warning = document.querySelector("#warning_msg");
//     if(!checkbox.checked){
//         event.preventDefault();
//         warning.style.display = "block";
//     }
//     else{
//         warning.style.display = "none";
//     }
// });

button.addEventListener("click",function(event){
    let warn = document.querySelector("#warning-password");
    let pass1 = document.querySelector("#pass");
    let pass2 = document.querySelector("#repass");
    let checkbox = document.querySelector("#check");
    let warning = document.querySelector("#warning_msg");
    let warning_validaton = document.querySelector("#warning-validation");
    let mobile = document.querySelector("#number");
    let warning_mobile = document.querySelector("#warning-mobile");
    let result = true;
    if(!checkbox.checked){
        warning.style.display = "block";
        result = false;
    }
    else{
        warning.style.display = "none";
    }

    if(mobile.value.length>10 || mobile.value.length<10){
        result = false;
        warning_mobile.style.display = "block";
    }
    else{
        warning_mobile.style.display = "none";
    }

    if(pass1.value != pass2.value){
        warn.style.display = "block";
        result = false;
    }
    else{
        warn.style.display = "none";
    }

    // if(pass1.value.length()<7){
    //     warning_validaton.style.display = "block";
    //     result = false;
    // }
    // else{
    //     warning_validaton.style.display = "none";
    // }


    // let passwordPattern = /^(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
    // if(!passwordPattern.test(pass1)){
    //     warning_validaton.style.display = "block";
    //     result = false;
    // }
    // else{
    //     warning_validaton.style.display = "none";
    // }

    if(!result){
        event.preventDefault();
    }
    
})



