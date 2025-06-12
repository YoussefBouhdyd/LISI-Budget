document.addEventListener('DOMContentLoaded', function() {
  // Navigation entre les sections
  const navItems = document.querySelectorAll('.nav-item');
  const contentSections = document.querySelectorAll('.content-section');

  navItems.forEach(item => {
    item.addEventListener('click', function() {
      // Retirer la classe active de tous les éléments
      navItems.forEach(i => i.classList.remove('active'));
      contentSections.forEach(section => section.classList.remove('active'));
      
      // Ajouter la classe active à l'élément cliqué
      this.classList.add('active');
      const target = this.getAttribute('data-section');
      document.getElementById(target).classList.add('active');
    });
  });

  // Gestion de l'édition du profil
  const editBtn = document.getElementById('edit-profile-btn');
  const cancelBtn = document.getElementById('cancel-edit');
  const formInputs = document.querySelectorAll('.profile-form input[readonly]');
  
  editBtn.addEventListener('click', function() {
    formInputs.forEach(input => {
      input.removeAttribute('readonly');
      input.style.backgroundColor = 'white';
      input.style.borderColor = '#e0e0e0';
      input.style.cursor = 'text';
    });
    
    this.style.display = 'none';
    document.querySelector('.form-actions').style.display = 'flex';
  });
  
  cancelBtn.addEventListener('click', function() {
    formInputs.forEach(input => {
      input.setAttribute('readonly', true);
      input.style.backgroundColor = '#f5f5f5';
      input.style.borderColor = '#eee';
      input.style.cursor = 'not-allowed';
    });
    
    editBtn.style.display = 'flex';
    document.querySelector('.form-actions').style.display = 'none';
  });

  // Gestion du changement de mot de passe
  const changePasswordBtn = document.getElementById('change-password-btn');
  const passwordModal = document.getElementById('password-modal');
  const closeModal = document.querySelector('.close-modal');
  
  changePasswordBtn.addEventListener('click', function() {
    passwordModal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  });
  
  closeModal.addEventListener('click', function() {
    passwordModal.style.display = 'none';
    document.body.style.overflow = 'auto';
  });
  
  window.addEventListener('click', function(e) {
    if (e.target === passwordModal) {
      passwordModal.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
  });

  // Force du mot de passe
  const newPassword = document.getElementById('new-password');
  const strengthBars = document.querySelectorAll('.strength-bar');
  const strengthText = document.querySelector('.strength-text');
  
  newPassword.addEventListener('input', function() {
    const password = this.value;
    let strength = 0;
    
    // Longueur minimale
    if (password.length >= 8) strength += 1;
    
    // Contient des chiffres
    if (/\d/.test(password)) strength += 1;
    
    // Contient des majuscules
    if (/[A-Z]/.test(password)) strength += 1;
    
    // Contient des caractères spéciaux
    if (/[^A-Za-z0-9]/.test(password)) strength += 1;
    
    // Mise à jour de l'affichage
    updateStrengthIndicator(strength);
  });

  function updateStrengthIndicator(strength) {
    // Réinitialiser
    strengthBars.forEach(bar => {
      bar.classList.remove('weak', 'medium', 'strong', 'very-strong');
      bar.style.backgroundColor = '';
    });
    strengthText.textContent = 'Faible';
    strengthText.style.color = '';
    
    switch(strength) {
      case 1:
        strengthBars[0].classList.add('weak');
        strengthBars[0].style.backgroundColor = '#ef5350';
        strengthText.textContent = 'Faible';
        strengthText.style.color = '#ef5350';
        break;
      case 2:
        strengthBars[0].classList.add('medium');
        strengthBars[1].classList.add('medium');
        strengthBars[0].style.backgroundColor = '#ffa726';
        strengthBars[1].style.backgroundColor = '#ffa726';
        strengthText.textContent = 'Moyen';
        strengthText.style.color = '#ffa726';
        break;
      case 3:
        strengthBars[0].classList.add('strong');
        strengthBars[1].classList.add('strong');
        strengthBars[2].classList.add('strong');
        strengthBars[0].style.backgroundColor = '#66bb6a';
        strengthBars[1].style.backgroundColor = '#66bb6a';
        strengthBars[2].style.backgroundColor = '#66bb6a';
        strengthText.textContent = 'Fort';
        strengthText.style.color = '#66bb6a';
        break;
      case 4:
        strengthBars[0].classList.add('very-strong');
        strengthBars[1].classList.add('very-strong');
        strengthBars[2].classList.add('very-strong');
        strengthBars[3].classList.add('very-strong');
        strengthBars[0].style.backgroundColor = '#26a69a';
        strengthBars[1].style.backgroundColor = '#26a69a';
        strengthBars[2].style.backgroundColor = '#26a69a';
        strengthBars[3].style.backgroundColor = '#26a69a';
        strengthText.textContent = 'Très fort';
        strengthText.style.color = '#26a69a';
        break;
    }
  }

  // Soumission du formulaire de mot de passe
  document.getElementById('password-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const currentPass = document.getElementById('current-password').value;
    const newPass = document.getElementById('new-password').value;
    const confirmPass = document.getElementById('confirm-password').value;
    
    // Validation simple
    if (newPass !== confirmPass) {
      alert('Les nouveaux mots de passe ne correspondent pas');
      return;
    }
    
    if (newPass.length < 8) {
      alert('Le mot de passe doit contenir au moins 8 caractères');
      return;
    }
    
    // Ici, vous feriez normalement une requête AJAX au serveur
    console.log('Mot de passe changé avec succès');
    alert('Mot de passe changé avec succès');
    passwordModal.style.display = 'none';
    document.body.style.overflow = 'auto';
    this.reset();
    
    // Réinitialiser l'indicateur de force
    strengthBars.forEach(bar => {
      bar.classList.remove('weak', 'medium', 'strong', 'very-strong');
      bar.style.backgroundColor = '#e0e0e0';
    });
    strengthText.textContent = 'Faible';
    strengthText.style.color = '#90a4ae';
  });

  // Cacher les boutons d'action du formulaire par défaut
  document.querySelector('.form-actions').style.display = 'none';
});