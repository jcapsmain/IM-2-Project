<?php

    ob_start();
    require 'config.php';
    ob_end_flush();

    if(isset($_POST["acceptRequest"])) {
        $coachID = $_POST["coach_id"];
        $status = $_POST["status"];
        $acceptQuery = "UPDATE client_booster SET status = 'Available' WHERE client_booster_id = '$coachID'";
        mysqli_query($conn, $acceptQuery);

    }

    if(isset($_POST["rejectRequest"])) {
        $coachID = $_POST["coach_id"];
        $status = $_POST["status"];
        $rejectQuery = "DELETE FROM client_booster WHERE client_booster_id = '$coachID'";
        mysqli_query($conn, $rejectQuery);

    }

    if(isset($_POST["deleteGame"])) {
        $gameID = $_POST["gameId"];
        $DeleteQuery = "DELETE FROM game WHERE game_id = '$gameID'";
        mysqli_query($conn, $DeleteQuery);

    }


    if(isset($_POST["addGame"])) {
        // Assuming $conn is your database connection object
    
        // Get game name from form
        $gameName = $_POST["gameName"];
    
        // File upload handling
        $gameImg = $_FILES['gameImg'];
        $gameImgName = $_FILES["gameImg"]["name"];
        $imgdir = "resources/Main_Content/" . $gameImgName;
    
        // Function to check if file is an image
        function is_image_file($filename) {
            $image_info = @getimagesize($filename['tmp_name']);
            return $image_info !== false && strpos($image_info['mime'], 'image/') === 0;
        }

        if (!empty($gameImg) && is_image_file($gameImg)) {

            if (move_uploaded_file($_FILES["gameImg"]["tmp_name"], $imgdir)) {
                $adminId = $_SESSION["moderator_id"]; 
    
                $addGame = "INSERT INTO game (gameDescription, image_path, uploaded_by) VALUES ('$gameName', '$imgdir', '$adminId')";
                mysqli_query($conn,$addGame);


            } else {
                echo "<script>alert('Error Uploading File');</script>";
            }
        } else {
            echo "<script>alert('Invalid file or file is not an image');</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Audiowide', cursive;
            background-color: #0b1d28;
            color: #e0e6ed;
            display: flex;
            min-height: 100vh;
            margin: 0;
            
        }
        .sidebar {
            background-color: #102b3f;
            color: #e0e6ed;
            width: 250px;
            min-height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            padding-left: 20px;
        }
        .sidebar a {
            color: #e0e6ed;
            text-decoration: none;
            display: block;
            padding: 15px;
            font-size: 1.2em;
        }
        .sidebar a:hover {
            background-color: #1e4b6f;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .table {
            background-color: #102b3f;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th, .table td {
            color: #e0e6ed;
            border-color: #2a3b47;
        }
        .table th {
            background-color: #1e4b6f;
        }
        .modal-content {
            background-color: #102b3f;
            color: #e0e6ed;
        }
        .modal-header, .modal-footer {
            border-color: #2a3b47;
        }
        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .modal-profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .form-group label {
            color: #e0e6ed;
        }
        .game-box {
            background-color: #102b3f;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            color: #e0e6ed;
        }
        .game-box img {
            width: 100%;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
        }
        .modal-profile-pic.enlarged {
            transform: scale(1.5);
            z-index: 1000;
            position: fixed;
            top: 50%;
            border-radius: 0%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100vh; /* Set the width to 50% of the viewport height */
            height: 100vh; /* Set the height to 50% of the viewport height */
            object-fit: contain;
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-light">Admin Panel</h4>
        <!-- <a href="#accountReports">Reports</a> -->
        <a href="#coachRequest">Coach Request</a>
        <a href="#coachReviews">Coach Review</a>
        <a href="#modifyGame">Game Review</a>
        <a href="logout.php">Back to page</a>
    </div>

    <!-- Account Reports -->
    <!-- <div class="content" id="accountReports">
        <div class="header">
            <h1>Account Reports</h1>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile Picture</th>
                        <th>Account Name</th>
                        <th>Report Type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="profile1.jpg" alt="JohnDoe123" class="profile-pic"></td>
                        <td>JohnDoe123</td>
                        <td>Spam</td>
                        <td>2024-07-06</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reportModal1">View Info</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><img src="profile2.jpg" alt="JaneSmith456" class="profile-pic"></td>
                        <td>JaneSmith456</td>
                        <td>Harassment</td>
                        <td>2024-07-05</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reportModal2">View Info</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->


    <!-- Coach Request -->
    <div class="content" id="coachRequest" style="display:none;">
        <div class="header">
            <h1>Coach Request</h1>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Profile Picture</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Coach IGN</th>
                        <th class="text-center">Application Date</th>
                        <th class="text-center">Game</th>
                        <th class="text-center">Game Rank</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $rowNumberRequest = 0;
                    $clientBoosterRequest = mysqli_query($conn ,"SELECT * FROM client_booster cb JOIN client c ON cb.client_id = c.client_ID WHERE status = 'Pending' ORDER BY client_booster_id ASC");
                    while ($boosterRowsRequest = mysqli_fetch_assoc($clientBoosterRequest)) {
                        $boosterIGNRequest = $boosterRowsRequest['IGN'];
                        $boosterIGNusername = $boosterRowsRequest['username'];
                        $boosterUIDRequest = $boosterRowsRequest['coach_uid'];
                        $gameRequest = $boosterRowsRequest['game'];
                        $gameRankRequest = $boosterRowsRequest['gamerank'];
                        $statusRequest = $boosterRowsRequest['status'];
                        $priceRequest = $boosterRowsRequest['price'];
                        $applicationDateRequest = $boosterRowsRequest['upload_Date'];
                        $uidScreenshotRequest = "clientBooster/" . $boosterIGNRequest . "/" . $boosterRowsRequest['game_uid_screenshot'];
                        $gameRankScreenshotRequest = "clientBooster/" . $boosterIGNRequest . "/" . $boosterRowsRequest['game_rank_screenshot'];
                        $rowNumberRequest += 1;
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $boosterRowsRequest['client_booster_id'] ?></th>
                        <td class="text-center"><img src="coach1.jpg" alt="CoachOne" class="profile-pic"></td>
                        <td class="text-center"><?php echo $boosterIGNusername; ?></td>
                        <td class="text-center"><?php echo $boosterIGNRequest; ?></td>
                        <td class="text-center"><?php echo $applicationDateRequest ?></td>
                        <td class="text-center"><?php echo $gameRequest ?></td>
                        <td class="text-center"><?php echo $gameRankRequest ?></td>
                        <td class="text-center"><?php echo $statusRequest ?></td>
                        <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModalRequest<?php echo $rowNumberRequest; ?>">View Info</button></td>
                    </tr>

                        <!-- Request Modal 1 -->
                        <div class="modal fade" id="reviewModalRequest<?php echo $rowNumberRequest; ?>" tabindex="-1" aria-labelledby="reviewModalLabelRequest" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabelRequest">Request Details: <?php echo $boosterIGNusername; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="coach1.jpg" alt="CoachOne" class="modal-profile-pic">
                                        <p><strong>Coach ID:</strong> <?php echo $boosterRowsRequest['client_booster_id'] ?></p>
                                        <p><strong>Client ID:</strong> <?php echo $boosterRowsRequest['client_id']  ?></p>
                                        <p><strong>Coach Name:</strong> <?php echo $boosterIGNRequest; ?></p>
                                        <p><strong>Application Date:</strong> <?php echo $applicationDateRequest; ?></p>
                                        <p><strong>Game:</strong> <?php echo $gameRequest; ?></p>
                                        <p><strong>Game Rank:</strong> <?php echo $gameRankRequest; ?></p>
                                        <p><strong>Price:</strong> <?php echo $priceRequest; ?></p>
                                        <p><strong>Status:</strong> <?php echo $statusRequest; ?></p>
                                        <p><strong>UID Screenshot:</strong></p>
                                        <img src="<?php echo $uidScreenshotRequest ?>" alt="UID Screenshot" class="modal-profile-pic" onclick="toggleImageSize(this)">
                                        <p><strong>Game Rank Screenshot:</strong></p>
                                        <img src="<?php echo $gameRankScreenshotRequest ?>" alt="Game Rank Screenshot" class="modal-profile-pic" onclick="toggleImageSize(this)">
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" autocomplete="off" name="coach-reg">
                                            <input type="hidden" name="status" value="Available">
                                            <input type="hidden" name="coach_id" value="<?php echo $boosterRowsRequest['client_booster_id']; ?>">
                                            <button type="submit" class="btn btn-secondary" name="acceptRequest">Accept</button>
                                            <button type="submit" class="btn btn-secondary" name="rejectRequest">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Coach Reviews -->
    <div class="content" id="coachReviews" style="display:none;">
        <div class="header">
            <h1>Coach Reviews</h1>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Profile Picture</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Coach IGN</th>
                        <th class="text-center">Application Date</th>
                        <th class="text-center">Game</th>
                        <th class="text-center">Game Rank</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $rowNumber = 0;
                    $clientBooster = mysqli_query($conn ,"SELECT * FROM client c JOIN client_booster cb ON c.client_ID = cb.client_id WHERE status
                     != 'Pending' ORDER BY client_booster_id ASC");
                    while ($boosterRows = mysqli_fetch_assoc($clientBooster)) {
                        $boosterIGN = $boosterRows['IGN'];
                        $boosterUID = $boosterRows['coach_uid'];
                        $game = $boosterRows['game'];
                        $gameRank = $boosterRows['gamerank'];
                        $username = $boosterRows['username'];
                        $status = $boosterRows['status'];
                        $price = $boosterRows['price'];
                        $applicationDate = $boosterRows['upload_Date'];
                        $uidScreenshot = "clientBooster/" . $boosterIGN . "/" . $boosterRows['game_uid_screenshot'];
                        $gameRankScreenshot = "clientBooster/" . $boosterIGN . "/" . $boosterRows['game_rank_screenshot'];
                        $rowNumber += 1;
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $boosterRows['client_booster_id'] ?></th>
                        <td class="text-center"><img src="coach1.jpg" alt="CoachOne" class="profile-pic"></td>
                        <td class="text-center"><?php echo $username; ?></td>
                        <td class="text-center"><?php echo $boosterIGN; ?></td>
                        <td class="text-center"><?php echo $applicationDate ?></td>
                        <td class="text-center"><?php echo $game ?></td>
                        <td class="text-center"><?php echo $gameRank ?></td>
                        <td class="text-center"><?php echo $status ?></td>
                        <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal<?php echo $rowNumber; ?>">View Info</button></td>
                    </tr>

                        <!-- Review Modal 1 -->
                        <div class="modal fade" id="reviewModal<?php echo $rowNumber; ?>" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabel">Review Details: <?php echo $boosterIGN; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="coach1.jpg" alt="CoachOne" class="modal-profile-pic">
                                        <p><strong>Coach ID:</strong> <?php echo $boosterRows['client_booster_id'] ?></p>
                                        <p><strong>Client ID:</strong> <?php echo $boosterRows['client_id']  ?></p>
                                        <p><strong>Coach Name:</strong> <?php echo $boosterIGN; ?></p>
                                        <p><strong>Application Date:</strong> <?php echo $applicationDate; ?></p>
                                        <p><strong>Game:</strong> <?php echo $game; ?></p>
                                        <p><strong>Game Rank:</strong> <?php echo $gameRank; ?></p>
                                        <p><strong>Price:</strong> <?php echo $price; ?></p>
                                        <p><strong>Status:</strong> <?php echo $status; ?></p>
                                        <p><strong>UID Screenshot:</strong></p>
                                        <img src="<?php echo $uidScreenshot ?>" alt="UID Screenshot" class="modal-profile-pic" onclick="toggleImageSize(this)">
                                        <p><strong>Game Rank Screenshot:</strong></p>
                                        <img src="<?php echo $gameRankScreenshot ?>" alt="Game Rank Screenshot" class="modal-profile-pic" onclick="toggleImageSize(this)">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modify Game -->
    <div class="content" id="modifyGame" style="display:none;">
        <div class="header">
            <h1>Game Review</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addGameModal">ADD GAME</button>
        </div>
        <div class="mt-4">
            <?php
                $rowNumber = 0;
                $gameMod = mysqli_query($conn ,"SELECT * FROM game");
                while ($gameRow = mysqli_fetch_assoc($gameMod)) {
                    $gameName = $gameRow['gameDescription'];
                    $gameImg = $gameRow['image_path'];
                    $gameID = $gameRow ['game_id'];
                    
                    
            ?>
                <div class="game-box">
                    <div class="row">
                        <div class="col-md-3">
                            <?php echo'<img src="'.$gameImg.'" alt="League of Legends">'; ?>
                        </div>
                        <div class="col-md-9">
                        <?php echo '<h3>' . $gameName . '</h3>'; 
                            
                            echo '<form method="post" autocomplete="off" name="deleteGamE">';
                            echo '<input type="hidden" name="gameId" value="'.$gameID.'">';
                            echo '<button class="btn btn-danger" name="deleteGame">Delete</button>';

                        ?>
                        </div>
                    </div>
                </div>
            <?php 
                }
            ?>
            

    <!-- Report Modal 1 -->
    <div class="modal fade" id="reportModal1" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report Details: JohnDoe123</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="profile1.jpg" alt="JohnDoe123" class="modal-profile-pic">
                    <p><strong>Reported User:</strong> JohnDoe123</p>
                    <p><strong>Report Type:</strong> Spam</p>
                    <p><strong>Report Date:</strong> 2024-07-06</p>
                    <p><strong>Reason:</strong> User was spamming messages in chat.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal 2 -->
    <div class="modal fade" id="reportModal2" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report Details: JaneSmith456</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="profile2.jpg" alt="JaneSmith456" class="modal-profile-pic">
                    <p><strong>Reported User:</strong> JaneSmith456</p>
                    <p><strong>Report Type:</strong> Harassment</p>
                    <p><strong>Report Date:</strong> 2024-07-05</p>
                    <p><strong>Reason:</strong> User was harassing others in chat.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Game Modal -->
    <div class="modal fade" id="addGameModal" tabindex="-1" aria-labelledby="addGameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGameModalLabel">Add New Game</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" autocomplete="off" name="addGamE" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="gameName">Game Name</label>
                            <input type="text" class="form-control" id="gameName" placeholder="Enter game name" name="gameName">
                        </div>
                        <div class="form-group">
                            <label for="gameImage">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage" name="gameImg" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary" name="addGame">Add Game</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Edit Game Modal 1 -->
     <div class="modal fade" id="editGameModal1" tabindex="-1" aria-labelledby="editGameModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel1">Edit Game: League of Legends</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gameTitle1">Game Title</label>
                        <input type="text" class="form-control" id="gameTitle1" value="League of Legends">
                    </div>
                    <div class="form-group">
                        <label for="gameImage1">Game Image</label>
                        <input type="file" class="form-control-file" id="gameImage1">
                    </div>
                    <div class="form-group">
                        <label for="gameDescription1">Game Description</label>
                        <textarea class="form-control" id="gameDescription1" rows="3">A highly competitive, team-based strategy game.</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Game Modal 2 -->
    <div class="modal fade" id="editGameModal2" tabindex="-1" aria-labelledby="editGameModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel2">Edit Game: Valorant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gameTitle2">Game Title</label>
                        <input type="text" class="form-control" id="gameTitle2" value="Valorant">
                    </div>
                    <div class="form-group">
                        <label for="gameImage2">Game Image</label>
                        <input type="file" class="form-control-file" id="gameImage2">
                    </div>
                    <div class="form-group">
                        <label for="gameDescription2">Game Description</label>
                        <textarea class="form-control" id="gameDescription2" rows="3">A tactical first-person shooter game.</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var links = document.querySelectorAll('.sidebar a');
            var sections = document.querySelectorAll('.content');

            links.forEach(function (link) {
                link.addEventListener('click', function () {
                    var targetId = link.getAttribute('href').substring(1);
                    sections.forEach(function (section) {
                        section.style.display = section.getAttribute('id') === targetId ? 'block' : 'none';
                    });
                });
            });
        });
    </script>

    <script>
        function toggleImageSize(img) {
            img.classList.toggle('enlarged');
        }
    </script>
</body>
</html>




