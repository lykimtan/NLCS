
function getFlashcardsBySetName(setName) {
    if (!flashcardData || !flashcardData[setName]) {
        console.error("Dữ liệu chưa tải hoặc bộ flashcard không tồn tại.");
        return;
    }
    console.log(`Flashcards của bộ "${setName}":`, flashcardData[setName]);
}
var flashcardData =  {};
fetch("./database/getFlashcardset.php")
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error("Lỗi: ", data.error);
            return;
        }

        data.forEach(set => {
            flashcardData[set.name] = set.flashcard;
        });

        console.log(flashcardData); 

        let flashcardSets = Object.keys(flashcardData);
        var containList = document.querySelector(".libary_list");

        Object.keys(flashcardData).forEach(setname=> {
            //btn_delete
            let btn = document.createElement('button');
            btn.classList.add('btn_delete_fcardset');
            btn.type = "button";

            //btn_edit
            let btn_edit = document.createElement('button');
            btn_edit.classList.add('btn_edit_fcardset');
            btn_edit.type = "button";

            //btn_edit decoration
            let icon_edit = document.createElement('i')
            icon_edit.classList.add('fa-solid','fa-pen-to-square');
            btn_edit.appendChild(icon_edit)
            



            //delete_decoration
            let iconDelete = document.createElement('i')
            iconDelete.classList.add('fa-solid','fa-trash')
            btn.appendChild(iconDelete)
            let form = document.createElement('form')
            form.classList.add('form_delete_flashcard')
            form.method = "POST";
            form.action = "./database/delete_flashcard.php"
            let input = document.createElement('input')
            form.appendChild(input);
            form.appendChild(btn)
            let li = document.createElement('li');
            li.classList.add('flashcard_set_item');
            let a = document.createElement('a');
            a.classList.add('flashcard_list_link');
            let icon = document.createElement('i');
            icon.classList.add('fa-solid', 'fa-folder');
            li.appendChild(a);
            li.appendChild(form);
            li.appendChild(btn_edit);
            a.appendChild(icon);
            input.value = setname;
            input.name = "setname"
            input.type = "hidden";
            a.appendChild(document.createTextNode(" " + setname));
            containList.appendChild(li);
            a.addEventListener('click', function(){
                displayFlashcard(this.textContent)
            }) 

         })

    if(containList.childElementCount===0) {
        containList.innerHTML = "<h2>Bạn chưa tạo bộ flashcard nào!</h2>"
    }
})
.catch(error => console.error("Lỗi fetch:", error));

function displayFlashcard(setname) {
    setname = setname.trim()
    let frontDisplay = document.querySelector('.content_front');
    let backDisplay = document.querySelector('.content_back');
    let title = document.querySelector('.title_flashcard_selection');
    let flashcard_view = document.querySelector('.flashcard_view');
    var flashcardSet = flashcardData[setname];
    let btn_next = document.querySelector('.foward-btn')
    let btn_back = document.querySelector('.back-btn')
    let curIndex = 1;
    title.textContent = setname;
    frontDisplay.textContent = flashcardSet[0].front;
    backDisplay.textContent = flashcardSet[0].back;
    function updateFlashcard(index) {
        frontDisplay.textContent = flashcardSet[index].front;
         backDisplay.textContent = flashcardSet[index].back;
    }
    
    btn_next.addEventListener('click', function() {
        if(curIndex < flashcardSet.length - 1) {
            curIndex++;
        } else {
            curIndex = 0;
        }
        updateFlashcard(curIndex);
    })

    document.addEventListener("keydown", function (event) {
        if (event.key === "ArrowRight") {  
            if (curIndex < flashcardSet.length - 1) {
                curIndex++;
            } else {
                curIndex = 0;
            }
            updateFlashcard(curIndex);
        }
    });



    btn_back.addEventListener('click', function(){
        if(curIndex > 0) {
            curIndex--;
        } else {
            curIndex = flashcardSet.length-1;
        }
        updateFlashcard(curIndex)
    })


    document.addEventListener("keydown", function (event) {
        if (event.key === "ArrowLeft") {  
            if(curIndex > 0) {
                curIndex--;
            } else {
                curIndex = flashcardSet.length-1;
            }
            updateFlashcard(curIndex)
        }
    });
    
}


document.querySelectorAll(".form_delete_flashcard").forEach(form => {
    form.addEventListener("submit", function(event) {

        event.preventDefault(); 

        let formData = new FormData(this);
        
        fetch(this.action, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showModal("Xóa thành công!");
                this.closest(".flashcard_set_item").remove(); 
            } else {
                showModal("Xóa thất bại: " + data.error);
            }
        })
        .catch(error => {
            showModal("Lỗi hệ thống!");
            console.error("Lỗi fetch:", error);
        });
    });
});


