<?php
session_start();
if (!isset($_SESSION['department_id'])) {
	header("Location: ../views/gamePage.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LeaderBoard</title>
  <link href="https://fonts.googleapis.com/css?family=Patrick+Hand&display=swap" rel="stylesheet">
  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/stylesheets/leaderboard.css">
</head>
<body style="background: url('../public/img/treasure1.jpg') no-repeat center fixed; background-size: cover;">
<!-- <body> -->

    <section class="game">

            <section id="leaderboard" class="screen screen-intro active-screen"> 

                <!-- <canvas id="canvas"></canvas> -->

                

            </section>
    </section>





<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<script>

(function() {
    fetch("../app/get_leaderboard.php?department_id=" + <?php echo $_SESSION['department_id']; ?>).then(response => {
    return response.json();
}).then(data => {
  for (i = 0; i < data.length; i++) {
    $("#leaderboard").append("<div class=\"button button-credits\"><h1 class=\"lead\">" + data[i].team_name + ": " + data[i].score + "</h1></div>");
  }
}).catch(err => {
    // catch err
    console.log(err);
});
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










var canvas,
	ctx,
	width,
	height,
	size,
	lines,
	tick;

function line() {
	this.path = [];
	this.speed = rand( 10, 20 );
	this.count = randInt( 10, 30 );
	this.x = width / 2, + 1;
	this.y = height / 2 + 1;
	this.target = { x: width / 2, y: height / 2 };
	this.dist = 0;
	this.angle = 0;
	this.hue = tick / 5;
	this.life = 1;
	this.updateAngle();
	this.updateDist();
}

line.prototype.step = function( i ) {
	this.x += Math.cos( this.angle ) * this.speed;
	this.y += Math.sin( this.angle ) * this.speed;
	
	this.updateDist();
	
	if( this.dist < this.speed ) {
		this.x = this.target.x;
		this.y = this.target.y;
		this.changeTarget();
	}
		
	this.path.push( { x: this.x, y: this.y } );	
	if( this.path.length > this.count ) {
		this.path.shift();
	}
	
	this.life -= 0.001;
	
	if( this.life <= 0 ) {
		this.path = null;
		lines.splice( i, 1 );	
	}
};

line.prototype.updateDist = function() {
	var dx = this.target.x - this.x,
		dy = this.target.y - this.y;
	this.dist = Math.sqrt( dx * dx + dy * dy );
}

line.prototype.updateAngle = function() {
	var dx = this.target.x - this.x,
		dy = this.target.y - this.y;
	this.angle = Math.atan2( dy, dx );
}

line.prototype.changeTarget = function() {
	var randStart = randInt( 0, 3 );
	switch( randStart ) {
		case 0: // up
			this.target.y = this.y - size;
			break;
		case 1: // right
			this.target.x = this.x + size;
			break;
		case 2: // down
			this.target.y = this.y + size;
			break;
		case 3: // left
			this.target.x = this.x - size;
	}
	this.updateAngle();
};

line.prototype.draw = function( i ) {
	ctx.beginPath();
	var rando = rand( 0, 10 );
	for( var j = 0, length = this.path.length; j < length; j++ ) {
		ctx[ ( j === 0 ) ? 'moveTo' : 'lineTo' ]( this.path[ j ].x + rand( -rando, rando ), this.path[ j ].y + rand( -rando, rando ) );
	}
	ctx.strokeStyle = 'hsla(' + rand( this.hue, this.hue + 30 ) + ', 80%, 55%, ' + ( this.life / 3 ) + ')';
	ctx.lineWidth = rand( 0.1, 2 );
	ctx.stroke();
};

function rand( min, max ) {
	return Math.random() * ( max - min ) + min;
}

function randInt( min, max ) {
	return Math.floor( min + Math.random() * ( max - min + 1 ) );
};

function init() {
	canvas = document.getElementById( 'canvas' );
	ctx = canvas.getContext( '2d' );
	size = 30;
	lines = [];
	reset();
	loop();
}

function reset() {
	width = Math.ceil( window.innerWidth / 2 ) * 2;
	height = Math.ceil( window.innerHeight / 2 ) * 2;
	tick = 0;
	
	lines.length = 0;	
	canvas.width = width;
	canvas.height = height;
}

function create() {
	if( tick % 10 === 0 ) {		
		lines.push( new line());
	}
}

function step() {
	var i = lines.length;
	while( i-- ) {
		lines[ i ].step( i );	
	}
}

function clear() {
	ctx.globalCompositeOperation = 'destination-out';
	ctx.fillStyle = 'hsla(0, 0%, 0%, 0.1';
	ctx.fillRect( 0, 0, width, height );
	ctx.globalCompositeOperation = 'lighter';
}

function draw() {
	ctx.save();
	ctx.translate( width / 2, height / 2 );
	ctx.rotate( tick * 0.001 );
	var scale = 0.8 + Math.cos( tick * 0.02 ) * 0.2;
	ctx.scale( scale, scale );
	ctx.translate( -width / 2, -height / 2 );
	var i = lines.length;
	while( i-- ) {
		lines[ i ].draw( i );	
	}
	ctx.restore();
}

function loop() {
	requestAnimationFrame( loop );
	create();
	step();
	clear();
	draw();
	tick++;
}

function onresize() {
	reset();	
}

window.addEventListener( 'resize', onresize );

init();

//From /codepen.io/jackrugile/pen/bdwvMo
</script>



</body>
</html>