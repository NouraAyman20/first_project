<?php
// Include the database connection credentials
require("sql.php");

$msg = '';
$msgclass = '';

if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Check if email is empty or invalid
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please enter a valid email address';
        $msgclass = 'alert-danger';
    }
    // Check if password is empty or invalid
    if (empty($password)) {
        $msg = 'Please enter a valid password';
        $msgclass = 'alert-danger';
    }

    // All fields are valid, check credentials in the database
    if (empty($msg)) {
        $sql = "SELECT * FROM `123` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];
            if (password_verify($password, $stored_password)) {
                header("Location: note.php");
                // $msg = 'Login Successful';
                // $msgclass = 'alert-success';
            } else {
                $msg = 'Invalid password';
                $msgclass = 'alert-danger';
            }
        } else {
            $msg = 'User not found';
            $msgclass = 'alert-danger';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="sign in.css">

</head>
<body>
    <h1>Welcome back!</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Enter your email" required>
        </div>
        <br>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" placeholder="Enter your password" required>
        </div>
        <br>
        <button type="submit" name="submit">
            Sign In
        </button>
        <p class="text-center">Don't have an account? Please <a href="signup.php">Sign Up</a></p>
    </form>
    <?php if ($msg != ''): ?>
        <div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>
</body>
</html>
