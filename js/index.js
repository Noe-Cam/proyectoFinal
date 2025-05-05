const logout=document.querySelector('.fa');
const form=document.querySelector('.feed-form');
const recurrentes=document.querySelector('.recurrentes');
const puntuales=document.querySelector('.puntuales');
const secForm=document.querySelector('.section_form');
const trayectos=document.querySelector('.trayectos');
if (logout!=null){
    logout.addEventListener('click',function(e){
        e.preventDefault();
        window.location.href = 'utils/logout.php';
    });
};
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
    secForm.classList.add('oculto');
    trayectos.classList.remove('oculto');
    //tratamos datos de viajes recurrentes
    if(datos.recurrentes.length>0){
        recurrentes.innerHTML=`<h5 class=titulo-viaje>VIAJES RECURRENTES</h5>`;
        datos.recurrentes.forEach(trayecto => {
            recurrentes.innerHTML+=`
                <div class="trayec_recu_punt">
                    <p>${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                    <p>${trayecto.precio} €</p>
                    <p>${trayecto.plazas} plazas</p>
                </div>
            `
        });
    } else{
        recurrentes.innerHTML+=`
                <h5 class=titulo-viaje>VIAJES RECURRENTES</h5>
                <div class="trayec_recu_punt">
                    <p>No hay viajes recurrentes publicados</p>
                </div>
            `
    };
    if(datos.puntuales.length>0){
        puntuales.innerHTML=`<h5 class=titulo-viaje>VIAJES PUNTUALES</h5>`;
        datos.puntuales.forEach(trayecto => {
            puntuales.innerHTML+=`
                <div class="trayec_recu_punt">
                    <p>${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                    <p>${trayecto.precio} €</p>
                    <p>${trayecto.plazas} plazas</p>
                </div>
            `
        });
    } else{
        puntuales.innerHTML+=`
                <h5 class=titulo-viaje>VIAJES PUNTUALES</h5>
                <div class="trayec_recu_punt">
                    <p>No hay viajes publicados para esa fecha</p>
                </div>
            `
    }
};