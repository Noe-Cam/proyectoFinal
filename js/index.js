const logout=document.querySelector('.fa');
logout.addEventListener('click',function(e){
    e.preventDefault();
    window.location.href = 'utils/logout.php';
});