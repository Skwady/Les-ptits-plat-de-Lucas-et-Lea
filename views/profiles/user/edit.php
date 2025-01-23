<section class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2>Modifier le Profil</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/profile/updateProfile/<?= $_SESSION['id'] ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                <!-- Date de naissance -->
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date de naissance :</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= $profile->date_of_birth; ?>" required>
                    <div class="invalid-feedback">Veuillez sélectionner une date valide.</div>
                </div>

                <!-- Bio -->
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio :</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Parlez un peu de vous..."><?= $profile->bio; ?></textarea>
                </div>

                <!-- Photo de profil -->
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Photo de profil :</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                    <div class="form-text">Formats acceptés : JPEG, PNG.</div>
                </div>

                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <!-- Bouton de soumission -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
            <div id="error-message" class="alert alert-danger mt-4 d-none" role="alert">
                Une erreur est survenue. Veuillez réessayer.
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2>Informations personnelles</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/users/updateUser/<?= $_SESSION['id'] ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Prenom ou pseudo :</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user->firstname ?? null; ?>">
                </div>

                <div class="mb-3">
                    <label for="firstname" class="form-label">Nom : (facultatif)</label>
                    <input class="form-control" id="firstname" name="firstname" value="<?= $user->name ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email : </label>
                    <input class="form-control" id="email" name="email" value="<?=$user->email;?>">
                </div>

                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <!-- Bouton de soumission -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
            <div id="error-message" class="alert alert-danger" role="alert"></div>
            <div id="success-message" class="alert alert-success" role="alert"></div>
        </div>
    </div>
</section>
