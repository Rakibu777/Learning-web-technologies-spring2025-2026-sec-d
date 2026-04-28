<?php
session_start();


if (!isset($_SESSION['users'])) {
    echo "No users found!";
    exit;
}


if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    
    if ($username == "" || $email == "") {
        echo "All fields are required!";
        exit;
    }

    foreach ($_SESSION['users'] as $key => $u) {
        if ($u['id'] == $id) {
            $_SESSION['users'][$key]['username'] = $username;
            $_SESSION['users'][$key]['email'] = $email;
            break;
        }
    }

    
    header("Location: user_list.php");
    exit;
}



if (!isset($_GET['id'])) {
    echo "No ID provided!";
    exit;
}

$id = $_GET['id'];
$user = null;

foreach ($_SESSION['users'] as $u) {
    if ($u['id'] == $id) {
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
<a href='user_list.php'>Back</a> |
<a href='../controller/logout.php'>Logout</a>
<br><br>

<form method="post">
    Id: <input type="text" name="id" readonly value="<?= $user['id'] ?>"/> <br>
    
    Username:
    <input type="text" name="username" value="<?= $user['username'] ?>"/> <br>
    
    Email:
    <input type="email" name="email" value="<?= $user['email'] ?>"/> <br>
    
    <input type="submit" name="submit" value="Update"/>
</form>

</body>
</html>