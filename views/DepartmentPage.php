<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../public/stylesheets/departmentpage.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body>

<video autoplay muted loop id="myVideo">
  <source src="../public/img/stormySeas.mp4" type="video/mp4">
</video>

<div class="box" style="display: none;">
	<a class="button" id="pirategif" href="#popup1">Let me Pop up</a>
</div>


<div id="popup1" class="overlay">
	<div class="popup">
		<h2><img id="pirate"src="../public/img/talking.gif"></h2>
		<a class="close" href="#">&times;</a>
		<!-- <div class="content"> -->
    <div class="content">
      <h1 class='lead' id="textsize">
        “Ay freshers, I need your help! I’ve lost me treasure all around the campus. I’ve got me treasure map marked out, but I need help getting it back. Been spotting scavengers around these parts recently and the longer I take, the more of me treasure they get. I’ve protected me treasure at each location behind some questions, but in me old age I've forgotten them! Help an old pirate out and help me answer these questions. Time is of the essence, let's get started!"
      </h1>
    </div>
	</div>
</div>






<script>

  document.getElementById("pirategif").click();


</script>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>