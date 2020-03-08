<?php
require '../app/database.php';

session_start();
if (!isset($_SESSION['user_id'], $_SESSION['department_id'])) {
	header("Location: ../views/gamePage.php");
}

$database = new database();
$response = $database->reset_score($_SESSION['user_id']);
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
  <script src="../jsQR.js"></script>


</head>

<!-- ;==========================================
; Title:  Front end Clue Page - HTML
; Author: William Wallitt, Stephen Kubal, Bevan Roberts
; Date:   25 Feb 2020
;========================================== -->

<body>

    <!-- floating FAQ button to FAQ page -->
    <a style="position:fixed;bottom:5px;right:5px;margin:0;padding:5px 3px;" href="#">
        <button class="btn btn-dark btn-sm m-1" type="button" onclick="window.location.href = '../views/faqPage.php'">FAQ's</button>
    </a>

    <a style="position:fixed;bottom:5px;right:90%;margin:0;padding:5px 3px;" href="#">
        <button class="btn btn-dark btn-sm m-1" type="button" id="score">Score : 0</button>
    </a>

    <!-- Map/Verify Location/ Clue tabs -->
    <ul class="nav nav-pills nav-fill mt-1" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="font-family: 'pirate'">Map</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="font-family: 'pirate'">Verify location</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" id="clue-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" onclick="getClueData()" style="font-family: 'pirate'">Clue</a>
        </li>
    </ul>
    <!-- Tab content -->
  <div class="tab-content" id="myTabContent">
      <!-- Map tab content -->
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <div class="container p-2">
        <div class="row justify-content-center">
          <div class="col-xs-12">
                <div class="table-responsive">
                <!-- map container -->
                <div class="container-fluid p-0 m-0">
                    <div id="map" class="border border-dark" style="width:100vw; height:80vh;"></div>
                </div>

                <!-- arrow container -->
                <a class="arrow-wrap" href="#content">
                    <span class="arrow"></span>
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

        <h1 class="d-flex justify-content-center lead m-5" style="font-family: 'pirate'">Scan QR Code</h1>
        <div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
        <canvas id="canvas" hidden></canvas>
        <div id="output" hidden>
            <div hidden><b>Data:</b> <span id="outputData"></span></div>
        </div>


    </div>

    <!-- Clue tab content -->
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <div class="row justify-content-center p-5">
        <div class="col-xs-12">
          <div class="table-responsive text-align-center">

            <!-- alert incorrect -->
            <div class="alert alert-danger" role="alert" id="incorrect" style="display: none">
                <strong>Incorrect!</strong>
            </div>

            <!-- alert correct -->

            <div class="alert alert-success" role="alert" id="correct" style="display: none">
                <strong>Correct!</strong>
            </div>

            <!-- Clue multiple choice questions -->

            <h1 class="question h3 bg-light text-center h2 p-2" id="clue">How many stairs does the Harrison Bulding have?</h1>

            <div class="container text-align-center h4">
                <hr/>
                <div class="custom-control custom-radio d-flex justify-content-center">
                    <input id="q1" name="choice" type="radio" class="custom-control-input">
                    <label class="custom-control-label" for="q1"><div class="person" id="question1">3 sets of stairs</div></label>
                </div>
                <div class="custom-control custom-radio d-flex justify-content-center">
                    <input id="q2" name="choice" type="radio" class="custom-control-input">
                    <label class="custom-control-label" for="q2"><div class="person" id="question2">1 sets of stairs</div></label>
                </div>
                <div class="custom-control custom-radio d-flex justify-content-center">
                    <input id="q3" name="choice" type="radio" class="custom-control-input">
                    <label class="custom-control-label" for="q3"><div class="person" id="question3">5 sets of stairs</div></label>
                </div>
                <div class="d-flex justify-content-center text-center"> 
                    <button type="submit" class="btn btn-success mt-3" onclick="checkIfCorrect()">Submit</button>
                </div>
            </div>
            <hr/>

            <!-- Extra info -->

            <div class="jumbotron vertical-center text-center bg-dark text-light">
                <h1 class="h2" id="departmentName">Harrison Building</h1>
                <p class="lead" id="extraInfo">Did you know it was founded in 1932, before WW2!</p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

<script> 




    function getScore() {

        var userid = "<?php echo $_SESSION['user_id']; ?>";

        fetch("../app/get_score.php?user_id=" + userid).then(response => {
            return response.json();
        }).then(data => {
            
            let score = data.score;

            document.getElementById("score").innerText = "Score: " + score + "";
            
        }).catch(err => {
            // catch err
            console.log(err);
        });



    }

    var timerEnabled = false;
    var time = 0;
    var attempts = 0;

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

          // if the QR code is corret, make the clue tab clickable and move user to it
          if (code.data == building_ids[indexStart-1]) {
            var element = document.getElementById("clue-tab");
            element.classList.remove("disabled");
            document.getElementById("clue-tab").click();
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

    // storing coordindates, building_id's, routeExtraInfo and building names in arrays.
    var array = [];
    var building_ids = [];
    var routeExtraInfo = [];
    var buildingNames = [];


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
    function getClueData(){

        var incorrect = document.getElementById("incorrect");
        var success = document.getElementById("correct");
        incorrect.style.display = "none";
        success.style.display = "none";

        let questions = document.getElementsByName("choice");
        questions[0].checked = false;
        questions[1].checked = false;
        questions[2].checked = false;

        fetch("../app/get_clues.php?building_id=" + building_ids[indexStart-1]).then(response => {
            return response.json();
        }).then(data => {

            // populating our HTML tags with found data
            
            document.getElementById("departmentName").innerHTML = buildingNames[indexStart-1];
            document.getElementById("extraInfo").innerHTML = routeExtraInfo[indexStart-1];
            document.getElementById("clue").innerHTML = data[0].clue;

            let question1 = document.getElementById("question1");
            question1.innerHTML = data[0].answers[0].answer;
            question1.setAttribute("answer_id", data[0].answers[0].answer_id);

            let question2 = document.getElementById("question2");
            question2.innerHTML = data[0].answers[1].answer;
            question2.setAttribute("answer_id", data[0].answers[1].answer_id);

            let question3 = document.getElementById("question3");
            question3.innerHTML = data[0].answers[2].answer;
            question3.setAttribute("answer_id", data[0].answers[2].answer_id);

            
        }).catch(err => {
            // catch err
            console.log(err);
        });

        fetch('../app/update_tracking.php', {
        headers: { "Content-Type": "application/json; charset=utf-8" },
        method: 'POST',
        body: JSON.stringify({
            user_id: "<?php echo $_SESSION['user_id']; ?>",
            building_id: building_ids[indexStart]
        })
        }).then(response => {
            return response.json();
        }).then(data => {
        });

        timerEnabled = true;
        time = 0;
        setTimeout(timer, 1000);
    }

    function timer() {
        if (!timerEnabled) {
            return;
        }
        time++;
        setTimeout(timer, 1000);
    }

    // checking if the selected answer is the correct one
    function checkIfCorrect() {

        attempts++;

        let element;
        let answer_id;

        let questions = document.getElementsByName("choice");

        if (questions[0].checked) {

            element = document.getElementById("question1");
            answer_id = element.getAttribute("answer_id");

            isAnswerTrue(answer_id)


    
        } else if (questions[1].checked) {

            element = document.getElementById("question2");
            answer_id = element.getAttribute("answer_id");

            isAnswerTrue(answer_id)



        } else if (questions[2].checked) {

            element = document.getElementById("question3");
            answer_id = element.getAttribute("answer_id");

            isAnswerTrue(answer_id)

        } else {

            alert("Please select an answer!");
        }


    }

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
                } else {
                    incorrect.style.display = "none";
                    success.style.display = "none";
                } 

                // disable the clue tab and move the user back to the Map page
                var element = document.getElementById("clue-tab");
                element.classList.add("disabled");

                document.getElementById("home-tab").click();

                // calculate the next route in the treasure trail
                calcRoute();

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
                } else {
                    success.style.display = "none";
                    incorrect.style.display = "none";
                } 
            }
        }).catch(err => {
            // catch err
            console.log(err);
        });

    }

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
        // such as loading the google map and the direction service/renderer

        // service to get generate the map with the route and the directions (renderer)
        // initialising the direction service and "how to get there" service

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer();
        var forum = new google.maps.LatLng(myLatLng.lat, myLatLng.lng);
        // setting how much we zoom into the map, and the initial centering of the map
        var mapOptions = {
            zoom:15,
            center: forum
        }
        // create new map object
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        // set the map object -> load the map
        directionsRenderer.setMap(map);
        // this is loading the directions (list of instructions how to get there)
        directionsRenderer.setPanel(document.getElementById('directionsPanel'));
        // calculate our route (first time its the users current location and the first building's location)
        calcRoute();
    }

    function calcRoute() {

        // if we are at the last location - loop
        if (indexEnd > array.length - 1) {

            window.location.href = "../views/finishedPage.php";

        }

        var request = {
            origin: new google.maps.LatLng(array[indexStart].lat, array[indexStart].lng),
            destination: new google.maps.LatLng(array[indexEnd].lat, array[indexEnd].lng),
            travelMode: 'WALKING'
        };
        // directionservice is just allowing use to use google to calc route
        // when we make our request -> If it succeeds then we wanna update our index values + update our locations + find directions
        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                // setting new directions based on the request
                directionsRenderer.setDirections(result);
                // basically we want every click to update the directions loaded - so we go through the list of coords
                indexStart += 1;
                indexEnd += 1;
            }
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