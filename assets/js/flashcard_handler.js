var addbutton = document.getElementById('add_flashcard_set-btn');
document.addEventListener("DOMContentLoaded", function(){
    addbutton.addEventListener('click', function(){
        saveFlashcard();
    })
})

function saveFlashcard() {
    let title = document.querySelector('#input_title').value.trim();
    let descr = document.querySelector('#input_description').value.trim();



    var cards = [];
    document.querySelectorAll(".input_content_flashcard").forEach((card) => {
    let front = card.querySelector('.input_content_flashcard_box_before input').value.trim();
    let back = card.querySelector('.input_content_flashcard_box_after input').value.trim();
            if (front !== '' && back !== '') {
                cards.push({ front, back });
            }
        });

console.log(cards); // Kiểm tra danh sách thẻ đã lấy được
    
    if (title==='' || descr===""|| cards.length===0) {
        showModalError('Vui lòng điền đủ thông tin cho bộ flashcard!')
    }
    else {
        var formData = new FormData()
        formData.append('title', title)
        formData.append('descr', descr)
        formData.append('cards', JSON.stringify(cards));
        fetch("saveFlashcard.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("Server response:", data);  
            if(data =='success') {
                showModalSuccess();
                setTimeout(() => location.reload(), 1600);
            }
            else{
                showModalError('Vui lòng đăng nhập để lưu flashcard!')
            }
    
        })
        .catch(error => console.error("Lỗi:",error));
    }
}

function showModalSuccess () {
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Bộ Flashcard của bạn đã được lưu thành công!",
        showConfirmButton: false,
        timer: 1500
      });
}

function showModalError (message) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
      });
}



