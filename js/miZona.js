const logout=document.querySelector('.fa');
const burger=document.querySelector('.burger');
const menu=document.querySelector('.menu');
const cambiarDatosUsu=document.querySelector('.btn-datos');
const cambiarContra=document.querySelector('.btn-contra');
const eliminarCuenta=document.querySelector('.eliminar');
const datosVehiculoNuevos=document.querySelector('.vehiculoNuevo');
const datosmodfVehiculo=document.querySelector('.modfVehiculo');
const infoViaje=document.querySelectorAll('.viaje-card');
const oscurecerFondo=document.querySelector('.modal-oscurecer-fondo');
const modalDatosUsu=document.querySelector('.modalDatosUsu');
const modalDatosContra=document.querySelector('.modalDatosContra');
const modalEliminarCuenta=document.querySelector('.modalEliminarCuenta');
const modalVehiculoNuevo=document.querySelector('.modalVehiculoNuevo');
const modalModfVehiculo=document.querySelector('.modalModfVehiculo');
const modalModifTrayecto=document.querySelector('.modalModifTrayecto');
const grupoDias=document.querySelector('.grupoDias');
const grupoFecha=document.querySelector('.grupoFecha');
const btnCerrar=document.querySelectorAll('.cerrar');
const formUsu=document.getElementById('formUsuario');
const formContra=document.getElementById('formContra');
const formVehicNuevo=document.getElementById('formDatosVehic');
const formModifTrayecto=document.getElementById('formModifTrayecto');
const btnGuardarUsu=document.querySelector('.guardar');
const btnguardarContra=document.querySelector('.guardarContra');
const btnDesactCuenta=document.querySelector('.desactCuenta');
const btnDatosVehiculoNuevo=document.querySelector('.guardarVehiculoNuevo');
const btnModfVehic=document.querySelector('.guardarModfVehic');
const btnModfTrayecto=document.querySelector('.guardarModifTrayecto');
const btnActDesactTrayecto=document.querySelector('.actDesacTrayecto');
const infoUsu=document.querySelector('.infoUsu');
const infoContra=document.querySelector('.infoContra');
const infoDesactCuenta=document.querySelector('.infoDesactCuenta');
const infoVehiculoNuevo=document.querySelector('.infoVehiculoNuevo');
const infoinfoModfVehic=document.querySelector('.infoModfVehic');
const infoModifTrayecto=document.querySelector('.infoModifTrayecto');
const mensajeExitoUsu=document.querySelector('.info__title.true');
const mensajeErrorUsu=document.querySelector('.info__title.false');
const mensajeCorreoFalse=document.querySelector('.info__title.emailFalse');
const mensajeExitoContra=document.querySelector('.trueContra');
const mensjErrorContra=document.querySelector('.falseContra');
const mensjErrorContraActual=document.querySelector('.falseContraActual');
const mensjContrasDif=document.querySelector('.contrasDif');
const mensjContraLongitud=document.querySelector('.contraLength');
const mensjCuentaDesactivada=document.querySelector('.trueCuentaDesact');
const mensjCuentaDesactivadaFalse=document.querySelector('.falseCuentaDesact');
const mensjNuevoVehiculoTrue=document.querySelector('.nuevoVehictrue');
const mensjNuevoVehiculoFalse=document.querySelector('.nuevoVehicfalse');
const mensjModfVehictrue=document.querySelector('.modfVehictrue');
const mensjModfVehicfalse=document.querySelector('.modfVehicfalse');
const mensjmodfTrayectotrue=document.querySelector('.modfTrayectotrue');
const mensjmodfTrayectofalse=document.querySelector('.modfTrayectofalse');
const mensjmodfTrayectoEstadotrue=document.querySelector('.modfTrayectoEstadotrue');
const mensjmodfTrayectoEstadofalse=document.querySelector('.modfTrayectoEstadofalse');

btnCerrar.forEach(boton=>{
    boton.addEventListener('click',cerrarModales);
});
function cerrarModales(){
    if(modalDatosUsu && modalDatosUsu.classList.contains('visible')){
        modalDatosUsu.classList.add('oculto');
        modalDatosUsu.classList.remove('visible');
        oscurecerFondo.classList.remove('visible');
        modalDatosUsu.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        infoUsu.classList.add('oculto');
        mensajeExitoUsu.classList.add('oculto');
        mensajeErrorUsu.classList.add('oculto');
        mensajeCorreoFalse.classList.add('oculto');
    }else if(modalDatosContra && modalDatosContra.classList.contains('visible')){
        formContra.reset();
        modalDatosContra.classList.add('oculto');
        modalDatosContra.classList.remove('visible');
        oscurecerFondo.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        infoContra.classList.add('oculto');
        mensajeExitoContra.classList.add('oculto');
        mensjErrorContra.classList.add('oculto');
        mensjErrorContraActual.classList.add('oculto');
        mensjContrasDif.classList.add('oculto');
    }else if(modalEliminarCuenta && (modalEliminarCuenta.classList.contains('visible') && mensjCuentaDesactivada.classList.contains('visible'))){
        window.location.href = '../utils/logout.php';
    }else if(modalEliminarCuenta && modalEliminarCuenta.classList.contains('visible')){
        oscurecerFondo.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        modalEliminarCuenta.classList.add('oculto');
        modalEliminarCuenta.classList.remove('visible');
    }else if(modalVehiculoNuevo && modalVehiculoNuevo.classList.contains('visible')){
        oscurecerFondo.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        modalVehiculoNuevo.classList.add('oculto');
        modalVehiculoNuevo.classList.remove('visible');
        infoVehiculoNuevo.classList.add('oculto');
        mensjNuevoVehiculoTrue.classList.add('oculto');
        mensjNuevoVehiculoFalse.classList.add('oculto');
    }else if(modalModfVehiculo && modalModfVehiculo.classList.contains('visible')){
        oscurecerFondo.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        modalModfVehiculo.classList.remove('visible');
        modalModfVehiculo.classList.add('oculto');
        infoinfoModfVehic.classList.add('oculto');
        mensjModfVehictrue.classList.add('oculto');
        mensjModfVehicfalse.classList.add('oculto');
    }else if(modalModifTrayecto && modalModifTrayecto.classList.contains('visible')){
        oscurecerFondo.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        modalModifTrayecto.classList.remove('visible');
        modalModifTrayecto.classList.add('oculto');
        infoModifTrayecto.classList.add('oculto');
        mensjmodfTrayectoEstadotrue.classList.add('oculto');
        mensjmodfTrayectoEstadofalse.classList.add('oculto');
        mensjmodfTrayectotrue.classList.add('oculto');
        mensjmodfTrayectotrue.classList.add('oculto');
    };
};
logout.addEventListener('click',function(e){
    e.preventDefault();
    window.location.href = '../utils/logout.php';
});
burger.addEventListener('click',()=>{
    menu.classList.toggle('visible');
});
cambiarDatosUsu.addEventListener('click',editarDatosUsu);
cambiarContra.addEventListener('click',editarContra);
eliminarCuenta.addEventListener('click',desactivarCuenta);
if(datosVehiculoNuevos){
    datosVehiculoNuevos.addEventListener('click',añadirDatosVehiculos);
};
if(datosmodfVehiculo){
    datosmodfVehiculo.addEventListener('click',modificarDatosVehiculos)
};
infoViaje.forEach(viaje=>{
    viaje.addEventListener('click',()=>{
        document.getElementById('id_trayecto').value = viaje.dataset.id;
        document.getElementById('origen').value = viaje.dataset.origen;
        document.getElementById('destino').value = viaje.dataset.destino;
        document.getElementById('fecha').value = viaje.dataset.fecha ;
        document.getElementById('hora').value = viaje.dataset.hora ;
        document.getElementById('precio').value = viaje.dataset.precio ;
        document.getElementById('plazas').value = viaje.dataset.plazas;
        document.getElementById('recurrente').value = viaje.dataset.recurrente ;
        document.getElementById('dias').value = viaje.dataset.dias;
        document.getElementById('descripcion').value = viaje.dataset.descripcion;

        const activo = viaje.dataset.activo;
        btnActDesactTrayecto.dataset.id=viaje.dataset.id;
        btnActDesactTrayecto.dataset.activo=activo;
        btnActDesactTrayecto.textContent = activo == '1' ? 'Desactivar viaje' : 'Activar viaje';
        mostrarDiasFecha();
    });
});
function mostrarDiasFecha(){
    const recurrente=document.getElementById('recurrente').value;
    if(recurrente=='1'){
        grupoFecha.classList.add('oculto');
        grupoFecha.classList.remove('visible');
        grupoDias.classList.add('visible');
        grupoDias.classList.remove('oculto');
        document.getElementById('dias').setAttribute('required', 'required');
        document.getElementById('fecha').removeAttribute('required');
    }else{
        grupoDias.classList.add('oculto');
        grupoDias.classList.remove('visible');
        grupoFecha.classList.add('visible');
        grupoFecha.classList.remove('oculto');
        document.getElementById('dias').removeAttribute('required');
        document.getElementById('fecha').setAttribute('required', 'required');
    };
    oscurecerFondo.classList.remove('oculto');
    oscurecerFondo.classList.add('visible');
    modalModifTrayecto.classList.remove('oculto');
    modalModifTrayecto.classList.add('visible');
};
function editarDatosUsu(){
    oscurecerFondo.classList.remove('oculto');
    oscurecerFondo.classList.add('visible');
    modalDatosUsu.classList.remove('oculto');
    modalDatosUsu.classList.add('visible');
};
function editarContra(){
    oscurecerFondo.classList.remove('oculto');
    oscurecerFondo.classList.add('visible');
    modalDatosContra.classList.remove('oculto');
    modalDatosContra.classList.add('visible');
};
function desactivarCuenta(){
    oscurecerFondo.classList.remove('oculto');
    oscurecerFondo.classList.add('visible');
    modalEliminarCuenta.classList.remove('oculto');
    modalEliminarCuenta.classList.add('visible');
};
function añadirDatosVehiculos(){
    oscurecerFondo.classList.remove('oculto');
    oscurecerFondo.classList.add('visible');
    modalVehiculoNuevo.classList.remove('oculto');
    modalVehiculoNuevo.classList.add('visible');
};
function modificarDatosVehiculos(){
    oscurecerFondo.classList.remove('oculto');
    oscurecerFondo.classList.add('visible');
    modalModfVehiculo.classList.add('visible');
    modalModfVehiculo.classList.remove('oculto');
}
btnGuardarUsu.addEventListener('click',function(e){
    e.preventDefault();
    const formData= new FormData (formUsu);
    formData.append('accion','modificar_datosUsu');

    fetch('../ajax/cambiosMiZona.php',{
        method: 'POST',
        body: formData
    })
    .then (response=> response.json())
    .then(data =>{
        respuestaServidorUsu(data);
    })
    .catch(error=>{
        respuestaServidorUsu(error);
    });
});
btnguardarContra.addEventListener('click',function(e){
    e.preventDefault();
    const formData= new FormData (formContra);
    formData.append('accion','modificar_contra');
    fetch('../ajax/cambiosMiZona.php',{
        method: 'POST',
        body: formData
    })
    .then (response=> response.json())
    .then(data =>{
        respuestaServidorContra(data);
    })
    .catch(error=>{
        respuestaServidorContra(error);
    });
});
btnDesactCuenta.addEventListener('click',function(){
    const datos=new FormData();
    datos.append('accion','desactivarCuenta');
    fetch('../ajax/cambiosMiZona.php',{
        method:'POST',
        body:datos
    }).then (response=> response.json())
    .then(data =>{
        respuestaServidorCuentaDesact(data);
    })
    .catch(error=>{
        respuestaServidorCuentaDesact(error);
    });
});
if(btnDatosVehiculoNuevo){
    btnDatosVehiculoNuevo.addEventListener('click',function(e){
        e.preventDefault();
        const formData= new FormData (formVehicNuevo);
        formData.append('accion','añadir_datosVehic');
        fetch('../ajax/cambiosMiZona.php',{
            method: 'POST',
            body: formData
        })
        .then (response=> response.json())
        .then(data =>{
            respuestaServidorNuevoVehic(data);
        })
        .catch(error=>{
            respuestaServidorNuevoVehic(error);
        });
    });
};
if(btnModfVehic){
    btnModfVehic.addEventListener('click',function(e){
        e.preventDefault();
        const formData= new FormData (formModfVehiculo);
        formData.append('accion','modificar_datosVehic');
        fetch('../ajax/cambiosMiZona.php',{
            method: 'POST',
            body: formData
        })
        .then (response=> response.json())
        .then(data =>{
            respuestaServidorModifVehic(data);
        })
        .catch(error=>{
            respuestaServidorModifVehic(error);
        });
    });
};
btnModfTrayecto.addEventListener('click',function(e){
    e.preventDefault();
    const formData= new FormData (formModifTrayecto);
    formData.append('accion','modificar_datosTrayecto');
        fetch('../ajax/cambiosMiZona.php',{
            method: 'POST',
            body: formData
        })
        .then (response=> response.json())
        .then(data =>{
            respuestaServidorModifTrayecto(data);
        })
        .catch(error=>{
            respuestaServidorModifTrayecto(error);
        });
});
btnActDesactTrayecto.addEventListener('click',function(){
    const idTrayecto = this.dataset.id;
    console.warn(idTrayecto);
    const estadoActual = this.dataset.activo;
    console.warn(estadoActual);
    // Invertimos el valor del estado del boton. Si antes era un boton de la zona viajes activos y se le ha pulsado pasa a valor 0, para cambiarlo a inactivo el viaje
    const nuevoEstado = estadoActual === '1' ? '0' : '1';
    const formData = new FormData();
    formData.append('accion', 'cambiar_estado_trayecto');
    formData.append('id_trayecto', idTrayecto);
    formData.append('nuevo_estado', nuevoEstado);
        fetch('../ajax/cambiosMiZona.php',{
            method: 'POST',
            body: formData
        })
        .then (response=> response.json())
        .then(data =>{
            respuestaServidorCambioEstadoTrayecto(data);
        })
        .catch(error=>{
            respuestaServidorCambioEstadoTrayecto(error);
        });
    
});
function respuestaServidorUsu(datos){
    if(datos.cambioUsu==true){
        infoUsu.classList.remove('oculto');
        mensajeExitoUsu.classList.add('visible');
        mensajeErrorUsu.classList.add('oculto');
        mensajeErrorUsu.classList.remove('visible');
        mensajeCorreoFalse.classList.add('oculto');
        mensajeCorreoFalse.classList.remove('visible');

    }else if(datos.cambioUsu==false && datos.mensaje=='email usado'){
        infoUsu.classList.remove('oculto');
        mensajeCorreoFalse.classList.add('visible');
        mensajeErrorUsu.classList.add('oculto');
        mensajeErrorUsu.classList.remove('visible')
        mensajeExitoUsu.classList.add('oculto');
        mensajeExitoUsu.classList.remove('visible');
    }else{
        console.warn(datos.errorSQL);
        infoUsu.classList.remove('oculto');
        mensajeErrorUsu.classList.add('visible');
        mensajeExitoUsu.classList.add('oculto');
        mensajeExitoUsu.classList.remove('visible');
        mensajeCorreoFalse.classList.add('oculto');
        mensajeCorreoFalse.classList.remove('visible');

    };
};

function respuestaServidorContra(datos){
    if (datos.cambioContra==true){
        infoContra.classList.remove('oculto');
        mensajeExitoContra.classList.add('visible');
        mensjErrorContra.classList.add('oculto');
        mensjErrorContra.classList.remove('visible');
        mensjErrorContraActual.classList.add('oculto');
        mensjErrorContraActual.classList.remove('visible');
        mensjContrasDif.classList.add('oculto');
        mensjContrasDif.classList.remove('visible');
        mensjContraLongitud.classList.add('oculto');
        mensjContraLongitud.classList.remove('visible');
    }else if(datos.cambioContra==false && datos.mensaje=='error contra actual'){
        infoContra.classList.remove('oculto');
        mensjErrorContraActual.classList.add('visible');
        mensajeExitoContra.classList.add('oculto');
        mensajeExitoContra.classList.remove('visible');
        mensjErrorContra.classList.add('oculto');
        mensjErrorContra.classList.remove('visible');
        mensjContrasDif.classList.add('oculto');
        mensjContrasDif.classList.remove('visible');
        mensjContraLongitud.classList.add('oculto');
        mensjContraLongitud.classList.remove('visible');
    }else if(datos.cambioContra==false && datos.mensaje=='contras diferentes'){
        infoContra.classList.remove('oculto');
        mensjContrasDif.classList.add('visible');
        mensajeExitoContra.classList.add('oculto');
        mensajeExitoContra.classList.remove('visible');
        mensjErrorContra.classList.add('oculto');
        mensjErrorContra.classList.remove('visible');
        mensjErrorContraActual.classList.add('oculto');
        mensjErrorContraActual.classList.remove('visible');
        mensjContraLongitud.classList.add('oculto');
        mensjContraLongitud.classList.remove('visible');
    }else if(datos.cambiarContra==false && datos.error==true){
        infoContra.classList.remove('oculto');
        mensjErrorContra.classList.add('visible');
        mensajeExitoContra.classList.add('oculto');
        mensajeExitoContra.classList.remove('visible');
        mensjErrorContraActual.classList.add('oculto');
        mensjErrorContraActual.classList.remove('visible');
        mensjContrasDif.classList.add('oculto');
        mensjContrasDif.classList.remove('visible');
        mensjContraLongitud.classList.add('oculto');
        mensjContraLongitud.classList.remove('visible');
    }else{
        infoContra.classList.remove('oculto');
        mensjContraLongitud.classList.add('visible');
        mensajeExitoContra.classList.add('oculto');
        mensajeExitoContra.classList.remove('visible');
        mensjErrorContraActual.classList.add('oculto');
        mensjErrorContraActual.classList.remove('visible');
        mensjContrasDif.classList.add('oculto');
        mensjContrasDif.classList.remove('visible');
        mensjErrorContra.classList.add('oculto');
        mensjErrorContra.classList.remove('visible');
    }
};
function respuestaServidorCuentaDesact(datos){
    if(datos.desactivarCuenta==true){
        infoDesactCuenta.classList.remove('oculto');
        mensjCuentaDesactivada.classList.remove('oculto');
        mensjCuentaDesactivada.classList.add('visible');
        mensjCuentaDesactivadaFalse.classList.add('oculto');
        mensjCuentaDesactivadaFalse.classList.remove('visible');
    }else{
        infoDesactCuenta.classList.remove('oculto');
        mensjCuentaDesactivada.classList.remove('visible');
        mensjCuentaDesactivada.classList.add('oculto');
        mensjCuentaDesactivadaFalse.classList.add('visible');
        mensjCuentaDesactivadaFalse.classList.remove('oculto');
    };
};
function respuestaServidorNuevoVehic(datos){
    if (datos.datosVehiculo==true){
        infoVehiculoNuevo.classList.remove('oculto');
        mensjNuevoVehiculoTrue.classList.add('visible');
        mensjNuevoVehiculoTrue.classList.remove('oculto');
        mensjNuevoVehiculoFalse.classList.add('oculto');
        mensjNuevoVehiculoFalse.classList.remove('visible');
    }else{
        infoVehiculoNuevo.classList.remove('oculto');
        mensjNuevoVehiculoFalse.classList.add('visible');
        mensjNuevoVehiculoFalse.classList.remove('oculto');
        mensjNuevoVehiculoTrue.classList.add('oculto');
        mensjNuevoVehiculoTrue.classList.remove('visible');
    };
};
function respuestaServidorModifVehic(datos){
    if(datos.datosModifVehiculo==true){
        infoinfoModfVehic.classList.remove('oculto');
        mensjModfVehicfalse.classList.add('oculto');
        mensjModfVehicfalse.classList.remove('visible');
        mensjModfVehictrue.classList.add('visible');
        mensjModfVehictrue.classList.remove('oculto');
    }else{
        infoinfoModfVehic.classList.remove('oculto');
        mensjModfVehicfalse.classList.add('visible');
        mensjModfVehicfalse.classList.add('oculto');
        mensjModfVehictrue.classList.add('oculto');
        mensjModfVehictrue.classList.remove('visible');
    }
};
function respuestaServidorModifTrayecto(datos){
    if(datos.datosModifTrayecto==true){
        infoModifTrayecto.classList.remove('oculto');
        mensjmodfTrayectotrue.classList.add('visible');
        mensjmodfTrayectotrue.classList.remove('oculto');
        mensjmodfTrayectofalse.classList.add('oculto');
        mensjmodfTrayectofalse.classList.remove('visible');
        mensjmodfTrayectoEstadotrue.classList.add('oculto');
        mensjmodfTrayectoEstadotrue.classList.remove('visible');
        mensjmodfTrayectoEstadofalse.classList.add('oculto');
        mensjmodfTrayectoEstadofalse.classList.remove('visible');
    } else {
        infoModifTrayecto.classList.remove('oculto');
        mensjmodfTrayectotrue.classList.add('oculto');
        mensjmodfTrayectotrue.classList.remove('visible');
        mensjmodfTrayectofalse.classList.add('visible');
        mensjmodfTrayectofalse.classList.remove('oculto');
        mensjmodfTrayectoEstadotrue.classList.add('oculto');
        mensjmodfTrayectoEstadotrue.classList.remove('visible');
        mensjmodfTrayectoEstadofalse.classList.add('oculto');
        mensjmodfTrayectoEstadofalse.classList.remove('visible');
    }
        
};
function respuestaServidorCambioEstadoTrayecto(datos){
    if(datos.datosModifEstado==true){
        infoModifTrayecto.classList.remove('oculto');
        mensjmodfTrayectoEstadotrue.classList.add('visible');
        mensjmodfTrayectoEstadotrue.classList.remove('oculto');
        mensjmodfTrayectoEstadofalse.classList.remove('visible');
        mensjmodfTrayectoEstadofalse.classList.add('oculto');
        mensjmodfTrayectotrue.classList.add('oculto');
        mensjmodfTrayectotrue.classList.remove('visible');
        mensjmodfTrayectofalse.classList.add('oculto');
        mensjmodfTrayectofalse.classList.remove('visible');
    } else if(datos.datosModifEstado==false && datos.mensaje=='fecha o plaza no ok'){
        infoModifTrayecto.classList.remove('oculto');
        mensjmodfTrayectoEstadofalse.classList.remove('oculto');
        mensjmodfTrayectoEstadofalse.classList.add('visible');
        mensjmodfTrayectoEstadotrue.classList.add('oculto');
        mensjmodfTrayectoEstadotrue.classList.remove('visible');
        mensjmodfTrayectotrue.classList.add('oculto');
        mensjmodfTrayectotrue.classList.remove('visible');
        mensjmodfTrayectofalse.classList.add('oculto');
        mensjmodfTrayectofalse.classList.remove('visible');
    }else{
        infoModifTrayecto.classList.remove('oculto');
        mensjmodfTrayectofalse.classList.add('visible');
        mensjmodfTrayectofalse.classList.remove('oculto');
        mensjmodfTrayectoEstadofalse.classList.remove('visible');
        mensjmodfTrayectoEstadofalse.classList.add('oculto');
        mensjmodfTrayectoEstadotrue.classList.add('oculto');
        mensjmodfTrayectoEstadotrue.classList.remove('visible');
        mensjmodfTrayectotrue.classList.add('oculto');
        mensjmodfTrayectotrue.classList.remove('visible');
    }
}

