<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connexion.php";



//Verifie si le mail est deja utilise
function verifierMail($email) {
    $bdd = connexion();
    $query = "SELECT * FROM membre WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true; // L'email est déjà utilisé
    } else {
        return false; // L'email est disponible
    }
}

//Creation d'un compte
function creerCompte($email, $nom, $motDePasse,$dateNaissance, $genre, $ville) {
    $bdd = connexion();
    $query = "INSERT INTO membre (email, nom, mdp,date_naissance, genre, ville, image_profil) VALUES 
                ('$email', '$nom', '$motDePasse','$dateNaissance', '$genre', '$ville', 'null.jpg')";
    if (!mysqli_query($bdd, $query)) {
        return false; // Erreur lors de la création 
    }
    return true; // Compte créé avec succès
}

//Verifie si le compte existe
function verifierCompte($email, $motDePasse) {
    $bdd = connexion();
    $query = "SELECT * FROM membre WHERE email = '$email' AND mdp = '$motDePasse'";
    $result = mysqli_query($bdd, $query);
    if (mysqli_num_rows($result) == 1) {
        return true; // Le compte existe
    } else {
        return false; // Le compte n'existe pas
    }
}

function getUser($email) {
    $bdd = connexion();
    $query = "SELECT * FROM membre WHERE email = '$email'";
    $result = mysqli_query($bdd, $query);
    return mysqli_fetch_assoc($result);
}


function getCategorie()
{
    $bdd = connexion();
    $query = "SELECT * FROM categorie_objet";
    $result = mysqli_query($bdd,$query);
    return $result;
}


function getListObjet($id) {
    $bdd = connexion();
    $query = "SELECT * FROM objet 
                JOIN images_objet on objet.id_objet = images_objet.id_objet 
                WHERE id_categorie = $id";
    $result = mysqli_query($bdd, $query);
    return  $result ;
}

function getEmprunt($id_objet) {
    $bdd = connexion();
    $query = "SELECT * FROM emprunt 
                WHERE id_objet = $id_objet 
                ORDER BY date_emprunt DESC 
                LIMIT 1";
    return mysqli_fetch_assoc(mysqli_query($bdd, $query));
}





?>