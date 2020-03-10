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
<body id="background" style="height:100vh">



<!-- ;==========================================
; Title:  Front end Department Page - HTML
; Author: William Wallitt, Edward Soutar, Bevan Roberts
; Date:   25 Feb 2020
;========================================== -->
    
<!-- Navigation -->
<canvas id="canvas" style="width: 100vw; height:100vh;"></canvas>

  <div class="layer">

  <video autoplay muted loop id="myVideo">
      <source src="../public/img/stormySeas.mp4" type="video/mp4">
  </video>


  <section class="game">

    <section class="screen screen-intro active-screen" id="home"> 

        <div class="box-shadow"></div>

        <div class="button button-newgame pt-4" style="margin-top: 180px;"><h1 class="h3 text-white text-center" id="h1font"><input type="text" class="form-control text-center" id="teamname" placeholder="Group Name"><i class="far fa-arrow-alt-circle-right mt-4" id="button-newgame"></i></h1></div>

                    
    </section>

    <section class="screen screen-game">


        <div id="screen-map" style="width: 100vw; height: 100vh">


            <div class="container list-group p-0 border border-dark rounded-lg" style="height: 90vh">
                <!-- search bar - want it as a form-group -->
                <a class="list-group-item">
                    <form class="form-inline md-form form-sm mt-4">
                      <!-- <i class="fas fa-search text-light" aria-hidden="true"></i> -->
                      <input class="form-control form-control-sm w-100" id="myInput" style="background: rgba(999, 999, 999, 1);" onkeyup="myFunction()" type="text" placeholder="Search for department"
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

<script>

var teamname;

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
    $("#myUL").append("<li class=\"list-group-item\"><a style=\"font-family: 'pirate' \" id=\"btn\" onclick=\"onDepartmentClick(" + data[i].department_id + ")\">" + data[i].department_name + "</a></li>");
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





    // animations
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
                // '../public/img/pirateShipBackground.jpg'
                fadeToScreen('screen-game');
                $("body").css({"background-image": 'url(' + "../public/img/treasure1.jpg" + ')', "background-position": "center", "background-repeat" : "no-repeat", "background-size" : "cover", "position" : "relative"});
                // $("body").css("background-color", "black");
                $("#canvas").hide();
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
      $("body").css({"background-image": 'url(' + "../public/img/treasure1.jpg" + ')', "background-position": "center", "background-repeat" : "no-repeat", "background-size" : "cover", "position" : "relative"});
      // $("body").css("background-color", "black");
      $("#canvas").hide();
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

</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>

<script>


(function () {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    window.requestAnimationFrame = requestAnimationFrame;
})();

var canvas = document.getElementById("canvas"),
    ctx = canvas.getContext("2d"),
    width = window.innerWidth,
    height = document.body.offsetHeight,
    settings = {
        size: 6,
        fireWidth: 15,
        lifeTime: 3000,
        innerFlameStartColor: {
            r: 250,
            g: 140,
            b: 0
        },
        innerFlameEndColor: {
            r: 50,
            g: 0,
            b: 0
        },
        outerFlameStartColor: {
            r: 200,
            g: 60,
            b: 0
        },
        outerFlameEndColor: {
            r: 80,
            g: 10,
            b: 0
        },
        showLogs: true
    },
    dimW = Math.ceil(width / settings.size),
    dimH = Math.ceil(height / settings.size),
    logWidth = settings.fireWidth + (settings.fireWidth / 4),
    flames = [],
    logs = [];

for (var i = 0; i < 400; i++) {
    flames.push(initFlame());
}

initLogs();

canvas.width = width;
canvas.height = height;

function initLogs() {
    logs = [];
    for (var i = 0; i < 300; i++) {
        logs.push({
            x: Math.ceil(((dimW / 2) - logWidth / 2 + Math.random() * logWidth) * 2) / 2,
            y: dimH - Math.ceil(Math.random() * 4)
        });
    }
}

function initFlame(reset) {
    var y = Math.ceil(Math.random() * dimH),
        x = Math.ceil(((dimW / 2) - settings.fireWidth / 2 + Math.random() * settings.fireWidth) * 2) / 2,
        colorStart = settings.innerFlameStartColor,
        colorStop = settings.innerFlameEndColor;

    if (reset) {
        y = dimH;
    }

    if (x <= (dimW / 2) - (settings.fireWidth / 6) || x >= (dimW / 2) + (settings.fireWidth / 6)) {
        colorStart = settings.outerFlameStartColor,
        colorStop = settings.outerFlameEndColor;
    }

    return {
        x: x,
        y: y,
        colorStart: colorStart,
        colorStop: colorStop,
        sinX: Math.round(Math.random() * 1),
        speedX: Math.ceil(Math.random() * 5),
        speedY: 0.5,
        top: Math.round(Math.random() * dimH / 2),
        startTime: new Date().getTime(),
        lifeTime: Math.random() * settings.lifeTime
    };
}

function render() {
    ctx.fillStyle = "rgba(26,0,1,0.2)";
    ctx.fillRect(0, 0, width, height);
    ctx.globalCompositeOperation = "lighter";
    for (var i = 0; i < flames.length; i++) {
        var flame = flames[i],
            endStep = (flame.startTime + flame.lifeTime),
            curStep = (flame.startTime + flame.lifeTime) - new Date().getTime();

        flame.y -= flame.speedY;
        y = Math.floor(flame.y);

        flame.x += Math.round(Math.sin(flame.sinX += flame.speedX));
        flame.x = Math.round(flame.x * 2) / 2

        if (flame.y <= flame.top || curStep <= 0) {
            flames[i] = initFlame(true);
        }

        var color = colorChange(flame.colorStart, flame.colorStop, dimH , flame.y);
        color.a = flame.lifeTime * curStep;

        ctx.fillStyle = "rgba(" + color.r + "," + color.g + "," + color.b + "," + color.a + ")";

        drawTriangle(flame.x, y);
    }
    ctx.globalCompositeOperation = "source-over";
    // if (settings.showLogs) {
    //     ctx.fillStyle = "rgb(70,30,0)";
    //     for (i = 0; i < logs.length; i++) {
    //         var log = logs[i];
    //         drawTriangle(log.x, log.y);
    //     }
    // }
    requestAnimationFrame(render);
}

function drawTriangle(x, y) {
    var size = settings.size;
    ctx.beginPath();
    if (parseInt(x) === x) {
        ctx.moveTo(x * size, y * size);
        ctx.lineTo(x * size + size / 2, y * size + size);
        ctx.lineTo(x * size - size / 2, y * size + size);
    } else {
        ctx.moveTo(x * size - size / 2, y * size);
        ctx.lineTo(x * size + size / 2, y * size);
        ctx.lineTo(x * size, y * size + size);
    }
    ctx.fill();
}
render();


function colorChange(startColor, endColor, totalSteps, step) {
    var scale = step / totalSteps,
        r = endColor.r + scale * (startColor.r - endColor.r),
        g = endColor.g + scale * (startColor.g - endColor.g),
        b = endColor.b + scale * (startColor.b - endColor.b);
    return {
        r: Math.floor(Math.min(255, Math.max(0, r))),
        g: Math.floor(Math.min(255, Math.max(0, g))),
        b: Math.floor(Math.min(255, Math.max(0, b)))
    };
}

window.onresize = function () {
    height = canvas.height = document.body.offsetHeight;
    width = canvas.width = document.body.offsetWidth;
    dimW = Math.ceil(width / settings.size);
    dimH = Math.ceil(height / settings.size);
    initLogs();
};



</script>




</body>
</html>
