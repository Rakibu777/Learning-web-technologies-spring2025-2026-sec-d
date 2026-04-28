<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
    header("Location: ../view/user_list.php?error=invalid_request");
    exit;
}


$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');


if ($username === '' || $email === '') {
    header("Location: ../view/create.php?error=all_fields_required");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/create.php?error=invalid_email");
    exit;
}

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

$newId = 1;

if (!empty($_SESSION['users'])) {
    $ids = array_column($_SESSION['users'], 'id');
    $newId = max($ids) + 1;
}


$newUser = [
    'id' => $newId,
    'username' => $username,
    'email' => $email
];


$_SESSION['users'][] = $newUser;


header("Location: ../view/user_list.php?success=user_inserted");
exit;
?>