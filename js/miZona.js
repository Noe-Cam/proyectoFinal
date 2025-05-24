const logout=document.querySelector('.fa');
const burger=document.querySelector('.burger');
const menu=document.querySelector('.menu');
const cambiarDatosUsu=document.querySelector('.btn-datos');
const cambiarContra=document.querySelector('.btn-contra');
const eliminarCuenta=document.querySelector('.eliminar');
const datosVehiculoNuevos=document.querySelector('.vehiculoNuevo');
const datosmodfVehiculo=document.querySelector('.modfVehiculo');
const oscurecerFondo=document.querySelector('.modal-oscurecer-fondo');
const modalDatosUsu=document.querySelector('.modalDatosUsu');
const modalDatosContra=document.querySelector('.modalDatosContra');
const modalEliminarCuenta=document.querySelector('.modalEliminarCuenta');
const modalVehiculoNuevo=document.querySelector('.modalVehiculoNuevo');
const modalModfVehiculo=document.querySelector('.modalModfVehiculo');
const btnCerrar=document.querySelectorAll('.cerrar');
const formUsu=document.getElementById('formUsuario');
const formContra=document.getElementById('formContra');
const formVehicNuevo=document.getElementById('formDatosVehic');
const btnGuardarUsu=document.querySelector('.guardar');
const btnguardarContra=document.querySelector('.guardarContra');
const btnDesactCuenta=document.querySelector('.desactCuenta');
const btnDatosVehiculoNuevo=document.querySelector('.guardarVehiculoNuevo');
const btnModfVehic=document.querySelector('.guardarModfVehic');
const infoUsu=document.querySelector('.infoUsu');
const infoContra=document.querySelector('.infoContra');
const infoDesactCuenta=document.querySelector('.infoDesactCuenta');
const infoVehiculoNuevo=document.querySelector('.infoVehiculoNuevo');
const infoinfoModfVehic=document.querySelector('.infoModfVehic');
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

btnCerrar.forEach(boton=>{
    boton.addEventListener('click',cerrarModales);
});
function cerrarModales(){
    if(modalDatosUsu.classList.contains('visible')){
        modalDatosUsu.classList.add('oculto');
        modalDatosUsu.classList.remove('visible');
        oscurecerFondo.classList.remove('visible');
        modalDatosUsu.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        infoUsu.classList.add('oculto');
        mensajeExitoUsu.classList.add('oculto');
        mensajeErrorUsu.classList.add('oculto');
        mensajeCorreoFalse.classList.add('oculto');
    }else if(modalDatosContra.classList.contains('visible')){
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
    }else if(modalEliminarCuenta.classList.contains('visible') && mensjCuentaDesactivada.classList.contains('visible')){
        window.location.href = '../utils/logout.php';
    }else if(modalEliminarCuenta.classList.contains('visible')){
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
    }else if(modalModfVehiculo.classList.contains('visible')){
        oscurecerFondo.classList.remove('visible');
        oscurecerFondo.classList.add('oculto');
        modalModfVehiculo.classList.remove('visible');
        modalModfVehiculo.classList.add('oculto');
        infoinfoModfVehic.classList.add('oculto');
        mensjModfVehictrue.classList.add('oculto');
        mensjModfVehicfalse.classList.add('oculto');
    }
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
}
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

