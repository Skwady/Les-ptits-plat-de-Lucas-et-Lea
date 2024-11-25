<section class="container">
    <h2 class="text-center">Modifier le Profil</h2>
    <form method="POST" action="/profile/updateProfile/<?= $_SESSION['id'] ?>" enctype="multipart/form-data">
        
        <div class="mb-3 pt-3">
            <label for="date_of_birth">Date de naissance :</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?= $user->date_of_birth; ?>">
        </div>
        
        <div class="mb-3 pt-3">
            <label for="bio">Bio :</label>
            <textarea id="bio" name="bio"><?= $user->bio; ?></textarea>
        </div>

        <div class="mb-3 pt-3">
            <label for="profile_picture">Photo de profile :</label>
            <input type="file" id="profile_picture" name="profile_picture" value="<?= $user->profile_picture; ?>">
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit" class="btn btn-primary mb-4">Modifier</button>
    </form>
    <div id="error-message" class="alert alert-danger mt-4 mb-4" role="alert"></div>
</section>