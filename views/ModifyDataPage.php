

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    <script
    src="https://use.fontawesome.com/releases/v5.12.1/js/all.js"
    data-search-pseudo-elements></script>
  <link rel="stylesheet" type="text/css" href='../public/stylesheets/modifyPage.css'>
<!------ Include the above in your HEAD tag ---------->
</head>

<style>
.menu a {
  display: block;
  text-decoration: none;
}

</style>

<body data-gr-c-s-loaded="true">

<div class="d-flex" id="wrapper">

<!-- Sidebar -->
  <!-- <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="list-group list-group-flush">
      <a href="#" class="list-group-item list-group-item-action active">Departments</a>
      <a href="#" class="list-group-item list-group-item-action bg-light">Clues</a>
      <a href="#" class="list-group-item list-group-item-action bg-light">Buildings</a>
      <a href="#" class="list-group-item list-group-item-action bg-light">Routes</a>
      <a href="#" class="list-group-item list-group-item-action bg-light">FAQ</a>
    </div>
  </div> -->

<div class="border-right" id="sidebar-wrapper">

<div class="menu">
  <ul class="nav nav-pills flex-column" style="list-style: none; margin: 0; padding: 0;">
    <li class="active nav-item"><a data-toggle="pill" href="#Departments"><button class="btn btn-outline-light text-dark mb-2 border-bottom">Departments</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Clues" data-toggle="pill"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%">Clues</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Buildings"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%">Buildings</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Routes"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%">Routes</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#FAQ"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%">FAQ</button></a></li>
  </ul>
</div>

</div>

<!-- Page Content -->
  <div class="container-fluid mt-2" id="page-content-wrapper">
    <div class="tab-content col-md-10">
      <div class="tab-pane active" id="Departments">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Department Name</th>
              </tr>
            </thead>
            <tbody id="departments">
              <tr>
                <td>Harrison</td>
              </tr>
              <tr>
                <td>Lava Building</td>
              </tr>
              <tr>
                <td>The Forum</td>
              </tr>
            </tbody>
          </table>
        </div>        
      </div>
      <div class="tab-pane" id="Clues">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Clue</th>
                  <th>Questions</th>
                </tr>
              </thead>

              <tbody>
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
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Q1</td>
                            <td>A1</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Q2</td>
                            <td>A2</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </div>
      </div>
      <div class="tab-pane" id="Buildings">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Building Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Extra Info</th>
                <th>Clue</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1,001</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>dolor</td>
                <td>sit</td>
              </tr>
              <tr>
                <td>1,002</td>
                <td>amet</td>
                <td>consectetur</td>
                <td>adipiscing</td>
                <td>elit</td>
              </tr>
              <tr>
                <td>1,003</td>
                <td>Integer</td>
                <td>nec</td>
                <td>odio</td>
                <td>Praesent</td>
              </tr>
            </tbody>
          </table>
        </div>        
      </div>
      <div class="tab-pane" id="Routes">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Department Name</th>
                <th>Building Name</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1,001</td>
                <td>Lorem</td>
              </tr>
              <tr>
                <td>1,002</td>
                <td>amet</td>
              </tr>
              <tr>
                <td>1,003</td>
                <td>Integer</td>
              </tr>
            </tbody>
          </table>
        </div> 
      </div>
      <div class="tab-pane" id="FAQ">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Question</th>
                <th>Answer</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Q1</td>
                <td>A1</td>
              </tr>
              <tr>
                <td>Q2</td>
                <td>A2</td>
              </tr>
              <tr>
                <td>Q3</td>
                <td>A3</td>
              </tr>
            </tbody>
          </table>
        </div> 
      </div>
    </div><!-- tab content -->

  </div>

  </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>


    <script>

function fetchDepartments() {

    fetch("../app/get_departments.php").then(response => {
        return response.json();
    }).then(data => {

      console.log(data);
      const departmentTable = document.getElementById("departments");

      for (let index = 0; index < data.length; index++) {
        const department = data[index].department_name;
        departmentTable.innerHTML += "<tr><td>" + department + "</td></tr>";
        
      }
        //alert(data);
    }).catch(err => {
        // catch err
        console.log(err);
    });
  }
      
  fetchDepartments();

    </script>
</body>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>

