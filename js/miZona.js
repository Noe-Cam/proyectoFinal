const logout=document.querySelector('.fa');
const burger=document.querySelector('.burger');
const menu=document.querySelector('.menu');

logout.addEventListener('click',function(e){
    e.preventDefault();
    window.location.href = 'utils/logout.php';
});

burger.addEventListener('click',()=>{
    menu.classList.toggle('visible');
});