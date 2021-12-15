<div class="container my-4"> <a href="add.html" class="btn btn-success float-right">Ajouter</a>
    <h2>Liste des &Eacute;tudiants</h2>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student) : ?>
            <tr>
                <th scope="row">1</th>
                <td><?= $student->getFirstName() ?></td>
                <td><?= $student->getLastName() ?></td>
                <td class="text-right">
                    <a href="edit.html" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"
                                href="/students/1/delete">Oui, je veux
                                supprimer</a>
                            <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>