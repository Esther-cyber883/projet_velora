<?php
include '../backend/db.php';

if (isset($_POST['envoyer'])) {
    $nom        = trim($_POST['nom']);
    $prenom     = trim($_POST['prenom']);
    $email      = trim($_POST['email']);
    $telephone  = trim($_POST['telephone']);
    $adresse    = trim($_POST['Adresse']);
    $ville      = trim($_POST['ville']);
    $mot_de_passe = $_POST['mot_de_passe'];

    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($adresse) && !empty($ville) && !empty($mot_de_passe)) {

        // Vérifier si l'email existe déjà
        $verif = $dbpdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE email = :email");
        $verif->bindValue(':email', $email);
        $verif->execute();

        if ($verif->rowCount() > 0) {
            echo "<script>alert('Cet email est déjà utilisé ! Veuillez en choisir un autre.'); window.location.href = '../frontend/pages/inscription.php';</script>";
        } else {
            // Insérer l'utilisateur (la colonne `role` n'existe pas dans le schéma fourni)
            // on utilise la colonne `date_inscription` pour stocker la date (CURDATE())
            $requete = $dbpdo->prepare(
                "INSERT INTO utilisateur (nom, prenom, email, telephone, Adresse, ville, mot_de_passe, date_inscription)
                 VALUES (:nom, :prenom, :email, :telephone, :Adresse, :ville, :mot_de_passe, CURDATE())"
            );
            $requete->bindValue(':nom',          $nom);
            $requete->bindValue(':prenom',        $prenom);
            $requete->bindValue(':email',         $email);
            $requete->bindValue(':telephone',     $telephone);
            $requete->bindValue(':Adresse',       $adresse);
            $requete->bindValue(':ville',         $ville);
            $requete->bindValue(':mot_de_passe',  password_hash($mot_de_passe, PASSWORD_DEFAULT));

            $result = $requete->execute();

            if (!$result) {
                echo "<script>alert('Erreur lors de l\\'inscription.'); window.location.href = '../frontend/pages/inscription.php';</script>";
            } else {
                // ✅ CORRECTION : le ç a été supprimé ici
                echo "<script>alert('Inscription réussie ! Vous pouvez maintenant vous connecter.'); window.location.href = '../frontend/pages/connexion.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Veuillez remplir tous les champs obligatoires.'); window.history.back();</script>";
    }
}
?>