<?php
function connexion() {




    static $bdd = null;
    if ($bdd === null) {
        $bdd = mysqli_connect('localhost', 'root', '', 'examens2');
        //$bdd = mysqli_connect('localhost', 'ETU004162', 'JrG6cVfq', 'examens2');
        //$bdd = mysqli_connect('localhost', 'ETU004028', '0jrYNTAy', 'examens2');
        if (!$bdd) {
            die ("Erreur de connection à la base de données" . mysqli_connect_error());
        }
    }

    return $bdd;
}
?>