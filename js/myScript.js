
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

// PASSWORD
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

// ZOOM del Badge
function zoom_badge(){
    
}

// ASSEGNA un badge allo studente
function add_badge(valore){
    let cont = document.querySelector('#add-badge');
    cont.style.display = 'flex';

    let input = document.createElement('input');
    input.value = valore;
    input.name = 'ID_persona';
    input.setAttribute('hidden', input);

    if (cont.children[0].lastElementChild.tagName == 'INPUT'){
        cont.children[0].removeChild(cont.children[0].lastChild);
    }
    cont.children[0].appendChild(input);
}
function close_add(){
    document.querySelector('#add-badge').style.display = 'none';
}

// MODIFICA un badge allo studente
function modify_badge(e, valore1, valore2){
    document.querySelector('#modify-badge').style.display = 'flex';
    let cont = document.querySelector('.cont-modifyB');
    let cont_form = cont.children[0];

    // passaggio della variabile ID_persona
    let input = document.createElement('input');
    input.value = valore1;
    input.name = 'ID_persona';
    input.setAttribute('hidden', input);
    
    if (cont_form.lastElementChild.tagName == 'INPUT'){
        cont_form.removeChild(cont_form.lastChild);
        cont_form.removeChild(cont_form.lastChild);
        cont_form.removeChild(cont_form.lastChild);
    }
    cont_form.appendChild(input);

    // passaggio della variabile dataB
    document.querySelector('#mod-dataB').value = valore2;

    // visualizza img badge
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

    // passaggio della variabile nomeB
    let input1 = document.createElement('input');
    input1.value = badge.match(/[A-Z][a-z]*/)[0];
    input1.name = 'nomeB_assegnato';
    input1.setAttribute('hidden', input1);
    cont_form.appendChild(input1);

    // passaggio della variabile livelloB
    let input2 = document.createElement('input');
    input2.value = badge.match(/\d+/)[0];
    input2.name = 'livelloB_assegnato';
    input2.setAttribute('hidden', input2);
    cont_form.appendChild(input2);
}
function close_modify(){
    document.querySelector('#modify-badge').style.display = 'none';
    let cont = document.querySelector('.cont-modifyB');
    cont.removeChild(cont.children[0]);
}

// Controllo sul seleziona per visualizzare il badge
var num = 0;
function visual_img(){
    let nameB = document.querySelector('#add-nomeB');
    let levelB = document.querySelector('#add-livelloB');
    let addB = document.querySelector('#add-badge');

    let img = document.createElement('img');
    let url_img = 'img/badge/' + nameB.value + levelB.value + '.png';

    if(nameB.value == '' || levelB.value == ''){
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

// POPUP di notifiche
function view_alert(){
    document.querySelector('#alerts').style.display = 'flex';
}
function close_alert(){
    document.querySelector('#alerts').style.display = 'none';
    refreshPage();
}

// AGGIORNA la pagina
function refreshPage(){
    location.reload();
}