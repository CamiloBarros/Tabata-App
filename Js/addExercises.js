//****Button del document****
var buttonAdd = document.getElementById("agregar");
buttonAdd.addEventListener("click",add);

var buttonDelete = document.getElementById("eliminar");
buttonDelete.addEventListener("click",del);

//****Elementos del document****
var panel = document.getElementById('ejercicios');
panel.addEventListener('change',changeImage);
var seccion = document.getElementById('secEjercicios');
var field = document.getElementById('rondas');



//***Funciones*** 
//Agregar option en la tarjeta
function add(){
    let numRondas = field.value;
    if(numRondas == ""){
        console.log("ENTRO");
        numRondas = 2;
    }
    else {
        console.log("NO entro");
        numRondas++;
    }

    //Actualiza el campo rounds 
    field.setAttribute('value',numRondas);

    var clone = panel.cloneNode(true);
    clone.setAttribute('name','ejercicios'+numRondas)
    seccion.appendChild(clone);
}

//Eliminar option de la tarjeta
function del(){
    let numRondas = field.value;
    console.log("primer: "+field.value);
    if(numRondas > 1){
        console.log("si es mayor");
        var elemDelete = document.getElementsByName('ejercicios'+numRondas)[0];
        seccion.removeChild(elemDelete);
        numRondas--;
        field.setAttribute('value',numRondas);
    }
    console.log(numRondas);

}

//Comprobar campos vacios
function changeImage(){
    
}
