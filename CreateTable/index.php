<?php

include 'db_connect.php';

$success_message = "";
$error_message = "";

// Checking if the company table exists or not and then creating it
$table_check_query = "SHOW TABLES LIKE 'company'";
$result = $conn->query($table_check_query);

if ($result->num_rows == 0) {
    // If the table does not exist, I am creating it here.
    $create_table_query = "
    CREATE TABLE company (
        id INT AUTO_INCREMENT PRIMARY KEY,
        company_name VARCHAR(255) NOT NULL,
        company_address TEXT NOT NULL,
        company_website VARCHAR(255) NOT NULL,
        company_email_id VARCHAR(255) NOT NULL,
        company_mobile VARCHAR(15) NOT NULL,
        headquarters_details TEXT NOT NULL,
        company_status ENUM('active', 'inactive') NOT NULL,
        resume_path VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($create_table_query) === TRUE) {
        $success_message = "Table 'company' created successfully.";
    } else {
        $error_message = "Error creating table: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $company_website = $_POST['company_website'];
    $company_email_id = $_POST['company_email_id'];
    $company_mobile = $_POST['company_mobile'];
    $headquarters_details = $_POST['headquarters_details'];
    $company_status = $_POST['company_status'];

    // Handling the resume upload
    $resume = $_FILES['resume'];

    if ($resume['error'] == 0) {
        // Defining the target directory and file path
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($resume["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowing only pdf, doc, and docx formats right now
        $allowed_types = ['pdf', 'docx', 'doc'];
        if (in_array($file_type, $allowed_types)) {
            // Moving the uploaded file to the target directory
            if (move_uploaded_file($resume["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO company (company_name, company_address, company_website, company_email_id, company_mobile, headquarters_details, company_status, resume_path, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt->bind_param("ssssssss", $company_name, $company_address, $company_website, $company_email_id, $company_mobile, $headquarters_details, $company_status, $target_file);

                if ($stmt->execute()) {
                    $success_message = "New record created successfully by Ankit Badhani";
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
            } else {
                $error_message = "Error uploading resume.";
            }
        } else {
            $error_message = "Invalid file format. Only PDF, DOC, and DOCX files are allowed.";
        }
    } else {
        $error_message = "Please upload a valid resume.";
    }

    $stmt->close();
}

// Fetching all uploaded files from the company SQL dtaabase
$fetch_files_query = "SELECT id, company_name, resume_path FROM company";
$files_result = $conn->query($fetch_files_query);

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Company Data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Insert Company Data</h1>
        <?php if ($success_message !== ""): ?>
            <p class="success" id="success-message"><?php echo $success_message; ?></p>
        <?php elseif ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="index.php" method="post" enctype="multipart/form-data">
            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" required>

            <label for="company_address">Company Address:</label>
            <textarea id="company_address" name="company_address" required></textarea>

            <label for="company_website">Company Website:</label>
            <input type="url" id="company_website" name="company_website" required>

            <label for="company_email_id">Company Email ID:</label>
            <input type="email" id="company_email_id" name="company_email_id" required>

            <label for="company_mobile">Company Mobile:</label>
            <input type="text" id="company_mobile" name="company_mobile" required>

            <label for="headquarters_details">Headquarters Details:</label>
            <textarea id="headquarters_details" name="headquarters_details" required></textarea>

            <label for="company_status">Company Status:</label>
            <select id="company_status" name="company_status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <label for="resume">Upload Resume:</label>
            <input type="file" id="resume" name="resume" required>

            <input type="submit" value="Submit">
        </form>
        <h2>Uploaded Files</h2>
        <ul>
            <?php if ($files_result->num_rows > 0): ?>
                <?php while ($file = $files_result->fetch_assoc()): ?>
                    <li>
                        <?php echo htmlspecialchars($file['company_name']); ?> -
                        <a href="<?php echo $file['resume_path']; ?>" download>Download Resume</a>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li>No files uploaded yet.</li>
            <?php endif; ?>
        </ul>
    </div>
    <script>
        window.onload = function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 5000);
            }
        };
    </script>
</body>

</html>