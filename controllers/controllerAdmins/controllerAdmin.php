<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
require_once('../mes_classes/Database.php');
require_once('../mes_classes/Admin.php');
require_once('../authers/fonctions.php');
/* Vérifier si c'est vraiment un admin */
verifierAdmin();

$db = new Database();
$conn = $db->getConnection();
$admin = new Admin();

$action = $_POST['action'] ?? $_GET['action'] ?? null;

/* ==================== AJOUTER UN UTILISATEUR ==================== */
if ($action === "addUser") {
    $nom      = $_POST['nom'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $admin->addUser($conn, $nom, $email, $password, $role);

    header("Location: ../views/admin/user_liste.php?success=1");
    exit;
}

/* ==================== MODIFIER UN UTILISATEUR ==================== */
if ($action === "updateUser") {
    $id    = $_POST['id'];
    $nom   = $_POST['nom'];
    $prenom   = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $role  = $_POST['role'];

    $admin->updateUser($conn, $id, $nom,$prenom, $telephone, $role);

    header("Location: ../views/admins/user_liste.php?updated=1");
    exit;
}

/* ==================== SUPPRIMER UN UTILISATEUR ==================== */
if ($action === "supprimer") {
    $id = $_GET['id'];
    
    $admin->deleteUser($conn, $id);

    header("Location: ../views/admin/user_liste.php?deleted=1");
    exit;
}

