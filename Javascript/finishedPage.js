


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




// redirect user back to department page when clicked
function backtoDepartments() {

    window.location.href = "../views/gamePage.php";

}