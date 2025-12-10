<?php
require_once('../mes_classes/Database.php');
require_once('../mes_classes/Admin.php');
session_start();

/* Vérifier si c'est vraiment un admin */
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../views/connexion.php");
    exit;
}

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

    header("Location: ../views/admin/users_list.php?success=1");
    exit;
}

/* ==================== MODIFIER UN UTILISATEUR ==================== */
if ($action === "updateUser") {
    $id    = $_POST['id'];
    $nom   = $_POST['nom'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    $admin->updateUser($conn, $id, $nom, $email, $role);

    header("Location: ../views/admin/users_list.php?updated=1");
    exit;
}

/* ==================== SUPPRIMER UN UTILISATEUR ==================== */
if ($action === "supprimer") {
    $id = $_GET['id'];
    
    $admin->deleteUser($conn, $id);

    header("Location: ../views/admin/users_list.php?deleted=1");
    exit;
}

