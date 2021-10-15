//Botones
let button = document.getElementById('estado');
button.addEventListener("click", temporizador);
button.opcion = false;

//Obteniendo valores de los campos
let prepared = document.getElementsByName('prepared')[0];
prepared.read = false;
let work = document.getElementsByName('work')[0];
work.read = false;
let rest = document.getElementsByName('rest')[0];
rest.read = false;
let series = document.getElementsByName('series')[0];
series.read = false;
let rounds = document.getElementsByName('rounds')[0];
rounds.read = false;

let finally_ = false;

//Inicializamos variables
var segundos = 0;
var segundosSecundarios = 0;
var minutos = 0;
var minutosSecundarios = 0;
var horas = 0;
var horasSecundarios = 0;
var contSegundos = 0;
var contSegundosSecundarios = 0;
var progress = 1;
//Variables controladoras recursivas
let serie_ = 1;
let ronda_ = 1;

//Ecuacion barProgress
let segTotales = (parseInt(prepared.value) + (parseInt(work.value) + parseInt(rest.value))*parseInt(series.value)*parseInt(rounds.value))*1000;
console.log(segTotales);
let tExtra = (1500*parseInt(series.value)*parseInt(rounds.value))+(1000*parseInt(series.value))+(2000*parseInt(rounds.value))+1000;
cSeg = (segTotales)/100;

//Sonidos
let sonido = {
    src: "Audio/Music_1.mp3",
    rep: false,
}

//Funciones
function temporizador() {   
    if(!sonido.rep){
        sonido.rep = true;
        sonido.audio = audio(sonido.src);
    }
    button.disabled = false;
    if(finally_){
        Segundos.innerHTML = ":00";
        Minutos.innerHTML = ":00";
        Horas.innerHTML = "00";

        Segundos_secondary.innerHTML = ":00";
        Minutos_secondary.innerHTML = ":00";
        Horas_secondary.innerHTML = "00";
        currentEj.innerHTML = "";

        clearBarProgress();
        finally_ = false;
    }
    if (button.opcion == true) {
        pausar();
    } else {
        button.innerHTML = "Pausar";
        button.setAttribute('class', 'btn btn-danger btn-block');
        button.opcion = true;
        inicio();
    }
}

function inicio() {
    if(!prepared.read){
        currentEj.innerHTML = "Calentamiento";        
    }
    timer = setTimeout(function e() {
        control = setInterval(cronometro, 1000);
        barProgress();
    }, 500);
}

function pausar() {
    button.innerHTML = "Renaudar";
    button.setAttribute('class', 'btn btn-primary btn-block');
    button.opcion = false;
    clearInterval(control);
    clearInterval(barInterval);
}

function cronometro() {
    if (segundos < 59) {
        segundos++;
        contSegundos++;
        if (segundos < 10) {
            segundos = "0" + segundos
        }
        Segundos.innerHTML = ":" + segundos;
    }
    if (segundos == 59) {
        segundos = -1;
    }
    if (segundos == 0) {
        minutos++;
        if (minutos < 10) {
            minutos = "0" + minutos
        }
        Minutos.innerHTML = ":" + minutos;
    }
    if (minutos == 59) {
        minutos = -1;
    }
    if ((segundos == 0) && (minutos == 0)) {
        horas++;
        if (horas < 10) {
            horas = "0" + horas
        }
        Horas.innerHTML = horas;
    }
    tiempos();
}

function tiempos() {
    if (contSegundos == prepared.value && !prepared.read) {
        contSegundos = 0;
        prepared.read = true;
        button.disabled = true;
        pausar();
        currentEj.innerHTML = current();
        setTimeout(temporizador, 1000);
    }
    if (prepared.read && contSegundos == work.value) {
        contSegundos = 0;
        work.read = true;
        button.disabled = true;
        pausar();
        currentEj.innerHTML = "Descanso";
        setTimeout(inicioSecundario,1000);
    }
}

//Funciones del temporizador secundario



function inicioSecundario() {
    button.disabled = false;
    timer = setTimeout(function e() {
        controlS = setInterval(cronometroSecundario, 1000);
        barProgress();
    }, 0000);
}

function cronometroSecundario() {
    if (segundosSecundarios < 59) {
        segundosSecundarios++;
        contSegundosSecundarios++;
        if (segundosSecundarios < 10) {
            segundosSecundarios = "0" + segundosSecundarios
        }
        Segundos_secondary.innerHTML = ":" + segundosSecundarios;
    }
    if (segundosSecundarios == 59) {
        segundosSecundarios = -1;
    }
    if (segundosSecundarios == 0) {
        minutosSecundarios++;
        if (minutosSecundarios < 10) {
            minutosSecundarios = "0" + minutosSecundarios
        }
        Minutos_secondary.innerHTML = ":" + minutosSecundarios;
    }
    if (minutosSecundarios == 59) {
        minutosSecundarios = -1;
    }
    if ((segundosSecundarios == 0) && (minutosSecundarios == 0)) {
        horasSecundarios++;
        if (horasSecundarios < 10) {
            horasSecundarios = "0" + horasSecundarios
        }
        Horas_secondary.innerHTML = horasSecundarios;
    }
    restTime();
}

function pausarSecundario() {
    clearInterval(controlS);
    clearInterval(barInterval);
}

function restTime() {   
    if (contSegundosSecundarios == rest.value){
        if(serie_ < parseInt(series.value)){
            contSegundosSecundarios = 0;
            serie_++;
            currentSerie.innerHTML = serie_;
            button.disabled = true;
            pausarSecundario();
            currentEj.innerHTML = current();
            setTimeout(temporizador,1000);
        }
        else{
            if(ronda_ < parseInt(rounds.value)){
                serie_ = 1;
                ronda_++;
                currentRound.innerHTML = ronda_;
                button.disabled = true;
                clearVariables();
                pausarSecundario();
                currentEj.innerHTML = "Siguiente Ejercicio";
                setTimeout(function() {
                    currentEj.innerHTML = current();
                },1000);
                setTimeout(temporizador, 1000);
                //setTimeout(inicioSecundario, 1000);            
            }
            else{
                serie_ = 0;
                ronda_ = 0;
                pausarSecundario();
                clearVariables();
                currentEj.innerHTML = "Finalizado";
                button.innerHTML = "Iniciar";
                button.setAttribute('class', 'btn btn-primary btn-block');
                button.opcion = false;
                finally_ = true;
                sonido.audio.pause();
                sonido.rep = false;
            }
        }
        work.read = false;
    }
}

function clearVariables(){
    segundos = 0;
    segundosSecundarios = 0;
    minutos = 0;
    minutosSecundarios = 0;
    horas = 0;
    horasSecundarios = 0;
    contSegundos = 0;
    contSegundosSecundarios = 0;
}

//Funcion para obtener el nombre del ejercicio que se esta ejecuntado
function current(){
    var select = document.getElementsByName('ejercicios'+ronda_)[0];
    var selectedOption = select.options[select.selectedIndex];
    console.log(selectedOption.value + ': ' + selectedOption.text);
    return selectedOption.text;
}

function barProgress(){
    console.log("Entro");
    //var bar = document.getElementById("bar");
    barInterval = setInterval(() =>{
        progress++;
        bar.setAttribute("style","width: "+progress+"%");
        //bar.innerHTML = progress + "%";
    }, cSeg); 
    
}

function clearBarProgress(){
    var bar = document.getElementById("bar");
    bar.setAttribute("style","width: 0%");
    progress = 0;
}

function audio(evento) {
    var reproducir = new Audio();
    reproducir.src = evento;
    //reproducir.volume = 0.3;

    reproducir.play();
    return reproducir;
}