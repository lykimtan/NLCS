document.addEventListener("click", function (event) {
    if (event.target.closest(".btn_edit_fcardset")) {
      let flashcardSelectedName = event.target.closest(".flashcard_set_item").innerText.trim(); 
      var flashcardSelected = flashcardData[flashcardSelectedName];
      var add_btn = document.querySelector(".add_flashcard-btn");
      document.querySelector("#add_flashcard_set-btn").innerText = 'Cập nhật'

  
      if (flashcardSelected.length > 3) {
          let n = flashcardSelected.length - 3;
          for (let i = 0; i < n; i++) {
            add_btn.click();
          }
      }
      let title = document.querySelector('#input_title');
      title.value = flashcardSelectedName ;
      let flashcardInputs = document.querySelectorAll(".input_content_flashcard");

      flashcardSelected.forEach((flashcard, index) => {
        if (flashcardInputs[index]) {
          let frontInput = flashcardInputs[index].querySelector('.input_content_flashcard_box_before input');
          let backInput = flashcardInputs[index].querySelector('.input_content_flashcard_box_after input');

          if (frontInput) frontInput.value = flashcard.front;
          if (backInput) backInput.value = flashcard.back;
        }
      });
    }
  });