function closeMenu() {
    document.querySelector(".container_libary").classList.add("hide");
    document.querySelector(".container_libary").classList.remove("show");
    setTimeout(() => {
      document.querySelector(".container_libary").style.display = "none";
    }, 300);
    
  }
  
  
  function showMenu() {
    
    document.querySelector(".container_libary").style.display = "block";
    setTimeout(() => {
      document.querySelector(".container_libary").classList.remove("hide");
      document.querySelector(".container_libary").classList.add("show");  
    }, 10);
  }


  document.querySelector(".rotate").addEventListener("click", function () {
    document.querySelector(".flashcard_view").classList.toggle("flipped");
  });

  document.addEventListener("keydown", function (event) {
    if (event.code === "Space") { 
        event.preventDefault(); // Ngăn trang bị cuộn khi nhấn Space
        document.querySelector(".flashcard_view").classList.toggle("flipped");
    }
});


