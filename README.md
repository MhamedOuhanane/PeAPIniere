# PéAPInière

## Contexte du projet

### Objectifs :
PéAPInière est une pépinière en pleine croissance qui cherche à améliorer son efficacité et sa productivité grâce à l’implémentation d’une **API**. Cette API vise à faciliter la gestion des stocks et des ventes, tout en offrant une meilleure expérience aux clients.

Les administrateurs pourront gérer les plantes existantes et leurs catégories. Des rôles utilisateurs seront également implémentés pour limiter l'accès aux fonctionnalités en fonction des permissions.

### User Stories :

- 🔐 **En tant que client**, je peux m’inscrire et me connecter pour accéder à mes informations et mes commandes avec un jeton JWT.
  
- 🪴 **En tant que client**, je peux consulter la liste des plantes disponibles et voir les détails d’une plante via son slug.
  
- 🧺 **En tant que client**, je peux passer une commande en choisissant des plantes par leur slug et en indiquant les quantités voulues.
  
- 🆗 **En tant que client**, je peux vérifier l’état de ma commande (en attente, en préparation, livrée).
  
- ❌ **En tant que client**, je peux annuler ma commande avant qu’elle ne soit préparée.
  
- 🪪 **En tant qu’employé**, je peux me connecter pour gérer les commandes avec des permissions adaptées à mon rôle.
  
- ⌛ **En tant qu’employé**, je peux indiquer qu’une commande est préparée et prête à être livrée.
  
- 📊 **En tant qu’administrateur**, je peux consulter des statistiques sur les ventes, les plantes les plus populaires, et leur répartition par catégorie, en utilisant le Query Builder de Laravel.
  
- 🎍 **En tant qu’administrateur**, je peux créer, modifier ou supprimer des catégories et des plantes.
  
- 🌳 **En tant que développeur**, je peux écrire des tests unitaires pour valider l’authentification, la gestion des catégories et la récupération des plantes par slugs avec Spatie Sluggable.
  
- 💐 **En tant que développeur**, je peux tester l’API avec Postman et rédiger une documentation claire des endpoints (via Swagger ou équivalent).
  
- 👮🏻 **En tant que développeur**, je peux gérer les exceptions en renvoyant des messages clairs et des codes HTTP adaptés.
  
- 💪🏻 **En tant que développeur**, je peux implémenter un DAO pour gérer les interactions directes avec la base de données.

---

## Fonctionnalités

- **Authentification JWT** pour les clients, employés, et administrateurs.
- **Gestion des plantes et catégories** par les administrateurs.
- **Gestion des commandes** avec la possibilité pour le client de vérifier le statut et d'annuler sa commande.
- **Système de rôles et permissions** pour restreindre l'accès aux différentes fonctionnalités selon le rôle de l'utilisateur.
- **Statistiques sur les ventes** et **plantes populaires** pour les administrateurs.
- **Tests unitaires** et **documentation API** via Postman et Swagger.

---

# Livrables

## 1. Planification des tâches (Jira)

Vous pouvez consulter la planification des tâches sur le board Jira. Le lien vers le board est le suivant :

- [Planification des tâches (Jira)](https://mhamde.atlassian.net/jira/software/projects/PEAP/boards/114?atlOrigin=eyJpIjoiMmQ1MzRhYzJmMWM2NDg3YWIwYzBiM2UwNjJmNWI3MTUiLCJwIjoiaiJ9)

## 2. Repository GitHub

Le code source du projet ainsi que tous les fichiers nécessaires sont disponibles dans le repository GitHub suivant :

- [Repository GitHub](https://github.com/MhamedOuhanane/PeAPIniere.git)


## 3. Présentation

La présentation du projet est disponible sur la plateforme **Canva**. Vous pouvez la consulter via le lien ci-dessous :

- [Présentation Canva](https://www.canva.com/design/DAGiqGiIA68/VkCpEd9xnd51RvHypyIPzw/edit?utm_content=DAGiqGiIA68&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)


