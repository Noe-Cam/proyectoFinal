const logout=document.querySelector('.fa');
const form=document.querySelector('.feed-form');
const recurrentes=document.querySelector('.recurrentes');
const puntuales=document.querySelector('.puntuales');
const secForm=document.querySelector('.section_form');
const trayectos=document.querySelector('.trayectos');
const nomTrayectos=document.querySelector('.nom_trayecto');
const inputOrigen=document.querySelector('input[name=origen]');
const inputDestino=document.querySelector('input[name=destino]');
const sugOrigen=document.getElementById('sugerencias-origen');
const sugDestino=document.getElementById('sugerencias-destino');
inputOrigen.addEventListener('input', APIorigen);
inputDestino.addEventListener('input', APIdestino);
let datosRecurrentes=[];
let datosPuntuales=[];

if (logout!=null){
    logout.addEventListener('click',function(e){
        e.preventDefault();
        window.location.href = 'utils/logout.php';
    });
};
async function APIorigen() {
    //trim para eliminar espacios
    const query=inputOrigen.value.trim();
    //Si solo se han puesto dos letras en el input no se buscan sugerencias
    if(query.length<3){
        sugOrigen.innerHTML='';
        return;
    }
    const url=`https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&limit=5&countrycodes=es&q=${encodeURIComponent(query)}`;
    try{
        const respuesta=await fetch(url,{
            headers:{
                'Accept-Language': 'es'
            }
        });
        const data= await respuesta.json();
        sugerenciasOrigen(data);
    }catch(e){
        console.error('Error en la busqueda con nominatim')
    };
};
function sugerenciasOrigen(data){
    sugOrigen.innerHTML='';
    data.forEach(direccion=>{
        const item =document.createElement('li');
        item.textContent=direccion.display_name;
        item.addEventListener('click',()=>{
            inputOrigen.value=direccion.display_name;
            sugOrigen.innerHTML='';
        });
        sugOrigen.appendChild(item);
    })
};
async function APIdestino() {
    //trim para eliminar espacios
    const query=inputDestino.value.trim();
    //Si solo se han puesto dos letras en el input no se buscan sugerencias
    if(query.length<3){
        sugDestino.innerHTML='';
        return;
    }
    const url=`https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&limit=5&countrycodes=es&q=${encodeURIComponent(query)}`;
    try{
        const respuesta=await fetch(url,{
            headers:{
                'Accept-Language': 'es'
            }
        });
        const data= await respuesta.json();
        sugerenciasDestino(data);
    }catch(e){
        console.error('Error en la busqueda con nominatim')
    };
};
function sugerenciasDestino(data){
    sugDestino.innerHTML='';
    data.forEach(direccion=>{
        const item =document.createElement('li');
        item.textContent=direccion.display_name;
        item.addEventListener('click',()=>{
            inputDestino.value=direccion.display_name;
            sugDestino.innerHTML='';
        });
        sugDestino.appendChild(item);
    });
};
form.addEventListener('submit',(e)=>{
    e.preventDefault();
    console.warn(e.target);
    let data=new FormData(e.target);
    let origen=data.get('origen');
    let destino=data.get('destino');
    fetch('buscarTrayecto.php',{
        method:'POST',
        body:data
    })
    .then(response=>response.json())
    .then(data=>{
        respuestaServidor(data,origen,destino);
    })
    .catch(error => console.error('Error al recibir datos :', error));
});

function respuestaServidor(datos,origen,destino){
    secForm.classList.add('oculto');
    trayectos.classList.remove('oculto');
    //tratamos datos de viajes recurrentes
    nomTrayectos.innerHTML=`Trayecto ${origen} - ${destino} `;
    datosRecurrentes=datos.recurrentes;
    datosPuntuales=datos.puntuales;
    ordenarDatos(datosRecurrentes,datosPuntuales);
}
function ordenarDatos(datosRecurrentes,datosPuntuales){
    if(datosRecurrentes.length>0){
        recurrentes.innerHTML=`
        <div class='contenedor_tit_btn'>
            <h5 class=titulo-viaje>VIAJES RECURRENTES</h5> 
            <button class="button" id="ordenarRecurrentes">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                </svg>
                <div class="text">
                    Ordenar por precio ascendente
                </div>
            </button>
        </div>`;
        datosRecurrentes.forEach(trayecto => {
            recurrentes.innerHTML+=`
                <div class="trayec_recu_punt">
                    <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                    <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                    <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                    <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                </div>
            `
        });
        document.getElementById('ordenarRecurrentes').addEventListener('click',()=>{
            datosRecurrentes.sort((a,b)=>a.precio - b.precio);
            recurrentes.innerHTML=`
                <div class='contenedor_tit_btn'>
                    <h5 class=titulo-viaje>VIAJES RECURRENTES</h5> 
                </div>`;
            datosRecurrentes.forEach(trayecto => {
                recurrentes.innerHTML+=`
                    <div class="trayec_recu_punt">
                    <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                    <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                    <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                    <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                </div>
                `
            });
        });
    } else{
        recurrentes.innerHTML+=`
                <h5 class=titulo-viaje>VIAJES RECURRENTES</h5>
                <div class="trayec_recu_punt">
                    <p>No hay viajes recurrentes publicados</p>
                </div>
            `
    };
    if(datosPuntuales.length>0){
        puntuales.innerHTML=`
            <div class='contenedor_tit_btn'>
                <h5 class=titulo-viaje>VIAJES PUNTUALES</h5> 
                <button class="button" id="ordenarPuntuales">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                    </svg>
                    <div class="text">
                        Ordenar por precio ascendente
                    </div>
                </button>
            </div>`;
        datosPuntuales.forEach(trayecto => {
            puntuales.innerHTML+=`
                <div class="trayec_recu_punt">
                    <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                    <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                    <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                    <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                </div>
            `
        });
        document.getElementById('ordenarPuntuales').addEventListener('click',()=>{
            datosRecurrentes.sort((a,b)=>a.precio - b.precio);
            puntuales.innerHTML=`
                <div class='contenedor_tit_btn'>
                    <h5 class=titulo-viaje>VIAJES PUNTUALES</h5> 
                </div>`;
            datosPuntuales.forEach(trayecto => {
                puntuales.innerHTML+=`
                    <div class="trayec_recu_punt">
                        <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                        <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                        <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                        <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                    </div>
                `
            }); 
        });
    } else{
        puntuales.innerHTML+=`
                <h5 class=titulo-viaje>VIAJES PUNTUALES</h5>
                <div class="trayec_recu_punt">
                    <p>No hay viajes publicados para esa fecha</p>
                </div>
            `
    };
    
}; 
