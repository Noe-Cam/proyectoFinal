const logout=document.querySelector('.fa');
const form=document.querySelector('.feed-form');
logout.addEventListener('click',function(e){
    e.preventDefault();
    window.location.href = 'utils/logout.php';
});
form.addEventListener('submit',(e)=>{
    e.preventDefault();
    let data=new FormData(e.target);
    fetch('buscarTrayecto.php',{
        method:'POST',
        body:data
    })
    .then(response=>response.json())
    .then(data=>{
        respuestaServidor(data);
    })
    .catch(error => console.error('Error al recibir datos :', error));
});

function respuestaServidor(datos){

};