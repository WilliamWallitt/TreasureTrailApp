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
  <link rel="stylesheet" type="text/css" href='../public/stylesheets/gamepage.css'>
</head>
<body id="background" style="background: url('../public/img/Backgroundnew.jpeg') no-repeat center fixed; background-size: cover;">


<!-- ;==========================================
; Title:  Front end Department Page - HTML
; Author: William Wallitt, Edward Soutar
; Date:   25 Feb 2020
;========================================== -->

  <div class="box" style="display: none;" style="z-index: 12">
      <a class="button text-dark" id="pirategif" href="#popup1">Let me Pop up</a>
  </div>

  <div id="popup1" class="overlay" style="z-index: 12;">
    <div class="container-fluid d-flex align-items-center;" style="height: 100%; flex-direction: column">
      <a class="close ml-auto" href="#" onclick="hidePopUp()" style="padding-top: 5vh; padding-right: 3vw; font-size:50px; color: white;">&times;</a>
      <div class="container-fluid" style="height: 40vw; width: 350px">
          <img id="pirate"src="../public/img/talking.gif" style="margin: 0 auto;">
      </div>
      <div class="container-fluid text-center" style="height: 60vw; overflow: scroll;">
        <h1 class='lead text-white' id="narrativeText" style="font-family:'skull'">“Ay freshers, I need your help! I’ve lost me treasure all around the campus. I’ve got me treasure map marked out, but I need help getting it back. Been spotting scavengers around these parts recently and the longer I take, the more of me treasure they get. I’ve protected me treasure at each location behind some questions, but in me old age I've forgotten them! Help an old pirate out and help me answer these questions. Time is of the essence, let's get started!"</h1>
      </div>
    </div>
  </div>


<!-- Navigation -->
<canvas id="canvas1" style="width: 100vw; height:100vh;"></canvas>

  <section class="game">

    <div class="layer"></div>



    <section class="screen screen-intro active-screen" id="home">

        <div class="box-shadow"></div>

        <div class="button button-newgame pt-4" style="margin-top: 180px;"><h1 class="h3 text-white text-center" id="h1font"><input type="text" class="form-control text-center" id="teamname" placeholder="Group Name"><i class="far fa-arrow-alt-circle-right mt-4" id="button-newgame"></i></h1></div>


    </section>


    <section class="screen screen-game">


        <div class="d-flex flex-column align-items-center" id="screen-map" style="width: 100vw; height: 100vh;">
          <!-- <div class="container-fluid" id="screen-map"> -->

            <h1 id="title">Department</h1>
            <!-- style="height: 90vh" -->
            <div class="container list-group p-0 rounded-lg" style="height: 90vh">
                <!-- search bar - want it as a form-group -->
                <a class="list-group-item">
                    <form class="form-inline md-form form-sm mt-4">
                      <!-- <i class="fas fa-search text-light" aria-hidden="true"></i> -->
                      <input class="form-control form-control-sm w-100" id="myInput" onkeyup="myFunction()" type="text" placeholder="Search for department"
                      aria-label="Search">
                    </form>
                </a>

                <!-- list of our departments -->
                <ul class="list-group text-center" id="myUL"></ul>
            </div>

        </div>
    </section>
  </section>



<script src="../Javascript/gamePage.js"></script>
<script src="../Javascript/gamePageAnimations.js"></script>

<script>

// ;==========================================
// ; Title:  Front end Javascript request's (Game Page)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================
  
function playPopUp() {
    $("#popup1").show();
    $(".box").show();
    document.getElementById("pirategif").click();
  }

function hidePopUp() {
    $("#popup1").hide();
    $(".box").hide();
}

playPopUp();
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>



</body>
</html>
