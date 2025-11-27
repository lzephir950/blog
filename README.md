# Mini blog PHP (procédural)

Mini application de blog développée en **PHP procédural** dans le cadre de mon apprentissage du back-end.  
Le projet permet à un utilisateur connecté de créer, lire, modifier et supprimer des articles, de les organiser par catégories et d’ajouter des commentaires.

---

## Fonctionnalités

### Utilisateurs
- Inscription d’un nouvel utilisateur (`register.php`)
- Connexion / déconnexion (`index.php`, `validation_user.php`, `logout.php`)
- Gestion de la session utilisateur (accès réservé à certaines actions)
- Messages d’erreur / succès via **sessions** (identifiants incorrects, champs vides, etc.)

### Articles
- Création d’un article (`create_article.php`)
  - Titre
  - Contenu en plusieurs parties (`content_one`, `content_two`, `content_three`)
  - Catégorie associée
  - Auteur récupéré depuis la session utilisateur
- Affichage de la liste des articles (`home.php`)
- Affichage du détail d’un article (`read_article.php`)
- Modification d’un article (`update_article.php`, `post_update_article.php`)
- Suppression d’un article (`delete_article.php`, `post_delete_article.php`)
- **Sécurité logique :** seul l’auteur de l’article peut le modifier / supprimer  
  (contrôle basé sur la session et le champ `author` / `user_id` en base)

### Catégories
- Création d’une catégorie (`create_category.php`)
- Association d’une catégorie à chaque article via un `<select>` dans le formulaire
- Protection via clé étrangère : impossible de supprimer une catégorie utilisée par des articles (erreur MySQL gérée côté PHP)

### Commentaires
- Ajout d’un commentaire sur un article (`create_comment.php`)
  - Récupération de l’article concerné via `article_id`
  - Récupération de l’utilisateur via la session
- Affichage des commentaires liés à un article dans `read_article.php`

### Structure générale
- Header commun (`header.php`)
- Fichier de fonctions réutilisables (`function.php`)
- Configuration base de données et modèles dans `config/`

---

## 🛠️ Stack technique

- **Langage :** PHP (procédural)
- **Base de données :** MySQL avec moteur InnoDB (via PDO)
- **Serveur web :** Apache (Wamp/Xampp ou équivalent)
- **Front :**
  - HTML5
  - CSS
  - [Bootstrap 5](https://getbootstrap.com/)
- **Gestion des erreurs / feedback :** Sessions PHP (`$_SESSION`)

---

## Organisation des fichiers

Principaux fichiers à la racine du projet :

- `index.php` : page de connexion
- `register.php` : page d’inscription
- `validation_user.php` : traitement du formulaire de login
- `logout.php` : déconnexion
- `home.php` : page d’accueil listant les articles
- `create_article.php` : formulaire de création d’article
- `update_article.php` & `post_update_article.php` : modification d’un article
- `delete_article.php` & `post_delete_article.php` : suppression d’un article
- `read_article.php` : lecture d’un article + commentaires
- `create_category.php` : création de catégories
- `create_comment.php` : création de commentaires
- `header.php` : barre de navigation / header commun
- `function.php` : fonctions utilitaires

Dossiers :

- `config/` : configuration MySQL, modèles, etc.
- `css/` : feuilles de style
- `img/` : ressources images

---

## Installation & configuration

1. **Cloner le projet**

```bash
git clone https://github.com/lzephir950/blog.git
cd blog
git checkout dev
