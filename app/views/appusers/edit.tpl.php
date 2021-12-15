<div class="container my-4"> <a href="<?= $router->generate('users-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Modifier un utilisateur</h2>

    <form action="" method="POST" class="mt-5">
        <input type="hidden" name="token" value="<?= $token ?>">
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="" value="<?= $_POST['email'] ?? $user->getEmail() ?>">
        </div>
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?= $_POST['name'] ?? $user->getName() ?>">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="" value="">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option disabled selected value="0">-</option>
                <?php $role = $_POST['role'] ?? $user->getRole() ?>
                <option <?= $role == 'admin' ? 'selected' : '' ?> value="admin">Administrateur</option>
                <option <?= $role == 'user' ? 'selected' : '' ?> value="user">Utilisateur</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control">
                <option disabled selected value="0">-</option>
                <?php $status = $_POST['status'] ?? $user->getStatus() ?>
                <option <?= $status == 1 ? 'selected' : '' ?> value="1">actif</option>
                <option <?= $status == 2 ? 'selected' : '' ?> value="2">désactivé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
    <?php if (isset($errors)) : ?>
    <?php foreach($errors as $error): ?>
        <div class="alert alert-danger my-2"><?= $error ?></div>
    <?php endforeach ?>
    <?php endif ?>
</div>