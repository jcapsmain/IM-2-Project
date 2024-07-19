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

    <!-- CAPTCHA -->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Your hCaptcha secret key obtained from hCaptcha admin panel
        $hCaptchaSecret = 'ES_9a306b270e6f4ade851ddc748df61fe6';

        // Retrieve hCaptcha response token from $_POST
        $hCaptchaResponse = $_POST['h-captcha-response'];

        // Prepare POST data for hCaptcha verification
        $postData = array(
            'secret' => $hCaptchaSecret,
            'response' => $hCaptchaResponse
        );

        // Send POST request to hCaptcha verification endpoint
        $verificationUrl = 'https://hcaptcha.com/siteverify';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $verificationUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response from hCaptcha
        $responseData = json_decode($response);

        // Check if the CAPTCHA was successfully completed
        if ($responseData && $responseData->success) {
            // CAPTCHA verification succeeded, process your form submission
            // Example: $email = $_POST['email'];
            echo "CAPTCHA verified successfully!";
        } else {
            // CAPTCHA verification failed, handle the error
            echo "CAPTCHA verification failed!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/coachRegistration.css">
    <script src="https://hcaptcha.com/1/api.js" async defer></script> <!-- CAPTCHA -->

</head>

<body>

    <!-- Coach Registration Modal -->
            <div class="container1">
                <div>
                    <h1>Register as Coach</h1>
                </div>
                
                    <div class="container">
                        <form method="post" autocomplete="off" name="coach-signup" enctype="multipart/form-data">

                                <div class="col-md-6">
                                    <label for="name" class="form-label">IGN</label>
                                    <input placeholder="Enter In Game Name" type="text" class="form-control" id="name" name="coachIGN" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="UID" class="form-label">UID</label>
                                    <input placeholder="Enter User ID" type="text" class="form-control" id="uid" name="coachUid" required>
                                </div>



                                <div class="col-md-6">
                                    <label for="game" class="form-label">Game</label>
                                    <select class="form-control" id="game" name="coachGame" onchange="populateGameRanks()" required>
                                        <?php 
                                            $gamequery = mysqli_query($conn ,"SELECT * FROM game WHERE gameDescription = '$games'");
                                            while ($gamerow = mysqli_fetch_assoc($gamequery)) {
                                                $gameDesc = htmlspecialchars($gamerow['gameDescription']);
                                                echo '<option value="' . $gameDesc . '">' . $gameDesc . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="gameRank" class="form-label">Game Rank</label>
                                    <select class="form-control" id="gameRank" name="coachGameRank" required>
                                        <?php 
                                            $gamerankquery = mysqli_query($conn ,"SELECT * FROM game g JOIN game_info gi ON g.game_id = gi.gameID WHERE g.gameDescription = '$games' GROUP BY gi.gameRank ORDER BY gi.gameinfoID DESC LIMIT 5");
                                            if ($gamerankquery) {
                                            $options = '';
                                                while ($gameinfoRow = mysqli_fetch_assoc($gamerankquery)) {
                                                    $gameinfoRank = $gameinfoRow['gameRank'];
                                                    $options .= '<option value="' . htmlspecialchars($gameinfoRank) . '">' . htmlspecialchars($gameinfoRank) . '</option>';
                                                }
                                                echo $options; // Output all options for dropdown
                                            }else {
                                                echo "Error: " . mysqli_error($conn); // Display error message if query fails
                                            }
                                        ?>
                                    </select>
                                
                                </div>



                            <div class="form-group">
                                <div class="col-md-4">
                                <label for="gameUidScreenshots" class="form-label">Attach Screenshots of your Game UID</label>
                                <input type="file" class="form-control" id="gameUidScreenshots" accept="image/*" name="gameUidScreenshots" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4">
                                <label for="gameRankScreenshots" class="form-label">Attach Screenshots of your Game Rank</label>
                                <input type="file" class="form-control" id="gameRankScreenshots" accept="image/*" name="gameRankScreenshots" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Hourly Coach Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input class="form-control" placeholder="Enter Price" type="number" id="price" name="price" value="10.00" min="0" required>
                                </div>
                            </div>

                            <div class="h-captcha" data-sitekey="9fa44994-76c4-46bc-9fe4-2946a0aea936" name="h-captcha-response"></div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-dark" name='coach-register'>Submit</button>
                            </div>
                        </form>
                    </div>
            </div>


    <script>
        // Ensure input is rounded to two decimal places on input change
        document.getElementById('price').addEventListener('input', function() {
            this.value = parseFloat(this.value).toFixed(2);
        });
    </script>

    

</body>
</html>
