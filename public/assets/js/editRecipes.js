document.querySelector('form').addEventListener('submit', function(event) {
    const cookTimeField = document.getElementById('cook_time');
    const restTimeField = document.getElementById('rest_time');

    // Remplacer les champs vides par null pour éviter l'envoi de 0
    if (cookTimeField.value.trim() === '') {
        cookTimeField.value = null;
    }
    if (restTimeField.value.trim() === '') {
        restTimeField.value = null;
    }
});
