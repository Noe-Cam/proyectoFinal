const formulario=document.querySelector('.form');
const contenedorFom=document.querySelector('.contenedor_form');
const burger=document.querySelector('.burger');
const menu=document.querySelector('.menu');
const logIncorrecto=document.querySelector('.notifications-container');
const btnIntento= document.querySelector('.intento');
btnIntento.addEventListener('click',()=>{
    logIncorrecto.classList.remove('visible');
    logIncorrecto.classList.add('oculto');
    contenedorFom.classList.remove('oculto');
});
burger.addEventListener('click',()=>{
    menu.classList.toggle('visible');
});
formulario.addEventListener('submit',(e)=>{
    e.preventDefault();
    console.warn(e.target)
    let data= new FormData(e.target);
    fetch('../ajax/inicioSesion.php',{
        method:'POST',
        body:data,
        credentials: 'include' //Para que se envien las variables de sesion
    })
    .then(response=>response.json())
    .then(data=>{
        respuestaServidor(data);
    })
    .catch(error => console.error('Error al recibir datos :', error));
});

function respuestaServidor(datos){
    console.warn(datos.autenticacion);
    if(datos.autenticacion=='true'){
        window.location.href = '../index.php';
    } else{
        contenedorFom.classList.add('oculto');
        logIncorrecto.classList.remove('oculto');
        formulario.reset();
    }
};

