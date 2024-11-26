<?php
$link = 'actu';
$title = 'Fil d\'actualité';
?>

<section class="container d-flex justify-content-center mt-5 h-100">
    <div class="col-12 col-md-12">

        <!-- Liste des activités -->
        <section class="activities mb-5 w-50" data-refresh-url="/profile/activities<?= $_SESSION['id'] ?>">
            <ul class="list-group">
            <?php foreach ($activities as $activity): ?>
                <li class="list-group-item mb-3">
                    <p><strong>Nom: </strong><?= $profile->name; ?></p>
                    <p><?= $activity['message'] ?? ''; ?></p>
                    <?php if (!empty($activity->image_url)): ?>
                    <div class="mb-3">
                        <img src="<?= $activity->image_url; ?>" alt="Image associée" class="img-fluid rounded">
                    </div>
                    <?php endif; ?>
                    <small class="text-muted">Publié le : <?= $activity->created_at->toDateTime()->format('d/m/Y H:i:s'); ?></small>
                </li>
            <?php endforeach; ?>
            </ul>
        </section>

        <!-- Barre de publication -->
        <section class="publish">
            <div class="card">
                <form method="POST" action="/profile/publish" enctype="multipart/form-data" data-refresh-target=".activities">
                    <div class="card-body d-flex align-items-center">
                        <!-- Zone de texte -->
                        <textarea class="form-control me-3" name="message" id="message" rows="2" placeholder="Écrivez un message..." required></textarea>

                        <!-- Icône d'ajout de fichier -->
                        <label for="fileInput" class="btn btn-outline-secondary me-3">
                            <i class="fas fa-paperclip"></i>
                            <input type="file" name="image" id="fileInput" class="d-none" accept="image/*">
                        </label>

                        <!-- Bouton emoji -->
                        <div class="position-relative d-inline-block">
                            <label id="emojiButton" class="btn btn-outline-secondary">
                                <i class="fas fa-smile"></i>
                            </label>
                            <div id="emojiPicker"></div>
                        </div>

                        <!-- Bouton de publication (flèche) -->
                        <div class="p-3">
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="publishButton">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    </div>
                </form>
            </div>
            <div id="error-message" class="alert alert-danger" role="alert"></div>
        </section>
    </div>
</section>

<?php
//Custom JS
$script = 'actu';
?>
