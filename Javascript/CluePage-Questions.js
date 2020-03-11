
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

// we send the answer_id to the database to check if the answer is correct or not
function isAnswerTrue(answer_id) {

    fetch("../app/verify_answer.php?answer_id=" + answer_id).then(response => {
        return response.json();
    }).then(data => {
        //alert(data);

        var incorrect = document.getElementById("incorrect");
        var success = document.getElementById("correct");

        // display our alert success if answer is correct
        if (data == true){
            if (success.style.display === "none") {
                incorrect.style.display = "none";
                success.style.display = "block";
                // add_to_score(score);
            } else {
                incorrect.style.display = "none";
                success.style.display = "block";
                getNarrativeData(building_ids[indexStart]);
            }


            right_voice();
            // disable the clue tab and move the user back to the Map page
            var element = document.getElementById("clue-tab");
            element.classList.add("disabled");

            document.getElementById("home-tab").click();

            // document.getElementById('coin-image').src='../public/img/Coins4.png';
            // calculate the next route in the treasure trail
            calcRoute();
            updateMarkers();

            requestAnimationFrame(tick);

            timerEnabled = false;

            fetch('../app/update_score.php', {
                headers: { "Content-Type": "application/json; charset=utf-8" },
                method: 'POST',
                body: JSON.stringify({
                    user_id: "<?php echo $_SESSION['user_id']; ?>",
                    seconds: time,
                    attempts: attempts - 1,
                })
                }).then(response => {
                    return response.json();
                }).then(data => {
                    getScore();
                });

            attempts = 0;
        // display our alert fail if answer is incorrect

        } else if (data == false) {
            if (incorrect.style.display === "none") {
                success.style.display = "none";
                incorrect.style.display = "block";
                // score = score-100;
            } else {
                success.style.display = "none";
                incorrect.style.display = "block";
            }
            wrong_voice();
        }
    }).catch(err => {
        // catch err
        console.log(err);
    });
}
