/gestionnaire-contacts
│
├── index.php            # Page principale (Liste des contacts)
├── add.php              # Page d'ajout de contact
├── delete.php           # Page de suppression de contact
├── db.php               # Connexion à la base de données
├── css/
│   └── styles.css       # Fichier CSS pour le style moderne
└── includes/
    ├── header.php       # En-tête HTML
    └── footer.php       # Pied de page HTML


# Gestionnaire de Contacts

## Description

Le projet **Gestionnaire de Contacts** permet de gérer une liste de contacts. Il offre une interface simple et intuitive pour ajouter, rechercher et afficher des contacts. Ce projet est conçu pour être utilisé par toute personne ayant besoin de garder une trace de ses contacts personnels ou professionnels.

## Fonctionnalités

- **Ajout de contacts** : Permet d'ajouter des informations de contact telles que le nom, le numéro de téléphone, l'adresse e-mail et d'autres détails pertinents.
- **Recherche de contacts** : Recherche de contacts par nom ou toute autre information disponible.
- **Affichage des contacts** : Liste des contacts ajoutés avec la possibilité de visualiser les détails complets.
- **Interface simple** : Conception claire et facile à utiliser avec un formulaire de recherche pour une navigation rapide.

## Technologies utilisées

- **HTML5** : Pour la structure de la page web.
- **CSS3** : Pour le style et la mise en page (y compris la gestion de la réactivité avec des media queries).
- **PHP** : Pour la gestion de la logique backend (CRUD des contacts).
- **MySQL** : Pour stocker les informations de contacts dans une base de données.
- **Font Awesome** : Pour ajouter des icônes dans l'interface utilisateur.
  
## Installation

### Prérequis

- Serveur web compatible PHP (ex : [XAMPP](https://www.apachefriends.org/fr/index.html), [WAMP](http://www.wampserver.com/en/), ou serveur de production).
- Serveur de base de données MySQL.
- Navigateur web moderne.

### Étapes d'installation

1. **Cloner ce repository** :

   ```bash
   git clone https://github.com/Gregoir30/gestion-de-contact.git
