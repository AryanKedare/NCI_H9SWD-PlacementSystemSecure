document.addEventListener('DOMContentLoaded', function() {
    fetch('htmls/csrf.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('csrf_token').value = data.csrf_token;
        });
});