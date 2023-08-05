<?php
// Include the database connection credentials
require("sql.php");

$msg = '';
$msgclass = '';

if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $Birthday = htmlspecialchars($_POST['Birthday']);
    $phone = htmlspecialchars($_POST['phone']);
    $password = htmlspecialchars($_POST['password']);
    $message = htmlspecialchars($_POST['message']);

    // Check if name is empty
    if (empty($username) || !filter_var($username, FILTER_SANITIZE_STRING)) {
        $msg = 'Please enter your username';
        $msgclass = 'alert-danger';
    }
    // Check if email is empty or invalid
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please enter a valid email address';
        $msgclass = 'alert-danger';
    }
    // Check if birthday is empty or invalid
    if (empty($Birthday) ) {
        $msg = 'Please enter a valid Birthday';
        $msgclass = 'alert-danger';
    }
    // Check if phone number is empty or invalid
    if (!empty($phone) && !preg_match('/^[0-9]{10}$/', $phone)) {
        $msg = 'Please enter a valid 10-digit phone number';
        $msgclass = 'alert-danger';
    }
    // Check if password is empty or invalid
    if (empty($password) ) {
        $msg = 'Please enter a valid password';
        $msgclass = 'alert-danger';
    }
    // Check if message is empty
    if (empty($message)) {
        $msg = 'Please enter a message';
        $msgclass = 'alert-danger';
    }
    // All fields are valid, insert into database
    if(empty($msg)){
        // $encrypted_password = hash('md5', $password);
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `123` (`name`, `email`, `birthday`, `phone`, `password`) VALUES ('$username', '$email', $Birthday, '$phone', '$encrypted_password')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_affected_rows($conn) > 0) {
            $msg = 'User Account Created Successfully';
            $msgclass = 'alert-success';
        } else {
            $msg = 'Error creating user account';
            $msgclass = 'alert-danger';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
    <h1>welcome</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">username:</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" placeholder="Enter your name" required>
            
        </div>
        <br>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Enter your email" required>
        </div>
        <br>
        <div class="form-group">
            <label for="Birthday">Birthday:</label>
            <input type="date" name="Birthday" id="Birthday" class="form-control" value="<?php echo isset($_POST['Birthday']) ? $_POST['Birthday'] : ''; ?>" placeholder="Enter your Birthday date" required>
        </div>
        <br>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" placeholder="Enter your phone number" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" placeholder="Enter your password" required>
        </div>
        <br>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" class="form-control"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
        </div>
        
        <br>
        <div class="form-group">
            
        </div>
        <button type="submit" name="submit">
            Create account
        </button>
        <p class="text-center">Already have an account? Please <a href="sign in.php">Sign In</a></p>
    </form>
    <?php if ($msg != ''): ?>
        <div class="alert <?php echo $msgclass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>
</body>
</html>