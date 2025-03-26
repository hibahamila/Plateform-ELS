{{-- <!-- L'icône de paramètres -->
<a class="setting-primary" href="javascript:void(0)" id="settings-icon">
    <i data-feather="settings"></i>
  </a>
  <img class="img-90 rounded-circle" src="{{ asset('assets/images/dashboard/1.png') }}" alt="" />
  
  <!-- Le formulaire d'édition de profil (masqué par défaut) -->
  <div id="edit-profile-form" class="modal" style="display:none;">
    <div class="modal-content">
      <h2>Éditer Profil</h2>
      <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT') <!-- Si tu utilises la méthode PUT dans ton route -->
  
        <div class="form-group">
          <label for="name">Prénom</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>
  
        <div class="form-group">
          <label for="lastname">Nom</label>
          <input type="text" name="lastname" id="lastname" class="form-control" value="{{ auth()->user()->lastname }}" required>
        </div>
  
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
        </div>
  
        <div class="form-group">
          <label for="password">Mot de passe (optionnel)</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
  
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Sauvegarder</button>
          <button type="button" id="close-form" class="btn btn-secondary">Annuler</button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- Ajouter le script pour ouvrir/fermer le formulaire -->
  <script>
    // Sélectionne l'icône et le formulaire
    const settingsIcon = document.getElementById('settings-icon');
    const editProfileForm = document.getElementById('edit-profile-form');
    const closeFormButton = document.getElementById('close-form');
  
    // Ouvre le formulaire lorsque l'icône est cliquée
    settingsIcon.addEventListener('click', () => {
      editProfileForm.style.display = 'block';
    });
  
    // Ferme le formulaire lorsque le bouton Annuler est cliqué
    closeFormButton.addEventListener('click', () => {
      editProfileForm.style.display = 'none';
    });
  
    // Optionnel : Fermer le formulaire si on clique à l'extérieur
    window.addEventListener('click', (event) => {
      if (event.target === editProfileForm) {
        editProfileForm.style.display = 'none';
      }
    });
  </script>
   --}}