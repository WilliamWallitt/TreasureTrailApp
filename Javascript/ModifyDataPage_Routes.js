// ;==========================================
// ; Title:  Front end Javascript request's (Modify Data Page - Routes)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================

function fetchRoute() {

  // due to only partial data being load (buildings and departments) as not all of them had a route
  // we need to fetch bot get_all_departments and get_all_buildings for the complete list

  // get all departments
  fetch("../app/get_departments.php").then(response => {
      return response.json();
  }).then(data => {
    // get the drop down list element
    const departmentDropDown = document.getElementById("departmentdropdown");
    var html1 = "";
    for (let index = 0; index < data.length; index++) {
      // iterate over all the departments and add them to our string
      let department = data[index];
      html1 += "<option id=\"" + department.department_id + "\">" + department.department_name + "</option>"

    }
    // set the department drop down innnerHTML to our string
    departmentDropDown.innerHTML = html1;

  }).catch(err => {
      console.log(err);
  });

  // get all buildings
  fetch("../app/get_all_buildings.php").then(response => {
      return response.json();
  }).then(data => {
    // get building drop down list
    const buildingDropDown = document.getElementById("buildingdropdown");

    var html = "";
    for (let index = 0; index < data.length; index++) {
      let building = data[index];
      html += "<option id=\"" + building.building_id + "\">" + building.building_name + "</option>"
    }

    buildingDropDown.innerHTML = html;
  }).catch(err => {
      console.log(err);
  });

  // fetching all the routes and populating the route table
  fetch("../app/get_all_routes.php").then(response => {
      return response.json();
  }).then(data => {

    const departmentTable = document.getElementById("routes");
    let departmentTableHTML = "";
    for (let index = 0; index < data.length; index++) {

      const department = data[index].department_name;

      for (let index2 = 0; index2 < data[index].buildings.length; index2++) {
        // each department has an array of buildings - so we loop through them and add each to our list
        const building = data[index].buildings[index2].building_name;

        var dep = "<tr><td>" + department + "</td><td>"+ building + "</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteRoute("+ data[index].buildings[index2].route_id + ")\">Delete</button></td></tr>";
        var build = "<tr><td></td><td>"+ building + "</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteRoute("+ data[index].buildings[index2].route_id + ")\">Delete</button></td></tr>";

        if (index2 == 0) {
          // so we only have one department for each list of buildings for the route (makes it look nicer)
          departmentTableHTML += dep;
        } else {
          departmentTableHTML += build;
        }
      }
    }
    // set our element's innerHTML to our variable
    departmentTable.innerHTML = departmentTableHTML;
  }).catch(err => {
      console.log(err);
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


function deleteRoute(route_id) {
  fetch("../app/remove_route.php?route_id=" + route_id).then(response => {
      return response.json();
  }).then(data => {
    fetchRoute();
  });
}
