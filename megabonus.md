# Mega BONUS :tada:

## Utilisateurs

- on veut gérer les utilisateurs dans ce backOffice
- seuls les utilisateurs `admin` peuvent accéder à cette partie
- "gérer" les utilisateurs signifie pouvoir :
  - lister
  - ajouter
  - modifier
  - supprimer

## CSRF

- mettre en place la protection anti-CSRF
- ajouter les tokens :
  - aux formulaires d'ajout
  - aux formulaires de mise à jour
  - aux liens de suppresion (en `GET`)
  - au formulaire de connexion
- vérifier la présence des tokens en question avant le traitement de données (`GET` ou `POST`)