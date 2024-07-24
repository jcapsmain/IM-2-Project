<?php
    ob_start();
    session_start(); // Ensure session is started

    require 'config.php';
    include 'navbar.php';

    $id = $_SESSION["client_ID"];
    $result = mysqli_query($conn, "SELECT * FROM client WHERE client_id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST["edit-submit"])) {
        $editFirstname = $_POST["fname"];
        $editLastname = $_POST["lname"];
        $editContact = $_POST["contact"];
        $editBirthdate = $_POST["date"];
        $editRegion = $_POST["region"];
        
        // Handle profile picture upload
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['profilePicture']['name']);
            
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadFile)) {
                // Update database with new profile picture path
                $profilePicture = $uploadFile;
                $query = "UPDATE client SET fname = '$editFirstname', lname = '$editLastname', phoneNumber = '$editContact', dateofbirth = '$editBirthdate', region = '$editRegion', profilePicture = '$profilePicture' WHERE client_ID = '$id'";
            } else {
                echo "<script>alert('Failed to upload profile picture');</script>";
            }
        } else {
            // Update without changing the profile picture
            $query = "UPDATE client SET fname = '$editFirstname', lname = '$editLastname', phoneNumber = '$editContact', dateofbirth = '$editBirthdate', region = '$editRegion' WHERE client_ID = '$id'";
        }
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Edit Successful');</script>";
            header("location: profile.php");
        } else {
            echo "<script>alert('Edit Not Successful');</script>";
        }
    }

    if (isset($_POST["edit-bio"])) {
        $editBio = $_POST["bio"];
        
        $query = "UPDATE client SET bio = '$editBio' WHERE client_id = '$id'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Edit Successful');</script>";
            header("location: profile.php");
        } else {
            echo "<script>alert('Edit Not Successful');</script>";
        }
    }

    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body class="pt-5 mt-4">

    <div class="container mt-4">
        <div class="profile-header p-4 rounded d-flex align-items-center mb-4">
            <img src="<?php echo $row["profilePicture"] ? $row["profilePicture"] : 'genaldgwaps.jpg'; ?>" alt="Profile Icon" class="profile-icon mr-4" width="150" height="150">
            <div class="profile-info">
                <h1 id="profile-name"><?php echo $row["username"]; ?></h1>
                <p id="profile-firstname">First Name: <?php echo $row["fname"]; ?></p>
                <p id="profile-lastname">Last Name: <?php echo $row["lname"]; ?></p>  
                <p id="profile-contact">Contact: <?php echo $row["phoneNumber"]; ?></p>
                <p id="date-of-birth">Birthdate: <?php echo $row["dateofbirth"]; ?></p>
                <p id="profile-email">Email: <?php echo $row["email"]; ?></p>
                <p id="profile-region">Region: <?php echo $row["region"]; ?></p>
                
                <button class="btn edit-profile-btn" onclick="openEditProfileOverlay()">Edit Profile</button>
                <button class="btn upload-profile-btn">Upload Profile</button>
            </div>
        </div>
        <div class="bio p-4 rounded mb-4">
            <h2>About Me</h2>
            <p id="bio-text"><?php echo $row["bio"]; ?></p>
            <button class="btn edit-bio-btn" onclick="openEditBioOverlay()">Edit Bio</button>
        </div>
    </div>

    <!-- Overlay for Edit Profile -->
    <div id="edit-profile-overlay" class="overlay">
        <div class="overlay-content p-4 rounded text-center">
            <span class="close-btn" onclick="closeEditProfileOverlay()">&times;</span>
            <h2>Edit Profile</h2>
            <form id="edit-form" class="edit-form" method="post" autocomplete="off" name="edit-register" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="edit-name">First Name:</label>
                    <input type="text" id="edit-fname" name="fname" class="form-control" value="<?php echo $row["fname"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-name">Last Name:</label>
                    <input type="text" id="edit-lname" name="lname" class="form-control" value="<?php echo $row["lname"];?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-contact">Contact Number:</label>
                    <input type="number" id="edit-phoneNumber" name="contact" class="form-control" value="<?php echo $row["phoneNumber"];?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-date">Birthdate:</label>
                    <input type="date" id="edit-birthday" name="date" class="form-control" value="<?php echo $row["dateofbirth"];?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-region">Region:</label>
                    <select id="edit-region" name="region" class="form-control" required>
                        <option value="North America">North America</option>
                        <option value="South America">South America</option>
                        <option value="Europe">Europe</option>
                        <option value="Asia">Asia</option>
                        <option value="Oceania">Oceania</option>
                        <option value="Africa">Africa</option>
                        <option value="Australia">Australia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="profilePicture">Profile Picture:</label>
                    <input type="file" id="profilePicture" name="profilePicture" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn save-profile-btn" name="edit-submit">Save Profile</button>
            </form>
        </div>
    </div>

    <!-- Overlay for Edit Bio -->
    <div id="edit-bio-overlay" class="overlay">
        <div class="overlay-content p-4 rounded text-center">
            <span class="close-btn" onclick="closeEditBioOverlay()">&times;</span>
            <h2>Edit Bio</h2>
            <form id="edit-bio-form" class="edit-form" method="post" autocomplete="off" name="edit-bio">
                <div class="form-group">
                    <label for="edit-bio-text">Bio:</label>
                    <textarea id="edit-bio-text" name="bio" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn save-bio-btn" name="edit-bio">Save Bio</button>
            </form>
        </div>
    </div>

    <script>
        function openEditProfileOverlay() {
            document.getElementById('edit-profile-overlay').classList.add('active');
        }

        function closeEditProfileOverlay() {
            document.getElementById('edit-profile-overlay').classList.remove('active');
        }

        function openEditBioOverlay() {
            document.getElementById('edit-bio-text').value = document.getElementById('bio-text').textContent.trim();
            document.getElementById('edit-bio-overlay').classList.add('active');
        }

        function closeEditBioOverlay() {
            document.getElementById('edit-bio-overlay').classList.remove('active');
        }
    </script>
</body>
</html>
