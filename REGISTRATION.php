<?php
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $gender = $_POST["gender"];
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];

    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($confirm)) {
        $msg = "All fields required";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email";
    }
    elseif ($password != $confirm) {
        $msg = "Passwords do not match";
    }
    else {
        $msg = "Registration successful";
    }
}
?>

<h2>REGISTRATION</h2>
<form method="post">

Name: <input type="text" name="name"><br><br>

Email: <input type="text" name="email"><br><br>

User Name: <input type="text" name="username"><br><br>

Password: <input type="password" name="password"><br><br>

Confirm Password: <input type="password" name="confirm"><br><br>

Gender:
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<input type="radio" name="gender" value="Other"> Other
<br><br>

Date of Birth:
<input type="text" name="day" size="2"> /
<input type="text" name="month" size="2"> /
<input type="text" name="year" size="4">
<br><br>

<input type="submit" value="Submit">
<input type="reset">

</form>

<p><?php echo $msg; ?></p>