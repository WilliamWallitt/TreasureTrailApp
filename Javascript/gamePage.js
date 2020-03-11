function onDepartmentClick(department_id) {

    fetch('../app/create_user.php', {
        headers: { "Content-Type": "application/json; charset=utf-8" },
        method: 'POST',
        body: JSON.stringify({
            team_name: $("#teamname").val(),
            department_id: department_id
        })
        }).then(response => {
        return response.json();
        }).then(data => {
        if (data == false) {
            return;
        }
        window.location.href = "../views/cluepage.php";
    });
}


fetch("../app/get_departments.php").then(response => {
    return response.json();
}).then(data => {
  for (i = 0; i < data.length; i++) {
    $("#myUL").append("<li class=\"list-group-item\"><a id=\"btn\" onclick=\"onDepartmentClick(" + data[i].department_id + ")\">" + data[i].department_name + "</a></li>");
  }
}).catch(err => {
    // catch err
    console.log(err);
});


function myFunction() {
    // Declare variables
    var input, filter, ul, li  , a, i, txtValue;
    // get input field
    input = document.getElementById('myInput');
    // get input value
    filter = input.value.toUpperCase();
    // get ul (unordered list)
    ul = document.getElementById("myUL");
    // get all li elements
    li = ul.getElementsByTagName('li');
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      // get first tag's contents
      a = li[i].getElementsByTagName("a")[0];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
          // display that li
        li[i].style.display = "";
      } else {
          // dont display that li
        li[i].style.display = "none";
      }
    }
}