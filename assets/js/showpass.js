var inputfield = document.getElementById('password');
       
function showpass(element,icon) {
    if(element.type === 'password')
    {
        element.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');

    }
    else {
        element.type ='password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}