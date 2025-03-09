document.getElementById('faq-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const question = document.getElementById('question').value;
    const answer = document.getElementById('answer').value;
    
    fetch('add_faq.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ question, answer })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('FAQ added successfully!');
            window.location.href = 'home.html';
        } else {
            alert('Failed to add FAQ.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});