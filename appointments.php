<?php 
include('includes/header.php'); 
include('config.php');
?>

<main>
<section class="appointments">
  <img src="assets/images/AAAAAA.jpg" alt="Appointments">
  <br>
  <h1>Book an Appointment</h1>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $service = mysqli_real_escape_string($conn, $_POST['service']);
      $date = mysqli_real_escape_string($conn, $_POST['date']);
      $time = mysqli_real_escape_string($conn, $_POST['time']);
    
      $sql = "INSERT INTO Appointments (name, email, service, appointment_date, appointment_time) 
              VALUES ('$name', '$email', '$service', '$date', '$time')";

      if (mysqli_query($conn, $sql)) {
          echo "<p style='color: green;'>Appointment booked successfully!</p>";
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
    <label>Service</label>
    <select name="service" required>
      <option value="">Select a Service</option>
      <option value="General Checkup">General Checkup</option>
      <option value="Pediatrics">Pediatrics</option>
      <option value="Dental Care">Dental Care</option>
      <option value="Laboratory Tests">Laboratory Tests</option>
    </select>
    <label>Date</label>
    <input type="date" name="date" required>
    <label>Time</label>
    <input type="time" name="time" required>
    <button type="submit">Book Appointment</button>
  </form>
</section>
</main>

<?php include('includes/footer.php'); ?>
