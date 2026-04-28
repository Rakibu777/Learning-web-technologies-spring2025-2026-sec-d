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

if (isset($_SESSION['users'])) {
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            header("Location: ../view/create.php?error=email_exists");
            exit;
        }
    }
}


if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}


$newId = count($_SESSION['users']) > 0 ? max(array_column($_SESSION['users'], 'id')) + 1 : 1;

// Or even simpler with just count:
// $newId = count($_SESSION['users']) + 1;

// Create new user (add htmlspecialchars for XSS protection)
$newUser = [
    'id' => $newId,
    'username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
    'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8')
];

$_SESSION['users'][] = $newUser;


header("Location: ../view/user_list.php?success=user_created");
exit;
?>