<?php

    ob_start();
    require 'config.php';
    include 'navbar.php';

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
        $coachResult = mysqli_query($conn ,"SELECT * FROM client_booster WHERE client_id = '$coachClientid' AND game = '$coachGame'");
        $coachRow = mysqli_fetch_assoc($coachResult);
    
        if($coachGame == $coachRow["game"]) {
            echo"<script> alert('You already have this game registered as a Coach'); </script>";
        }
        else {
            $query = "INSERT INTO client_booster VALUES ('', '$coachIGN', '$coachClientid', '$coachUid', '$coachGame', '$coachGameRank')";
            mysqli_query($conn,$query);
            header("location: Redirect.php");
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
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
                    $gamesQuerry = "SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID JOIN game g ON cb.game = g.gameDescription JOIN game_info gi ON g.game_id = gi.gameID AND cb.gamerank = gi.gameRank WHERE game = '$games' AND c.client_ID != '$sessionID' GROUP BY cb.client_booster_id ORDER BY gi.gameinfoID DESC, cb.client_booster_id ASC";
                } else {
                    $gamesQuerry = "SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID JOIN game_info gi ON cb.gamerank = gi.gameRank WHERE game = '$games' GROUP BY cb.client_booster_id ORDER BY gi.gameinfoID DESC";
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
                                <p><strong>Region:</strong> Asia</p>
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
                            <form method="post" autocomplete="off" name="coach-signup">
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
                                        <option disabled selected>Select your rank</option>
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
                            <form>
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
    


</body>