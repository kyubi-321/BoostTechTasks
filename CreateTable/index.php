<?php

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $company_address = $_POST['company_address'];
    $company_website = $_POST['company_website'];
    $company_email_id = $_POST['company_email_id'];
    $company_mobile = $_POST['company_mobile'];
    $headquarters_details = $_POST['headquarters_details'];
    $company_status = $_POST['company_status'];

    $stmt = $conn->prepare("INSERT INTO company (company_name, company_address, company_website, company_email_id, company_mobile, headquarters_details, company_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $company_name, $company_address, $company_website, $company_email_id, $company_mobile, $headquarters_details, $company_status);

    if ($stmt->execute()) {
        echo "<p class='success'>New record created successfully by Ankit Badhani</p>";
    } else {
        echo "<p class='error'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

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
        <form action="index.php" method="post">
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

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
