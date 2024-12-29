<?php
$link = 'main';
$links = 'password';
$title = 'Login';
?>

<div class="background-custom"></div>

<section class="text-center d-flex justify-content-center align-items-center login">
    <div class="container p-4 col-12 col-md-8 col-lg-4 bg-gradiant">
        <h2 class="tw">Connexion</h2>
        <form method="POST" class="p-3" id="loginForm" action="/login/conect" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email" class="tw">Email :</label>
                <input type="email" name="email" id="email" class="form-control mb-3" required>
            </div>
            <div class="form-group mb-3">
            <div class="input-container">
                <input type="password" id="password" name="password" class="form-control" required>
                <span class="toggle-password" id="togglePassword">👁️</span>
            </div>
            </div>
            <div class="formLogin">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <button type="submit" id="submit" class="btn bg-gradiant2 tw border w-50">Connexion</button> 
            </div>
        </form>
        <a href="/login/register" class="tw">Pas encore inscrit ?</a>
        <div id="error-message" class="alert alert-danger" role="alert"></div>
    </div>    
</section>

<?php
$script = "password";