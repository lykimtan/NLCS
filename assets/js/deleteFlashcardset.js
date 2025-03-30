fetch("../database/delete_flashcard.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "setname=" + encodeURIComponent(flashcardName)
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        Swal.fire({
            icon: "success",
            title: "Thành công!",
            text: data.message
        }).then(() => {
            window.location.href = "../createPost.php"; // Chuyển hướng sau khi nhấn OK
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Lỗi!",
            text: data.error
        });
    }
})
.catch(error => console.error("Lỗi khi gửi request:", error));