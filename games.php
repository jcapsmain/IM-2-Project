<?php

    ob_start();
    require 'config.php';
    include 'navbar.php';
    include 'messagepopup.php';

    $games = htmlspecialchars($_GET['game']);
    $gamequery = mysqli_query($conn ,"SELECT * FROM game WHERE gameDescription = '$games'");
    $gamerow = mysqli_fetch_assoc($gamequery);
    $imageSrc = $gamerow['image_path'];
    $gameDescription = $gamerow['gameDescription'];

    if(isset($_POST["coach-register"])) {
        $coachIGN = $_POST["coachIGN"];
        $coachGame = $_POST["coachGame"];
        $coachGameRank = $_POST["coachGameRank"];
        $coachUid = $_POST["coachUid"];
        $coachClientid = $_SESSION["client_ID"];
        $gameUidScreenshot = "";
        $gameRankScreenshot = "";
        $uploadDir = "clientBooster/" . $coachIGN . "/";
        $coachgamePrice = $_POST["price"];
        $coachResult = mysqli_query($conn ,"SELECT * FROM client_booster WHERE client_id = '$coachClientid' AND game = '$coachGame'");
        $coachRow = mysqli_fetch_assoc($coachResult);
        $maxFileSize = 20 * 1024 * 1024;
    
        if($coachGame == $coachRow["game"]) {
            echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#messageModal").modal("show");
                });
                </script>';
                unset($_POST["coachGame"]);
                unset($coachRow);
        }
        else {

            function is_image_file($filename) {
                $image_info = @getimagesize($filename);
                return $image_info !== false && strpos($image_info['mime'], 'image/') === 0;
            }

            if (!empty($gameUidScreenshot) && is_image_file($_FILES['gameUidScreenshots']['tmp_name']) && 
                !empty($gameUidScreenshot) && is_image_file($_FILES['gameUidScreenshots']['tmp_name']) && 
                ($_FILES['gameUidScreenshots']['size'] > $maxFileSize && $_FILES['gameRankScreenshots']['size'] > $maxFileSize)) {
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $gameUidScreenshot = $_FILES['gameUidScreenshots']['name'];
                $gameRankScreenshot = $_FILES['gameRankScreenshots']['name'];
                move_uploaded_file($_FILES['gameUidScreenshots']['tmp_name'], $uploadDir . $gameUidScreenshot);
                move_uploaded_file($_FILES['gameRankScreenshots']['tmp_name'], $uploadDir . $gameRankScreenshot);
                $query = "INSERT INTO client_booster VALUES ('', '$coachIGN', '$coachClientid', '$coachUid', '$coachGame', '$coachGameRank', '$gameUidScreenshot', 
                '$gameRankScreenshot', '$coachgamePrice')";
                mysqli_query($conn,$query);
                header("location: Redirect.php");
            }
            else {
                echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#messageModal").modal("show");
                    });
                    </script>';
                    unset($_POST["coachGame"]);
                    unset($coachRow);
            }
        }
    }

    if(!empty($_SESSION["client_ID"])){
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var createAccount = document.getElementById('start_now');
                    createAccount.style.display = 'none';
                });
            </script>
        ";
    } else  {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var coachRegister = document.getElementById('register_as_coach');
                    coachRegister.style.display = 'none';
                    var hirebtns = document.getElementsByClassName('btn btn-primary');
                    for (var i = 0; i < hirebtns.length; i++) {
                        hirebtns[i].style.display = 'none';
                    }
                });
            </script>
        ";
    }

    if(isset($_POST["session-register"])) {
        $sessionGameRank = $_POST["gameRank"];
        $sessionStartDate = $_POST["startDate"];
        $sessionEndDate = $_POST["endDate"];
        $sessionStartTime = $_POST["startTime"];
        $sessionEndTime = $_POST["endTime"];
        $sessiontrainerID = $_SESSION["client_ID"];
        $sessionRegisterDuplicate = mysqli_query($conn ,"SELECT * FROM boosting_session bs JOIN client_booster cb ON bs.trainerID = cb.client_booster_id JOIN client c ON cb.client_booster_id = c.client_ID WHERE bs.trainerID = '$sessiontrainerID' OR cb.client_id = '$sessiontrainerID'");
        if(mysqli_num_rows($sessionRegisterDuplicate) > 0) {
            echo "<script> alert('You already have a coach'); </script>";
        }
        else{
            
            $sessionRegisterQuery = "INSERT INTO client VALUES ('', '$registerUsername', '$registerFirstname', '$registerLastname', '$registerEncpassword', '$registerPhonenumber', '$registerEmail', '$registerDate',  '$registerRegion')";
            mysqli_query($conn,$registerQuery);
            echo"<script> alert('Registration Succesful'); </script>";
        }
    }
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKBD | <?php echo"$games";?></title>
    <!-- Bootstrap CSS link -->
    <!-- Custom CSS link -->
    <link rel="stylesheet" href="css/games.css">

</head>
<body>

<!-- Main Carousel -->
    <div class="container-fluid p-0">
        <div id="HeadCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-content text-start transparent-background">
                <div class="carousel-caption">
                    <h1>These are our available games for coaching</h1>
                    <p>If you wish to become a coach or become a trainee
                    to cultivate your skills<br></br> in the game of your choice 
                    then feel free to join our program here.</p>
                </div>
                <div class="carousel-buttons">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createAccountModal" id="start_now">Start Now</button>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#CoachRegisterModal" id="register_as_coach">Register as Coach</button>
                </div>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php echo '<img src="' . $imageSrc . '" class="d-block w-100" alt="' . htmlspecialchars($gameDescription) . '">'; ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Game Sections -->
    <div class="container-fluid full-height" id="containfluid">
        <div class="row">


            <?php
                if(!empty($_SESSION["client_ID"])){
                    $sessionID = $_SESSION["client_ID"];
                    $clientRegionQuery = "SELECT region FROM client WHERE client_ID = '$sessionID'";
                    $regionResult = $conn->query($clientRegionQuery);
                    $clientRegion = $regionResult->fetch_assoc()["region"];

                    $gamesQuerry = "SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID JOIN game g ON cb.game = g.gameDescription JOIN 
                    game_info gi ON g.game_id = gi.gameID AND cb.gamerank = gi.gameRank WHERE game = '$games' AND c.client_ID != '$sessionID' GROUP BY cb.client_booster_id 
                    ORDER BY gi.gameinfoID DESC, cb.client_booster_id ASC, c.region = '$clientRegion' DESC";

                } else {

                    $gamesQuerry = "SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID JOIN game_info gi ON cb.gamerank = gi.gameRank WHERE game = 
                    '$games' GROUP BY cb.client_booster_id ORDER BY gi.gameinfoID DESC, cb.client_booster_id ASC";

                }
                $result = $conn->query($gamesQuerry);

                if ($result->num_rows > 0) {
                    // Loop through each row of data
                    while($row = $result->fetch_assoc()) {
                        // Output HTML for each coach
                ?>
                    <div class="col-md-4">
                        <div class="game-box">
                            <h2><?php echo $row["IGN"]; ?></h2>
                            <div class="coach-details position-relative">
                                <p><strong>Game Rank:</strong> <?php echo $row["gamerank"]; ?></p>
                                <!-- Logo (Absolute Positioning) -->
                                <div class="position-absolute top-0 end-0">
                                <img src="css/images/peakpx.jpg" alt="Logo" style="height: 150px;">
                                </div>
                                <p><strong>Rating:</strong> 4.5 / 5</p>
                                <p><strong>Region:</strong> <?php echo $row["region"]; ?></p>
                                <p><strong>Email:</strong> <?php echo $row["email"]; ?></p>
                            </div>
                            <!-- Hire Button -->
                            <div class="mt-3 d-flex justify-content-end">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#StudentRegisterModal">Hire</button>
                            </div>
                        </div>
                    </div>  
                <?php
                    }
                } 
                else {
                    echo "0 results";
                }
                    ?>
        </div>
    </div>
        
        <!-- Modals -->
        <!-- Coach Registration Modal -->
        <div class="modal fade" id="CoachRegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Register as Coach</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form method="post" autocomplete="off" name="coach-signup" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">IGN</label>
                                    <input class="form-control" placeholder="Enter In Game Name" type="text" class="form-control" id="name" name="coachIGN" required>
                                </div>
                                <div class="mb-3">
                                    <label for="UID" class="form-label">UID</label>
                                    <input class="form-control" placeholder="Enter User ID" type="text" class="form-control" id="uid" name="coachUid" required>
                                </div>
                                <div class="mb-3">
                                    <label for="game" class="form-label">Game</label>
                                    <select class="form-select" id="game" name="coachGame" onchange="populateGameRanks()" required>
                                        <?php 
                                            $gamequery = mysqli_query($conn ,"SELECT * FROM game WHERE gameDescription = '$games'");
                                            while ($gamerow = mysqli_fetch_assoc($gamequery)) {
                                                $gameDesc = htmlspecialchars($gamerow['gameDescription']);
                                                echo '<option value="' . $gameDesc . '">' . $gameDesc . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="gameRank" class="form-label">Game Rank</label>
                                    <select class="form-select" id="gameRank" name="coachGameRank" required>
                                        <?php 
                                            $gamerankquery = mysqli_query($conn ,"SELECT * FROM game g JOIN game_info gi ON g.game_id = gi.gameID WHERE g.gameDescription = '$games' GROUP BY gi.gameRank ORDER BY gi.gameinfoID ASC");
                                            if ($gamerankquery) {
                                                $options = '';
                                                while ($gameinfoRow = mysqli_fetch_assoc($gamerankquery)) {
                                                    $gameinfoRank = $gameinfoRow['gameRank'];
                                                    $options .= '<option value="' . htmlspecialchars($gameinfoRank) . '">' . htmlspecialchars($gameinfoRank) . '</option>';
                                                }
                                                echo $options; // Output all options for dropdown
                                            } else {
                                                echo "Error: " . mysqli_error($conn); // Display error message if query fails
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="gameUidScreenshots" class="form-label">Attach Screenshots of your Game UID</label>
                                    <input type="file" class="form-control" id="gameUidScreenshots" accept="image/*" name="gameUidScreenshots" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gameRankScreenshots" class="form-label">Attach Screenshots of your Game Rank</label>
                                    <input type="file" class="form-control" id="gameRankScreenshots" accept="image/*" name="gameRankScreenshots" required>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Hourly Coach Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" placeholder="Enter Price" type="number" id="price" name="price" value="10.00" min="0" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark" name='coach-register'>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Registration Modal -->
        <div class="modal fade" id="StudentRegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Register as Student</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form method="post" autocomplete="off" name="session-register">
                                <div class="form-group">
                                    <label class="form-label" for="gameRank">Game Rank</label>
                                    <input class="form-control" placeholder="Enter Game Rank" type="text" id="gameRank" name="gameRank" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="startdate">Enter Start Date Session</label>
                                    <input class="form-control" placeholder="Enter Start Date" type="date" id="startdate" name="startDate" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="enddate">Enter End Date Session</label>
                                    <input class="form-control" placeholder="Enter End Date" type="date" id="enddate" name="endDate" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="starttime">Enter Start Time Session (HH-MM-AM/PM)</label>
                                    <input class="form-control" type="time" id="starttime" name="startTime" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="endtime">Enter End Time Session (HH-MM-AM/PM)</label>
                                    <input class="form-control" type="time" id="endtime" name="endTime" required>
                                </div>
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4 text-center">
                                        <button type="submit" class="submit-button">Submit</button>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script>
            // Ensure input is rounded to two decimal places on input change
            document.getElementById('price').addEventListener('input', function() {
                this.value = parseFloat(this.value).toFixed(2);
            });
        </script>
</body>