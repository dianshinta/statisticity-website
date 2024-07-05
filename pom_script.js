let workTitle = document.getElementById('work');
let breakTitle = document.getElementById('break');

let workTime = 25;
let breakTime = 5;

let seconds = 0;
let sessions = 0;

//display
window.onload = () => {
    document.getElementById('minutes').innerHTML = workTime < 10? '0' + workTime : workTime;
    document.getElementById('seconds').innerHTML = seconds < 10? '0' + seconds : seconds;

    workTitle.classList.add('active');
}

//start timer


document.getElementById('pom-submit').addEventListener('submit', function(event) {
    sessions = parseInt(document.getElementById('pom-input').value);
    start();
});

function start() {
    //change button
    document.getElementById('start').style.display = "none";
    document.getElementById('reset').style.display = "block";

    seconds = 59;
    let workMinutes = workTime-1;
    let breakMinutes = breakTime-1;

    breakCount = 0;

    let timerFunction = () => {

        //changing the display
        document.getElementById('minutes').innerHTML = workMinutes < 10? '0' + workMinutes : workMinutes;
        document.getElementById('seconds').innerHTML = seconds < 10? '0' + seconds : seconds;

        //start
        seconds--;

        let i = 1;
        if(seconds === -1) {
            workMinutes--;
            if(workMinutes === -1) {
                if(breakCount % 2 === 0) {
                    //start break
                    workMinutes = breakMinutes;
                    breakCount++;

                    //change panel
                    workTitle.classList.remove('active');
                    breakTitle.classList.add('active');
                } else {
                    //continue work
                    workMinutes = workTime;
                    breakCount++;

                    breakTitle.classList.remove('active');
                    workTitle.classList.add('active');
                }
            }
            seconds = 59;
        } 
        
    };


    let intervalId = setInterval(timerFunction, 1000); //1000 = 1s

    document.getElementById('reset').onclick = function() {
        clearInterval(intervalId); //clear interval
        document.getElementById('start').style.display = "block";
        document.getElementById('reset').style.display = "none";
        document.getElementById('minutes').innerHTML = workTime;
        document.getElementById('seconds').innerHTML = '00';
        workTitle.classList.add('active');
        breakTitle.classList.remove('active');
    };
} 