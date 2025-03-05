const closeIcon = document.getElementById('close-toast');
const nodeToast = document.getElementById('toast')
closeIcon.addEventListener('click', function () {
    nodeToast.remove();
})

