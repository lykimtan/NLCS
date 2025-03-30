
let title = document.querySelector('#status_input');
let content = document.querySelector('#content_input');
let img = document.querySelector('#img_input');
let btn_submit = document.querySelector('#uploadPost_btn');
let form_create_post = document.getElementById('form_create_post');

btn_submit.addEventListener("click", function(e) {
  if(title.value==='' && content.value ==='' && img.value==='') {
      e.preventDefault();
      showErrorModal('Không được để trống tất cả các trường !')  
  }
  else {
    form_create_post.submit();
  }
})


function showErrorModal(message) {
    Swal.fire({
    icon: "error",
    title: "Oops...",
    text: message,
  });
}

function showSuccessModal(message) {
    Swal.fire({
        icon: "success",
        title: message,
        showConfirmButton: true,
      });
}