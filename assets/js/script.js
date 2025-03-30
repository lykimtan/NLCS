const inputBox = document.getElementById("input_box");
const listContainer = document.getElementById("list_container");
const audio = document.querySelector('#checked_sound')


document.getElementById("input_box").addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
        AddTask();
    }
});

function AddTask(){
    if(inputBox.value ==='')
    {
        alert("Bạn không được để trống ô công việc !");
    }

    else{
        let li  = document.createElement("li");
        li.innerHTML = inputBox.value;
        listContainer.appendChild(li);
        let span = document.createElement("span");
        span.innerHTML = "\u00d7"; // mã unicode của dấu nhân
        li.appendChild(span);
    }
    inputBox.value = "";
    saveData();
}


listContainer.addEventListener("click",function(e)
{
    if(e.target.tagName ==="LI")
    {
       e.target.classList.toggle("checked");
       audio.play();
       saveData();
    }
    else if(e.target.tagName ==="SPAN")
    {
        e.target.parentElement.remove();
        saveData();
    }
},false);



function saveData()
{
    localStorage.setItem("data", listContainer.innerHTML);
}


function showTask()
{
    listContainer.innerHTML = localStorage.getItem("data");
}
showTask();