var select = document.getElementById('ejercicios');
select.addEventListener('change',reloadImg);

function reloadImg(){
    document.forms['catalogo'].submit();
}