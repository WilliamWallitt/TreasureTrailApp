
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

<div class="border-right" id="sidebar-wrapper">

<div class="menu">
  <ul class="nav nav-pills flex-column" style="list-style: none; margin: 0; padding: 0;">
    <li class="active nav-item"><a data-toggle="pill" href="#Departments"><button class="btn btn-outline-light text-dark mb-2 border-bottom">Departments</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Clues" data-toggle="pill"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchClues()">Clues</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Buildings"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchBuildings()">Buildings</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#Routes"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchRoute()">Routes</button></a></li>
    <li class="nav-item"><a data-toggle="pill" href="#FAQ"><button class="btn btn-outline-light text-dark mb-2 border-bottom" style="width: 100%" onclick="fetchFAQs()">FAQ</button></a></li>
  </ul>
</div>

</div>

<!-- Page Content -->
  <div class="container-fluid mt-2" id="page-content-wrapper">
    <div class="tab-content col-md-10">
      <div class="tab-pane active" id="Departments">
        <form>
          <div class="form-group">
            <input type="text" class="form-control" id="departmentName" aria-describedby="test" placeholder="Add Department Name">
            <div class="container mt-3">
              <button type="submit" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;" onclick="addDepartment()">Submit</button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Department Name</th>
              </tr>
            </thead>
            <tbody id="departments">
            </tbody>
          </table>
        </div>        
      </div>
      <div class="tab-pane" id="Clues">

        <form>
          <div class="col">
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
                  <label class="radio-inline"><input type="radio" name="true1">True</label>
                  <label class="radio-inline"><input type="radio" name="true1" checked>False</label>
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
                  <label class="radio-inline"><input type="radio" name="true2">False</label>
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
                  <label class="radio-inline"><input type="radio" name="false3">False</label>
              </div>
            </div>
          </div>


          <div class="container">
            <button type="submit" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;">Submit</button>
          </div>
        </form>

          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Clue</th>
                  <th>Questions</th>
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
                        <!-- <tbody>
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
                        </tbody> -->
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </div>
      </div>
      <div class="tab-pane" id="Buildings">
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

            <div class="container mt-3">
              <button type="submit" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;" onclick="addBuilding()">Submit</button>
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
                <th>Clue</th>
              </tr>
            </thead>
            <tbody id="buildings">
              
            </tbody>
          </table>
        </div>        
      </div>
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
              <button type="submit" class="btn btn-sm btn-outline-dark" onclick="addRoute()">Add Route</button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Department Name</th>
                <th>Building Name</th>
              </tr>
            </thead>
            <tbody id="routes">

            </tbody>
          </table>
        </div> 
      </div>
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
              <button type="submit" class="btn btn-sm btn-outline-dark mb-2" style="margin: 0 auto; display: block;" onclick="addFAQ()">Submit</button>
            </div>
          </div>
        </form>

        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>Question</th>
                <th>Answer</th>
              </tr>
            </thead>
            <tbody id="faq">

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


<script>


  function addFAQ() {

    let question = document.getElementById("question").value;
    let answer = document.getElementById("answer").value;

    if (question.length == 0 || answer.length == 0) {
      alert("Please fill in the required fileds");
      return;
    } 
    // Create a new user
    fetch('../app/create_faq.php', {
      headers: { "Content-Type": "application/json; charset=utf-8" },
      method: 'POST',
      body: JSON.stringify({
        question: question,
        answer: answer,
      })
    }).then(response => {
      return response.json();
    }).then(data => {
      document.getElementById("question").value = ""; 
      document.getElementById("answer").value = "";
      fetchFAQs();
    });
  }

  function deleteFAQ(faq_id) {

    fetch("../app/remove_faq.php?faq_id=" + faq_id).then(response => {
        return response.json();
    }).then(data => {
      fetchFAQs();
    });

  }

function addDepartment() {

  let departmentName = document.getElementById("departmentName").value;

  if (departmentName.length == 0) {
    alert("Please fill in the required fileds");
    return;
  } 

  // Create a new user
  fetch('../app/create_department.php', {
    headers: { "Content-Type": "application/json; charset=utf-8" },
    method: 'POST',
    body: JSON.stringify({
      department_name: departmentName,
    })
  }).then(response => {
    return response.json();
  }).then(data => {
    document.getElementById("departmentName").value = ""; 
    fetchDepartments();
  });
}


function deleteDepartment(department_id) {

  fetch("../app/remove_department.php?department_id=" + department_id).then(response => {
      return response.json();
  }).then(data => {
    fetchDepartments();
  });
}


function addBuilding() {

  let buildingName = document.getElementById("buildingname").value;
  let lat = document.getElementById("latcoord").value;
  let lng = document.getElementById("lngcoord").value;
  let extraInfo = document.getElementById("extrainfo").value;


  if (buildingName.length == 0 || lat.length == 0 || lng.length == 0 || extraInfo.length == 0) {
    alert("Please fill in the required fields - ");
    return;
  } 

  fetch('../app/create_building.php', {
      headers: { "Content-Type": "application/json; charset=utf-8" },
      method: 'POST',
      body: JSON.stringify({
        building_name: buildingName,
        latitude: lat,
        longitude: lng,
        extra_info: extraInfo,
        // sort clues out
        clues: []
      })
    }).then(response => {
      return response.json();
    }).then(data => {
      document.getElementById("buildingname").value = ""; 
      document.getElementById("latcoord").value = ""; 
      document.getElementById("lngcoord").value = ""; 
      document.getElementById("extrainfo").value = ""; 

      fetchBuildings();

    });
}


  function deleteBuilding(building_id) {

    fetch("../app/remove_building.php?building_id=" + building_id).then(response => {
        return response.json();
    }).then(data => {
      fetchBuildings();
    });
  }

  function addRoute() {

    let departments = document.getElementById("departmentdropdown");
    let department_id = departments.options[departments.selectedIndex].id;
    
    let buildings = document.getElementById("buildingdropdown");
    let building_id = buildings.options[buildings.selectedIndex].id;

    fetch('../app/create_route.php', {
      headers: { "Content-Type": "application/json; charset=utf-8" },
      method: 'POST',
      body: JSON.stringify({
        department_id: department_id,
        building_id: building_id
      })
    }).then(response => {
      return response.json();
    }).then(data => {
      departments.selectedIndex = 0;
      buildings.selectedIndex = 0;
      fetchRoute();
    });
  }
















  function fetchDepartments() {

    fetch("../app/get_departments.php").then(response => {
        return response.json();
    }).then(data => {

      console.log(data);
      const departmentTable = document.getElementById("departments");
      var html = "";
      for (let index = 0; index < data.length; index++) {
        const department = data[index].department_name;
        html += "<tr><td>" + department + "</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteDepartment("+ data[index].department_id + ")\">Delete</button></td></tr>";
        
      }
      departmentTable.innerHTML = html;
        //alert(data);
    }).catch(err => {
        // catch err
        console.log(err);
    });
  }

  function fetchClues() {

    fetch("../app/get_all_clues.php").then(response => {
        return response.json();
    }).then(data => {
      const cluesTable = document.getElementById("clues");

      let html = "";
      for (let index = 0; index < data.length; index++) {
        const clue = data[index].clue;
        html += "<tr> <td>" + clue + "</td><td> <table class=\"table table-hover table-light bg-light table-sm\"> <thead> <tr> <th>#</th> <th>Answer</th> <th>Correct</th> </tr></thead> <tbody>";
        
        for (let index2 = 0; index2 < data[index].answers.length; index2++) {
          const answer = data[index].answers[index2].answer;
          const correct = data[index].answers[index2].correct;

          html += "<tr> <th scope=\"row\">" + (index2 + 1) + "</th> <td>" + answer + "</td><td>" + correct + "</td><td><button class=\"btn btn-sm btn-outline-danger\"><i class=\"fas fa-minus\"></i></button></td></tr>";
        }
        html += "</tbody> </table> </td><td class=\"text-center\"><button class=\"btn btn-sm btn-outline-danger mt-5\">Delete</button></td></tr>";     
      }

      cluesTable.innerHTML = html;
        //alert(data);

      populateClueBuildings();
    }).catch(err => {
        // catch err
        console.log(err);
    });
  }

  function populateClueBuildings() {
    fetch("../app/get_all_buildings.php").then(response => {
        return response.json();
    }).then(data => {
      const buildingDropDown = document.getElementById("cluebuildingdropdown");
      var html = "";
      for (let index = 0; index < data.length; index++) {
        let building = data[index];
        html += "<option id=\"" + building.building_id + "\">" + building.building_name + "</option>"
      }
      buildingDropDown.innerHTML = html;
    }).catch(err => {
        // catch err
        console.log(err);
    });
  }

  function fetchBuildings() {

    fetch("../app/get_all_buildings.php").then(response => {
        return response.json();
    }).then(data => {

      console.log(data);
      const departmentTable = document.getElementById("buildings");
      let departmentTableHTML = "";
      for (let index = 0; index < data.length; index++) {
        const buildingName = data[index].building_name;
        const lat = data[index].latitude;
        const lng = data[index].longitude;
        const extraInfo = data[index].extra_info;
        departmentTableHTML += "<tr><td>" + buildingName + "</td><td>" + lat + "</td><td>" + lng + "</td><td>" + extraInfo + "</td><td>Clue</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteBuilding("+ data[index].building_id + ")\">Delete</button></td></tr>";
        
      }

      departmentTable.innerHTML = departmentTableHTML;
        //alert(data);
    }).catch(err => {
        // catch err
        console.log(err);
    });


  }


  function fetchRoute() {

    fetch("../app/get_all_routes.php").then(response => {
        return response.json();
    }).then(data => {
      // array for department names
      // array for building names
      const departmentNamesArr = [];
      const buildingNamesArr = [];

      const departmentTable = document.getElementById("routes");
      let departmentTableHTML = "";
      for (let index = 0; index < data.length; index++) {
        const department = data[index].department_name;
        //data[index].buildings

        // add department to array
        departmentNamesArr.push(data[index]);

        for (let index2 = 0; index2 < data[index].buildings.length; index2++) {
          const building = data[index].buildings[index2].building_name;
          // add building to array

          buildingNamesArr.push(data[index].buildings[index2]);


          // \"\"
          var dep = "<tr><td>" + department + "</td><td>"+ building + "</td><td><button class=\"btn btn-sm btn-outline-danger\"><i class=\"fas fa-minus\"></i></button></td></tr>";
          var build = "<tr><td></td><td>"+ building + "</td><td><button class=\"btn btn-sm btn-outline-danger\"><i class=\"fas fa-minus\"></i></button></td></tr>";

          if (index2 == 0) {
            departmentTableHTML += dep;
          } else {
            departmentTableHTML += build;
          }
        }
                
      }

      departmentTable.innerHTML = departmentTableHTML;

      // populate drop downs
      const departmentDropDown = document.getElementById("departmentdropdown");
      const buildingDropDown = document.getElementById("buildingdropdown");

    
      var html1 = "";
      for (let index = 0; index < departmentNamesArr.length; index++) {
        let department = departmentNamesArr[index];
        html1 += "<option id=\"" + department.department_id + "\">" + department.department_name + "</option>"
        
      }

      departmentDropDown.innerHTML = html1;

      var html = "";
      for (let index = 0; index < buildingNamesArr.length; index++) {
        let building = buildingNamesArr[index];
        html += "<option id=\"" + building.building_id + "\">" + building.building_name + "</option>"
      }
      buildingDropDown.innerHTML = html;

        //alert(data);
    }).catch(err => {
        // catch err
        console.log(err);
    });


  }


  function fetchFAQs() {


    fetch("../app/get_faqs.php").then(response => {
        return response.json();
    }).then(data => {
      const faqTable = document.getElementById("faq");
      let faqTableHTML = "";
      for (let index = 0; index < data.length; index++) {
        const question = data[index].question;
        const answer = data[index].answer;
        faqTableHTML += "<tr><td>" + question + "</td><td>"+ answer + "</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteFAQ("+ data[index].faq_id + ")\">Delete</button></td></tr>";
        
      } 

      faqTable.innerHTML = faqTableHTML;
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

