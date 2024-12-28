// Sélectionne le champ mot de passe et l'icône
const passwordField = document.getElementById('password');
const togglePassword = document.getElementById('togglePassword');

// Ajoute un événement au clic pour afficher/masquer le mot de passe
togglePassword.addEventListener('click', function () {
  // Bascule entre 'password' et 'text'
  const type = passwordField.type === 'password' ? 'text' : 'password';
  passwordField.type = type;

  // Change l'icône
  this.textContent = type === 'password' ? '👁️' : '🙈';
});