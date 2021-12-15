<div class="container my-4"> <a href="<?= $router->generate('students-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Modifier un étudiant</h2>

    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="<?= $_POST['firstname'] ?? $student->getFirstName() ?>">
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="<?= $_POST['lastname'] ?? $student->getLastName() ?>">
        </div>
        <div class="form-group">
            <label for="teacher">Prof</label>
            <select name="teacher" id="teacher" class="form-control">
                <option value="0">-</option>
                <?php foreach ($teachers as $teacher): 
                    $currentTeacherId = $_POST['teacher'] ?? $student->getTeacher_id() ?>
                    <option value="<?= $teacher->getId() ?>" <?= $currentTeacherId == $teacher->getId() ? 'selected' : '' ?>>
                        <?= $teacher->getFirstname() ?> - <?= $teacher->getJob() ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control">
                <?php $status = $_POST['status'] ?? $student->getStatus() ?>
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