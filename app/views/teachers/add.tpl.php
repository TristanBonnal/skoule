<div class="container my-4"> <a href="../teacher/list.html" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un prof</h2>

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
            <label for="job">Titre</label>
            <input type="text" class="form-control" name="job" id="job" placeholder="" value="">
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