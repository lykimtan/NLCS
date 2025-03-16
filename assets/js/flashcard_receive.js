
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

        console.log(flashcardData); // Kiểm tra dữ liệu đã được lưu

        // Gọi hàm sau khi dữ liệu đã tải xong
        let flashcardSets = Object.keys(flashcardData);
        var containList = document.querySelector(".libary_list");

        Object.keys(flashcardData).forEach(setname=> {
            let li = document.createElement('li');
            li.classList.add('flashcard_set_item');
            let a = document.createElement('a');
            a.classList.add('flashcard_list_link');
            let icon = document.createElement('i');
            icon.classList.add('fa-solid', 'fa-folder');
            li.appendChild(a);

            a.appendChild(icon);
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

    btn_back.addEventListener('click', function(){
        if(curIndex > 0) {
            curIndex--;
        } else {
            curIndex = flashcardSet.length-1;
        }
        updateFlashcard(curIndex)
    })

    

    
    
    
}

