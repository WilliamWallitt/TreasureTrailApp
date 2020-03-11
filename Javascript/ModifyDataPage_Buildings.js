// ;==========================================
// ; Title:  Front end Javascript request's (Modify Data Page - Buildings)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   25 Feb 2020
// ;==========================================

function fetchBuildings() {
  fetch("../app/get_all_buildings.php").then(response => {
      return response.json();
  }).then(data => {

    console.log(data);
    const departmentTable = document.getElementById("buildings");
    let departmentTableHTML = "";
    for (let index = 0; index < data.length; index++) {
      const building_id = data[index].building_id;
      const buildingName = data[index].building_name;
      const lat = data[index].latitude;
      const lng = data[index].longitude;
      const extraInfo = data[index].extra_info;
      const narrative = data[index].narrative;
      departmentTableHTML += "<tr><td>" + buildingName + "</td><td>" + lat + "</td><td>" + lng + "</td><td>" + extraInfo + "</td><td><img src=\"https://api.qrserver.com/v1/create-qr-code/?size=50x50&data=" +  building_id + "\"></img></td><td>" + narrative +"</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteBuilding("+ data[index].building_id + ")\">Delete</button></td></tr>";
    }
    departmentTable.innerHTML = departmentTableHTML;
  }).catch(err => {
      console.log(err);
  });
}

function addBuilding() {

  let buildingName = document.getElementById("buildingname").value;
  let lat = document.getElementById("latcoord").value;
  let lng = document.getElementById("lngcoord").value;
  let extraInfo = document.getElementById("extrainfo").value;
  let narrative = document.getElementById("narrative").value;

  if (buildingName.length == 0 || lat.length == 0 || lng.length == 0 || extraInfo.length == 0 || narrative.length == 0) {
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
      narrative: narrative,
      clues: []
    })
  }).then(response => {
    return response.json();
  }).then(data => {
    document.getElementById("buildingname").value = "";
    document.getElementById("latcoord").value = "";
    document.getElementById("lngcoord").value = "";
    document.getElementById("extrainfo").value = "";
    document.getElementById("narrative").value = "";
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
