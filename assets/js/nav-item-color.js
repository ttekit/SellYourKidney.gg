
var nhref = window.location.href.replace(window.location.origin+"/", "");
if(nhref.includes("/")){
    nhref = nhref.split('/')[0];
}
if(nhref == ""){
    var btn = document.querySelector(".HOME");
    var tmp = setInterval(function (){
        btn.parentElement.classList.add("active");
        if(btn.parentElement.classList.contains("active")){
            clearInterval(tmp);
        }
    }, 200);
}
else{
    var navpanel = document.getElementsByClassName("nav-link");
    for (let i = 0; i < navpanel.length; i++){
        if(navpanel[i].innerHTML.includes(nhref.toUpperCase())){
            navpanel[i].parentElement.classList.add("active");
        }
        else{
            if(navpanel[i].classList.contains("active")){
                navpanel[i].classList.remove("active");
            }
        }
    }
}
