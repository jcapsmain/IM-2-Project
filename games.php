<?php
    require 'config.php';
    include 'navbar.php';

    $games = $_GET['game'];
    $gamequery = mysqli_query($conn ,"SELECT * FROM game WHERE gameDescription = '$games'");

    $gamerow = mysqli_fetch_assoc($gamequery);
    $imageSrc = $gamerow['image_path'];
    $gameDescription = $gamerow['gameDescription'];
    
?>

<!-- Bayot ka franz -->

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
                    $gamesQuerry = "SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID WHERE game = '$games' AND c.client_ID != '$sessionID'";
                } else {
                    $gamesQuerry = "SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID WHERE game = '$games'";
                }
                $result = $conn->query($gamesQuerry);

                if ($result->num_rows > 0) {
                    // Loop through each row of data
                    while($row = $result->fetch_assoc()) {
                        // Output HTML for each coach
                ?>
                    <div class="col-md-4">
                        <div class="game-box">
                            <h2><?php echo $row["username"]; ?></h2>
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

                    $conn->close();
                    ?>
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