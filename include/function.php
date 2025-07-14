<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connexion.php";



//Verifie si le mail est deja utilise
function verifierMail($email) {
    $bdd = connexion();
    $query = "SELECT * FROM final_membre WHERE email = '$email'";
    $result = mysqli_query($bdd, $query);
    if (mysqli_num_rows($result) > 0) {
        return true; // L'email est déjà utilisé
    } else {
        return false; // L'email est disponible
    }
}

//Creation d'un compte
function creerCompte($email, $nom, $motDePasse,$dateNaissance, $genre, $ville) {
    $bdd = connexion();
    $query = "INSERT INTO final_membre (email, nom, mdp,date_naissance, genre, ville, image_profil) VALUES 
                ('$email', '$nom', '$motDePasse','$dateNaissance', '$genre', '$ville', 'null.jpg')";
    if (!mysqli_query($bdd, $query)) {
        return false; 
    }
    return true; 
}

//Verifie si le compte existe
function verifierCompte($email, $motDePasse) {
    $bdd = connexion();
    $query = "SELECT * FROM final_membre WHERE email = '$email' AND mdp = '$motDePasse'";
    $result = mysqli_query($bdd, $query);
    if (mysqli_num_rows($result) == 1) {
        return true; 
    } else {
        return false; 
    }
}

function getUser($email) {
    $bdd = connexion();
    $query = "SELECT * FROM final_membre WHERE email = '$email'";
    $result = mysqli_query($bdd, $query);
    return mysqli_fetch_assoc($result);
}


function getCategorie()
{
    $bdd = connexion();
    $query = "SELECT * FROM final_categorie_objet ORDER BY nom_categorie"; ;
    $result = mysqli_query($bdd,$query);
    return $result;
}


function getListObjet($id) {
    $bdd = connexion();
    $query = "SELECT * FROM final_objet 
                JOIN final_images_objet on final_objet.id_objet = final_images_objet.id_objet 
                WHERE id_categorie = $id ORDER BY nom_objet"; ;
    $result = mysqli_query($bdd, $query);
    return  $result ;
}

function getAllObjets() {
    $bdd = connexion();
    $query = "SELECT * FROM final_objet";
    $result = mysqli_query($bdd, $query);
    return $result;
}

function getEmprunt($id_objet) {
    $bdd = connexion();
    $query = "SELECT * FROM final_emprunt 
                WHERE id_objet = $id_objet 
                ORDER BY date_emprunt DESC 
                LIMIT 1";
    return mysqli_fetch_assoc(mysqli_query($bdd, $query));
}

function newImageObjet($id_objet, $nom_image) {
    $bdd = connexion();
    $query = "INSERT INTO final_images_objet (id_objet, nom_image) VALUES ($id_objet, '$nom_image')";
    $result = mysqli_query($bdd, $query);
}

function newObjet($id_categorie, $nom_objet, $id_membre) {
    $bdd = connexion();
    $query = "INSERT INTO final_objet (id_categorie, nom_objet, id_membre) 
                VALUES ($id_categorie, '$nom_objet', $id_membre)";
    $result = mysqli_query($bdd, $query);
}

function getDernierObjet() {
    $bdd = connexion();
    $query = "SELECT * FROM final_objet ORDER BY id_objet DESC LIMIT 1";
    $result = mysqli_query($bdd, $query);
    return mysqli_fetch_assoc($result);
}

function getFicheObjet($id_objet) {
    $bdd = connexion();
    $query = "SELECT o.*, c.nom_categorie 
              FROM final_objet o
              JOIN final_categorie_objet c ON o.id_categorie = c.id_categorie
              WHERE o.id_objet = $id_objet";
    $result = mysqli_query($bdd, $query);
    return mysqli_fetch_assoc($result);
}

function getImagesObjet($id_objet) {
    $bdd = connexion();
    $query = "SELECT * FROM final_images_objet WHERE id_objet = $id_objet";
    return mysqli_query($bdd, $query);
}

function getHistoriqueEmprunts($id_objet) {
    $bdd = connexion();
    $query = "SELECT e.*, m.nom 
              FROM final_emprunt e
              JOIN final_membre m ON e.id_membre = m.id_membre
              WHERE id_objet = $id_objet
              ORDER BY date_emprunt DESC";
    return mysqli_query($bdd, $query);
}



?>