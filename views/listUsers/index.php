<?php 
$link = 'actu';
$title = 'Liste des utilisateurs'; 
?>


<section>
    <div>
        <h1 class="d-flex justify-content-center mt-2 mb-5">liste des utilisateurs</h1>
        <section class="activities mb-5 w-50" data-refresh-url="/profile/activities<?= $_SESSION['id'] ?>">
            <ul class="list-group gap-3">
                <?php foreach ($users as $user): ?>
                    <li class="list-group-item mb-3 position-relative">
                        <p><?= $user->name; ?></p>
                        <p><?= $user->email; ?></p>
                            <!-- Icône croix -->
                            <span class="delete-comment position-absolute top-0 end-0 me-2" data-comment-id="<?= $user->id; ?>">
                                &times;
                            </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
</section>

<?php
$script = "deleteUser";
?>