# Bonus

Chaque bonus est indépendant. Tu peux suivre l'ordre que tu souhaite.

## Validation des données

- dans le traitement des données envoyées en POST (ajout prof et ajout étudiant)
- après la récupération des données, vérifier que :
  - chaque donnée ne soit pas vide
  - que le statut soit 1 ou 2
- si les données sont incorrectes :
  - ne pas ajouter
  - créer un tableau avec toutes les "erreurs"
  - réafficher la _View_ du formulaire
  - en transmettant le tableau
  - puis afficher toutes les erreurs dans une "alert" _Bootstrap_

## Mise à jour d'un prof

- coder route, _Controller_, _View_, _Model_
- le formulaire est le même que pour l'ajout
- la récupération et la validation des données est la même que pour l'ajout
- par contre, il faudra :
  - récupérer le _Model_ `Teacher` à partir de l'id fourni dans l'URL
  - puis rediriger vers la page de modification du prof en question

## Mise à jour d'un étudiant

- coder route, _Controller_, _View_, _Model_
- s'inspirer de l'étape précédente

## Suppression d'un prof

- coder route, _Controller_, _Model_
- attention, la suppression se fait sans formulaire, juste avec une URL dans une balise `<a>` de la liste des profs

## Suppression d'un étudiant

- coder route, _Controller_, _Model_
- attention, la suppression se fait sans formulaire, juste avec une URL dans une balise `<a>` de la liste des étudiants

## Mega Bonus :rainbow:

Tu veux encore bosser sur ce projet ?  
J'espère que la deadline du parcours est passée et que ça te sert de révision :pray:  
Dans le [Mega Bonus](megabonus.md), il y aura encore moins de détails.  
=> _C'est le jeu, ma pauvre Lucette_
