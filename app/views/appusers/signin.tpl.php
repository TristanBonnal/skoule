<div class="container my-4">
    <div class="card card--signin">
        <div class="card-header">
            Connexion
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" class="form-control" name="email" id="email"
                        placeholder="Saisissez votre adresse email" value="">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Saisissez votre mot de passe" value="">
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">se connecter</button>
            </form>
        </div>
    </div>
    <?php if (isset($errors)) : ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endforeach ?>
    <?php endif ?>
</div>