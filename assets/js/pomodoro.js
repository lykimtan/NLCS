// Lấy các nút cần thiết
var modify_time = document.querySelector('.modify-show-session')
var modify_timeBreak = document.querySelector('.modify-show-break')
const startBtn = document.querySelector('.start-btn')
const pauseBtn = document.querySelector('.pause-btn')
const resumeBtn = document.querySelector('.resume-btn')
const audio = document.querySelector('audio')

window.onload = function () {
    document.querySelector('.modify-show-session').value = 25;
    document.querySelector('.modify-show-break').value = 5; 
}

function getValueInput() {
    return document.querySelector('.modify-show-session').value;
}


let timer;
var timeleft = 25 * 60;

document.querySelector('.modify-show-session').addEventListener('change',function(){
    if(this.value >= 60) 
        {
            Swal.fire({
                icon: "info",
                title: "Nhắc nhở",
                text: "Thời gian tập trung quá lâu có thể khiến bạn mệt mỏi đấy! Muốn đi đường dài phải tập nghỉ ngắn bạn nhé",
              });
        }
    return timeleft = Number(document.querySelector('.modify-show-session').value)*60;
})



function startCountDown(cb) {
    if(timer) clearInterval(timer)
    isPause = false
    function countDownTimer () {
        if(!isPause && timeleft > 0)
        {
            timeleft--;
            upDateDisplay()
            if(timeleft < 7) audio.play();
        }
        else if(timeleft===0){
            clearInterval(timer);
            Swal.fire({
                title: "Chúc mừng bạn đã hoàn thành một phiên làm việc",
                text: "Quá giỏi!!",
                imageUrl: "https://unsplash.it/400/200",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image"
              });
            cb()
        }
    }
    timer = setInterval(countDownTimer,1000)  
}


let timerbreak;
let timeleftBreak  = 5*60;

function startCountBreak() {
    if(timerbreak) clearInterval(timerbreak)
    function countDownTimerBreak() {
        if(timeleftBreak > 0)
        {
            timeleftBreak--;
            upDateDisplayBreak()
        }
        else if(timeleftBreak === 0) {
            clearInterval(timerbreak)
            Swal.fire({
                title: "Đã hết thời gian giải lao, tiếp tục làm việc nào",
                text: "5Ting",
                imageUrl: "https://unsplash.it/400/200",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image"
              });
        }
      }
      timerbreak = setInterval(countDownTimerBreak,1000)
}



function upDateDisplay() {
    let minute = Math.floor(timeleft / 60)
    let second = timeleft % 60;
    document.querySelector('.timer-primary').textContent
    =`${minute.toString().padStart(2,'0')} : ${second.toString().padStart(2,'0')}`
}

function upDateDisplayBreak() {
    let minute = Math.floor(timeleftBreak / 60)
    let second = timeleftBreak % 60;
    document.querySelector('.timer-primary').textContent
    =`${minute.toString().padStart(2,'0')} : ${second.toString().padStart(2,'0')}`
}



function pauseCountDown() {
    isPause = true;
    pauseBtn.disabled = true;
    resumeBtn.disabled = false;

}

function resumeCountDown() {
    isPause = false
    resumeBtn.disabled = true
    pauseBtn.disabled = false;
    startBtn.disabled = false;
}

upDateDisplay()

startBtn.addEventListener('click',function() {
    startCountDown(startCountBreak);
 }
)
pauseBtn.addEventListener('click',pauseCountDown)
resumeBtn.addEventListener('click',resumeCountDown)









