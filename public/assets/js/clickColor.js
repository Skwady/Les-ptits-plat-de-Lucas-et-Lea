document.addEventListener('DOMContentLoaded', () => {
    const heartIcon = document.querySelector('.heart-icon');
    const heartGradient = document.querySelector('.heart-gradient');
    const notification = document.getElementById('notification');
    const notifications = document.getElementById('notifications');

    heartIcon.addEventListener('click', (event) => {
        event.preventDefault(); 
        heartIcon.classList.toggle('filled');



        notification.classList.add('show');
        notification.innerText = heartIcon.classList.contains('filled')
            ? 'Recette ajoutée à vos favoris'
            : 'Recette retirée de vos favoris';


        setTimeout(() => {
            notification.classList.remove('show');
        }, 2000);
    });

    heartGradient.addEventListener('click', (event) => {
        event.preventDefault();
        heartGradient.classList.toggle('filled');

        notifications.classList.add('show');
        notifications.innerText = heartGradient.classList.contains('filled')
            ? 'Merci pour votre j\'aime'
            : 'que n\'avez vous pas aimer dans cette recette ?';


        setTimeout(() => {
            notifications.classList.remove('show');
        }, 2000);

    });

});