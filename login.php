<?php
session_start();
include('config.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields!";
    } else {
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $error = "Email not found!";
        } else {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name']    = $user['name'];

                header("Location: index.php");
                exit();
            } else {
                $error = "Incorrect password!";
            }
        }
    }
}
?>

<?php include('includes/header.php'); ?>

<main>
  <section class="login">
    <h1>Login</h1>
    <div class="form-wrapper">

      <?php if($error): ?>
        <div class="alert error"><?php echo $error; ?></div>
      <?php endif; ?>

      <form class="sign-in-form" method="POST" action="">
        <label>Email</label>
        <input type="email" name="email" placeholder="Your Email" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Your Password" required>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="signup.php" class="signup">Sign Up</a></p>
      </form>
    </div>
  </section>
</main>

<?php include('includes/footer.php'); ?>