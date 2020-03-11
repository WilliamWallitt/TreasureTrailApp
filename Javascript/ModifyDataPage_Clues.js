// ;==========================================
// ; Title:  Front end Javascript request's (Modify Data Page - Clues)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   25 Feb 2020
// ;==========================================

function addClue() {

  let buildings = document.getElementById("cluebuildingdropdown");
  let building_id = buildings.options[buildings.selectedIndex].id;

  let clueName = document.getElementById("clueName").value;

  let answer1 = document.getElementById("question1").value;
  let answer1correct = document.getElementsByName("true1")[0].checked;

  let answer2 = document.getElementById("question2").value;
  let answer2correct = document.getElementsByName("true2")[0].checked;

  let answer3 = document.getElementById("question3").value;
  let answer3correct = document.getElementsByName("true3")[0].checked;

  if (clueName.length == 0 || (!answer1correct && !answer2correct && !answer3correct)) {
    alert("Please fill in the required fields - ");
    return;
  }

  fetch('../app/create_clue.php', {
    headers: { "Content-Type": "application/json; charset=utf-8" },
    method: 'POST',
    body: JSON.stringify({
      building_id: building_id,
      clue: clueName,
      answers: [
        {
          answer: answer1,
          correct: answer1correct
        },
        {
          answer: answer2,
          correct: answer2correct
        },
        {
          answer: answer2,
          correct: answer2correct
        }
      ]
    })
  }).then(response => {
    return response.json();
  }).then(data => {
    buildings.selectedIndex = 0;
    document.getElementById("buildingname").value = "";
    document.getElementById("clueName").value = "";
    document.getElementById("question1").value = "";
    document.getElementById("question2").value = "";
    document.getElementById("question3").value = "";
    document.getElementsByName("true1")[0].checked = true;
    document.getElementsByName("true2")[0].checked = false;
    document.getElementsByName("true3")[0].checked = false;
    fetchClues();
  });
}

function deleteClue(clue_id) {

  fetch("../app/remove_clue.php?clue_id=" + clue_id).then(response => {
      return response.json();
  }).then(data => {
    fetchClues();
  });
}

function fetchClues() {
  fetch("../app/get_all_clues.php").then(response => {
      return response.json();
  }).then(data => {
    const cluesTable = document.getElementById("clues");

    let html = "";
    for (let index = 0; index < data.length; index++) {
      const clue_id = data[index].clue_id;
      const clue = data[index].clue;
      html += "<tr> <td>" + clue + "</td><td> <table class=\"table table-hover table-light bg-light table-sm\"> <thead> <tr> <th>#</th> <th>Answer</th> <th>Correct</th> </tr></thead> <tbody>";

      for (let index2 = 0; index2 < data[index].answers.length; index2++) {
        const answer_id = data[index].answers[index2].answer_id;
        const answer = data[index].answers[index2].answer;
        const correct = data[index].answers[index2].correct;

        html += "<tr> <th scope=\"row\">" + (index2 + 1) + "</th> <td>" + answer + "</td><td>" + correct + "</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteAnswer("+ answer_id + ")\"><i class=\"fas fa-minus\"></i></button></td></tr>";
      }
      html += "</tbody> </table> </td><td class=\"text-center\"><button class=\"btn btn-sm btn-outline-danger mt-5\" onclick=\"deleteClue("+ clue_id + ")\">Delete</button></td></tr>";
    }

    cluesTable.innerHTML = html;

    populateClueBuildings();
  }).catch(err => {
      console.log(err);
  });
}

function populateClueBuildings() {
  fetch("../app/get_all_buildings.php").then(response => {
      return response.json();
  }).then(data => {
    const buildingDropDown = document.getElementById("cluebuildingdropdown");
    var html = "";
    for (let index = 0; index < data.length; index++) {
      let building = data[index];
      html += "<option id=\"" + building.building_id + "\">" + building.building_name + "</option>"
    }
    buildingDropDown.innerHTML = html;
  }).catch(err => {
      // catch err
      console.log(err);
  });
}


function deleteAnswer(answer_id) {

  fetch("../app/remove_answer.php?answer_id=" + answer_id).then(response => {
      return response.json();
  }).then(data => {
    fetchClues();
  });
}
