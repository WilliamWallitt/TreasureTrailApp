<<<<<<< HEAD



=======
>>>>>>> bc3af19f8426c27ef99b98597e1aabede16b012c
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

<<<<<<< HEAD



=======
>>>>>>> bc3af19f8426c27ef99b98597e1aabede16b012c
// redirect user back to department page when clicked
function backtoDepartments() {

    window.location.href = "../views/gamePage.php";

}
