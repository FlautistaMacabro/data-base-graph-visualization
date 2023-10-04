function toggleTestArea() {
    if(typeof(toggleTestArea.ativo) == 'undefined')
        toggleTestArea.ativo = true;
    if(!toggleTestArea.ativo){
        toggleTestArea.ativo = true;
        document.getElementById("divcontenttestarea").style.display = "block";
        //document.getElementById("divtestareabtt").style.display = "grid";
    }else {
        toggleTestArea.ativo = false;
        document.getElementById("divcontenttestarea").style.display = "none";
        //document.getElementById("divtestareabtt").style.display = "none";
    }
    document.getElementById("bttopentestarea").classList.toggle("content");
    document.getElementById("divcontenttestarea").classList.toggle("display"); 
    document.getElementById("divopentestarea").classList.toggle("marginBtt");
}

function loadMenu(menuFilePath){
    fetch(menuFilePath)
    .then(data => {
      return data.text()
    })
    .then( data => {
      document.getElementById("divcontentconfg").innerHTML = data;
    })
}

function loadMenuHome(){
    loadMenu('php/menus/menu_home.php');
}

function loadMenuConfg(){
    loadMenu('php/menus/menu_confg.php');
}

function loadMenuConfgAdd(){
    loadMenu('php/menus/menu_confg_add.php');
}

function loadMenuStatistics(){
    loadMenu('php/menus/menu_statistics.php');
}