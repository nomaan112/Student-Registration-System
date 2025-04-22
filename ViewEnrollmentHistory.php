<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get student ID from query string
$student_id = $_GET['student_id'] ?? '';

// Prepare SQL
$sql = "SELECT course_code, course_title, semester, grade FROM enrollments WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Enrollment History</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f5f5f5;
    }
    .container {
      max-width: 800px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #007BFF;
      color: white;
    }
    .message {
      text-align: center;
      margin-top: 20px;
      color: #999;
      font-size: 18px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Enrollment History for Student ID: <?php echo htmlspecialchars($student_id); ?></h2>
    
    <?php if ($result->num_rows > 0): ?>
      <table>
        <tr>
          <th>Course Code</th>
          <th>Course Title</th>
          <th>Semester</th>
          <th>Grade</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['course_code']) ?></td>
            <td><?= htmlspecialchars($row['course_title']) ?></td>
            <td><?= htmlspecialchars($row['semester']) ?></td>
            <td><?= $row['grade'] ?? 'N/A' ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <div class="message">No data available</div>
    <?php endif; ?>

  </div>
</body>
</html>

<?php
$conn->close();
?>
