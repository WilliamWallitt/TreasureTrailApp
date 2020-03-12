<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Treasure Trail App</title>
  <link href="https://fonts.googleapis.com/css?family=Patrick+Hand&display=swap" rel="stylesheet">
  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/stylesheets/faq.css">
</head>

<!-- ;==========================================
; Title:  Front end FAQ Page - HTML
; Author: William Wallitt, Justin Van Daalen
; Date:   25 Feb 2020
;========================================== -->

<!-- setting the background -->
<body style="background: url('../public/img/Backgroundnew.jpeg') no-repeat center fixed; background-size: cover;">

    <button class="btn btn-outline-light mt-2 p-2" onclick="window.location='../views/cluepage.php';" style="margin: 0 auto; width: 100vw";>Back to game</button> 

    <h2 class="text-white">Frequently Asked Questions</h2>

    <!-- using svg-import -->
    <div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
      <svg xmlns="http://www.w3.org/2000/svg">
        <symbol viewBox="0 0 20 20" id="expand-more">
          <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/><path d="M0 0h24v24H0z" fill="none"/>
        </symbol>
        <symbol viewBox="0 0 24 24" id="close">
          <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/>
        </symbol>
      </svg>
    </div>


    <div class="container-fluid text-center" id="faq"></div>


    <div class="container-fluid bg-transparent text-center text-white">
      <h4 class="h2">Need help? Contact a GameKeeper!</h4>
              <!-- gamekeeper email? -->
      <form>
        <div class="form-group">
          <a class="btn btn-outline-dark m-2 text-white border-light" href="mailto:willcdswallitt@gmail.com?Subject=Help">Contact a GameKeeper</a> 
        </div>
      </form>

      <h1 class="lead">In the event of an emergency, where you or a member of your group requires urgent medical assistance you must call 999.</h1>
  </div>
</body>

<!-- front end javascript code -->
<script src="../Javascript/faqPage.js"></script>


<script>

 // ;==========================================
// ; Title:  Front end Javascript request's (FAQ Page)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================
  
function emailGamekeeper() {
  let emailaddress = $("#emailAddress").text();
  let message = $("#message").text();
}


</script>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
</html>
