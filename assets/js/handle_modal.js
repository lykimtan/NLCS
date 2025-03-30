let deleteForm; 
function showDeleteModal(button) {
    deleteForm = button.closest(".delete-form"); 
    document.getElementById("deleteModal").style.display = "flex";
}


document.getElementById("confirmDelete").addEventListener("click", function () {
    deleteForm.submit(); 
});


document.getElementById("cancelDelete").addEventListener("click", function () {
    document.getElementById("deleteModal").style.display = "none";
});







function openEditModal(postId, title, content) {
        document.getElementById("editPostId").value = postId;
        document.getElementById("editTitle").value = title;
        document.getElementById("editContent").value = content;

        // Hiển thị modal
        document.querySelector(".over_lay_edit").style.display = "flex";
    }

    function closeEditModal() {
        document.querySelector(".over_lay_edit").style.display = "none";
    }

// Đóng modal khi click ra ngoài
window.onclick = function(event) {
    let modal = document.getElementById("editPostModal");
    if (event.target === modal) {
        closeEditModal();
    }
};