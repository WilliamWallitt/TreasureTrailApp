<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finished Page</title>
  <link href="https://fonts.googleapis.com/css?family=Patrick+Hand&display=swap" rel="stylesheet">
  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/stylesheets/finishedpage.css">
</head>
<body>


<!-- ;==========================================
; Title:  Front end Finished Page - HTML
; Author: William Wallitt, Justin Van Daalen
; Date:   25 Feb 2020
;========================================== -->

    <!-- game menu -->

  <section class="game">
  <section class="screen screen-intro active-screen"> 
    <div class="button button-leaderboard"><h1 class="display-5">Whooooo You Finished!</h1></div>
    <div class="button button-newgame"><h1 class="lead" id="backtodep" onclick="backtoDepartments()">New Game</h1></div>
    <div class="button button-newgame"><h1 class="lead">Leader Board</h1></div>
    <div class="button button-newgame"><h1 class="lead">Credits</h1></div>
  </section>

  <!-- Leader board and Credit onlick content -->
  <section class="screen screen-game">
    <h3>
      Leader Board and Credits coming soon!
    </h3>
    <a href="../views/finishedPage.php"><h1 class=lead>Go to Game Menu</h1></a>
  </section>


</section>


<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

    // animations
(function() {
  var SELECTOR_REPLAY_INTRO_BUTTONS = '#button-replay';
  var SELECTOR_BUTTON_NEWGAME = '.button-newgame';
  var SELECTOR_BUTTON_GAME_MENU = '.button-game-menu';

  var timelineIntroScreen;

  function buildTimelines() {
    timelineIntroScreen = new TimelineMax({
      paused: false
    });

    timelineIntroScreen.staggerFrom('.screen-intro .button', 2, {
      css: {
        scale: 0
      },
      autoAlpha: 0,
      ease: Elastic.easeOut
    }, .1);
  }

  function playIntroButtons() {
    timelineIntroScreen.restart();
  }

  function reverseIntroButtons() {
    timelineIntroScreen.reverse();
  }

  function fadeToScreen(targetScreenClassName) {
    var _nameScreen;

    if (!targetScreenClassName) {
      _nameScreen = 'screen-intro';
    }

    _nameScreen = targetScreenClassName;

    var $elementTarget = $('.' + _nameScreen);
    var $elementActiveScreen = $('.active-screen');
    
    console.log('$elementTarget: ', $elementTarget);
    console.log('targetScreenClassName: ', targetScreenClassName);
    console.log('$elementActiveScreen: ', $elementActiveScreen);    
    
    return TweenMax.to($elementActiveScreen, .4, {
      autoAlpha: 0,
      y: '+=10',
      onComplete: function() {
        console.log('onComplete: ', $elementTarget);
        
        $elementActiveScreen.removeClass('active-screen');
        
        TweenMax
        .to($elementTarget, .4, {
          y: '-=10',
          autoAlpha: 1,
          className: '+=active-screen'
        });
      }
    });

  }

  // Initialize
  $(document).ready(buildTimelines);

  // Bindings
  $(document).on('click', SELECTOR_REPLAY_INTRO_BUTTONS, function(event) {
    event.preventDefault();

    if (!$('.screen-intro').hasClass('active-screen')) {
      return;
    }

    playIntroButtons();
  });

  $(document).on('click', SELECTOR_BUTTON_NEWGAME, function(event) {
    event.preventDefault();
    reverseIntroButtons();

    timelineIntroScreen.eventCallback('onReverseComplete', function() {
      fadeToScreen('screen-game');
    });
  });

  $(document).on('click', SELECTOR_BUTTON_GAME_MENU, function(event) {
    event.preventDefault();
    var tween = fadeToScreen('screen-intro');
    tween.eventCallback('onComplete', function() {
      playIntroButtons();
    });
  });
})();

// redirect user back to department page when clicked
function backtoDepartments() {

    window.location.href = "../views/DepartmentPage.php";

}
</script>


</body>
</html>