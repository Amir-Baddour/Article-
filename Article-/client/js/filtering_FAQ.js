document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");
    const searchButton = document.getElementById("search-button");
  
    function filterFAQs() {
      let input = searchInput.value.toLowerCase();
      let faqItems = document.querySelectorAll(".faq-item");
  
      faqItems.forEach(item => {
        let question = item.querySelector(".faq-question").innerText.toLowerCase();
        let answer = item.querySelector(".faq-answer").innerText.toLowerCase();
  
        if (question.includes(input) || answer.includes(input)) {
          item.style.display = "block"; // Show matched item
        } else {
          item.style.display = "none"; // Hide unmatched item
        }
      });
    }
  
    // Event Listeners
    searchInput.addEventListener("keyup", filterFAQs);
    searchButton.addEventListener("click", filterFAQs);
  });
  