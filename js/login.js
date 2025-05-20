const formulario=document.querySelector('.form');
const burger=document.querySelector('.burger');
const menu=document.querySelector('.menu');

burger.addEventListener('click',()=>{
    menu.classList.toggle('visible');
});

formulario.addEventListener('submit',(e)=>{
    e.preventDefault();
    let data= new FormData(e.target);
    fetch('ajax/inicioSesion.php',{
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
        window.location.href = 'index.php';
    } else{
        const logIncorrecto=document.querySelector('.notifications-container');
        formulario.classList.add('oculto');
        logIncorrecto.classList.remove('oculto');
        logIncorrecto.classList.add('visible');
    }
};