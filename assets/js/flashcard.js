var addbutton = document.querySelector('.add_flashcard-btn');
var container_block = document.querySelector('.create_flashcard_box');


addbutton.addEventListener('click', function (){
    let flashcardContainer = document.querySelector(".create_flashcard_box");
    // Tạo div chứa flashcard
    let flashcardDiv = document.createElement("div");
    let flashcardDivBefore = document.createElement("div");
    let flashcardDivAfter = document.createElement("div");
    flashcardDiv.classList.add("input_content_flashcard")
    flashcardDivBefore.classList.add("input_content_flashcard_box_before");
    flashcardDivAfter.classList.add("input_content_flashcard_box_after");
  

    flashcardDiv.appendChild(flashcardDivBefore);
    flashcardDiv.appendChild(flashcardDivAfter);

    // Tạo input
    let input = document.createElement("input");
    input.type = "text";
    input.classList.add("input_flashcard_zone");

    flashcardDivAfter.appendChild(input);

    let input2 = document.createElement("input");
    input2.type = "text";
    input2.classList.add("input_flashcard_zone");

    flashcardDivBefore.appendChild(input2);


   



    //tao icon 
    let icon = document.createElement("i");
    icon.classList.add('delete_content_flashcard-icon', 'fa-solid', 'fa-eraser')
    let icon2 = document.createElement("i");
    icon2.classList.add('delete_content_flashcard-icon', 'fa-solid', 'fa-eraser')

    // Tạo nút xóa
    let deleteBtn = document.createElement("button");
    deleteBtn.classList.add("delete_content_flashcard-btn");
    let deleteBtn2 = document.createElement("button");
    deleteBtn2.classList.add("delete_content_flashcard-btn");

    //them icon vao nut xoa
    deleteBtn.appendChild(icon);
    deleteBtn2.appendChild(icon2);

    flashcardDivBefore.appendChild(deleteBtn)
    flashcardDivAfter.appendChild(deleteBtn2)

     
    let deletebox = document.createElement('button')
    deletebox.classList.add("delete_flashcard-btn")
    let iconDeleteBox = document.createElement('i')
    iconDeleteBox.classList.add('delete_flashcard-icon',  'fa-solid' ,'fa-x')

    deletebox.appendChild(iconDeleteBox)
    flashcardDiv.appendChild(deletebox)



//them vao the cha lon nhat
    flashcardContainer.appendChild(flashcardDiv)

    document.querySelectorAll(".delete_content_flashcard-btn").forEach(function(button) {
      button.addEventListener("click", function() {
          // Tìm thẻ cha gần nhất có class "input_content_flashcard"
          let flashcard = this.closest(".input_content_flashcard");
          
          if (flashcard) {
              // Tìm tất cả input trong flashcard và xóa nội dung
              flashcard.querySelectorAll(".input_flashcard_zone").forEach(function(input) {
                  input.value = "";
              });
          }
      });
    });


    document.querySelectorAll('.delete_flashcard-btn').forEach(function(button) {
        button.addEventListener("click", function() {
            let flashcardbox =  this.closest(".input_content_flashcard")
            flashcardbox.remove();
        })
    })
  
})

// var closeBtn = document.querySelector(".close_libary");
// var libaryBlock = document.querySelector(".container_libary")
// closeBtn.addEventListener('click', function(){
//      libaryBlock.style.display = "none";
// })

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
