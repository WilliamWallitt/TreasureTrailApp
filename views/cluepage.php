<?php
require '../app/database.php';

session_start();
if (!isset($_SESSION['user_id'], $_SESSION['department_id'])) {
	header("Location: ../views/gamePage.php");
}

$user_id = $_SESSION['user_id'];
$department_id = $_SESSION['department_id'];

$database = new database();
$user = $database->get_user($user_id);
if ($user === FALSE) {
  header("Location: ../views/gamePage.php");
}

if ($user->completed == 1) {
  $database->reset_user($user_id);
  $_SESSION['current_building_id'] = 0;
  $_SESSION['score'] = 0;
} else {
  $_SESSION['current_building_id'] = $user->current_building_id;
  $_SESSION['score'] = $user->score;
}
$database->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Treasure Trail App</title>
  <link href="https://fonts.googleapis.com/css?family=Patrick+Hand&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../public/stylesheets/main.css">
  <link rel="stylesheet" type="text/css" href="../public/stylesheets/departmentpage.css">
	<script
	    src="https://use.fontawesome.com/releases/v5.12.1/js/all.js"
	    data-search-pseudo-elements>
	</script>
	<script src="../Javascript/CluePage-Questions.js"></script>
  <script src="../jsQR.js"></script>
	<script src = "../audio/howler.js"></script>
  <script>
    var muted = false;
    var waves = new Howl({
      src: ['../audio/waves.mp3'],
      loop: true,
      volume: 0.05
    }).play();

    var click_sound_wood = new Howl({
      src: ['../audio/button-click-wood.mp3']
    });

    var click_sound_paper = new Howl({
      src: ['../audio/button-click-paper.mp3']
    });

    var click_sound_directions = new Howl({
      src: ['../audio/button-click-paper-1.mp3']
    });

    var right = new Howl({
      src: ['../audio/treasure-chest.mp3'],
      volume: 0.2
    });

    var voice = new Howl({
      src: ['../audio/pirate.mp3'],
      sprite: {
        start: [0, 4000],
        map_1: [4000, 4000],
        map_2: [8000, 4000],
        map_3: [12000, 4000],
        right_1: [16000, 4000],
        right_2: [20000, 4000],
        right_3: [24000, 4000],
        scan_1: [28000, 4000],
        scan_2: [32000, 4000],
        scan_3: [36000, 4000],
        wrong_1: [40000, 4000],
        wrong_2: [44000, 4000],
        wrong_3: [48000, 4000],
				volume:0.3
      }
    });

    voice.play('start');

    function button_click_wood()
    {
        click_sound_wood.play();
    }

    function button_click_directions()
    {
        click_sound_directions.play();
    }

    function button_click_paper()
    {
        click_sound_paper.play();
    }

    function map_voice()
    {
      var rand = Math.floor(Math.random() * 3) + 1;
      if(rand == 1) {
        voice.play('map_1');
      }
      else if(rand == 2) {
        voice.play('map_2');
      }
      else {
        voice.play('map_3');
      }
    }

    function scan_voice()
    {
      var rand = Math.floor(Math.random() * 3) + 1;
      if(rand == 1) {
        voice.play('scan_1');
      }
      else if(rand == 2) {
        voice.play('scan_2');
      }
      else {
        voice.play('scan_3');
      }
    }

    function right_voice()
    {
      var rand = Math.floor(Math.random() * 3) + 1;
      if(rand == 1) {
        voice.play('right_1');
      }
      else if(rand == 2) {
        voice.play('right_2');
      }
      else {
        voice.play('right_3');
      }
      right.play();
    }

    function wrong_voice()
    {
      var rand = Math.floor(Math.random() * 3) + 1;
      if(rand == 1) {
        voice.play('wrong_1');
      }
      else if(rand == 2) {
        voice.play('wrong_2');
      }
      else {
        voice.play('wrong_3');
      }
    }
    function toggle_sound(){
        if(muted == false){
            muted = true;
            Howler.mute(true);
						document.getElementById("mutebutton").innerHTML = "<i class='fas text-white fa-volume-mute' style='width:30px;'></i>"
	    }
        else {
            muted = false;
            Howler.mute(false);
						document.getElementById("mutebutton").innerHTML = "<i class='fas text-white fa-volume-up' style='width:30px;'></i>"
        }
    }
  </script>

</head>

<!-- ;==========================================
; Title:  Front end Clue Page - HTML
; Author: William Wallitt, Stephen Kubal, Bevan Roberts
; Date:   25 Feb 2020
;========================================== -->
  <body style="background: url('../public/img/Backgroundnew.jpeg') no-repeat center fixed; background-size: cover;">

		<nav class="navbar navbar-dark vertical-center">
            <a class="nav-link disabled lead mr-auto p-2" style="background-color: transparent; color:white;" id = "score" href="#">Score:0</a>
            <a class="nav-link lead text-white lead" style="background-color: transparent;" href="../views/faqPage.php">FAQ</a>
            <a class="nav-link lead d-flex ml-auto pb-3" style="background-color: transparent;"id="mutebutton" onclick="toggle_sound()"><i class="fas text-white fa-volume-up"></i></a>
    </nav>

    <!-- popup code -->

  <div class="box" style="display: none;" style="z-index: 12">
    <a class="button" id="pirategif" href="#popup1">Let me Pop up</a>
  </div>

  <video autoplay muted loop id="myVideo" style="display:none; z-index: 9">
        <source src="../public/img/stormySeas.mp4" type="video/mp4">
  </video>

  <div id="popup1" class="overlay" style="z-index: 12;">
    <div class="container-fluid;">
      <a class="close" href="#" onclick="hidePopUp()" style="padding-top: 5vh; padding-right: 3vw; font-size:50px">&times;</a>
      <h2 class="container p-0 m-0">
        <img id="pirate"src="../public/img/talking.gif" style="margin-left: 30%">
      </h2>
      <!-- <div class="content"> -->
      <div class="container-fluid" style="position: absolute;">
        <h1 class='text-white' id="narrativeText" style="height: 100vw; font-size: 150%;"></h1>
      </div>
    </div>
  </div>

  <!-- end pop up code -->

    <!-- Map/Verify Location/ Clue tabs -->

		<ul class="nav nav-pills nav-fill navbar-static-top mt-1" id="myTab" role="tablist">
        <li class="nav-item border border-dark"  styles="background: black;">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick=button_click_paper();map_voice()>Map</a>
        </li>
        <li class="nav-item border border-dark">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick=button_click_paper();scan_voice()>Verify location</a>
        </li>
        <li class="nav-item border border-dark">
            <a class="nav-link disabled" id="clue-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" onclick=button_click_paper();>Clue</a>
        </li>
    </ul>
    <!-- Tab content -->
  <div class="tab-content" id="myTabContent">
      <!-- Map tab content -->
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

	      <div class="container p-2">
	        <div class="row justify-content-center" style="margin:0;">
	          <div class="col-xs-12">
	                <div class="table-responsive">
	                <!-- map container -->
                  <div style="position:relative;">
	                    <div id="map" class="border border-dark"></div>
	                    <div id="map-overlay"><img class="m-0 p-0" src="../public/img/compass.png" id="map-overlay-image"></div>
	                    <div class="wood" id="destination-overlay"><p id="directions-title"></p></div>
			            </div>

	                <!-- arrow container -->
	                <a class="wax-seal-wrap" href="#content" onclick=button_click_directions()>
	                    <img class="wax-seal" src="../public/img/wax-seal.png">
	                </a>

	                <!-- directions container -->
	                <div class="container d-flex justify-content-center" id="content">
	                    <div id="directionsPanel"></div>
	                </div>
	              </div>
	          </div>
	        </div>
	      </div>
	    </div>

    <!-- Verify Location tab content -->

    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

        <h1 class="d-flex justify-content-center lead m-5">Scan QR Code</h1>
        <div id="loadingMessage" style="font-size:20px;font-family:'skull';color:white;text-shadow: 2px 2px black;text-align: center;'">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
        <canvas id="canvas" hidden></canvas>
        <div id="output" style="padding:0;margin:0;" hidden>
            <div hidden><b>Data:</b> <span id="outputData"></span></div>
        </div>


    </div>

    <!-- Clue tab content -->
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <div class="container">
        <div class="row justify-content-center p-5">
          <div class="col-xs-12">
            <div class="table-responsive text-align-center">

              <!-- alert incorrect -->
              <div class="alert alert-danger lead text-center" role="alert" id="incorrect" style="display: none">
                  <strong>Incorrect!</strong>
              </div>

              <!-- alert correct -->

              <div class="alert alert-success lead text-center" role="alert" id="correct" style="display: none">
                  <strong>Correct!</strong>
              </div>

              <!-- Clue multiple choice questions -->

              <h1 class="question h3 text-white text-center h2 p-2" id="clue"></h1>

							<ul class="question-list text-center">
    						<li class="question-item lead">
									<input id="q1" name="choice" type="radio" style="display:none;">
									<label for="q1"><div class="person text-center" id="question1"></div></label>
    						</li>
    						<li class="question-item lead">
									<input id="q2" name="choice" type="radio" style="display:none;">
									<label for="q2"><div class="person text-center" id="question2"></div></label>
    						</li>
    						<li class="question-item lead">
        					<input id="q3" name="choice" type="radio" style="display:none;">
									<label for="q3"><div class="person text-center" id="question3"></div></label>
    						</li>
								<li class="text-center">
									<button type="submit" id="submitbtn" class="btn btn-light mt-3" onclick="checkIfCorrect()" style="display: none; font-family: 'skull'" >Submit</button>
									<button type="submit" class="btn btn-light mt-3" id="countdown" style="font-family: 'skull'">Wait 30's</button>
    						</li>
							</ul>


              <!-- Extra info -->


              <div id ="extra-info" class="jumbotron vertical-center text-center text-white" style="font-family: 'skull';text-shadow: 2px 2px black;  background-color: rgba(0,0,0, 0.3);
							  box-shadow: 0 0 10px rgba(0, 0, 0, 1) inset;">
                  <h1 class="h2" id="departmentName"></h1>
                  <p class="lead" id="extraInfo"></p>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
// ;==========================================
// ; Title:  Front end Javascript request's (Clue Page)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================
	
// we send the answer_id to the database to check if the answer is correct or not
function isAnswerTrue(answer_id) {

    fetch("../app/verify_answer.php?answer_id=" + answer_id).then(response => {
        return response.json();
    }).then(data => {
        //alert(data);

        var incorrect = document.getElementById("incorrect");
        var success = document.getElementById("correct");

        // display our alert success if answer is correct
        if (data == true){
            if (success.style.display === "none") {
                incorrect.style.display = "none";
                success.style.display = "block";
                // add_to_score(score);
            } else {
                incorrect.style.display = "none";
                success.style.display = "block";
            }

	    getNarrativeData(building_ids[indexStart]);
            right_voice();
            // disable the clue tab and move the user back to the Map page
            var element = document.getElementById("clue-tab");
            element.classList.add("disabled");

            document.getElementById("home-tab").click();

            // document.getElementById('coin-image').src='../public/img/Coins4.png';
            // calculate the next route in the treasure trail
            calcRoute();
            updateMarkers();

            requestAnimationFrame(tick);

            timerEnabled = false;

            fetch('../app/update_score.php', {
                headers: { "Content-Type": "application/json; charset=utf-8" },
                method: 'POST',
                body: JSON.stringify({
                    user_id: "<?php echo $_SESSION['user_id']; ?>",
                    seconds: time,
                    attempts: attempts - 1,
                })
                }).then(response => {
                    return response.json();
                }).then(data => {
                    getScore();
                });

            attempts = 0;
        // display our alert fail if answer is incorrect

        } else if (data == false) {
            if (incorrect.style.display === "none") {
                success.style.display = "none";
                incorrect.style.display = "block";
                // score = score-100;
            } else {
                success.style.display = "none";
                incorrect.style.display = "block";
            }
            wrong_voice();
        }
    }).catch(err => {
        // catch err
        console.log(err);
    });
}

	
function getNarrativeData(building_id) {
  fetch("../app/get_all_buildings.php").then(response => {
        return response.json();
    }).then(data => {

// }
  for (let index = 0; index < data.length; index++) {
    const element = data[index];
    if (element.building_id == building_id) {
      document.getElementById("narrativeText").innerHTML = element.narrative;
    }
    playPopUp();
  }

// }
}).catch(err => {
// catch err
console.log(err);
});
}

function playPopUp() {
    $("#myVideo").show();
    $("#popup1").show();
    $(".box").show();
    // $("#home").hide();
    document.getElementById("pirategif").click();
  }

function hidePopUp() {
    // $("#home").show();
    $("#myVideo").hide();
    $(".box").hide();
    $("#popup1").hide();
}

playPopUp();

function getScore() {

    var userid = "<?php echo $_SESSION['user_id']; ?>";
    fetch("../app/get_score.php?user_id=" + userid).then(response => {
        return response.json();
      }).then(data => {

          let score = data.score;

          document.getElementById("score").innerText =  "Score:" + score;

      }).catch(err => {
          // catch err
          console.log(err);
      });

  }

	// QR code scanner code - creating the video stream + decoding the image

	var video = document.createElement("video");
	var canvasElement = document.getElementById("canvas");
	var canvas = canvasElement.getContext("2d");
	var loadingMessage = document.getElementById("loadingMessage");
	var outputContainer = document.getElementById("output");
	var outputMessage = document.getElementById("outputMessage");
	var outputData = document.getElementById("outputData");

	function drawLine(begin, end, color) {
	  canvas.beginPath();
	  canvas.moveTo(begin.x, begin.y);
	  canvas.lineTo(end.x, end.y);
	  canvas.lineWidth = 4;
	  canvas.strokeStyle = color;
	  canvas.stroke();
	}

	let result;

	// Use facingMode: environment to attemt to get the front camera on phones
	navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
	  video.srcObject = stream;
	  video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
	  video.play();
	  requestAnimationFrame(tick);
	});

	function tick() {
	  loadingMessage.innerText = "⌛ Loading video..."
	  if (video.readyState === video.HAVE_ENOUGH_DATA) {
	    loadingMessage.hidden = true;
	    canvasElement.hidden = false;
	    outputContainer.hidden = false;

	    canvasElement.height = window.innerHeight / 2.2;
	    canvasElement.width = window.innerWidth;

	    canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
	    var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
	    var code = jsQR(imageData.data, imageData.width, imageData.height, {
	      inversionAttempts: "dontInvert",
	    });
	    if (code) {
	      drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
	      drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
	      drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
	      drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");

	      // logging code decoded data + current building id
	      console.log("code: " + code.data);
	      console.log("building id: " + building_ids[indexStart-1])

	      // if the QR code is correct, make the clue tab clickable and move user to it
	      if (code.data == building_ids[indexStart-1]) {
          getClueData();

          fetch('../app/update_tracking.php', {
            headers: { "Content-Type": "application/json; charset=utf-8" },
            method: 'POST',
            body: JSON.stringify({
                user_id: "<?php echo $_SESSION['user_id']; ?>",
                department_id: "<?php echo $_SESSION['department_id']; ?>",
                building_id: building_ids[indexStart-1]
            })
            }).then(response => {
                return response.json();
            }).then(data => {
            });
	        return;
	      }
	    }
	  }
	  requestAnimationFrame(tick);
	}


  // coordinates for the forum exeter
  var myLatLng = {lat: 50.735371, lng: -3.533782};
  // we have to declare these globally -> so we can call them during the onClick event + the calc route function
  var map;
  var directionsRenderer;
  var directionsService;

  // current location and next location index's
  var indexStart = 0;
  var indexEnd = 1;
  // var score = 500;

  // storing coordindates, building_id's, routeExtraInfo and building names in arrays.
  var array = [];
  var building_ids = [];
  var routeExtraInfo = [];
  var buildingNames = [];
  var markers = [];

  // fetching the route from the database based on what department id the user has clicked on
  // in the department page

  function getRoute(){
      var department_id = "<?php echo $_SESSION['department_id']; ?>";
      fetch("../app/get_route.php?department_id=" + department_id).then(response => {
          return response.json();
      }).then(data => {
          for (i = 0; i < data.length; i++) {
              let latlng = {
                  lat: data[i].latitude,
                  lng: data[i].longitude
              }
              // populating our arrays
              array.push(latlng);
              building_ids.push(data[i].building_id);
              routeExtraInfo.push(data[i].extra_info);
              buildingNames.push(data[i].building_name);
          }
      }).catch(err => {
          // catch err
          console.log(err);
      });
  }

  // getting our clue data from our current building id


// option function: converts our coordinates to an address (not used yet)
function coordsToAddress(lat, long) {
		// get api call for places containing that lat long
		fetch("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + ","+ long + "&key=AIzaSyAtnGySF8OE4Pa2VKOlkCMYvAnX8Ziza0A").then(response => {
				return response.json();
		}).then(data => {
				console.log(data);
		}).catch(err => {
				// catch err
				console.log(err);
		});
}

// this initalises our map, populates our arrays and finds the users current location
// navigating them to the first department in the treasure trail
function init_route(){
		var department_id = "<?php echo $_SESSION['department_id']; ?>";
		fetch("../app/get_route.php?department_id=" + department_id).then(response => {
				return response.json();
		}).then(data => {
				// creating an array of coordinate objects - each is the coordinates for a building
				for (i = 0; i < data.length; i++) {
						let latlng = {
								lat: data[i].latitude,
								lng: data[i].longitude
						}
						array.push(latlng);
						building_ids.push(data[i].building_id);
						routeExtraInfo.push(data[i].extra_info);
						buildingNames.push(data[i].building_name);
				}
				getNarrativeData(building_ids[0]);
				geolocation();
		}).catch(err => {
				// catch err
				console.log(err);
		});
}


// ;==========================================
// ; Title:  Front end Javascript request's (add/delete requests)
// ; Author: William Wallitt, Edward Soutar, Stephen Kubal
// ; Date:   25 Feb 2020
// ;==========================================


// getting current location coordinates
function geolocation() {

		// getting route

		var pos;
		if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position){
						// we now set our lat/log as a object
						pos = {
								lat: position.coords.latitude,
								lng: position.coords.longitude
						}
						// all this does is add our current position at the front of the array
						array.unshift(pos);
						// now as we have the users current location and the building locations coordinates
						// we can now display the map and directions the user can take to the first location
						initMap();
		}, function(){
								// handling any errors
								handleLocationError(true, infoWindow, map.getCenter());
						});
		} else {
				// browser doesnt support geolocation
				handleLocationError(false, infoWindow, map.getCenter());
		}

		return pos;

}


// this is just saying hey if the brower doesnt have our geolocation -> throw an error
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
				infoWindow.setPosition(pos);
				infoWindow.setContent(browserHasGeolocation ?
														'Error: The Geolocation service failed.' :
														'Error: Your browser doesn\'t support geolocation.');
				infoWindow.open(map);
}


// simple map application - all this does is get our current location and finds the path to the forum
function initMap() {
		directionsService = new google.maps.DirectionsService();
		directionsRenderer = new google.maps.DirectionsRenderer();
		var forum = new google.maps.LatLng(myLatLng.lat, myLatLng.lng);
		//styling the map
		var styledMapType = new google.maps.StyledMapType(
				[

					{elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
					{
elementType: 'labels.text.fill',
stylers: [{
		color: '#523735'
}]
},
{
elementType: 'labels.text.stroke',
stylers: [{
		color: '#f5f1e6'
}]
},
{
featureType: 'administrative',
elementType: 'geometry.stroke',
stylers: [{
		color: '#c9b2a6'
}]
},
{
featureType: 'administrative.land_parcel',
elementType: 'geometry.stroke',
stylers: [{
		color: '#dcd2be'
}]
},
{
featureType: 'administrative.land_parcel',
elementType: 'labels.text.fill',
stylers: [{
		color: '#ae9e90'
}]
},
{
featureType: 'landscape.natural',
elementType: 'geometry',
stylers: [{
		color: '#dfd2ae'
}]
},
{
featureType: 'poi',
elementType: 'geometry',
stylers: [{
		color: '#dfd2ae'
}]
},
{
featureType: 'poi',
elementType: 'labels.text.fill',
stylers: [{
		color: '#93817c'
}]
},
{
featureType: 'poi.park',
elementType: 'geometry.fill',
stylers: [{
		color: '#a5b076'
}]
},
{
featureType: 'poi.park',
elementType: 'labels.text.fill',
stylers: [{
		color: '#447530',
}]
},
{
featureType: 'road',
elementType: 'geometry',
stylers: [{
		color: '#f5f1e6'
}]
},

{
featureType: 'road.arterial',
elementType: 'geometry',
stylers: [{
		color: '#fdfcf8'
}]
},
{
featureType: 'road.highway',
elementType: 'geometry',
stylers: [{
		color: '#f8c967'
}]
},
{
featureType: 'road.highway',
elementType: 'geometry.stroke',
stylers: [{
		color: '#e9bc62'
}]
},
{
featureType: 'road.highway.controlled_access',
elementType: 'geometry',
stylers: [{
		color: '#e98d58'
}]
},
{
featureType: 'road.highway.controlled_access',
elementType: 'geometry.stroke',
stylers: [{
		color: '#db8555'
}]
},
{
featureType: 'road.local',
elementType: 'labels.text.fill',
stylers: [{
		color: '#806b63'
}]
},
{
featureType: 'transit.line',
elementType: 'geometry',
stylers: [{
		color: '#dfd2ae'
}]
},
{
featureType: 'transit.line',
elementType: 'labels.text.fill',
stylers: [{
		color: '#8f7d77'
}]
},
{
featureType: 'transit.line',
elementType: 'labels.text.stroke',
stylers: [{
		color: '#ebe3cd'
}]
},
{
featureType: 'transit.station',
elementType: 'geometry',
stylers: [{
		color: '#dfd2ae'
}]
},
{
featureType: 'water',
elementType: 'geometry.fill',
stylers: [{
		color: '#b9d3c2'
}]
},
{
featureType: 'water',
elementType: 'labels.text.fill',
stylers: [{
		color: '#92998d'
}]
},

], {
name: 'Styled Map'
});

// Create a map object, and include the MapTypeId to add
// to the map type control.
map = new google.maps.Map(document.getElementById('map'), {
zoom: 16,
center: forum,
mapTypeControlOptions: {
mapTypeIds: [
'styled_map'
]
},
mapTypeControl: false,
fullscreenControl: false,
streetViewControl: false,
zoomControl: false,
});


//Associate the styled map with the MapTypeId and set it to display.
map.mapTypes.set('styled_map', styledMapType);
map.setMapTypeId('styled_map');

// set the map object -> load the map
directionsRenderer.setMap(map);

// this is loading the directions (list of instructions how to get there)
directionsRenderer.setPanel(document.getElementById('directionsPanel'));

// calculate our route (first time its the users current location and the first building's location)
//Creating icon for treasure chest
var treasurechest = {
url: '../public/img/treasurechest.png', // url
scaledSize: new google.maps.Size(60, 50), // scaled size
origin: new google.maps.Point(0, 0), // origin
anchor: new google.maps.Point(30, 25) // anchor
};
//setting all the buildings to treasure chestsf
for (var i = indexStart + 1; i < array.length; i++) {
var marker = new google.maps.Marker({
position: new google.maps.LatLng(array[i].lat, array[i].lng),
map: map,
icon: treasurechest,
title: buildingNames[i - 1]
});
marker.setVisible(false);
markers.push(marker);
}
markers[0].setVisible(true);
calcRoute();
}

//Sets the last visited location to an open treasure chest
function updateMarkers() {
var treasurechest = {
url: '../public/img/treasurechest.png', // url
scaledSize: new google.maps.Size(60, 50), // scaled size
origin: new google.maps.Point(0, 0), // origin
anchor: new google.maps.Point(25, 30) // anchor
};
var open_treasurechest = {
url: '../public/img/open_treasurechest.png',
scaledSize: new google.maps.Size(60, 50),
origin: new google.maps.Point(0, 0),
anchor: new google.maps.Point(25, 30)
};
markers[indexStart - 1].setIcon(open_treasurechest);
markers[indexStart].setVisible(true);
markers[indexStart].setIcon(treasurechest);
}

function calcRoute() {
//resetting max score
//   score = 500;

// if we are at the last location - loop
if (indexEnd > array.length - 1) {
window.location.href = "../views/finishedPage.php";

			}
			var request = {
				origin: new google.maps.LatLng(array[indexStart].lat, array[indexStart].lng),
				destination: new google.maps.LatLng(array[indexEnd].lat, array[indexEnd].lng),
				travelMode: 'WALKING',
		};

		map.setCenter(new google.maps.LatLng(array[indexStart].lat, array[indexStart].lng));
		// directionservice is just allowing use to use google to calc route
		// when we make our request -> If it succeeds then we wanna update our index values + update our locations + find directions
		directionsService.route(request, function(result, status) {
			if (status == 'OK') {
				// setting new directions based on the request
				directionsRenderer.setDirections(result);
				document.getElementById('directions-title').innerHTML = markers[indexStart].title
				// basically we want every click to update the directions loaded - so we go through the list of coords
				indexStart += 1;
				indexEnd += 1;
			}
		});
		var lineSymbol = {
			path: 'M 0,-1 0,1',
			strokeOpacity: 1,
			scale: 4
		};
		directionsRenderer.setOptions({
			suppressMarkers: true,
			polylineOptions: {
				strokeColor: 'black',
				strokeOpacity: 0,
				icons: [{
					icon: lineSymbol,
					offset: '0',
					repeat: '20px'
				}]
			},
			preserveViewport: true
		});
	}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtnGySF8OE4Pa2VKOlkCMYvAnX8Ziza0A&callback=init_route"
async defer></script>

<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js">
</script>

    </body>
</html>
