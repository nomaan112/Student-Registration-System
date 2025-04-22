//Student Registration System

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .required:after {
            content: " *";
            color: red;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        .success-message {
            color: green;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Registration Form</h1>
        <form id="registrationForm">
            <div class="form-group">
                <label for="name" class="required">Full Name</label>
                <input type="text" id="name" name="name" required>
                <div id="nameError" class="error"></div>
            </div>
            
            <div class="form-group">
                <label for="email" class="required">Email</label>
                <input type="email" id="email" name="email" required>
                <div id="emailError" class="error"></div>
            </div>
            
            <div class="form-group">
                <label for="studentId">Student ID</label>
                <input type="text" id="studentId" name="studentId">
            </div>
            
            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" name="department">
                    <option value="">Select Department</option>
                    <option value="Arts">Arts</option>
                    <option value="Science">Science</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Business">Business</option>
                    <option value="Medicine">Medicine</option>
                    <option value="Law">Law</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="major">Major</label>
                <input type="text" id="major" name="major">
            </div>
            
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob">
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3"></textarea>
            </div>
            
            <button type="submit">Register</button>
        </form>
        <div id="successMessage" class="success-message"></div>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            
            // Get form values
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const studentId = document.getElementById('studentId').value.trim();
            const department = document.getElementById('department').value;
            const major = document.getElementById('major').value.trim();
            const dob = document.getElementById('dob').value;
            const address = document.getElementById('address').value.trim();
            
            // Validate required fields
            let isValid = true;
            
            if (!name) {
                document.getElementById('nameError').textContent = 'Name is required';
                isValid = false;
            }
            
            if (!email) {
                document.getElementById('emailError').textContent = 'Email is required';
                isValid = false;
            } else if (!validateEmail(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address';
                isValid = false;
            }
            
            if (!isValid) {
                return;
            }
            
            // Prepare data for submission
            const formData = {
                name,
                email,
                studentId,
                department,
                major,
                dob,
                address
            };
            
            // In a real application, you would send this data to a server
            // For this example, we'll simulate it with a timeout
            document.getElementById('successMessage').textContent = 'Submitting data...';
            
            setTimeout(() => {
                // Here you would typically make an AJAX call to your backend
                // For example:
                // fetch('/api/register', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //     },
                //     body: JSON.stringify(formData),
                // })
                // .then(response => response.json())
                // .then(data => {
                //     console.log('Success:', data);
                //     document.getElementById('successMessage').textContent = 'Registration successful!';
                //     document.getElementById('registrationForm').reset();
                // })
                // .catch((error) => {
                //     console.error('Error:', error);
                //     document.getElementById('successMessage').textContent = 'Registration failed. Please try again.';
                // });
                
                // Simulated success response
                console.log('Form data:', formData);
                document.getElementById('successMessage').textContent = 'Registration successful!';
                document.getElementById('registrationForm').reset();
                
                // In a real application, the data would now be in your database
            }, 1500);
        });
        
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    </script>
</body>
</html>

///PHP backend to handle the form submission and store data in a MySQL database:

<?php
// database.php - Database connection
$host = 'localhost';
$dbname = 'university';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// register.php - Handle form submission
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Validate required fields
    if (empty($input['name']) || empty($input['email'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Name and email are required']);
        exit;
    }
    
    // Validate email format
    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid email format']);
        exit;
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO students (name, email, student_id, department, major, dob, address) 
                              VALUES (:name, :email, :student_id, :department, :major, :dob, :address)");
        
        $stmt->execute([
            ':name' => $input['name'],
            ':email' => $input['email'],
            ':student_id' => $input['studentId'] ?? null,
            ':department' => $input['department'] ?? null,
            ':major' => $input['major'] ?? null,
            ':dob' => $input['dob'] ?? null,
            ':address' => $input['address'] ?? null
        ]);
        
        echo json_encode(['success' => 'Student registered successfully']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}


//Database Schema (MySQL)

CREATE DATABASE university;

USE university;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    student_id VARCHAR(20),
    department VARCHAR(50),
    major VARCHAR(50),
    dob DATE,
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_email (email)
);
