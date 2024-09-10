<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "company";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE company (
    company_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    company_address TEXT NOT NULL,
    company_website VARCHAR(255) NOT NULL,
    company_email_id VARCHAR(255) NOT NULL,
    company_mobile VARCHAR(20) NOT NULL,
    headquarters_details TEXT NOT NULL,
    created_datetime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    company_status ENUM('active', 'inactive') NOT NULL DEFAULT 'active'
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'company' created successfully by Ankit Badhani";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
