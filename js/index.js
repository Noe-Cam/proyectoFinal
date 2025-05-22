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
const main=document.querySelector('.contenido');
const datosModal=document.querySelector('.datosModal');
const modal=document.querySelector('.modal');
const fondoOscuro=document.querySelector('.modal-oscurecer-fondo');
const infoContactar=document.querySelector('.informContacto');
const burger=document.querySelector('.burger');
const menu=document.querySelector('.menu');
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
burger.addEventListener('click',()=>{
    menu.classList.toggle('visible');
});
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
    let data1=new FormData(e.target);
    data1.append('accion', 'buscarTrayectos');
    let origen=data1.get('origen');
    let destino=data1.get('destino');
    fetch('ajax/buscarTrayecto.php',{
        method:'POST',
        body:data1
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
    nomTrayectos.innerHTML=`${origen}<br>${destino} `;
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
                <div class="trayec_recu_punt" id="${trayecto.id_trayecto}">
                    <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                    <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                    <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                    <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                </div>
            `
        });
        asignarEventosTrayectos(recurrentes);
        document.getElementById('ordenarRecurrentes').addEventListener('click',()=>{
            datosRecurrentes.sort((a,b)=>a.precio - b.precio);
            recurrentes.innerHTML=`
                <div class='contenedor_tit_btn'>
                    <h5 class=titulo-viaje>VIAJES RECURRENTES</h5> 
                </div>`;
            datosRecurrentes.forEach(trayecto => {
                recurrentes.innerHTML+=`
                    <div class="trayec_recu_punt"id="${trayecto.id_trayecto}" >
                        <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                        <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                        <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                        <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                </div>
                `
            });
            asignarEventosTrayectos(recurrentes);
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
                <div class="trayec_recu_punt" id="${trayecto.id_trayecto}">
                        <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                        <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                        <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                        <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                </div>
            `
        });
        asignarEventosTrayectos(puntuales);
        document.getElementById('ordenarPuntuales').addEventListener('click',()=>{
            datosPuntuales.sort((a,b)=>a.precio - b.precio);
            puntuales.innerHTML=`
                <div class='contenedor_tit_btn'>
                    <h5 class=titulo-viaje>VIAJES PUNTUALES</h5> 
                </div>`;
            datosPuntuales.forEach(trayecto => {
                puntuales.innerHTML+=`
                    <div class="trayec_recu_punt" id="${trayecto.id_trayecto}">
                        <p><i class="fa fa-user-circle"style="font-size:24px"></i>  ${trayecto.nombre_usuario} ${trayecto.apellido_usuario}</p>
                        <p><i class="fa fa-money" style="font-size:24px"></i>  ${trayecto.precio} €</p>
                        <p><i class="fa fa-users" style="font-size:24px"></i>  ${trayecto.plazas} plazas</p>
                        <p><i class="fa fa-clock-o" style="font-size:24px"></i>  ${trayecto.hora} h</p>
                    </div>
                `
            }); 
            asignarEventosTrayectos(puntuales);
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
function asignarEventosTrayectos(contenedor){
    contenedor.querySelectorAll('.trayec_recu_punt').forEach(elemento=>{
        elemento.addEventListener('click',(e)=>{
            detallesViaje(e);
        });
    });
};
function detallesViaje(e){
    console.warn(e.currentTarget.id);
    fetch('ajax/buscarTrayecto.php',{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body:JSON.stringify({
            accion: 'infoModal',
            idTrayecto: e.currentTarget.id
        })
    })
    .then(response=>response.json())
    .then(data=>{
        if(data.error==='no logeado'){
            main.innerHTML=`
                <video autoplay muted loop playsinline class='video-background'>
                    <source src='img/fondoSubir.mp4' type='video/mp4'>
                    Tu navegador no soporta el video.
                </video>
                    <div class='notifications-container'>
                        <div class='error-alert'>
                            <div class='flex'>
                                <div class='flex-shrink-0'>
                        
                                    <svg aria-hidden='true' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' class='error-svg'>
                                    <path clip-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z' fill-rule='evenodd'></path>
                                    </svg>
                                </div>
                            <div class='error-prompt-container'>
                                <p class='error-prompt-heading'>Debe registrarse para continuar
                                </p><div class='error-prompt-wrap'>
                                <ul class='error-prompt-list' role='list'>
                                    <li>Inicia sesión <a href='pages/login.php'>Aquí</a></li>
                                    <i class='fa-li fa fa-spinner fa-spin'>
                                </ul>
                            </div>
                        </div>
                    </div>     
            `
        }else{
            infoModal(data);
        };
    })
    .catch(error => console.error('Error al recibir datos :', error));

};
async function infoModal(datos){
    console.warn(datos);
    console.warn(datos.datosModal.fecha);
    let html=`
    <table class=info-tabla>
        <tr>
            <td class='etiqueta'>Conductor</td>
            <td class='valor'>${datos.datosModal.nombre_usuario} ${datos.datosModal.apellido_usuario}</td>
        </tr>`;
    if (datos.datosModal.fecha=='0000-00-00'){
       html+=`
        <tr>
            <td class='etiqueta'>Dias</td>
            <td class='valor'>${datos.datosModal.dias}</td>
        </tr>`;
    }else{
        html+=`
        <tr>
            <td class='etiqueta'>Fecha</td>
            <td class='valor'>${datos.datosModal.fecha}</td>
        </tr>`;
    };
    html+=`
    <tr>
        <td class='etiqueta'>Hora</td>
        <td class='valor'>${datos.datosModal.hora}</td>
    </tr>
    <tr>
        <td class='etiqueta'>Plazas disponibles</td>
        <td class='valor'>${datos.datosModal.plazas}</td>
    </tr>
    <tr>
        <td class='etiqueta'>Precio</td>
        <td class='valor'>${datos.datosModal.precio} €</td>
    </tr>
        `
    if (datos.datosModal.vehiculo!=false){
        html+=`
        <tr>
            <td class='etiqueta'>Vehículo</td>
            <td class='valor'>${datos.datosModal.vehiculo}</td>
        </tr>
        </table>`;
        
    } else{
        html+=` </table>`;
    };
    html+=`
        <button class="button_submit contactar" onclick='emailConductor("${datos.datosModal.email}","${datos.datosModal.id_trayecto}");infoContacto()'>CONTACTAR</button>
        <button class=" button_submit cerrar" onclick='cerrarModal()'>CERRAR</button>
        `;
    infoContactar.insertAdjacentHTML('afterend',html);
    fondoOscuro.classList.remove('oculto');
    modal.classList.remove('oculto');
    let map=await iniciarMapa();
    let coordOrigen=[datos.datosModal.lon_origen,datos.datosModal.lat_origen];
    let coorDestino=[datos.datosModal.lon_destino,datos.datosModal.lat_destino];
    await dibujarRuta(coordOrigen,coorDestino,map);
    fondoOscuro.classList.remove('oculto');
    modal.classList.remove('oculto');
};
function infoContacto(){
    infoContactar.classList.remove('oculto');
}
function cerrarModal(){
    fondoOscuro.classList.add('oculto');
    modal.classList.add('oculto');
}
function emailConductor(emailConductor,id_trayecto){
    console.warn('entrando en mandar email')
    fetch("ajax/buscarTrayecto.php",{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            email: emailConductor,
            idTrayecto:id_trayecto,
            accion: 'mandarEmailConductor'
        })
    })
    .then(response=>response.text())
    .then(data=>{
        console.warn(data);
    })
    .catch(error=>{
        console.warn('Error',error)
    });
};
async function iniciarMapa() {
     // Inicializo el mapa centrado en Madrid
     const map = L.map('map').setView([40.4168, -3.7038], 6);
     map.invalidateSize();
     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; OpenStreetMap contributors'
     }).addTo(map);
     return map;
};
// Con Leaflet, creamos el mapa dinámico y con OpenRouteService, creo la ruta 
async function dibujarRuta(coordOrigen, coorDestino,map) {
    const request = new XMLHttpRequest();
    // Configuramos la solicitud POST
    request.open('POST', 'https://api.openrouteservice.org/v2/directions/driving-car/json', true);
    request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');
    request.setRequestHeader('Content-Type', 'application/json');
    request.setRequestHeader('Authorization', '5b3ce3597851110001cf62486fe95c12b918412989fd54fef610ac9e'); 

    // Definimos la función que manejará la respuesta
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const respuesta = JSON.parse(this.responseText);
            const summary = respuesta.routes[0].summary;
            // Para sacar distancia y tiempo de trayecto
            const distanciaKm = (summary.distance / 1000).toFixed(2);
            const duracionMin = Math.ceil(summary.duration / 60);
            console.log(respuesta); 
            const coords = polyline.decode(respuesta.routes[0].geometry); //devuelve en [latitud,longitud]
            //  Convierto las coordenadas en [longitud,latitud] para Leaflet
            trayecto=L.geoJSON  ({
                type: "Feature",
                geometry: {
                    type: "LineString",
                    coordinates: coords.map(c => [c[1], c[0]])  // lon, lat
                }
            }).addTo(map);
            //Añadimos marcages en el punto de origen y destino
            L.marker([coordOrigen[1], coordOrigen[0]])
                .addTo(map)
                .bindPopup("🚀 Origen")
                .openPopup();
            L.marker([coorDestino[1], coorDestino[0]])
                .addTo(map)
                .bindPopup("🏁 Destino");
            map.fitBounds(trayecto.getBounds());
            const infoControl = L.control({ position: 'topright' });
            // Para añadir el div de distancia y tiempo 
            infoControl.onAdd = function () {
                const div = L.DomUtil.create('div', 'info-control');
                div.innerHTML = `
                    <div><strong>Distancia:</strong> ${distanciaKm} km</div>
                    <div><strong>Duración:</strong> ${duracionMin} min</div>
                `;
                return div;
            };

            infoControl.addTo(map);
        } else if (this.readyState === 4  && this.status != 200) {
            console.error('Error en la API:', this.status, this.statusText);
        }
    };

    // Preparar el cuerpo de la solicitud
    const body = JSON.stringify({
        coordinates: [coordOrigen, coorDestino]  // coordenads en el orden correcto (lon, lat)
    });

 // Enviar la solicitud con el cuerpo
    request.send(body);
};