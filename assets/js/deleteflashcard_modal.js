document.addEventListener("click", function (event) {
    if (event.target.closest(".btn_delete_fcardset")) {
        let button = event.target.closest(".btn_delete_fcardset"); 
        let flashcardName = button.closest(".flashcard_set_item").querySelector("input[name='setname']").value;
        let form = button.closest(".form_delete_flashcard");
        Swal.fire({
            title: "Bạn có chắc chắn muốn xoá bộ Flashcard này không?",
            text: "Bạn sẽ không thể khôi phục lại nó sau này!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Tôi biết, hãy xoá",
            cancelButtonText: "Huỷ bỏ" 
        }).then((result) => {
          if (result.isConfirmed) {
                Swal.fire({
                    title: "Xoá thành công!",
                    text: "Bộ flashcard đã bị xóa.",
                    icon: "success",
                    timer: 1500,  // Hiển thị thông báo trong 1.5s
                    showConfirmButton: false
                }).then(() => {
                    form.submit(); // Submit form sau khi hiển thị thông báo
                });
            }
        });
    }
});