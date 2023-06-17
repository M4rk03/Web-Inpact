
/*
function controllo(){
    form = document.forms;
    for(let i=0; i < form.elements.length; i++){
        if(form.elements[i].type == 'checkbox' && form.elements[i].checked){
            n++;
        }
    }
} */

var n = 0
// Seleziona max un checkbox
function check(chkBox){
    if (chkBox.checked){
        if(n == 1){
            chkBox.checked = false;
        } else{
            n++;
        }
    } else{
        n--;
    }
}

// Password
function icon_change(){
    let icon_lock = document.querySelector('#icon_lock');
    let pwd = document.querySelector('#pwd');

    icon_lock.classList.toggle('fa-lock');
    icon_lock.classList.toggle('fa-unlock');

    if(pwd.type == "password"){
        pwd.type = "text";
    } else{
        pwd.type = "password";
    }
}
function icon_change2(){
    let icon_lock = document.querySelector('#icon_lock2');
    let pwd = document.querySelector('#conf_pwd');

    icon_lock.classList.toggle('fa-lock');
    icon_lock.classList.toggle('fa-unlock');

    if(pwd.type == "password"){
        pwd.type = "text";
    } else{
        pwd.type = "password";
    }
}

// Controllo sul seleziona tipo persona
function select_control(){
    var type_person = document.querySelector('#type_person');
    var classe = document.querySelector('.in_classe');
    var sezione = document.querySelector('#classe_sez');
    
    if(type_person.value == 'studente'){
        classe.style.display = 'flex';
        sezione.required = true;
    } else{
        classe.style.display = 'none';
        sezione.required = false;
    }
}

// Zoom del Badge
function zoom_badge(e){
    e.classList.toggle('cont-badge-G');
}