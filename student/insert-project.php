<?php
session_start();
$connection = mysqli_connect("localhost", "root", '', 'mysqli_fyp');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $_name = $_POST['name'];
    $_rollno = $_POST['rollno'];
    $_title = $_POST['title'];
    $_supervisor = $_POST['supervisor'];
    // Directory where the file will be saved
    $uploadDir = 'uploads/';

    // Generate a random name
    $randomName = bin2hex(random_bytes(16)); // Generates a 32-character random string

    // Get the file extension
    $fileExtension = pathinfo($_FILES['uploaded_file']['name'], PATHINFO_EXTENSION);

    // Combine random name with the file extension
    $newFileName = $randomName . '.' . $fileExtension;

    // Full path to save the file
    $uploadFile = $uploadDir . $newFileName;

    // Check if the upload directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // Move the uploaded file to the new location with the new name
    if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadFile)) {
        echo "File uploaded successfully with the new name: " . $newFileName;

        // Insert project data into database
        $query = "INSERT INTO project (name, rollno, title, supervisor, file) VALUES ('$_name', '$_rollno', '$_title', '$_supervisor', '$newFileName')";
        if (mysqli_query($connection, $query)) {
            $_SESSION['submit'] = "Project submitted successfully";
            header('Location: project-sub.php');
            exit();
        } else {
            $_SESSION['message2'] = "Project not submitted: " . mysqli_error($connection);
        }
    } else {
        $_SESSION['message2'] = "Failed to upload the file.";
    }
} else {
    $_SESSION['message2'] = "Invalid request.";
}

mysqli_close($connection);
?>