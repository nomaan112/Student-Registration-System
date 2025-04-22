<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, student_id, department, major, email FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registered Students</title>
  <style>
    body {
      font-family: Arial;
      background: #f4f4f4;
      padding: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #007BFF;
      color: white;
    }
    .container {
      max-width: 900px;
      margin: auto;
    }
    .message {
      text-align: center;
      padding: 20px;
      background: #fff3cd;
      border: 1px solid #ffeeba;
      color: #856404;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Registered Students</h2>
    <?php
    if ($result->num_rows > 0) {
      echo "<table><tr><th>Name</th><th>Student ID</th><th>Department</th><th>Major</th><th>Email</th></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['name']}</td><td>{$row['student_id']}</td><td>{$row['department']}</td><td>{$row['major']}</td><td>{$row['email']}</td></tr>";
      }
      echo "</table>";
    } else {
      echo "<div class='message'>No data in the table</div>";
    }
    $conn->close();
    ?>
  </div>
</body>
</html>
