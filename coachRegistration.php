<?php

    ob_start();
    require 'config.php';
    include 'messagepopup.php';

    $games = htmlspecialchars($_GET['game']);

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
        $gameUidScreenshot = $_FILES['gameUidScreenshots'];
        $gameRankScreenshot = $_FILES['gameRankScreenshots'];
        $uploadDir = "clientBooster/" . $coachIGN . "/";
        $coachgamePrice = $_POST["price"];
        $coachResult = mysqli_query($conn ,"SELECT * FROM client_booster WHERE client_id = '$coachClientid' AND game = '$coachGame'");
        $coachRow = mysqli_fetch_assoc($coachResult);
        $maxFileSize = 20 * 1024 * 1024;
        $currentDate = date('Y-m-d');
    
        if(mysqli_num_rows($coachResult) > 0) {
            echo '<script>alert("Your message here");</script>';
        }
        else {
            function is_image_file($filename) {
                $image_info = @getimagesize($filename['tmp_name']);
                return $image_info !== false && strpos($image_info['mime'], 'image/') === 0;
            }

            if (!empty($gameUidScreenshot) && is_image_file($gameUidScreenshot) && 
                !empty($gameRankScreenshot) && is_image_file($gameRankScreenshot) && 
                ($_FILES['gameUidScreenshots']['size'] < $maxFileSize && $_FILES['gameRankScreenshots']['size'] < $maxFileSize)) {

                    
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $gameUidScreenshotName = $_FILES['gameUidScreenshots']['name'];
                $gameRankScreenshotName = $_FILES['gameRankScreenshots']['name'];
                move_uploaded_file($_FILES['gameUidScreenshots']['tmp_name'], $uploadDir . $gameUidScreenshotName);
                move_uploaded_file($_FILES['gameRankScreenshots']['tmp_name'], $uploadDir . $gameRankScreenshotName);

                $query = "INSERT INTO client_booster VALUES ('', '$coachIGN', '$coachClientid', '$coachUid', '$coachGame', '$coachGameRank', '$gameUidScreenshot', 
                '$gameRankScreenshot', '$coachgamePrice', '$currentDate', 'Pending')";
                mysqli_query($conn,$query);
                header("location: Redirect.php");
            }
            else {

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
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/coachRegistration.css">

</head>

<body>

    <!-- Coach Registration Modal -->
            <div class="container1">
                <div>
                    <h1 id="exampleModalLabel">Register as Coach</h1>
                </div>
                <div>
                    <div class="container">
                        <form method="post" autocomplete="off" name="coach-signup" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">IGN</label>
                                <input class="form-control" placeholder="Enter In Game Name" type="text" class="form-control" id="name" name="coachIGN" required>
                            </div>
                            <div class="mb-3">
                                <label for="UID" class="form-label">UID</label>
                                <input class="form-control" placeholder="Enter User ID" type="number" class="form-control" id="uid" name="coachUid" required>
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


    

    

</body>
</html>
