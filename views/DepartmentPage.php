
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400' rel='stylesheet'>
  <script
    src="https://use.fontawesome.com/releases/v5.12.1/js/all.js"
    data-search-pseudo-elements>
  </script>
  <link rel="stylesheet" type="text/css" href='../public/stylesheets/departmentpage.css'>
</head>

<body style="background: url('../public/img/departmentBackground.jpg') no-repeat center fixed; background-size: cover;">


<!-- ;==========================================
; Title:  Front end Department Page - HTML
; Author: William Wallitt, Justin Van Daalen
; Date:   25 Feb 2020
;========================================== -->
    
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top mb-5 shadow">
    <div class="container justify-content-center">
      <div class="container p-1 text-center">
        <!-- this is our own animation container -->
        <div id=container>
          <div id=flip>
            <!-- flipping between each div  -->
            <div><div>Choose A Department</h1></div></div>
            <div><div>Choose A Department</h1></div></div>
            <div><div>Choose A Department</h1></div></div>
          </div>
        </div> 
      </div>
      </div>
    </div>
  </nav>


<!-- adding border to our list and making sure its centered -->
  <div class="container list-group p-0 border border-dark rounded-lg">

    <!-- search bar - want it as a form-group -->
    <a class="list-group-item">
        <form class="form-inline md-form form-sm mt-0">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" id="myInput" onkeyup="myFunction()" type="text" placeholder="Search"
            aria-label="Search">
        </form>
    </a>
    <ul class="list-group text-center" id="myUL">

    
    </ul>
  </div>

</script>

<script>

fetch("../app/get_departments.php").then(response => {
    return response.json();
}).then(data => {
  for (i = 0; i < data.length; i++) {
    $("#myUL").append("<li class=\"list-group-item\"><a href=\"../views/cluepage.php?id=" + data[i].department_id + "\" id=\"btn\">" + data[i].department_name + "<i class=\"fas fa-arrow-right\"></i></a></li>");
  }
}).catch(err => {
    // catch err
    console.log(err);
});

function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
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


</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

