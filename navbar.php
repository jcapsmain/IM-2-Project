<?php 
    
    ob_start();
    if(isset($_POST["user-register"])) {
        $registerUsername = $_POST["user-register-username"];
        $registerFirstname = $_POST["user-register-firstname"];
        $registerLastname = $_POST["user-register-lastname"];
        $registerEmail = $_POST["user-register-email"];
        $registerPassword = $_POST["user-register-password"];
        $registerConfirmpassword = $_POST["user-register-confirm-password"];
        $registerPhonenumber = $_POST["user-register-phonenumber"];
        $registerDate = $_POST["user-register-date"];
        $registerRegion = $_POST["user-register-region"];
        $registerDuplicate = mysqli_query($conn ,"SELECT * FROM client WHERE email = '$registerEmail' OR username = '$registerUsername'");
        $registerEncpassword = md5($registerPassword);
        if(mysqli_num_rows($registerDuplicate) > 0) {
            echo "<script> alert('Email or Username has already taken'); </script>";
        }
        else{
            if($registerPassword == $registerConfirmpassword) {
                $registerQuery = "INSERT INTO client VALUES ('', '$registerUsername', '$registerFirstname', '$registerLastname', '$registerEncpassword', '$registerPhonenumber', '$registerEmail', '$registerDate',  '$registerRegion')";
                mysqli_query($conn,$registerQuery);
                echo"<script> alert('Registration Succesful'); </script>";
            }
            else{
                echo"<script> alert('Password doesn\\'t match'); </script>";
            }
        }
    }

    if(isset($_POST["user-login"])) {
        $loginUserEmail = $_POST["signInUser"];
        $loginPassword = $_POST["signInPassword"];
        $loginEncpassword = md5($loginPassword);
        $loginResult = mysqli_query($conn ,"SELECT * FROM client WHERE email = '$loginUserEmail' OR username = '$loginUserEmail'");
        $loginRow = mysqli_fetch_assoc($loginResult);
        if(mysqli_num_rows($loginResult) > 0) {
            if($loginEncpassword == $loginRow["password"]) {
                $_SESSION["login"] = true;
                $_SESSION["client_ID"] = $loginRow["client_ID"];
                header("location: Homepage.php");
            }
            else {
                echo "<script> alert('Wrong Password'); </script>";
            }
        }
        else {
            echo "<script> alert('User not registered'); </script>";
        }
    }

    if(!empty($_SESSION["client_ID"])){
        $id = $_SESSION["client_ID"];
        $result = mysqli_query($conn, "SELECT * FROM client WHERE client_ID = $id");
        $user = mysqli_fetch_assoc($result);
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var login = document.getElementById('login');
                login.style.display = 'none';
            });
        </script>
        ";
    }
    else {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                    var profileImg = document.getElementById('profile');
                    var logout = document.getElementById('logout');
                    var profile = document.getElementById('text-profile');
                    var inbox = document.getElementById('text-inbox');
                    var schedule = document.getElementById('text-schedule');
                    schedule.style.display = 'none';
                    inbox.style.display = 'none';
                    profileImg.style.display = 'none';
                    logout.style.display = 'none';
                    profile.style.display = 'none';
            });
        </script>
        ";
    }
    ob_end_flush();
?> 

<head>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">     <!-- Press Start 2p Font -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/navbar.css">
</head>


<nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar">
    <div class="container-fluid">
    <a class="navbar-brand" href="Homepage.php">Sensei's Kitchen for Boosting and Development</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
        <div class="navbar-text ml-auto">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="custom-text ml-2 "><?php if(!empty($_SESSION["client_ID"])){echo $user["username"];}else {echo("Guest"); ob_end_flush();} ?></span>
                    <img src="resources/tempPP.jpg" alt="Profile Picture" class="rounded-circle profile-picture" id="profile">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="profile.php" id="text-profile">Profile</a></li>
                    <li><a class="dropdown-item" href="schedule.php" id="text-schedule">
                        <img src="resources/calendar.svg" alt="schedule" id="schedule" style="width: 20px; height: 20px;"> Schedule
                    </a></li>
                    <li><a class="dropdown-item" href="inbox.php" id="text-inbox">
                        <img src="resources/inbox.svg" alt="Inbox" id="inbox"> Inbox
                    </a></li>
                    <li class="text-center"><button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#signInModal" id="login">Login</button></li>
                    <li class="text-center"><button class="btn btn-dark" type="button" onclick="location.href='logout.php';" id="logout"><a>logout</a></button></li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<!-- Sign in Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sign in</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" autocomplete="off" name="user-signin">
                        <div class="form-group">
                            <label for="signInEmail">Email/Username</label>
                            <input class="form-control" placeholder="Enter Email/Username" type="text" id="signInEmail" name="signInUser" required>
                        </div>
                        <div class="form-group">
                            <label for="signInPassword">Password</label>
                            <input class="form-control" placeholder="Enter Password" type="password" id="signInPassword" name="signInPassword" required>
                        </div>
                        <div class="text-end mt-2">
                        <a href="#" class="link-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <button type="submit" class="submit-button" name="user-login">Sign in</button>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="sign-in-text">
                    <span>Don't have an account? <button type="button" data-bs-toggle="modal" data-bs-target="#createAccountModal">Sign up</button></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Account Creation Modal -->
<div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create an account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form method="post" autocomplete="off" name="user-register">
                                <div class="form-group">
                                    <label class="form-label" for="username">Username</label>
                                    <input class="form-control" placeholder="Enter Username" type="text" id="username" name="user-register-username" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="firstName">First Name</label>
                                    <input class="form-control" placeholder="Enter First Name" type="text" id="firstName" name="user-register-firstname" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="lastName">Last Name</label>
                                    <input class="form-control" placeholder="Enter Last Name" type="text" id="lastName" name="user-register-lastname" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control" placeholder="Enter Email" type="email" id="email" name="user-register-email" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control" placeholder="Enter Password" type="password" id="password" name="user-register-password" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                                    <input class="form-control" placeholder="Confirm Password" type="password" id="confirmPassword" name="user-register-confirm-password" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <input class="form-control" placeholder="Enter Phone Number" type="tel" id="phoneNumber" name="user-register-phonenumber" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="dob">Date of Birth</label>
                                    <input class="form-control" placeholder="Enter Date of Birth" type="date" id="dob" name="user-register-date" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="region">Region</label>
                                    <select class="form-select" id="region" name="user-register-region" required>
                                        <option value="North America">North America</option>
                                        <option value="South America">South America</option>
                                        <option value="Europe">Europe</option>
                                        <option value="Asia">Asia</option>
                                        <option value="Oceania">Oceania</option>
                                        <option value="Antartica">Antartica</option>
                                        <option value="Africa">Africa</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4 text-center">
                                        <button type="submit" class="submit-button" name="user-register">Sign up</button>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="sign-in-text">
                            <span>Already have an account? <button type="button" data-bs-toggle="modal" data-bs-target="#signInModal">Sign in</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>