const formulario=document.querySelector('.form');
const cardInformacion=document.querySelector('.cardInformativo');
const contenedorInfo=document.querySelector('.contenedorInfo');
const publicado=document.querySelector('.infoUsu');
const publicadoOk=document.querySelector('.viajeTrue');
const publicadoFalse=document.querySelector('.viajeFalse');
const contenedorMapa=document.querySelector('.mapa');
const botonViajePuntual=document.querySelector('.puntual');
const botonViajeRecurrente=document.querySelector('.recurrente');
const inputFecha=document.querySelector('.fechaPuntual');
const inputDias=document.querySelector('.grid-dias');
const contenedorTipoViaje=document.querySelector('.mensaje_tipoviaje');
const contenedorViajeInfo=document.querySelector('.columna');
const error=document.querySelector('.error');
const cerrarIfo=document.querySelector('.close-icon');
const cardDatosVehiculo=document.querySelector('.card-datos-vehiculo');
const contenedorError=document.querySelector('.contenedor_form_error');
const inputOrigen=document.querySelector('input[name=origen]');
const inputDestino=document.querySelector('input[name=destino]');
const sugOrigen=document.getElementById('sugerencias-origen');
const sugDestino=document.getElementById('sugerencias-destino');
const burger=document.querySelector('.burger');
const menu=document.querySelector('.menu');
inputOrigen.addEventListener('input', APIorigen);
inputDestino.addEventListener('input', APIdestino);
let datosRecurrentes=[];
let datosPuntuales=[];
let origen;
let destino;
let fecha;
let hora;
let plazas;
let descripcion;
let diasSeleccionados;
let precio;
let trayecto;

burger.addEventListener('click',()=>{
    menu.classList.toggle('visible');
});
const cerrarError=document.querySelector('.error__close');
cerrarError.addEventListener('click',function(){
    error.classList.add('oculto');
});
if(cerrarIfo){
    cerrarIfo.addEventListener('click',function(){
    cardDatosVehiculo.classList.add('oculto');
    });
};

const logout=document.querySelector('.fa');
logout.addEventListener('click',function(e){
    e.preventDefault();
    window.location.href = '../utils/logout.php';
});
botonViajePuntual.addEventListener('click',function(){
    console.warn(botonViajePuntual);
    if(contenedorViajeInfo){
        contenedorViajeInfo.classList.add('oculto');
    };
    contenedorTipoViaje.classList.add('oculto');
    contenedorError.classList.remove('oculto');
    formulario.classList.remove('oculto');
    inputFecha.classList.remove('oculto');
});
botonViajeRecurrente.addEventListener('click',function(){
    if(contenedorViajeInfo){
        contenedorViajeInfo.classList.add('oculto');
    };
    contenedorTipoViaje.classList.add('oculto');
    contenedorError.classList.remove('oculto');
    formulario.classList.remove('oculto');
    inputDias.classList.remove('oculto');
});
async function APIorigen() {
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
    const query=inputDestino.value.trim();
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
formulario.addEventListener('submit',async (e)=>{
    e.preventDefault();
    let data=new FormData(e.target);
    origen=data.get('origen');
    destino=data.get('destino');
    fecha=data.get('fecha');
    hora=data.get('hora');
    plazas=data.get('plazas');
    descripcion=data.get('descripcion');
    diasSeleccionados = data.getAll('dias[]');
    precio=data.get('precio');
    console.warn(descripcion);
    const coordOrigen= await  coordenadas(origen);
    const coorDestino= await coordenadas(destino);
    if(error.classList.contains('oculto')){
        cambiarPantalla(coordOrigen,coorDestino);
    };
});
// Nominatim de OpenStreetMap, para obtener las coordenadas
async function coordenadas(direccion) {
    const url=`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(direccion)}`;
    const respuesta=await fetch(url);
    const datos = await respuesta.json();
    if (!datos[0] || datos[0].lon == undefined || datos[0].lat == undefined){
        error.classList.remove('oculto'); 
    } else{
        return [parseFloat(datos[0].lon), parseFloat(datos[0].lat)];
    } 
};
async function cambiarPantalla(coordOrigen,coorDestino){
    contenedorError.classList.add('oculto');
    let recurrente=false;
    if(inputDias.classList.contains('oculto')){
        cardInformacion.innerHTML=`
        <form class="form publicar">
                <div class='titulo'>
                    <h3>RESUMEN DE TU VIAJE</h3>
                </div>
                <div class="etiqueta">
                    <label>Origen
                    <input required placeholder="" type="text" class="input" name='origen' value="${origen}" readonly>
                    </label>
                    <label>Destino
                    <input required placeholder="" type="text" class="input" name='destino' value="${destino}" readonly>
                    </label>
                </div>
                <div class="etiqueta">
                    <label>Numero de plazas
                        <input required type="number" min="1" max="10" placeholder="" class="input" name='plazas' value="${plazas}" readonly>
                    </label> 
                    <label>Precio €
                        <input required type="number" step="0.01" placeholder=" " class="input" name='precio'value="${precio}" readonly>
                    </label> 
                </div>  
                <div class="etiqueta">
                    <label>Fecha
                        <input required placeholder="" type="date" class="input" name='fecha' value="${fecha}" readonly>
                    </label>
                    <label>Hora
                        <input required placeholder="" type="time" class="input" name='hora' value="${hora}" readonly>
                    </label>
                      
                </div>  
                <label class='textArea'>Descripción del trayecto
                    <textarea  rows="1" placeholder="" class="input01" name='descripcion' readonly>${descripcion}</textarea>
                </label>    
                <button class="fancy" href="#">
                    <span class="text">Publicar trayecto</span>
                </button>
                <a href='subirTrayecto.php'<button class="fancy" href="#">
                    <span class="text">Volver atrás </span>
                </button></a>
            </form>
    `
    }else{
        recurrente=true;
        cardInformacion.innerHTML=`
        <form class="form publicar">
                <div class='titulo'>
                    <h3>RESUMEN DE TU VIAJE</h3>
                </div>
                <div class="etiqueta">
                    <label>Origen
                        <input required placeholder="" type="text" class="input" name='origen' value="${origen}" readonly>
                    </label>
                    <label>Destino
                        <input required placeholder="" type="text" class="input" name='destino' value="${destino}" readonly>
                    </label>
                </div>
                <div class="etiqueta">
                    <label>Numero de plazas
                        <input required type="number" min="1" max="10" placeholder="" class="input" name='plazas' value="${plazas}" readonly>
                    </label> 
                    <label>Precio € 
                        <input required type="number" step="0.01" placeholder=" " class="input" name='precio'value="${precio}" readonly>
                    </label> 
                </div>  
                <div class="etiqueta">
                    <label>Fecha
                        <input required placeholder="" type="text" class="input" name='dias' value="${diasSeleccionados}" readonly>
                    </label>
                    <label>Hora
                        <input required placeholder="" type="time" class="input" name='hora' value="${hora}" readonly>
                    </label>
                      
                </div>  
                <label class='textArea'>Descripción del trayecto
                    <textarea  rows="1" placeholder="" class="input01" name='descripcion' readonly>${descripcion}</textarea>
                </label>    
                <button class="fancy" href="#">
                    <span class="text">Publicar trayecto</span>
                </button>
                <a href='subirTrayecto.php'<button class="fancy" href="#">
                    <span class="text">Volver atrás</span>
                </button></a>
            </form>
    `
    }
    await cambiarClases();
    let map=await iniciarMapa();
    console.warn(`coordenadas destino: ${coorDestino}`);
    console.warn(`coordenadas origen: ${coordOrigen}`);
    await dibujarRuta(coordOrigen,coorDestino,map);
   
    let publicar=document.querySelector('.publicar');
    console.warn(publicar);
    console.warn(coorDestino);
    publicar.addEventListener('submit',(e)=>{
        console.warn(e);
        e.preventDefault();
        let data= new FormData(e.target);
        data.append('recurrente',recurrente.toString());
        data.append('coordOrigen', JSON.stringify(coordOrigen));
        data.append('coordDestino', JSON.stringify(coorDestino));
        console.log(Object.fromEntries(data.entries()));
        fetch('../ajax/publicarTrayecto.php',{
            method:'POST',
            body:data
        })
        .then(response=>response.json())
        .then(data=>{
            respuestaServidor(data,publicar);
        })
        .catch(error => {
            console.error('Error al recibir datos :', error);
            
            contenedorMapa.classList.add('oculto');
            publicado.classList.add('visible');
            publicadoFalse.classList.add('visible');
            publicadoFalse.classList.remove('oculto');
            publicadoOk.classList.remove('visible');
            publicadoOk.classList.add('oculto');
        
        });
        
    });
}
async function cambiarClases() {
    formulario.classList.add('oculto');
    contenedorInfo.classList.remove('oculto');
    contenedorInfo.classList.add('visible');
}
async function iniciarMapa() {
     // Inicializo el mapa centrado en Madrid
     const map = L.map('map').setView([40.4168, -3.7038], 6);
     map.invalidateSize();
     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; OpenStreetMap contributors'
     }).addTo(map);
     return map;
}
// Con Leaflet, creamos el mapa dinámico y con OpenRouteService, creo la ruta 
async function dibujarRuta(coordOrigen, coorDestino,map) {
    const request = new XMLHttpRequest();
    // Configuramos la solicitud POST
    request.open('POST', 'https://api.openrouteservice.org/v2/directions/driving-car/json', true);
    request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');
    request.setRequestHeader('Content-Type', 'application/json');
    request.setRequestHeader('Authorization', ' 5b3ce3597851110001cf62486fe95c12b918412989fd54fef610ac9e'); 

    // Definimos la función que manejará la respuesta
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const respuesta = JSON.parse(this.responseText);
            const summary = respuesta.routes[0].summary;
            // Para sacar distancia y tiempo de trayecto
            const distanciaKm = (summary.distance / 1000).toFixed(2);
            const duracionMin = Math.ceil(summary.duration / 60);
            console.log(respuesta);  // Para depuración
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

    // contenido de la solicitud
    const body = JSON.stringify({
        coordinates: [coordOrigen, coorDestino]  
    });

 // Enviar la solicitud con el cuerpo
    request.send(body);
};
function respuestaServidor(datos,formulario){
    console.warn(datos.publicado);
    if(datos.publicado=='true'){
        contenedorMapa.classList.add('oculto');
        publicado.classList.remove('oculto');
        publicado.classList.add('visible');
        publicadoFalse.classList.add('oculto');
        publicadoFalse.classList.remove('visible');
        publicadoOk.classList.remove('oculto');
        publicadoOk.classList.add('visible');

    } else{
        console.warn('trayecto no publicado');
        contenedorMapa.classList.add('oculto');
        publicado.classList.add('visible');
        publicadoFalse.classList.add('visible');
        publicadoFalse.classList.remove('oculto');
        publicadoOk.classList.remove('visible');
        publicadoOk.classList.add('oculto');
    }
};

