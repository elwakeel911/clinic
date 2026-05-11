<?php 
include('includes/header.php'); 
include('config.php');
?>

<main>
<section class="contact">
  <img src="assets/images/contact.jpg" alt="Contact">
  <br>
  <h1>Contact Us</h1>
  
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $subject = mysqli_real_escape_string($conn, $_POST['subject']);
      $message = mysqli_real_escape_string($conn, $_POST['message']);

      
      $sql = "INSERT INTO Contact (name, email, subject, message) 
              VALUES ('$name', '$email', '$subject', '$message')";

      if (mysqli_query($conn, $sql)) {
          echo "<p style='color: green;'>Message sent successfully!</p>";
      } else {
          echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
      }
  }
  ?>

  <form method="POST" action="">
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Subject</label>
    <input type="text" name="subject" required>
    <label>Message</label>
    <textarea name="message" rows="5" required></textarea>
    <button type="submit">Send Message</button> 
  </form>
</section>
</main>

<?php include('includes/footer.php'); ?>
