<?php
session_start();


if (!isset($_SESSION['users'])) {
    echo "No users found!";
    exit;
}


if (!isset($_GET['id'])) {
    echo "No ID provided!";
    exit;
}

$id = $_GET['id'];
$user = null;


foreach ($_SESSION['users'] as $u) {
    if ((string)$u['id'] === (string)$id) {
        $user = $u;
        break;
    }
}


if ($user === null) {
    echo "User not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
</head>
<body>

<h1>Edit User</h1>

<a href="user_list.php">Back</a> |
<a href="../controller/logout.php">Logout</a>

<br><br>

<form method="post" action="../controller/updateCheck.php">

    <!-- Hidden ID -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>"/>

    Username: <br>
    <input type="text" name="username" 
           value="<?= htmlspecialchars($user['username']) ?>"/> 
    <br><br>

    Email: <br>
    <input type="email" name="email" 
           value="<?= htmlspecialchars($user['email']) ?>"/> 
    <br><br>

    <input type="submit" name="submit" value="Update">

</form>

</body>
</html>