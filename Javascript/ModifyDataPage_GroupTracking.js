// ;==========================================
// ; Title:  Front end Javascript request's (Modify Data Page - Group Tracking)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================

function fetchGroupTracking() {

fetch("../app/get_all_tracking.php").then(response => {
    return response.json();
}).then(data => {

  const groupTracking = document.getElementById("grouptracking");
  let groupTrackingHTML = "";
  for (let index = 0; index < data.length; index++) {
    const team_name = data[index].team_name;
    const department = data[index].department.department_name;
    const currentBuilding = data[index].current_building.building_name;
    const score = data[index].score;
    groupTrackingHTML += "<tr><td>" + team_name + "</td><td>" + department + "</td><td>" + currentBuilding + "</td><td>" + score + "</td></tr>";
  }
  groupTracking.innerHTML = groupTrackingHTML;
  }).catch(err => {
    console.log(err);
  });
}
