// ;==========================================
// ; Title:  Front end Javascript request's (FAQ Page)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   25 Feb 2020
// ;==========================================

fetch("../app/get_faqs.php").then(response => {
    return response.json();
}).then(data => {

  let details = document.getElementById("faq");
  let html = "";
  for (i = 0; i < data.length; i++) {

    let question = data[i].question;
    let answer = data[i].answer;

    html += "<div class=\"container m-3\"><details><summary open>"+ question +"<svg class=\"control-icon control-icon-expand\" width=\"24\" height=\"24\" role=\"presentation\"><use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#expand-more\" /></svg><svg class=\"control-icon control-icon-close\" width=\"24\" height=\"24\" role=\"presentation\"><use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#close\" /></svg></summary><p>"+ answer +"</p></details></div>"

}

details.innerHTML = html;


}).catch(err => {
    // catch err
    console.log(err);
});
