function convertMinutesToHours(minutes) {
    if (minutes < 60) {
        return `${minutes}min`;
    }

    const hours = Math.floor(minutes / 60);
    const remainingMinutes = minutes % 60;

    if (remainingMinutes > 0) {
        return `${hours}h ${remainingMinutes}min`;
    }else if (hours > 0 && remainingMinutes == 0) {
        return `${hours}h`;
    }
    return 'aucun';
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("[data-prep-time]").forEach((element) => {
        const minutes = parseInt(element.getAttribute("data-prep-time"));
        element.innerText = convertMinutesToHours(minutes);
    });

    document.querySelectorAll("[data-cook-time]").forEach((element) => {
        const minutes = parseInt(element.getAttribute("data-cook-time"));
        element.innerText = convertMinutesToHours(minutes);
    });

    document.querySelectorAll("[data-rest-time]").forEach((element) => {
        const minutes = parseInt(element.getAttribute("data-rest-time"));
        element.innerText = convertMinutesToHours(minutes);
    });
});

function shareRecipe(recipeId, recipeTitle) {
    const recipeUrl = window.location.origin + '/recipes/viewRecipe/' + recipeId;

    // Utilisation de l'API Web Share si elle est disponible
    if (navigator.share) {
        navigator.share({
            title: recipeTitle,
            text: `Découvrez cette recette incroyable : ${recipeTitle}`,
            url: recipeUrl
        }).then(() => {
            alert('Recette partagée avec succès !');
        }).catch(err => {
            console.error('Erreur lors du partage : ', err);
        });
    } else {
        // Fallback : copier le lien de partage dans le presse-papier
        navigator.clipboard.writeText(recipeUrl).then(() => {
            alert('Lien de partage copié dans le presse-papier !');
        }).catch(err => {
            console.error('Impossible de copier dans le presse-papier : ', err);
        });
    }
}

function prepareShareModal(recipeId, recipeTitle) {
    const recipeUrl = `${window.location.origin}/recipes/viewRecipe/${recipeId}`;

    // Configurer les liens pour les réseaux sociaux
    document.getElementById('share-facebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(recipeUrl)}`;
    document.getElementById('share-twitter').href = `https://twitter.com/intent/tweet?text=${encodeURIComponent('Découvrez cette recette : ' + recipeTitle + ' ' + recipeUrl)}`;
    document.getElementById('share-whatsapp').href = `https://wa.me/?text=${encodeURIComponent('Découvrez cette recette : ' + recipeTitle + ' ' + recipeUrl)}`;

    // Mettre à jour le champ du lien à copier
    document.getElementById('share-link').value = recipeUrl;
}

function copyToClipboard() {
    const shareLink = document.getElementById('share-link');
    shareLink.select();
    document.execCommand('copy');
    alert('Lien copié dans le presse-papier !');
}




