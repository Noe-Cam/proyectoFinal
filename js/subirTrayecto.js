const formulario=document.querySelector('.form');
const cardInformacion=document.querySelector('.cardInformativo');
const contenedorInfo=document.querySelector('.contenedorInfo');
let origen;
let destino;
let fecha;
let hora;
let plazas;
let descripcion;
let trayecto;
formulario.addEventListener('submit',async (e)=>{
    e.preventDefault();
    let data=new FormData(e.target);
    origen=data.get('origen');
    destino=data.get('destino');
    fecha=data.get('fecha');
    hora=data.get('hora');
    plazas=data.get('plazas');
    descripcion=data.get('descripcion');
    console.warn(descripcion);
    const coordOrigen= await  coordenadas(origen);
    const coorDestino= await coordenadas(destino);
    console.warn(coordOrigen);
    cambiarPantalla(coordOrigen,coorDestino);
    
});
// Nominatim de OpenStreetMap, para obtener las coordenadas
async function coordenadas(direccion) {
    const url=`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(direccion)}`;
    const respuesta=await fetch(url);
    const datos = await respuesta.json();
    return [parseFloat(datos[0].lon), parseFloat(datos[0].lat)];
};
async function cambiarPantalla(coordOrigen,coorDestino){
    cardInformacion.innerHTML=`
        <form class="form">
                <div class='titulo'>
                    <h3>RESUMEN DE TU VIAJE</h3>
                </div>
                <div class="etiqueta">
                    <label>Origen
                    <input required placeholder="" type="text" class="input" name='origen' value=${origen} readonly>
                    </label>
                    <label>Destino
                    <input required placeholder="" type="text" class="input" name='destino' value=${destino} readonly>
                    </label>
                </div>  

                <div class="etiqueta">
                    <label>Fecha
                        <input required placeholder="" type="date" class="input" name='fecha' value=${fecha} readonly>
                    </label>
                    <label>Hora
                        <input required placeholder="" type="time" class="input" name='hora' value=${hora} readonly>
                    </label>
                    <label>Numero de plazas
                        <input required type="number" min="1" max="10" placeholder="" class="input" name='plazas' value=${plazas} readonly>
                    </label> 
                </div>  

                <label class='textArea'>Descripción del trayecto
                    <textarea  rows="3" placeholder="" class="input01" name='descripcion' readonly>${descripcion}</textarea>
                </label>    
                <button class="fancy" href="#">
                    <span class="text">Publicar trayecto</span>
                </button>
                <a href='subirTrayecto.php'<button class="fancy" href="#">
                    <span class="text">Modificar trayecto</span>
                </button></a>
            </form>

    `
    await cambiarClases();
    let map=await iniciarMapa();
    await dibujarRuta(coordOrigen,coorDestino,map);

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
// Con Leaflet, creamos el mapa donámico y con OpenRouteService, creo la ruta (Posibilidad de añadir tiempo de duracion y km--------PENDIENTE)
async function dibujarRuta(coordOrigen, coorDestino,map) {
    const request = new XMLHttpRequest();
    // Configuramos la solicitud POST
    request.open('POST', 'https://api.openrouteservice.org/v2/directions/driving-car/json', true);
    request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');
    request.setRequestHeader('Content-Type', 'application/json');
    request.setRequestHeader('Authorization', ' 5b3ce3597851110001cf62486fe95c12b918412989fd54fef610ac9e'); // Reemplaza con tu clave de API real

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
        coordinates: [coordOrigen, coorDestino]  // Asegúrate de que las coordenadas están en el orden correcto (lon, lat)
    });

 // Enviar la solicitud con el cuerpo
    request.send(body);
}



