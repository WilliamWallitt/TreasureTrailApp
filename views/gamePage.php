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
; Author: William Wallitt, Edward Soutar, Bevan Roberts
; Date:   25 Feb 2020
;========================================== -->

<!-- Navigation -->
<canvas id="canvas1" style="width: 100vw; height:100vh;"></canvas>

  <video autoplay muted loop id="myVideo">
      <source src="../public/img/stormySeas.mp4" type="video/mp4">
  </video>


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
                <a class="list-group-item list-group-flush">
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js"></script>
<!-- front end javascript code -->
<script src="../Javascript/gamePageAnimations.js"></script>
<script src="../Javascript/gamePage.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>

</body>
</html>
