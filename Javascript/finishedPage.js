fetch("../app/get_leaderboard.php?department_id=" + <?php echo $_SESSION['department_id']; ?>).then(response => {
    return response.json();
}).then(data => {
  const leaderBoard = document.getElementById("leaderboard");
  let leaderBoardHTML = "";
  for (i = 0; i < data.length; i++) {
    const team_name = data[i].team_name;
    const score = data[i].score;
    leaderBoardHTML += "<tr><td class=\"h6\">" + (i + 1) + "</td><td class=\"h6\">" + team_name + "</td><td class=\"h6\">" + score + "</td></tr>";

  }

  getPosition();

  leaderBoard.innerHTML = leaderBoardHTML;
  test();
}).catch(err => {
    // catch err
    console.log(err);
});


function getPlaceSuperscript(number) {
  let numString = number + "";
  let lenString = numString.length;

  if ((numString).charAt(lenString - 1) == "1") {
    return "st";
  } else if ((numString).charAt(lenString - 1) == "2") {
    return "nd";
  } else if ((numString).charAt(lenString - 1) == "3"){
    return "rd";
  } else {
    return "th";
  }
}


function getPosition() {

  fetch("../app/get_leaderboard_position.php?user_id=" + <?php echo $_SESSION['user_id']; ?> +"&department_id=" + <?php echo $_SESSION['department_id']; ?>).then(response => {
      return response.json();
  }).then(data => {
      const position = data.position;
      if (data == false) {
        $("#finishedPosition").text("Whoooo You Finished!");
        return;
      }
      $("#finishedPosition").text("You Finished in " + position + getPlaceSuperscript(position) + " place");

  }).catch(err => {
      // catch err
      console.log(err);
  });

}

// redirect user back to department page when clicked
function backtoDepartments() {

    window.location.href = "../views/gamePage.php";

}