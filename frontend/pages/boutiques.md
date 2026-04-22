-- Base de données pour Velora
-- Copiez ce code dans phpMyAdmin pour créer les tables

CREATE DATABASE IF NOT EXISTS velora_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE velora_db;



-- 2. Table utilisateur
CREATE TABLE utilisateur (
    id_utilisateur   INT AUTO_INCREMENT PRIMARY KEY,
    nom              VARCHAR(80)      NOT NULL,
    prenom           VARCHAR(80)      NOT NULL,
    email            VARCHAR(120)     NOT NULL ,
    telephone        VARCHAR(30),
    Adresse          TEXT,
    ville            VARCHAR(100),   NOT NULL,
    mot_de_passe     VARCHAR(255)     NOT NULL,          
    
    date_inscription DATE             
) ENGINE=InnoDB;

-- Ajouter la colonne `role` si vous souhaitez gérer les rôles (par défaut 'client')
ALTER TABLE utilisateur
  ADD COLUMN role VARCHAR(20) NOT NULL DEFAULT 'client';


-- 3. Table catégorie
CREATE TABLE categorie (
    id_categorie   INT AUTO_INCREMENT PRIMARY KEY,
    nom            VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;




-- Table des produits
CREATE TABLE IF NOT EXISTS produits (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    categorie VARCHAR(100),
    description TEXT,
    stock INT DEFAULT 100,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table du panier 
CREATE TABLE IF NOT EXISTS panier (
    id_panier INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT DEFAULT 1,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_produit) REFERENCES produits(id_produit) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
);

-- Table des commandes
CREATE TABLE IF NOT EXISTS commandes (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL DEFAULT 1,
    nom_utilisateur VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    Adresse TEXT NOT NULL,
    mode_paiement VARCHAR(50) NOT NULL,
    montant_total DECIMAL(10, 2) NOT NULL,
    statut VARCHAR(50) DEFAULT 'en_attente',
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des détails de commande
CREATE TABLE IF NOT EXISTS details_commande (
    id_details_commande INT AUTO_INCREMENT PRIMARY KEY,
    id_commande INT NOT NULL,
    id_produit INT NOT NULL,
    nom_produit VARCHAR(255) NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    quantite INT NOT NULL,
    FOREIGN KEY (id_commande) REFERENCES commandes(id_produit) ON DELETE CASCADE,
    FOREIGN KEY (id_produit) REFERENCES produits(id_produit) ON DELETE CASCADE
);

-- Insérer quelques produits d'exemple
INSERT INTO produits (nom, prix, image, categorie, description) VALUES
('Fleur de Néroli', 25000, '../images/nerolie.webp', 'Parfums', 'Eau de parfum 50ml, notes florales délicates'),
('Nuit Intense', 40000, '../images/nuit-intense-scaled.jpg', 'Parfums', 'Parfum longue tenue 100ml'),
('Perruque Naturelle', 45000, '../images/perruquenou.webp', 'Perruques', 'Perruque naturelle, coupe longue et soyeuse'),
('Dark Spot', 8500, '../images/dark_spot.jpg', 'Soins', 'Anti-tache & nourrie'),
('Fond de Teint Naturel', 10000, '../images/font_de_teint_naturel.jpg', 'Maquillage', 'Finition légère et couvrante - 30ml'),
('Mascara Volume', 6000, '../images/mascara_volume.webp', 'Maquillage', 'Cils volumineux et définition longue durée');


# GUIDE D'INSTALLATION - SYSTÈME DE PANIER VELORA
# ================================================

## ÉTAPE 1: CRÉER LA BASE DE DONNÉES
-------------------------------------

1. Ouvrez phpMyAdmin dans votre navigateur
   (généralement: http://localhost/phpmyadmin)

2. Cliquez sur "Nouvelle base de données" en haut à gauche

3. Nommez-la "velora_db" et cliquez sur "Créer"

4. Sélectionnez la base de données "velora_db"

5. Cliquez sur l'onglet "SQL" en haut

6. Copiez TOUT le contenu du fichier "database.sql" et collez-le dans la zone de texte

7. Cliquez sur "Exécuter" en bas

✅ Votre base de données est maintenant créée avec des produits d'exemple!


## ÉTAPE 2: PLACER LES FICHIERS PHP
-----------------------------------

Placez les fichiers dans votre dossier "pages/" (là où se trouvent main.php, boutique.php, etc.):

📁 Votre structure doit ressembler à:
```
votre_projet/
├── pages/
│   ├── main.php (existant)
│   ├── boutique.php (existant)
│   ├── config.php ✨ NOUVEAU
│   ├── gerer_panier.php ✨ NOUVEAU
│   ├── traiter_commande.php ✨ NOUVEAU
│   ├── panier.php (REMPLACER par panier_nouveau.php)
│   └── confirmation.php ✨ NOUVEAU
├── css/
└── images/
```

**IMPORTANT**: Renommez "panier_nouveau.php" en "panier.php" (ou remplacez l'ancien)


## ÉTAPE 3: MODIFIER BOUTIQUE.PHP
---------------------------------

Dans boutique.php, vous devez modifier CHAQUE bouton "Ajouter au panier" pour qu'il fonctionne.

### AVANT (ligne 104 par exemple):
```html
<button class="btn-panier" aria-label="Ajouter au panier">
  <i class="fas fa-shopping-cart"></i>
</button>
```

### APRÈS:
```html
<form method="POST" action="gerer_panier.php" style="display:inline;">
  <input type="hidden" name="action" value="ajouter">
  <input type="hidden" name="produit_id" value="1">
  <button type="submit" class="btn-panier" aria-label="Ajouter au panier">
    <i class="fas fa-shopping-cart"></i>
  </button>
</form>
```

⚠️ IMPORTANT: Changez le "produit_id" pour chaque produit:
- Fleur de Néroli → produit_id="1"
- Nuit Intense → produit_id="2"
- Perruque Naturelle → produit_id="3"
- Dark Spot → produit_id="4"
- Fond de Teint → produit_id="5"
- Mascara Volume → produit_id="6"

Vous pouvez ajouter plus de produits dans la base de données et utiliser leurs IDs.


## ÉTAPE 4: MODIFIER MAIN.PHP
-----------------------------

Faites la même modification dans main.php pour les boutons du panier.

Exemple à la ligne 139:
```html
<form method="POST" action="gerer_panier.php" style="display:inline;">
  <input type="hidden" name="action" value="ajouter">
  <input type="hidden" name="produit_id" value="3">
  <button type="submit" class="btn-paniere" aria-label="Ajouter au panier">
    <i class="fas fa-shopping-cart"></i>
  </button>
</form>
```


## ÉTAPE 5: AJOUTER config.php EN HAUT DE CHAQUE PAGE
----------------------------------------------------

Dans TOUS vos fichiers PHP (main.php, boutique.php, panier.php, etc.), 
ajoutez cette ligne TOUT EN HAUT, juste après <?php:

```php
<?php
require_once 'config.php';
// ... le reste de votre code
```

Si le fichier ne commence pas par <?php, ajoutez-le avant le <!DOCTYPE html>:

```php
<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html>
...
```


## ÉTAPE 6: TESTER LE SYSTÈME
----------------------------

1. Ouvrez votre site: http://localhost/votre_projet/pages/main.php

2. Cliquez sur "Boutique"

3. Cliquez sur un bouton "Ajouter au panier" 
   → Vous devriez être redirigé vers la page panier

4. Vérifiez que le produit apparaît dans le panier

5. Modifiez la quantité → le sous-total doit se mettre à jour

6. Remplissez le formulaire de paiement en bas

7. Cliquez sur "Valider la commande"

8. Vous devriez voir la page de confirmation avec les détails


## ÉTAPE 7: VOIR LES COMMANDES DANS LA BASE
-------------------------------------------

1. Allez dans phpMyAdmin

2. Sélectionnez la base "velora_db"

3. Cliquez sur la table "commandes" → vous verrez toutes les commandes

4. Cliquez sur "details_commande" → vous verrez les produits de chaque commande


## CONFIGURATION (OPTIONNEL)
---------------------------

Si votre base de données a un nom d'utilisateur ou mot de passe différent,
modifiez le fichier config.php:

```php
define('DB_USER', 'votre_nom_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');
```


## RÉSOLUTION DE PROBLÈMES
-------------------------

❌ ERREUR: "Erreur de connexion"
→ Vérifiez que la base de données "velora_db" existe
→ Vérifiez les identifiants dans config.php

❌ ERREUR: "Session non démarrée"
→ Assurez-vous que config.php est inclus en haut de chaque page

❌ Le panier est vide après ajout
→ Vérifiez que le produit_id dans le formulaire correspond à un ID dans la table "produits"

❌ Page blanche
→ Activez l'affichage des erreurs PHP dans config.php:
   ini_set('display_errors', 1);
   error_reporting(E_ALL);


## FONCTIONNALITÉS INCLUSES
--------------------------

✅ Ajouter des produits au panier
✅ Modifier les quantités
✅ Supprimer un produit
✅ Vider le panier
✅ Formulaire de paiement intégré
✅ 3 modes de paiement (livraison, mobile money, virement)
✅ Enregistrement des commandes
✅ Page de confirmation
✅ Calcul automatique du total


## POUR AJOUTER DE NOUVEAUX PRODUITS
-----------------------------------

1. Allez dans phpMyAdmin → velora_db → table "produits"

2. Cliquez sur "Insérer"

3. Remplissez:
   - nom: Nom du produit
   - prix: Prix en FCFA
   - image: Chemin vers l'image (ex: ../images/produit.jpg)
   - categorie: Parfums, Maquillage, Soins, Perruques
   - description: Description du produit

4. Cliquez sur "Exécuter"

5. Notez l'ID du produit créé

6. Utilisez cet ID dans votre bouton "Ajouter au panier"


## BESOIN D'AIDE?
----------------

Si vous rencontrez des problèmes:
1. Vérifiez que TOUS les fichiers sont au bon endroit
2. Vérifiez que la base de données est créée
3. Vérifiez que config.php est inclus partout
4. Activez l'affichage des erreurs PHP

Bon courage pour votre BTS! 🎓