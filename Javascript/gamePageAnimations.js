var teamname;

(function() {


  var SELECTOR_REPLAY_INTRO_BUTTONS = '#button-replay';
  var SELECTOR_BUTTON_NEWGAME = '#button-newgame';
  var SELECTOR_BUTTON_QRCODE = '.button-qrcode';
  var SELECTOR_BUTTON_CHOICE = '.button-choice';
  var SELECTOR_BACK = '.button-back';
  var SELECTOR_BUTTON_GAME_MENU = '.button-game-menu';
  var timelineIntroScreen;

  $("#fadeInText").fadeIn();




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


  $(document).on('keypress',function(e) {
        if(e.which == 13) {
            teamname = $("#teamname").val();

            if (teamname.length < 1) {
                return;
            }

            fetch('../app/exists_user.php', {
              headers: { "Content-Type": "application/json; charset=utf-8" },
              method: 'POST',
              body: JSON.stringify({
                team_name: $("#teamname").val(),
              })
            }).then(response => {
              return response.json();
            }).then(data => {
              if (data == true) {

                $("#teamname").val("");
                $("#teamname").attr("placeholder", "name taken");

                return;
              }

              e.preventDefault();
              reverseIntroButtons();
              timelineIntroScreen.eventCallback('onReverseComplete', function() {
                fadeToScreen('screen-game');
                $(".layer").css({"background-color": "transparent"});
                $("#canvas").hide();
                $("#myVideo").hide();
              });
            });
        }
  });

  $(document).on('click', SELECTOR_BUTTON_NEWGAME, function(event) {

    var groupname = $("#teamname").val();

    if (groupname.length < 1) {
        return;
    }

    fetch('../app/exists_user.php', {
      headers: { "Content-Type": "application/json; charset=utf-8" },
      method: 'POST',
      body: JSON.stringify({
        team_name: $("#teamname").val(),
      })
    }).then(response => {
      return response.json();
    }).then(data => {
      if (data == true) {

        $("#teamname").val("");
        $("#teamname").attr("placeholder", "name taken");


        return;
      }

      event.preventDefault();
      reverseIntroButtons();
      timelineIntroScreen.eventCallback('onReverseComplete', function() {
      fadeToScreen('screen-game');
      $(".layer").css({"background-color": "transparent"});
      //   $('body').css('background-image', 'url(' + "../public/img/treasure1.jpg" + ')');
      // $("body").css({"background-image": 'url(' + "../public/img/Backgroundnew.jpeg" + ')', "background-position": "center", "background-repeat" : "no-repeat", "background-size" : "cover", "position" : "relative"});
      // $("body").css("background-color", "black");
      $("#canvas").hide();
      $("#myVideo").hide();

    });

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