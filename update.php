<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
    header("Location: ../view/user_list.php?error=invalid_request");
    exit;
}


$id = $_POST['id'] ?? '';
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');


if ($id === '' || $username === '' || $email === '') {
    header("Location: ../view/user_list.php?error=all_fields_required");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/user_list.php?error=invalid_email");
    exit;
}


if (!isset($_SESSION['users']) || empty($_SESSION['users'])) {
    header("Location: ../view/user_list.php?error=no_users_found");
    exit;
}


$found = false;

foreach ($_SESSION['users'] as $key => $user) {
    if ((string)$user['id'] === (string)$id) {
        $_SESSION['users'][$key]['username'] = $username;
        $_SESSION['users'][$key]['email'] = $email;
        $found = true;
        break;
    }
}


if (!$found) {
    header("Location: ../view/user_list.php?error=user_not_found");
} else {
    header("Location: ../view/user_list.php?success=user_updated");
}
exit;
?>