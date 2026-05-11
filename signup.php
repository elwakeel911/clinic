<?php
session_start();
include('config.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($email) || empty($password)) {
        $error = "Please fill in all fields!";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<?php include('includes/header.php'); ?>

<main>
  <section class="login">
    <h1>Create Account</h1>
    <div class="form-wrapper">

      <?php if($error): ?>
        <div class="alert error"><?php echo $error; ?></div>
      <?php endif; ?>

      <form class="sign-up-form" method="POST" action="">
        <label>Name</label>
        <input type="text" name="name" placeholder="Your Name" required>
        <label>Email</label>
        <input type="email" name="email" placeholder="Your Email" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Your Password" required>
        <button type="submit">Sign Up</button>
        <p>Already have an account? <a href="login.php" class="signup">Login</a></p>
      </form>
    </div>
  </section>
</main>

<?php include('includes/footer.php'); ?>
