<?php
function connexion() {
    static $bdd = null;
    if ($bdd === null) {
        $bdd = mysqli_connect('localhost', 'root', '', 'employees');
        if (!$bdd) {
            die ("Erreur de connection à la base de données" . mysqli_connect_error());
        }
    }

    return $bdd;
}
?>