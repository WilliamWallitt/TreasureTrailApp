<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../public/stylesheets/login.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body>

    <div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <div class="jumbotron">
                <h1 class="lead">Game Keeper Login</h1>
            </div>
        </div>

        <!-- Login Form -->
        <!-- need to get this form and validate it before next page -->
        <form>
            <input type="text" id="login" class="fadeIn second" name="login" placeholder="username">
            <input type="password" id="password" class="fadeIn third" name="login" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Log In" href="/ModifyDataPage.php">
        </form>

        <!-- Remind Passowrd -->
        <!-- <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
        </div> -->

    </div>
    </div>

<script>

$("#login").focus(function(){
   $(this).removeAttr('placeholder');
});


$("#login").focusout(function(){
   $(this).attr('placeholder', 'username');
});

$("#password").focus(function(){
   $(this).removeAttr('placeholder');
});


$("#password").focusout(function(){
   $(this).attr('placeholder', 'password');
});

</script>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtnGySF8OE4Pa2VKOlkCMYvAnX8Ziza0A&callback=initMap"
async defer></script>


    </body>
</html>

