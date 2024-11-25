<!-- Fil d'actualité -->
<section class="container">
    <h2>Fil d'actualité public</h2>

    <!-- Liste des activités -->
    <section class="activities">
        <h3>Activités récentes</h3>
        <?php if (!empty($activities)): ?>
            <ul>
                <?php foreach ($activities as $activity): ?>
                    <li>
                        <p><strong>Utilisateur :</strong> <?= $activity->user_id; ?></p>
                        <p><?= $activity['message'] ?? ''; ?></p>
                        <?php if (!empty($activity->image_url)): ?>
                            <img src="<?= $activity->image_url; ?>" alt="Image associée">
                        <?php endif; ?>
                        <small>Publié le : <?= $activity->created_at->toDateTime()->format('d/m/Y H:i:s'); ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune activité récente.</p>
        <?php endif; ?>
    </section>

    <!-- Formulaire de publication -->
    <?php if (isset($_SESSION['id'])): ?>
    <section class="publish mb-5">
        <h3>Publier un message</h3>
        <form method="POST" action="/profile/publish" enctype="multipart/form-data">
            <div class="mb-3 pt-3">
                <textarea class="w-25" name="message" placeholder="Écrivez un message..." required></textarea>
            </div>
            <div class="mb-3 pt-3">
                <label for="image">Joindre une image :</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
            <div class="mb-3 pt-3">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <button type="submit">Publier</button>
            </div>
        </form>
        <div id="error-message" class="alert alert-danger" role="alert"></div>
    </section>
    <?php endif; ?>
</section>