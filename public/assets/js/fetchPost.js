document.querySelectorAll('form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); 

        let data = new FormData(this); 
        let action = this.action; 

        fetch(action, {
            method: 'POST',
            body: data,
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                return response.json().then(err => { throw err; });
            }
        })
        .then(function(jsonResponse) {
            // Cacher le message d'erreur en cas de succès
            const errorMessageContainer = document.getElementById('error-message');
            errorMessageContainer.style.display = 'none';

            form.reset();
            
            if (jsonResponse.redirect) {
                window.location.href = jsonResponse.redirect; // Redirection si demandée
            }
        })
        .catch(function(error) {
            // Afficher l'erreur dans le conteneur d'erreurs
            const errorMessageContainer = document.getElementById('error-message');
            errorMessageContainer.style.display = 'block';
            errorMessageContainer.textContent = error.message || "Une erreur est survenue.";
        });
    });
});