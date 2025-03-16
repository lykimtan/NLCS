document.getElementById("formreg").addEventListener("submit", function(event) {
    let email = document.querySelector(".email").value.trim();
    let fullname = document.querySelector(".fullname").value.trim();
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    let repassword = document.getElementById("repassword").value.trim();
    let errorMessage = "";

    if (!email || !username || !fullname || !password || !repassword) {
        errorMessage = "Vui lòng điền đầy đủ thông tin!";
    }
    else if (password !== repassword) {
        errorMessage = "Mật khẩu không khớp!";
    }

    else if (password.length < 6) {
        errorMessage = "Mật khẩu phải có ít nhất 6 ký tự!";
    }

    if (errorMessage) {
        event.preventDefault(); 
        alert(errorMessage); 
    }
});






