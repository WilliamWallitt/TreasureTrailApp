// ;==========================================
// ; Title:  Front end Javascript request's (Modify Data Page - FAQ)
// ; Author: William Wallitt, Justin Van Daalen, Stephan Kubal, Oliver Fawcett
// ; Date:   12 Mar 2020
// ;==========================================

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
  }).catch(err => {
      console.log(err);
  });
}


function addFAQ() {

  let question = document.getElementById("question").value;
  let answer = document.getElementById("answer").value;

  if (question.length == 0 || answer.length == 0) {
    alert("Please fill in the required fields");
    return;
  }
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
