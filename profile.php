<?php
    ob_start();

    require 'config.php';
    include 'navbar.php';

    $id = $_SESSION["client_ID"];
    $result = mysqli_query($conn ,"SELECT * FROM client WHERE client_id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST["edit-submit"])) {
        $editFirstname = $_POST["fname"];
        $editLastname = $_POST["lname"];
        $editcontact = $_POST["contact"];
        $editBirthdate = $_POST["date"];
        $editRegion = $_POST["region"];
    
        $query = "UPDATE client SET fname = '$editFirstname', lname = '$editLastname', phoneNumber = '$editcontact', dateofbirth = '$editBirthdate', region = '$editRegion' WHERE client_ID = '$id'";
        mysqli_query($conn,$query);
        if($query) {
            echo"<script> alert('Edit Succesful'); </script>";
            header("location: profile.php");
        }
        else {
            echo"<script> alert('Edit Not Succesful'); </script>";
        }
    }

    if(isset($_POST["edit-bio"])) {
        $editFirstname = $_POST["bio"];
    
        $query = "UPDATE client SET bio = '$editFirstname' WHERE client_id = '$id'";
        mysqli_query($conn,$query);
        if($query) {
            echo"<script> alert('Edit Succesful'); </script>";
            header("location: profile.php");
        }
        else {
            echo"<script> alert('Edit Not Succesful'); </script>";
        }
    }

    if(isset($_POST["upload-submit"])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["profileImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            echo "<script>alert('File is not an image.');</script>";
        }
        
        // Check file size
        if ($_FILES["profileImage"]["size"] > 500000) {
            $uploadOk = 0;
            echo "<script>alert('Sorry, your file is too large.');</script>";
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
                $query = "UPDATE client SET profile_image = '$targetFile' WHERE client_id = '$id'";
                mysqli_query($conn, $query);
                echo "<script>alert('The file ". htmlspecialchars( basename( $_FILES["profileImage"]["name"])). " has been uploaded.');</script>";
                header("location: profile.php");
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
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
            <img src="<?php echo $row['profile_image'] ?: 'genaldgwaps.jpg'; ?>" alt="Profile Icon" class="profile-icon mr-4" width="150" height="150">
            <div class="profile-info">
                <h1 id="profile-name"><?php echo $row["username"]; ?></h1>
                <p id="profile-firstname">First Name: <?php echo $row["fname"]; ?></p>
                <p id="profile-lastname">Last Name: <?php echo $row["lname"]; ?></p>  
                <p id="profile-contact">Contact: <?php echo $row["phoneNumber"]; ?></p>
                <p id="date-of-birth">Birthdate: <?php echo $row["dateofbirth"]; ?></p>
                <p id="profile-email">Email: <?php echo $row["email"]; ?></p>
                <p id="profile-birthday">Region: <?php echo $row["region"]; ?></p>
                
                <button class="btn edit-profile-btn" onclick="openEditProfileOverlay()">Edit Profile</button>
                <button class="btn upload-profile-btn" onclick="openUploadProfileOverlay()">Upload Profile</button>
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
            <form id="edit-form" class="edit-form" method="post" autocomplete="off" name="edit-register">
                <div class="form-group">
                    <label for="edit-name">First Name:</label>
                    <input type="text" id="edit-fname" name="fname" class="form-control" value="<?php echo $row["fname"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-name">Last Name:</label>
                    <input type="text" id="edit-lname" name="lname" class="form-control" value="<?php echo $row["lname"];?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-age">Contact Number:</label>
                    <input type="number" id="edit-phoneNumber" name="contact" class="form-control" value="<?php echo $row["phoneNumber"];?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-gender">Birthdate:</label>
                    <input type="date" id="edit-birthday" name="date" class="form-control" value="<?php echo $row["dateofbirth"];?>" required>
                </div>
                <div class="form-group">
                    <label for="edit-region">Region:</label>
                    <select id="edit-region" name="region" class="form-control" required>
                        <option value="North America" <?php if ($row["region"] == "North America") echo "selected"; ?>>North America</option>
                        <option value="South America" <?php if ($row["region"] == "South America") echo "selected"; ?>>South America</option>
                        <option value="Europe" <?php if ($row["region"] == "Europe") echo "selected"; ?>>Europe</option>
                        <option value="Asia" <?php if ($row["region"] == "Asia") echo "selected"; ?>>Asia</option>
                        <option value="Oceania" <?php if ($row["region"] == "Oceania") echo "selected"; ?>>Oceania</option>
                        <option value="Antartica" <?php if ($row["region"] == "Antartica") echo "selected"; ?>>Antartica</option>
                        <option value="Africa" <?php if ($row["region"] == "Africa") echo "selected"; ?>>Africa</option>
                    </select>
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

    <!-- Overlay for Upload Profile Image -->
    <div id="upload-profile-overlay" class="overlay">
        <div class="overlay-content p-4 rounded text-center">
            <span class="close-btn" onclick="closeUploadProfileOverlay()">&times;</span>
            <h2>Upload Profile Image</h2>
            <form id="upload-profile-form" class="edit-form" method="post" enctype="multipart/form-data" autocomplete="off" name="upload-profile">
                <div class="form-group">
                    <label for="profileImage">Choose Profile Image:</label>
                    <input type="file" id="profileImage" name="profileImage" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn upload-profile-btn" name="upload-submit">Upload Image</button>
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

        function openUploadProfileOverlay() {
            document.getElementById('upload-profile-overlay').classList.add('active');
        }

        function closeUploadProfileOverlay() {
            document.getElementById('upload-profile-overlay').classList.remove('active');
        }
    </script>

</body>
</html>
