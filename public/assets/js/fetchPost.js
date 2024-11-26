document.querySelectorAll('form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); 

        let data = new FormData(this); 
        let action = this.action; 
        let target = this.getAttribute('data-target');

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

            // Rafraîchir la cible si spécifiée
            if (target) {
                refreshContent(Target);
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

// Fonction pour rafraîchir une section cible
function refreshContent(targetSelector) {
    const targetElement = document.querySelector(targetSelector);

    if (targetElement) {
        // URL de rafraîchissement à partir de data-refresh-url
        const refreshUrl = targetElement.getAttribute('data-refresh-url');

        if (refreshUrl) {
            fetch(refreshUrl)
                .then(response => {
                    if (response.ok) {
                        return response.text(); // Récupérer le contenu HTML
                    } else {
                        throw new Error("Impossible de rafraîchir le contenu.");
                    }
                })
                .then(updatedContent => {
                    // Mettre à jour le contenu HTML de la section cible
                    targetElement.innerHTML = updatedContent;
                })
                .catch(error => {
                    console.error("Erreur lors du rafraîchissement :", error);
                });
        } else {
            console.warn(`Aucune URL de rafraîchissement spécifiée pour ${targetSelector}`);
        }
    }
}