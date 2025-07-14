<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connexion.php";




function getDepartments() {
    $bdd = connexion();
    $query = "SELECT * FROM departments";
    $result = mysqli_query($bdd, $query);
    return $result;
}



function getManagerOfDepartment($dept_no) {
    $bdd = connexion();
    $query = "SELECT * FROM dept_manager 
                JOIN employees ON dept_manager.emp_no = employees.emp_no 
                WHERE dept_no = '$dept_no' 
                AND to_date = '9999-01-01'";
    $result = mysqli_query($bdd, $query);
    return $result;
}






function getNameOfDepartment($dept_no) {
    $bdd = connexion();
    $query = "SELECT * FROM departments WHERE dept_no = '$dept_no' ORDER BY dept_name";
    $result = mysqli_query($bdd, $query);
    $department = mysqli_fetch_assoc($result);
    return $department['dept_name'];
}

function getemployerOfDepartment($dept_no) {
    $bdd = connexion();
    $query = "SELECT * FROM dept_emp
                JOIN employees ON dept_emp.emp_no = employees.emp_no
                WHERE dept_no = '$dept_no'  AND dept_emp.to_date = '9999-01-01'
                ORDER BY first_name, last_name";
    $result = mysqli_query($bdd, $query);
    return $result;
}

function getEmployer($emp_no) {
    $bdd = connexion();
    $query = "SELECT * FROM employees 
                JOIN salaries ON employees.emp_no = salaries.emp_no 
                JOIN titles ON employees.emp_no = titles.emp_no 
                WHERE employees.emp_no = '$emp_no'";
    $result = mysqli_query($bdd, $query);
    return $result ;
}

function getSalaireOfEmployer($emp_no) {
    $bdd = connexion();
    $query = "SELECT * FROM salaries WHERE emp_no = '$emp_no'";
    $result = mysqli_query($bdd, $query);
    return $result;
}

function getResultats($dept, $emp, $min, $max, $page, $lignes) {
    $bdd = connexion();
    $offset = $page * $lignes;
    $query = "SELECT dept_name, first_name, last_name, employees.emp_no AS emp_no, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age 
                FROM dept_emp 
                JOIN employees ON dept_emp.emp_no = employees.emp_no 
                JOIN departments ON dept_emp.dept_no = departments.dept_no 
                WHERE ";

    $options = "";
    if ($dept != "0") {
        $options .= "AND dept_name LIKE '%$dept%' ";
    }
    if ($emp != "0") {
        $options .= "AND (first_name LIKE '%$emp%' OR last_name LIKE '%$emp%') ";
    }
    $options .= "AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN $min AND $max ";
    $options = substr($options, 3);

    $query .= $options . "ORDER BY first_name, last_name LIMIT $offset, $lignes";

    $result = mysqli_query($bdd, $query);
    return $result;
}

function getCountResultats($dept, $emp, $min, $max) {
    $bdd = connexion();
    $query = "SELECT COUNT(*) AS count 
                FROM dept_emp 
                JOIN employees ON dept_emp.emp_no = employees.emp_no 
                JOIN departments ON dept_emp.dept_no = departments.dept_no 
                WHERE ";

    $options = "";
    if ($dept != "0") {
        $options .= "AND dept_name LIKE '%$dept%' ";
    }
    if ($emp != "0") {
        $options .= "AND (first_name LIKE '%$emp%' OR last_name LIKE '%$emp%') ";
    }
    $options .= "AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN $min AND $max ";
    $options = substr($options, 3);

    $query .= $options;

    $result = mysqli_query($bdd, $query);
    return mysqli_fetch_assoc($result)['count'];
}

function makeBoutonNavigation($bouton, $page, $lignes, $dept, $emp, $min, $max) {
    $page = (int)$page;
    $lignes = (int)$lignes;
    return "<a href='resultats.php?dept=$dept&emp=$emp&min=$min&max=$max&page=$page&lignes=$lignes'>
                <button class='btn btn-primary'>$bouton</button>
            </a>";
}


function getnombreEmployer($dept_no)
{
    $N=getemployerOfDepartment($dept_no);
    $q=mysqli_num_rows($N);
    return $q;
}

function getEmplois() {
    $bdd = connexion();
    $query = "SELECT title FROM titles GROUP BY title";
    $result = mysqli_query($bdd, $query);
    return $result;
}

function getHommeEmployes($emploi) {
    $bdd = connexion();
    $query = "SELECT count(titles.emp_no) AS hommes 
                FROM titles JOIN employees ON titles.emp_no = employees.emp_no 
                WHERE gender = 'M' 
                AND title = '$emploi' 
                AND titles.to_date = '9999-01-01' 
                GROUP BY title";
    $result = mysqli_query($bdd, $query);
    return $result;
}

function getFemmeEmployes($emploi) {
    $bdd = connexion();
    $query = "SELECT count(titles.emp_no) AS femmes 
                FROM titles JOIN employees ON titles.emp_no = employees.emp_no 
                WHERE gender = 'F' 
                AND title = '$emploi' 
                AND titles.to_date = '9999-01-01' 
                GROUP BY title";
    $result = mysqli_query($bdd, $query);
    return $result;
}

function getSalaireEmploi($emploi) {
    $bdd = connexion();
    $query = "SELECT AVG(salary) AS moyenne 
                FROM titles JOIN salaries ON titles.emp_no = salaries.emp_no 
                WHERE title = '$emploi' 
                AND titles.to_date = '9999-01-01' 
                GROUP BY title";
    $result = mysqli_query($bdd, $query);
    return $result;
}

function getemployslepluslongtemps($emp_no)
{
    $bdd = connexion();
    $query = "
        SELECT t.emp_no, e.first_name, e.last_name, t.title,
               TIMESTAMPDIFF(YEAR, t.from_date, t.to_date) AS duree
        FROM titles t
        JOIN employees e ON t.emp_no = e.emp_no
        WHERE t.emp_no = '$emp_no'
        ORDER BY TIMESTAMPDIFF(YEAR, t.from_date, t.to_date) DESC
        LIMIT 1
    ";
    return mysqli_query($bdd, $query);
}


function getSexeOfEmployer($emp_no)
{
    $bdd = connexion();
    $query = "SELECT gender FROM employees WHERE emp_no = '$emp_no'";
    $result = mysqli_query($bdd, $query);
   return mysqli_fetch_assoc($result);
}



function verifiedepartementEmploye($emp_no, $dept_no, $date_debut) {
    $bdd = connexion();
    $query = "SELECT * FROM dept_emp 
                WHERE emp_no = '$emp_no' 
                AND dept_no = '$dept_no' 
                AND from_date <= '$date_debut' 
                AND to_date = '9999-01-01'";
    $result = mysqli_query($bdd, $query);
    return mysqli_num_rows($result) > 0;
}


function changerDepartementEmploye($emp_no, $new_dept_no, $date_debut) {
    $bdd = connexion();

    // Clôture l'ancien département
    $query1 = "UPDATE dept_emp 
               SET to_date = DATE_SUB('$date_debut', INTERVAL 1 DAY) 
               WHERE emp_no = '$emp_no' AND to_date = '9999-01-01'";
    mysqli_query($bdd, $query1);

    // Supprime toute ancienne affectation dans le même département (pour éviter le doublon)
    $query_del = "DELETE FROM dept_emp WHERE emp_no = '$emp_no' AND dept_no = '$new_dept_no'";
    mysqli_query($bdd, $query_del);

    // Ajoute la nouvelle affectation
    $query2 = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) 
               VALUES ('$emp_no', '$new_dept_no', '$date_debut', '9999-01-01')";
    return mysqli_query($bdd, $query2);
}




?>