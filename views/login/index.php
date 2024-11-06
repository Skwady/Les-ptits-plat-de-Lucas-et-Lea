<?php
$link = 'main';
$title = 'Login';
?>

<div class="background-custom"></div>

<section class="text-center d-flex justify-content-center align-items-center login">
    <div class="container p-4 col-12 col-md-8 col-lg-4 bg-gradiant">
        <h2>Connexion</h2>
        <form method="POST" class="p-3" id="loginForm" action="/login/conect">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control mb-3">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" class="form-control mb-3">
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