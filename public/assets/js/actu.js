document.addEventListener('DOMContentLoaded', () => {
    const emojiButton = document.querySelector('#emojiButton');
    const emojiPicker = document.querySelector('#emojiPicker');
    const messageInput = document.querySelector('#message');

    // Liste d'emojis (visages et nourriture)
    const emojis = [
        // Emojis de visages
        '😀', '😁', '😂', '🤣', '😃', '😄', '😅', '😆', '😉', '😊',
        '😋', '😎', '😍', '😘', '🥰', '😗', '😙', '😚', '🙂', '🤗',
        '🤩', '🤔', '🤨', '😐', '😑', '😶', '🙄', '😏', '😣', '😥',
        '😮', '🤐', '😯', '😪', '😫', '🥱', '😴', '😌', '😛', '😜',
        '😝', '🤤', '😒', '😓', '😔', '😕', '🙃', '🫠', '🤑', '😲',
        '☹️', '🙁', '😖', '😞', '😟', '😤', '😢', '😭', '😦', '😧',
        '😨', '😩', '🤯', '😬', '😰', '😱', '🥵', '🥶', '😳', '🤪',
        '😵', '🤕', '🤒', '🤮', '🤧', '😷', '🤠', '🥳', '🥸', '😎',

        // Emojis de nourriture
        '🍏', '🍎', '🍐', '🍊', '🍋', '🍌', '🍉', '🍇', '🍓', '🫐',
        '🥝', '🍒', '🍑', '🥭', '🍍', '🥥', '🥑', '🍅', '🍆', '🥔',
        '🥕', '🌽', '🌶️', '🫑', '🥒', '🥬', '🥦', '🧄', '🧅', '🍄',
        '🥜', '🌰', '🍞', '🥐', '🥖', '🥨', '🥯', '🫓', '🥞', '🧇',
        '🧀', '🍖', '🍗', '🥩', '🥓', '🍔', '🍟', '🍕', '🌭', '🥪',
        '🌮', '🌯', '🫔', '🥙', '🧆', '🥗', '🥘', '🫕', '🍝', '🍜',
        '🍲', '🍛', '🍣', '🍱', '🥟', '🍤', '🍚', '🍥', '🥮', '🍡',
        '🥠', '🧁', '🍰', '🎂', '🍮', '🍬', '🍭', '🍫', '🍿', '🍩',
        '🍪', '🌰', '🥛', '🍼', '☕', '🍵', '🫖', '🥤', '🧃', '🍶',
        '🍺', '🍻', '🥂', '🍷', '🥃', '🍸', '🍹', '🧉', '🧊', '🥄',
    ];

    // Générer les spans d'emojis dans le picker
    emojis.forEach(emoji => {
        const span = document.createElement('span');
        span.className = 'emoji-item';
        span.innerText = emoji;
        emojiPicker.appendChild(span);
    });

    // Afficher/Masquer le picker avec ajustement de position
    emojiButton.addEventListener('click', (event) => {
        event.preventDefault(); // Empêche le comportement par défaut si nécessaire

        // Calculer la position du bouton emoji
        const rect = emojiButton.getBoundingClientRect();

        // Position par défaut (sous le bouton emoji)
        let top = rect.bottom + window.scrollY + 5; // Ajouter un petit espace
        let left = rect.left + window.scrollX;

        // Ajuster si le picker dépasse à droite
        const pickerWidth = emojiPicker.offsetWidth || 300; // Largeur estimée
        if (left + pickerWidth > window.innerWidth) {
            left = window.innerWidth - pickerWidth - 10; // 10px de marge
        }

        // Ajuster si le picker dépasse en bas
        const pickerHeight = emojiPicker.offsetHeight || 300; // Hauteur estimée
        if (top + pickerHeight > window.innerHeight + window.scrollY) {
            top = rect.top + window.scrollY - pickerHeight - 5; // Placer au-dessus du bouton
        }

        emojiPicker.style.top = `${top}px`;
        emojiPicker.style.left = `${left}px`;

        // Afficher/Masquer le picker
        emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
    });

    // Ajouter l'emoji sélectionné au champ texte
    emojiPicker.addEventListener('click', (event) => {
        if (event.target.classList.contains('emoji-item')) {
            messageInput.value += event.target.innerText;
            emojiPicker.style.display = 'none'; // Fermer le picker après sélection
        }
    });

    // Cacher le picker si on clique en dehors
    document.addEventListener('click', (event) => {
        if (!emojiPicker.contains(event.target) && event.target !== emojiButton) {
            emojiPicker.style.display = 'none';
        }
    });
});
