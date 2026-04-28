<?php
session_start();

if (!isset($_GET['id'])) {
    header("Location: ../view/user_list.php?error=missing_id");
    exit;
}

$id = $_GET['id'];


if (!isset($_SESSION['users']) || empty($_SESSION['users'])) {
    header("Location: ../view/user_list.php?error=no_users_found");
    exit;
}


$found = false;

foreach ($_SESSION['users'] as $key => $user) {
    if ((string)$user['id'] === (string)$id) {
        unset($_SESSION['users'][$key]);
        $found = true;
        break;
    }
}


$_SESSION['users'] = array_values($_SESSION['users']);

if ($found) {
    header("Location: ../view/user_list.php?success=user_deleted");
} else {
    header("Location: ../view/user_list.php?error=user_not_found");
}

exit;
?>