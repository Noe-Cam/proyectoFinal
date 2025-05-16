const expresiones = {
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  apellidos: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  password: /^.{4,12}$/, // 4 a 12 digitos.
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  telefono: /^\d{7,14}$/, // 7 a 14 numeros.
};
const campos = {
  nombre: false,
  apellidos:false,
  password: false,
  correo: false,
};
const formulario = document.getElementById("formulario");
console.log(formulario);
// query selector All te devuelve un node list (que funciona como un array) con los eventos que se cumplan, en cambio query selector solo, devuevle la primera coincidencia.
// Recojo todos los inputs que hay dentro del formulario
const inputs = document.querySelectorAll("#formulario input");

const validarFormulario = (e) => {
  switch (e.target.name) {
    case "nombre":
      validarCampo(expresiones.nombre, e.target, "nombre");
    break;
    case "apellidos":
      validarCampo(expresiones.apellidos,e.target,"apellidos");
    break;
    case "password":
      validarCampo(expresiones.password, e.target, "password");
      validarPassword2();
    break;
    case "password2":
      validarPassword2();
    break;
    case "correo":
      validarCampo(expresiones.correo, e.target, "correo");
    break;
  }
};
const validarCampo = (expresion, input, campo) => {
  if (expresion.test(input.value)) {
    document.getElementById(`grupo__${campo}`).classList.add("formulario__grupo-correcto");
    document.getElementById(`grupo__${campo}`).classList.remove("formulario__grupo-incorrecto");
    document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove("formulario__input-error-activo");
    campos[campo]=true;
  } else {
    document.getElementById(`grupo__${campo}`).classList.add("formulario__grupo-incorrecto");
    document.getElementById(`grupo__${campo}`).classList.remove("formulario__grupo-correcto");
    document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add("formulario__input-error-activo");
    campos[campo]=false;
  }
};
const validarPassword2=()=>{
  const inputPassword=document.getElementById('password');
  const inputPassword2=document.getElementById('password2');
  if(inputPassword.value !== inputPassword2.value){
   document.getElementById(`grupo__password2`).classList.add("formulario__grupo-incorrecto");
    document.getElementById(`grupo__password2`).classList.remove("formulario__grupo-correcto");
    document.querySelector(`#grupo__password2 .formulario__input-error`).classList.add("formulario__input-error-activo");
    campos['password']=false;
  }else{
    document.getElementById(`grupo__password2`).classList.add("formulario__grupo-correcto");
    document.getElementById(`grupo__password2`).classList.remove("formulario__grupo-incorrecto");
    document.querySelector(`#grupo__password2 .formulario__input-error`).classList.remove("formulario__input-error-activo");
    campos['password']=true;
    
  }
};
// Asigno los dos eventlisteners a cada input
inputs.forEach((input) => {
  console.warn(input);
  input.addEventListener("keyup", validarFormulario);
  input.addEventListener("blur", validarFormulario);
});
function obtenerAño(data){
  let fechaNacimiento= data.get('fecha');
  let fechaNac=new Date(fechaNacimiento);
  let hoy =new Date();
  let edad = hoy.getFullYear() - fechaNac.getFullYear();
  if(edad<18){
    formulario.classList.add('oculto');
    let infoEdad=document.querySelector('.notifications-container');
    infoEdad.classList.remove('oculto');
    infoEdad.classList.add('visible');
    edad=-1;
    return edad;
  }else{
    return edad;
  }
};
formulario.addEventListener('submit',(e)=>{
  if(campos.nombre && campos.apellidos && campos.password && campos.correo){
    e.preventDefault();
    // Recoge los datos del formulario
    let data= new FormData(e.target);
    
    let edad=obtenerAño(data);
    if (edad!=-1){
      data.append('edad',edad);
      // DEBUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUUG
      console.warn(Object.fromEntries(data.entries()));
      fetch('registro.php',{
        method:'POST',
        body:data
      })
      .then(response=>response.json())
      .then(data=>{
        respuestaServidor(data);
      })
      .catch(error=>console.error('Error al recibir datos :', error));
      
      document.getElementById("formulario__mensaje-exito").classList.add("formulario__mensaje-exito-activo");
      formulario.reset();
      // let exito=document.querySelector('.card');
      // formulario.classList.add('oculto');
      // exito.classList.remove('oculto');
      // exito.classList.add('visible');
    };
  }else{
    // Por defecto submit borra los inputs, pero si no es correcto todo no queremos que los borre, con esta funcion se deshabilita esa funcionalidad
    document.getElementById("formulario__mensaje").classList.add("formulario__mensaje-activo");
    e.preventDefault();
  }
});
function respuestaServidor(verificacion){
  if(verificacion.registro=='true'){
    console.warn('Esperando verificación movil')
  }else{
    console.warn('ERROR');
  }
}
