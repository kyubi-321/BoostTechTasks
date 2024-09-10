<?php
$name = "Ankit Badhani";
$bio = "I am a software developer with expertise in web development. I enjoy building scalable web applications using Next.js, React, and have discussions abot DevOps tools with devops team in backend in previous internship.I am always willing to open to good opprotunities for me because my aim is to always grow in life";
$skills = [
    "Frontend Development" => "Exeperienced in React, Next.js, and modern JavaScript frameworks.",
    "Backend & DevOps" => "Some experience in Node.js, Docker.",
    "Problem Solver" => "Enjoy working on complex challenges in both frontend and backend development."
];
$profileImage = "Ankit_Photo_Latest.jpg"; 
$email = "ankitbadhani102@gmail.com";

$experience = [
    "title" => "Software Development Engineer Intern",
    "company" => "Yatri Cabs (Unit of AARSAAR Technologies)",
    "location" => "India",
    "description" => "RIDE EVEE(another name : (Yatri Cabs)) is an online app-based Car Rental Service provider that offers Intercity & Intra City Cab Services. The app allows booking One-way cabs, Local full-day cabs, Outstation cabs, Airport transfer cabs, and more, while also enabling users to select electric vehicles.",
    "responsibilities" => "I am working as an SDE (Front-End Developer) with engineers from different colleges, building India's first Electric Vehicle rental service app.",
    "website" => "https://www.yatricabs.com/",
    "verification_contact" => "Rajkumar Tiwari - rajkumar.tiwari@yatricabs.com",
    "reference" => "Read more at: https://yourstory.com/companies/ride-evee"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me - <?php echo $name; ?></title>
    <link rel="stylesheet" href="index.css"> 
</head>
<body>

    <div class="container">
        <!-- About Section -->
        <div class="about-section">
            <img src="<?php echo $profileImage; ?>" alt="<?php echo $name; ?>'s Profile Picture" class="profile-pic">
            <h1>Hello, I'm <?php echo $name; ?></h1>
            <p>
                <?php echo $bio; ?>
            </p>

            <a href="mailto:<?php echo $email; ?>" class="contact-btn">Get in Touch</a>
        </div>

        <!-- Skills Section -->
        <div class="skills">
            <?php foreach ($skills as $skill => $description): ?>
                <div>
                    <h3><?php echo $skill; ?></h3>
                    <p><?php echo $description; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Work Experience Section -->
        <div class="work-experience-section">
            <h2>Work Experience</h2>
            <h3><?php echo $experience['title']; ?></h3>
            <p><strong>Company:</strong> <?php echo $experience['company']; ?></p>
            <p><strong>Location:</strong> <?php echo $experience['location']; ?></p>
            <p><strong>About the Company:</strong> <?php echo $experience['description']; ?></p>
            <p><strong>Responsibilities:</strong> <?php echo $experience['responsibilities']; ?></p>
            <p><strong>Website:</strong> <a href="<?php echo $experience['website']; ?>" target="_blank"><?php echo $experience['website']; ?></a></p>
            <p><strong>Contact for Verification:</strong> <?php echo $experience['verification_contact']; ?></p>
            <p><?php echo $experience['reference']; ?></p>
        </div>
    </div>

</body>
</html>
