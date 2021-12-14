# Parcours S06 :fire:

Une école 100% en ligne formant des développeurs Web souhaite mettre en place un BackOffice de gestion de leurs formateurs et de leurs étudiants.

> ceci est une œuvre de fiction. Toute ressemblance avec des personnages ayant réellement existé serait purement fortuite

## Informations :information_source:

**:bulb: Conseil du jour, bonjour**  
Prend bien le temps de lire TOUT l'énoncé avant de commencer à coder.  
De nombreux éléments sont fournis, pour gagner du temps. Ce serait dommage de passer à côté :wink:

### #1 Routes, _Controllers_ :motorway:

- la liste des routes du projet est fournie : [docs/routes.md](docs/routes.md)
- toutes les routes ne sont pas à mettre en place
- il est préférable d'ajouter chaque route au fur et à mesure du besoin
- les noms de _Controllers_ sont libres
- les noms des méthodes de ces _Controllers_ sont libres aussi

### #2 Intégration HTML/CSS :lipstick:

- l'intégration HTML du projet est fournie dans [docs/integration-html-css/](docs/integration-html-css/)
- toutes les pages de cette intégration ne sont pas à mettre en place
- à chaque nouvelle page/route, tu peux piocher le code HTML nécessaire

### #3 Imports SQL :floppy_disk:

- :warning: il y a 2 fichiers d'imports SQL :
  - import des tables et champs : [docs/structure.sql](docs/structure.sql)
  - import des données : [docs/data.sql](docs/data.sql)
- il faut bien entendu effectuer les imports dans le bon ordre :
  - importer d'abord la structure
  - puis se placer dans la base de données `skoule` créée
  - et enfin importer les données

### #4 Architecture MVC :heart_eyes:

- on ne va pas réinventer la roue complète lors de ce parcours
- on va plutôt se baser sur le code de cette saison (BackOffice), et le personnaliser
   - on peut récupérer le code complet de _oShop_ et supprimer le code superflu
   - ou bien partir de zéro et copier-coller des bouts de code de _oShop_ nécessaires
- par contre, il ne doit pas rester le moindre code spécifique au projet _oShop_, il faudra donc bien penser à supprimer les bouts de code inutiles

### #5 Git

- la correction de ce parcours se fera grâce à une _Pull Request_
- [fiche récap sur la création d'une _Pull Request_](https://kourou.oclock.io/ressources/fiche-recap/pull-request/) à faire à la fin du parcours
- sauf que pour faire une _Pull Request_, il faut déjà penser à coder dans une nouvelle branche :thinking:

## Let's code ! :keyboard:

### #1 Créer une nouvelle branche

- pour préparer la PR
- créer une nouvelle branche (nommée `skoule` ou `parcours` par exemple)
- comme je me suis levé du bon pied ce matin, je veux bien donner la commande
- `git checkout -b nom-de-la-branche`
- c'est :gift:, ne me remerciez pas :sweat_smile:

### #2 Lister tous les profs

- coder route, _Controller_, _View_, _Model_
- pour t'aider, on te fournit les bouts de code ci-dessous

<details><summary>récupération de tous les profs</summary>

```php
// On commence par récupérer tous les Models Teachers
// pour transmettre ensuite à la view
$teachersList = Teacher::findAll();
```

</details>

<details><summary>Dans la vue, on affiche la liste de profs</summary>

```html
<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Titre</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($teachersList as $currentTeacher) : ?>
        <tr>
            <th scope="row"><?= $currentTeacher->getId() ?></th>
            <td><?= $currentTeacher->getFirstname() ?></td>
            <td><?= $currentTeacher->getLastname() ?></td>
            <td><?= $currentTeacher->getJob() ?></td>
            <td class="text-right">
                <a href="todo" class="btn btn-sm btn-warning">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="todo">Oui, je veux supprimer</a>
                        <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
```

</details>


### #3 Lister tous les étudiants

- coder route, _Controller_, _View_, _Model_
- pour t'aider, tu peux t'inspirer de l'étape précédente

### #4 Ajout d'un prof

- coder route, _Controller_, _View_, _Model_
- :warning: il y a une route en `GET` et une autre en `POST`
- générer le lien du bouton "Ajouter" de la liste des profs, vers cette page d'ajout
- une fois les données envoyées par le formulaire vers la même URL mais en `POST`
- c'est la route en `POST` qui est sollicitée et exécute la méthode de _Controller_ correspondante
- cette méthode contient tout le traitement nécessaire :
  - récupérer les données
  - ajouter en DB
  - rediriger sur la page "liste"
  - (la validation simple des données sera un bonus)
- pour t'aider, on te fournit les bouts de code ci-dessous

<details><summary>récupération des données en POST</summary>

**Première façon : avec filter_input()**

```php
// On récupère les données
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$job = filter_input(INPUT_POST, 'job');
$status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
```

**Deuxième façon : avec $_POST et les conditions ternaires**

```php
// On récupère les données
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$job = isset($_POST['job']) ? $_POST['job'] : '';
$status = isset($_POST['status']) ? intval($_POST['status']) : 0;
```

</details>

<details><summary>Ajout d'un prof en DB</summary>

```php
// On crée un nouveau Model
$teacher = new Teacher();

// On renseigne les propriétés
$teacher->setFirstname($firstname);
$teacher->setLastname($lastname);
$teacher->setJob($job);
$teacher->setStatus($status);

// On sauvegarde en DB
if ($teacher->save()) {
    // TODO rediriger vers la page liste
}
```

</details>

### #5 Ajout d'un étudiant

- coder route, _Controller_, _View_, _Model_
- pour t'aider, tu peux t'inspirer de l'étape précédente
- mais on te fournit aussi un bout de code :wink:

<details><summary>Ajout d'un étudiant en DB</summary>

```php
// On crée un nouveau Model
$student = new Student();

// On renseigne les propriétés
$student->setFirstname($firstname);
$student->setLastname($lastname);
$student->setTeacherId($teacherId);
$student->setStatus($status);

// On sauvegarde en DB
if ($student->save()) {
    // TODO rediriger vers la page liste
}
```

</details>

### #6 Restreindre l'accès aux utilisateurs

- coder la page de connexion "sign in" (`GET` et `POST`)
- coder le _Model_ `AppUser`
- la table `app_user` contient actuellement 2 utilisateurs :
  - _Lucie copin_, mot de passe : `cameleons`
  - _Benji_, mot de passe : `nicole`
- désormais, toutes les pages du projet nécessitent un utilisateur connecté, SAUF :
  - la page de connexion, bien sûr :wink:

### #7 Mettre en place les permissions

- le _Role_ de chaque utilisateur connecté permet de déterminer à quelles ressources/pages il a accès
- on a 2 _Roles_ dans ce projet : `admin` et `user`
- les pages liées aux étudiants sont autorisées aux _Roles_ `admin` et `user`
- les pages liées aux profs ont des permissions plus précises :
  - ajout, modification et suppression autorisés au _Role_ `admin`
  - liste autorisée aux _Roles_ `admin` et `user`

### #8 Pull Request

- faire un `push` de son travail
- aller sur son repo GitHub pour créer la _Pull Request_
- [fiche récap sur la création d'une _Pull Request_](https://kourou.oclock.io/ressources/fiche-recap/pull-request/)

## Bonus

Et oui, comme pour les challenges, il y a [des bonus](bonus.md) :tada:
