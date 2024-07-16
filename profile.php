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

    ob_end_flush()

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
<body>

    <div class="container mt-4">
        <div class="profile-header p-4 rounded d-flex align-items-center mb-4">
            <img src="genaldgwaps.jpg" alt="Profile Icon" class="profile-icon mr-4" width="150" height="150">
            <div class="profile-info">
                <h1 id="profile-name"><?php echo $row["username"]; ?></h1>
                <p id="profile-firstname">First Name: <?php echo $row["fname"]; ?></p>
                <p id="profile-lastname">Last Name: <?php echo $row["lname"]; ?></p>  
                <p id="profile-contact">Contact: <?php echo $row["phoneNumber"]; ?></p>
                <p id="date-of-birth">Birthdate: <?php echo $row["dateofbirth"]; ?></p>
                <p id="profile-email">Email: <?php echo $row["email"]; ?></p>
                <p id="profile-birthday">Region: <?php echo $row["region"]; ?></p>
                
                <button class="btn edit-profile-btn" onclick="openEditProfileOverlay()">Edit Profile</button>
                <button class="btn upload-profile-btn">Upload Profile</button>
            </div>
        </div>
        <div class="bio p-4 rounded mb-4">
            <h2>About Me</h2>
            <p id="bio-text">(Text here)</p>
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
                    <input type="text" id="edit-fname" name="fname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit-name">Last Name:</label>
                    <input type="text" id="edit-lname" name="lname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit-age">Contact Number:</label>
                    <input type="number" id="edit-phoneNumber" name="contact" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edit-gender">Birthdate:</label>
                    <input type="date" id="edit-birthday" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edit-region">Region:</label>
                    <select id="edit-region" name="region" class="form-control">
                        <option value="North America">North America</option>
                        <option value="South America">South America</option>
                        <option value="Europe">Europe</option>
                        <option value="Asia">Asia</option>
                        <option value="Oceania">Oceania</option>
                        <option value="Africa">Africa</option>
                        <option value="Australia">Australia</option>
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
            <form id="edit-bio-form" class="edit-form" onsubmit="return updateBio()">
                <div class="form-group">
                    <label for="edit-bio-text">Bio:</label>
                    <textarea id="edit-bio-text" name="bio" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn save-bio-btn">Save Bio</button>
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

        function updateProfile(event) {
            event.preventDefault();
            document.getElementById('profile-name').textContent = document.getElementById('edit-name').value;
            document.getElementById('profile-age').textContent = 'Age: ' + document.getElementById('edit-age').value;
            document.getElementById('profile-gender').textContent = 'Gender: ' + document.getElementById('edit-gender').value;
            document.getElementById('profile-birthday').textContent = 'Birthday: ' + document.getElementById('edit-birthday').value;
            document.getElementById('profile-region').textContent = 'Region: ' + document.getElementById('edit-region').value;
            closeEditProfileOverlay();
            return false;
        }

        function openEditBioOverlay() {
            document.getElementById('edit-bio-text').value = document.getElementById('bio-text').textContent.trim();
            document.getElementById('edit-bio-overlay').classList.add('active');
        }

        function closeEditBioOverlay() {
            document.getElementById('edit-bio-overlay').classList.remove('active');
        }

        function updateBio(event) {
            event.preventDefault();
            document.getElementById('bio-text').textContent = document.getElementById('edit-bio-text').value;
            closeEditBioOverlay();
            return false;
        }
    </script>

                                        <!-- <div class="mb-3 text-center">
                                    <div class="image-preview position-relative" style="cursor: pointer;">
                                        <img id="imagePreview" src="https://via.placeholder.com/150" alt="Profile Image" class="rounded-circle" style="width: 150px; height: 150px;">
                                        Hidden file input to trigger file selection 
                                        <input type="file" class="form-control" id="imageUpload" name="imageUpload" accept="image/*" required style="display: none;">
                                        Button styled as a link to appear as text 
                                        <label for="imageUpload" class="btn btn-link position-absolute top-50 start-50 translate-middle p-0">
                                            Upload Profile Image
                                        </label>
                                    </div>
                                </div> -->

</body>
</html>
