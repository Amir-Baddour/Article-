document.addEventListener('DOMContentLoaded', function() {
    fetch('get_faqs.php')
        .then(response => response.json())
        .then(faqs => {
            const faqList = document.getElementById('faq-list');
            faqs.forEach(faq => {
                const faqItem = document.createElement('div');
                faqItem.className = 'faq-item';
                faqItem.innerHTML = `
                    <h3 class="faq-question">${faq.question}</h3>
                    <p class="faq-answer">${faq.answer}</p>
                `;
                faqList.appendChild(faqItem);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

