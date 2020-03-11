<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ../views/LoginPage.php');
  exit();
}

//session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    <script
    src="https://use.fontawesome.com/releases/v5.12.1/js/all.js"
    data-search-pseudo-elements></script>
  <link rel="stylesheet" type="text/css" href='../public/stylesheets/modifyPage.css'>
  <script src="../Javascript/ModifyDataPage_Buildings.js"></script>
  <script src="../Javascript/ModifyDataPage_Clues.js"></script>
  <script src="../Javascript/ModifyDataPage_Departments.js"></script>
  <script src="../Javascript/ModifyDataPage_FAQ.js"></script>
  <script src="../Javascript/ModifyDataPage_Routes.js"></script>
  <script src="../Javascript/ModifyDataPage_GroupTracking.js"></script>
</head>

<!-- ;==========================================
; Title:  Front end Modify Data Page - HTML
; Author: William Wallitt, Justin Van Daalen
; Date:   25 Feb 2020
;========================================== -->

<style>
.menu a {
  display: block;
  text-decoration: none;
}

</style>

<body data-gr-c-s-loaded="true">

<div class="d-flex" id="wrapper">

<div class="border-right" id="sidebar-wrapper">

<!-- sidebar menu items -->

<div class="menu">
  <ul class="nav nav-pills flex-column" style="list-style: none; margin: 0; padding: 0;">
    <li class="active nav-item"><a data-toggle="pill" href="#Departments"><button class="btn btn-outline-light text-dark mb-2 border-bottom">Departments</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Clues" data-toggle="pill"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchClues()">Clues</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Buildings"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchBuildings()">Buildings</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Routes"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchRoute()">Routes</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#FAQ"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchFAQs()">FAQ's</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#GroupTracking"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchGroupTracking()">Group Tracking</button></a></li>

  </ul>
</div>

</div>

<!-- Page Content -->
  <div class="container-fluid mt-2" id="page-content-wrapper">
    <div class="tab-content col-md-10">
      <!-- Department content -->
      <div class="tab-pane active" id="Departments">
        <div class="container text-center">
          <h1 class="lead">Add a new department!</h1>
        </div>
        <form>
          <div class="form-group">
            <input type="text" class="form-control" id="departmentName" aria-describedby="test" placeholder="Add Department Name">
            <div class="container mt-3">
              <button type="button" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;" onclick="addDepartment()">Submit</button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Department Name</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody id="departments">
            </tbody>
          </table>
        </div>
      </div>
      <div class="tab-pane" id="Clues">
        <!-- clue content -->
        <div class="container text-center">
          <h1 class="lead">Add a new clue!</h1>

        </div>

        <form>
          <div class="form-group">
            <h1>
            <select class="custom-select my-1 mr-sm-2" id="cluebuildingdropdown">
              <option selected>Building</option>
            </select>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="clueName" aria-describedby="test" placeholder="Enter Clue/Question Name">
          </div>


          <div class="container">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <input type="text" class="form-control" id="question1" aria-describedby="test" placeholder="Enter Answer 1 Here">
                </div>
              </div>
              <div class="col">
                  <label class="radio-inline"><input type="radio" name="true1" checked>True</label>
                  <label class="radio-inline"><input type="radio" name="true1">False</label>
              </div>
            </div>
          </div>


          <div class="container">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <input type="text" class="form-control" id="question2" aria-describedby="test" placeholder="Enter Answer 2 Here">
                </div>
              </div>
              <div class="col">
                  <label class="radio-inline"><input type="radio" name="true2">True</label>
                  <label class="radio-inline"><input type="radio" name="true2" checked>False</label>
              </div>
            </div>
          </div>


          <div class="container">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <input type="text" class="form-control" id="question3" aria-describedby="test" placeholder="Enter Answer 3 Here">
                </div>
              </div>
              <div class="col">
                  <label class="radio-inline"><input type="radio" name="true3">True</label>
                  <label class="radio-inline"><input type="radio" name="true3" checked>False</label>
              </div>
            </div>
          </div>


          <div class="container">
            <button type="button" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;" onclick="addClue()">Submit</button>
          </div>
        </form>

          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Clue</th>
                  <th>Questions</th>
                  <th>Delete</th>
                </tr>
              </thead>

              <tbody id="clues">
                <tr>
                  <td>Clue Name</td>
                    <td>
                      <table class="table table-hover table-dark table-sm">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Answer</th>
                            <th>Correct</th>
                          </tr>
                        </thead>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </div>
      </div>

      <!-- Buildings content -->

      <div class="tab-pane" id="Buildings">

        <div class="container text-center">
          <h1 class="lead">Add a new building!</h1>
        </div>
        <form>
          <div class="form-group">
            <div class="container m-1">
              <input type="text" class="form-control" id="buildingname" aria-describedby="test" placeholder="Add Building Name">
            </div>
            <div class="container m-1">
              <input type="text" class="form-control" id="latcoord" aria-describedby="test" placeholder="Add Latitude Coordinates">
            </div>
            <div class="container m-1">
              <input type="text" class="form-control" id="lngcoord" aria-describedby="test" placeholder="Add Longitude Coordiates">
            </div>
            <div class="container m-1">
              <input type="text" class="form-control" id="extrainfo" aria-describedby="test" placeholder="Add Extra Info">
            </div>
            <div class="container m-1">
              <input type="text" class="form-control" id="narrative" aria-describedby="test" placeholder="Add Narrative">
            </div>

            <div class="container mt-3">
              <button type="button" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;" onclick="addBuilding()">Submit</button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Building Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Extra Info</th>
                <th>QR Code</th>
                <th>Narritive</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody id="buildings">

            </tbody>
          </table>
        </div>
      </div>

      <!-- Routes content -->

      <div class="tab-pane" id="Routes">

        <form>
          <div class="row m-1">
            <div class="container text-center">
              <h1 class="lead">Add a route to a department!</h1>
            </div>
          </div>
          <div class="row m-3">
            <div class="col">
              <select class="custom-select my-1 mr-sm-2" id="departmentdropdown">
                <option selected>Department</option>
              </select>
            </div>
            <div class="col">
              <select class="custom-select my-1 mr-sm-2" id="buildingdropdown">
                <option selected>Building</option>
              </select>
            </div>
            <div class="col my-auto">
              <button type="button" class="btn btn-sm btn-outline-dark" onclick="addRoute()">Add Route</button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Department Name</th>
                <th>Building Name</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody id="routes">

            </tbody>
          </table>
        </div>
      </div>

      <!-- FAQ content -->

      <div class="tab-pane" id="FAQ">

        <form>
          <div class="form-group">
            <div class="container text-center">
              <h1 class="lead">Add a new FAQ</h1>
            </div>
            <div class="container m-1">
              <input type="text" class="form-control" id="question" aria-describedby="test" placeholder="Add question">
            </div>
            <div class="container m-1">
              <input type="text" class="form-control" id="answer" aria-describedby="test" placeholder="Add answer">
            </div>
            <div class="container mt-3">
              <button type="button" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;" onclick="addFAQ()">Submit</button>
            </div>
          </div>
        </form>

        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody id="faq">

            </tbody>
          </table>
        </div>
      </div>


      <div class="tab-pane" id="GroupTracking">
        <div class="container text-center">
          <h1 class="lead">Group Tracking</h1>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Solo/Group Name</th>
                <th>Department Name</th>
                <th>Current Building</th>
                <th>Current Score</th>
              </tr>
            </thead>
            <tbody id="grouptracking">
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- tab content -->
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
