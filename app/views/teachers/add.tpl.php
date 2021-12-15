<div class="container my-4"> <a href="<?= $router->generate('teachers-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un prof</h2>

    <form action="" method="POST" class="mt-5">
    <input type="hidden" name="token" value="<?= $token ?>">

        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= $_POST['firstname'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= $_POST['lastname'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="job">Titre</label>
            <input type="text" class="form-control" name="job" id="job" placeholder="" value="<?= $_POST['job'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control">
                <option selected disabled value="0">-</option>
                <option <?= isset($_POST['status']) && $_POST['status'] == 1 ? 'selected' : '' ?> value="1">actif</option>
                <option <?= isset($_POST['status']) && $_POST['status'] == 2 ? 'selected' : '' ?> value="2">désactivé</option>
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