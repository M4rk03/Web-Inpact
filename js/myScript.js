
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
    let type_person = document.querySelector('#type_person');
    let classe = document.querySelector('.in_classe');
    let sezione = document.querySelector('#classe_sez');
    
    if(type_person.value == 'studente'){
        classe.style.display = 'flex';
        sezione.required = true;
    } else{
        classe.style.display = 'none';
        sezione.required = false;
    }
}

// Zoom del Badge
function zoom_badge(){
    
}

// Assegna un badge allo studente
function add_badge(){
    document.querySelector('#add-badge').style.display = 'flex';
}
function close_add(){
    document.querySelector('#add-badge').style.display = 'none';
}

// Modifica un badge allo studente
function modify_badge(e){
    document.querySelector('#modify-badge').style.display = 'flex';
    let cont = document.querySelector('.cont-modifyB');
    let badge = e.children[0].alt;

    let img = document.createElement('img');
    let url_img = 'img/badge/' + badge + '.png';
    img.setAttribute('src', url_img);
    cont.insertBefore(img, cont.children[0]);

    let nameB = document.querySelector('#mod-nomeB');
    let levelB = document.querySelector('#mod-livelloB');
    
    for (const i of  nameB.children) {
        if (i.value == badge.match(/[A-Z][a-z]*/)[0]) {
            i.selected = true;
        }
    }

    for (const i of  levelB.children) {
        if (i.value == badge.match(/\d+/)[0]) {
            i.selected = true;
        }
    }
}
function close_modify(){
    document.querySelector('#modify-badge').style.display = 'none';
    let cont = document.querySelector('.cont-modifyB');
    cont.removeChild(cont.children[0]);
}

// Controllo sul seleziona per visualizzare il badge
var num = 0;
function visual_img(){
    let nome_badge = document.querySelector('#nomeB');
    let livello_badge = document.querySelector('#livelloB');
    let addB = document.querySelector('#add-badge');

    let img = document.createElement('img');
    let url_img = 'img/badge/' + nome_badge.value + livello_badge.value + '.png';

    if(nome_badge.value == '' || livello_badge.value == ''){
        if(addB.firstElementChild.tagName == 'IMG'){
            addB.removeChild(addB.firstChild);
        }
    } else{
        img.setAttribute('src', url_img);

        if(addB.firstElementChild.tagName == 'IMG'){
            addB.removeChild(addB.firstChild);
        }
        if(addB.firstElementChild.tagName != 'IMG'){
            addB.insertBefore(img, addB.children[0]);
        }
    }
}