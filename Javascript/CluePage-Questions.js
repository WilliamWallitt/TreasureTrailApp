
var timerEnabled = false;
var time = 0;
var attempts = 0;

function getClueData(){

    var incorrect = document.getElementById("incorrect");
    var success = document.getElementById("correct");
    incorrect.style.display = "none";
    success.style.display = "none";

    let questions = document.getElementsByName("choice");
    questions[0].checked = false;
    questions[1].checked = false;
    questions[2].checked = false;

    fetch("../app/get_clues.php?building_id=" + building_ids[indexStart-1]).then(response => {
        return response.json();
    }).then(data => {

        // populating our HTML tags with found data

        document.getElementById("departmentName").innerHTML = buildingNames[indexStart-1];
        document.getElementById("extraInfo").innerHTML = routeExtraInfo[indexStart-1];
        document.getElementById("clue").innerHTML = data[0].clue;

        let question1 = document.getElementById("question1");
        question1.innerHTML = data[0].answers[0].answer;
        question1.setAttribute("answer_id", data[0].answers[0].answer_id);

        let question2 = document.getElementById("question2");
        question2.innerHTML = data[0].answers[1].answer;
        question2.setAttribute("answer_id", data[0].answers[1].answer_id);

        let question3 = document.getElementById("question3");
        question3.innerHTML = data[0].answers[2].answer;
        question3.setAttribute("answer_id", data[0].answers[2].answer_id);

        var element = document.getElementById("clue-tab");
        element.classList.remove("disabled");
        // delaySubmit();
        var count = 2;
        // Function to update counters on all elements with class counter
        var doUpdate = function() {
            $('#countdown').each(function() {
            if (count !== 0) {
                let countString = "Wait " + count + "'s"
                $(this).html(countString);
                count = count - 1;
            } else {
                $('#countdown').hide();

                $('#submitbtn').show();

            }
            });
        };

        // Schedule the update to happen once every second
        setInterval(doUpdate, 1000);

        document.getElementById("clue-tab").click();

    }).catch(err => {
        // catch err
        console.log(err);
    });

    fetch('../app/update_tracking.php', {
    headers: { "Content-Type": "application/json; charset=utf-8" },
    method: 'POST',
    body: JSON.stringify({
        user_id: "<?php echo $_SESSION['user_id']; ?>",
        building_id: building_ids[indexStart]
    })
    }).then(response => {
        return response.json();
    }).then(data => {
    });

    timerEnabled = true;
    time = 0;
    setTimeout(timer, 1000);
}

function timer() {
    if (!timerEnabled) {
        return;
    }
    time++;
    setTimeout(timer, 1000);
}

// checking if the selected answer is the correct one
function checkIfCorrect() {

    attempts++;

    let element;
    let answer_id;

    let questions = document.getElementsByName("choice");

    if (questions[0].checked) {

        element = document.getElementById("question1");
        answer_id = element.getAttribute("answer_id");

        isAnswerTrue(answer_id)



    } else if (questions[1].checked) {

        element = document.getElementById("question2");
        answer_id = element.getAttribute("answer_id");

        isAnswerTrue(answer_id)



    } else if (questions[2].checked) {

        element = document.getElementById("question3");
        answer_id = element.getAttribute("answer_id");

        isAnswerTrue(answer_id)
    } else {
        alert("Please select an answer!");
    }
}
