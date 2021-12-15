<div class="container my-4"> <a href="../student/list.html" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un étudiant</h2>

    <form action="" method="POST" class="mt-5">
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="" value="">
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="" value="">
        </div>
        <div class="form-group">
            <label for="teacher">Prof</label>
            <select name="teacher" id="teacher" class="form-control">
                <option value="0">-</option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher->getId() ?>"><?= $teacher->getFirstname() ?> - <?= $teacher->getJob() ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control">
                <option value="0">-</option>
                <option value="1">actif</option>
                <option value="2">désactivé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>