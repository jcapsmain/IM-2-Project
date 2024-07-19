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
        $sessionBoosterID = $_POST["boosterID"];
        $sessionGameRank = $_POST["sessiongameRank"];
        $sessionStartDate = $_POST["startDate"];
        $sessionEndDate = $_POST["endDate"];
        $sessionStartTime = $_POST["startTime"];
        $sessionEndTime = $_POST["endTime"];
        $sessiontrainerID = $_SESSION["client_ID"];
        $sessionRegisterDuplicate = mysqli_query($conn ,"SELECT * FROM boosting_session WHERE trainerID = '$sessiontrainerID'");
        if(mysqli_num_rows($sessionRegisterDuplicate) > 0) {
            echo "<script> alert('You already have a coach'); </script>";
            
        }
        else{
            $sessionRegisterQuery = "INSERT INTO boosting_session VALUES ('', '$sessiontrainerID', '$sessionBoosterID', '$games', '$sessionGameRank', '$sessionStartDate', '$sessionEndDate', '$sessionStartTime',  '$sessionEndTime')";
            mysqli_query($conn,$sessionRegisterQuery);
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
<body class="pt-5 mt-4">

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
                    <button type="button" class="btn btn-dark"  id="register_as_coach" onclick="location.href='coachRegistration.php?game=<?php echo htmlspecialchars($games); ?>'">Register as Coach</button>
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
                    game_info gi ON g.game_id = gi.gameID AND cb.gamerank = gi.gameRank WHERE game = '$games' AND c.client_ID != '$sessionID' AND cb.status = 'Available' 
                    GROUP BY cb.client_booster_id 
                    ORDER BY gi.gameinfoID DESC, cb.client_booster_id ASC, c.region = '$clientRegion' DESC";

                } else {

                    $gamesQuerry = "SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID JOIN game_info gi ON cb.gamerank = gi.gameRank WHERE game = 
                    '$games' AND cb.status = 'Available' GROUP BY cb.client_booster_id ORDER BY gi.gameinfoID DESC, cb.client_booster_id ASC";

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
                                <button class="btn btn-primary hire-button" data-bs-toggle="modal" data-bs-target="#StudentRegisterModal" data-booster-id="<?php echo $row["client_booster_id"]; ?>">
                                Hire</button>
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
                        <form method="post" autocomplete="off" name="session-signup">

                            <div class="form-group d-none">
                                <label class="form-label" for="boosterID">BoosterID</label>
                                <input class="form-control" placeholder="BoosterID" type="number" id="boosterID" name="boosterID" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="gameRank">Game Rank</label>
                                <select class="form-select" id="sessiongameRank" name="sessiongameRank" required>
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
                                    <button type="submit" class="submit-button" name="session-register">Submit</button>
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

            <!-- JavaScript to set modal form values -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var hireButtons = document.querySelectorAll('.hire-button');
            
            hireButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var booster_id = this.getAttribute('data-booster-id');
                    
                    document.getElementById('boosterID').value = booster_id;
                });
            });
        });
    </script>
</body>