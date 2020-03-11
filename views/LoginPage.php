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

<!-- ;==========================================
; Title:  Front end Login Page - HTML
; Author: William Wallitt, Oliver Fawcett, Stephen Kubal
; Date:   25 Feb 2020
;========================================== -->

    <div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        
        <div class="fadeIn first">
            <div class="jumbotron">
                <h1 class="lead">Game Keeper Login</h1>
            </div>
        </div>

        <!-- Login Form -->
        <form onsubmit="return checkLoginCredentials()">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="username">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

    </div>
    </div>

<script src="../Javascript/LoginPage.js"></script>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
async defer></script>


    </body>
</html>


