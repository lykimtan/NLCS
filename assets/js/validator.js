


var inputUserName = document.querySelector('#username');
var inputPass = document.querySelector('#password');
var repass = document.querySelector('#repassword');



function validateUsername(username) 
{
    if(username==='')
    {
        alert("Vui lòng điền tên đăng nhập");
        username.focus();
    }
    
}