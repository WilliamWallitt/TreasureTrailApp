// ;==========================================
// ; Title:  Front end Javascript request's (Modify Data Page - Departments)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================

function fetchDepartments() {
  fetch("../app/get_departments.php").then(response => {
      return response.json();
  }).then(data => {
    const departmentTable = document.getElementById("departments");
    var html = "";

    for (let index = 0; index < data.length; index++) {
      const department = data[index].department_name;
      html += "<tr><td>" + department + "</td><td><button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteDepartment("+ data[index].department_id + ")\">Delete</button></td></tr>";
    }
    departmentTable.innerHTML = html;
  }).catch(err => {
      console.log(err);
  });
}

function addDepartment() {
  let departmentName = document.getElementById("departmentName").value;

  if (departmentName.length == 0) {
    alert("Please fill in the required fileds");
    return;
  }
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

// getting departments -> as its the first page
fetchDepartments();
