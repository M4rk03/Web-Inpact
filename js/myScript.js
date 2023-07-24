// PASSWORD
function icon_change(e){
    let pwd = e.parentElement.children[1];

    e.classList.toggle('fa-lock');
    e.classList.toggle('fa-unlock');

    pwd.type == "password" ? pwd.type = "text" : pwd.type = "password";
}

// Controllo sull'input radio
function checkRadio(el) {
    let object1 = document.querySelector('#male');
    let object2 = document.querySelector('#female');

    if (el.id == 'M') {
        if (el.checked) {
            object1.classList.toggle('fa-circle');
            object1.classList.toggle('fa-circle-dot');

            object2.classList.add('fa-circle');
            object2.classList.remove('fa-circle-dot');
        }
    } else {
        if (el.checked) {
            object2.classList.toggle('fa-circle');
            object2.classList.toggle('fa-circle-dot');

            object1.classList.add('fa-circle');
            object1.classList.remove('fa-circle-dot');
        }
    }
}

// Controllo sul seleziona tipo persona
function select_control(){
    let type_person = document.querySelector('#type_person');
    let classe_stu = document.querySelector('#classe_anno');
    let sezione = document.querySelector('#classe_sez');
    let classe_doc = document.querySelector('#classe_doc');
    let materia = document.querySelector('#mat_inseg');
    
    if(type_person.value == 1){
        classe_stu.style.display = 'flex';
        sezione.required = true;

        classe_doc.style.display = 'none';
        materia.required = false;

    } else if(type_person.value == 2){
        classe_doc.style.display = 'grid';
        materia.required = true;

        classe_stu.style.display = 'none';
        sezione.required = false;

    } else{
        classe_stu.style.display = 'none';
        sezione.required = false;
        classe_doc.style.display = 'none';
        materia.required = false;
    }
}

// Aggiungi o Rimuovi classe per docente
function dragStart(ev) {
    ev.dataTransfer.setData("Text", ev.target.id);
}

function allowDrop(ev) {
    if ((ev.target.id == 'cl_tot') || (ev.target.id == 'cl_inseg')) ev.preventDefault();
}

function drop(ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("Text");
    ev.target.appendChild(document.getElementById(data));

    let select_class = document.querySelector('#lettura_classe');

    // modifica icone
    ev.target.lastChild.children[0].classList.remove('fa-plus');
    ev.target.lastChild.children[0].classList.remove('fa-trash');

    if (ev.target.id == 'cl_tot') {
        ev.target.lastChild.children[0].classList.add('fa-plus');

        // seleziono la classe
        let ID_classe = ev.target.lastChild.id.split("_");

        for (const i of  select_class.children) {
            if (i.value == ID_classe[1]) {
                i.selected = false;
            }
        }

    } else if (ev.target.id == 'cl_inseg') {
        ev.target.lastChild.children[0].classList.toggle('fa-trash');

        // seleziono la classe
        let ID_classe = ev.target.lastChild.id.split("_");

        for (const i of  select_class.children) {
            if (i.value == ID_classe[1]) i.selected = true;
        }
    }
}

// Aggiungi materia
function addMateria(){
    document.querySelector('#add-materia').style.display = 'flex';
    document.querySelector('#ins-mat').required = true;
}
function close_mat(){
    document.querySelector('#add-materia').style.display = 'none';
    document.querySelector('#ins-mat').required = false;
}

// Passaggio di variabile per popup
function passVariable(variable, name) {
    let input = document.createElement('input');
    input.value = variable;
    input.name = name;
    input.setAttribute('hidden', input);

    return input;
}

// Visualizzazione badge
function visual_img(url){
    let img = document.createElement('img');
    let url_img = 'img/badge/' + url + '.png';
    img.setAttribute('src', url_img);
    img.classList.add('badge-popup')

    return img;
}

// ZOOM del Badge
let visualizza_badge = document.querySelector('#visual-badge');
function zoom_badge(badge, data, prof, mat, testo){
    visualizza_badge.style.display = 'flex';
    let cont = visualizza_badge.children[0];

    // visualizza img badge
    let img = visual_img(badge);
    img.classList.add('.info-badge-img');
    cont.insertBefore(img, cont.children[0]);

    // passaggio dati
    document.querySelector('#data').firstChild.textContent = data.substring(8, 10) + "/" + data.substring(5, 7) + "/" + data.substring(0, 4);
    document.querySelector('#prof').firstChild.textContent = prof;
    document.querySelector('#mat').firstChild.textContent = mat;
    
    if (testo == "") testo = "<em> Nessuna descrizione </em>";
    document.querySelector('#desc').innerHTML = testo;
}
function close_visual(){
    visualizza_badge.style.display = 'none';
    let cont = visualizza_badge.children[0];
    cont.removeChild(cont.children[0])
}

// ASSEGNA un badge allo studente
let add_badge = document.querySelector('#add-badge');

function addBadge(valore){
    add_badge.style.display = 'flex';
    let add_badge_child = add_badge.children[0];

    if (add_badge_child.lastElementChild.tagName == 'INPUT'){
        add_badge_child.removeChild(add_badge_child.lastChild);
    }
    add_badge_child.appendChild(passVariable(valore, 'ID_persona'));
}
function close_add(){
    add_badge.style.display = 'none';

    if (add_badge.children[0].tagName == 'IMG'){
        add_badge.removeChild(add_badge.children[0]);
    }
}

// MODIFICA un badge allo studente
let modify_badge = document.querySelector('.cont-modifyB');

function modifyBadge(e, IDpers, data, text){
    document.querySelector('#modify-badge').style.display = 'flex';
    let modify_badge_child = modify_badge.children[0];

    // passaggio della variabile ID_persona
    if (modify_badge_child.lastElementChild.tagName == 'INPUT'){
        for (let i=0; i < 3; i++) {
            modify_badge_child.removeChild(modify_badge_child.lastChild);
        }
    }
    modify_badge_child.appendChild(passVariable(IDpers, 'ID_persona'));

    // passaggio delle variabili dataB e descrizione
    document.querySelector('#mod-dataB').value = data;
    document.querySelector('#mod-descri').value = text;

    // visualizza img badge
    let badge = e.children[0].alt;
    modify_badge.insertBefore(visual_img(badge), modify_badge_child);

    let nameB = document.querySelector('#mod-nomeB');
    let levelB = document.querySelector('#mod-livelloB');

    let badge_nome = badge.match(/[A-Z][a-z]*/)[0];
    let badge_livello = badge.match(/\d+/)[0];
    
    for (const i of nameB.children) {
        if (i.value == badge_nome) i.selected = true;
    }

    for (const i of levelB.children) {
        if (i.value == badge_livello) i.selected = true;
    }

    // passaggio delle variabili nomeB e livelloB
    modify_badge_child.appendChild(passVariable(badge_nome, 'nomeB_assegnato'));
    modify_badge_child.appendChild(passVariable(badge_livello, 'livelloB_assegnato'));
}
function close_modify(){
    document.querySelector('#modify-badge').style.display = 'none';
    modify_badge.removeChild(modify_badge.children[0]);
}

// Controllo per visualizzare il badge
function visual_badge(){
    let nameB = document.querySelector('#add-nomeB');
    let levelB = document.querySelector('#add-livelloB');

    let badge = nameB.value + levelB.value;

    if(add_badge.firstElementChild.tagName == 'IMG') add_badge.removeChild(add_badge.firstElementChild);

    if(nameB.value != '' && levelB.value != ''){
        if(add_badge.firstElementChild.tagName != 'IMG') add_badge.insertBefore(visual_img(badge), add_badge.children[0]);
    }
}

// POPUP di notifiche
function close_alert(){
    refreshPage();
    document.querySelector('#alerts').style.display = 'none';
}

// AGGIORNA la pagina
function refreshPage(){
    location.reload();
}