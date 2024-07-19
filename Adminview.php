
<?php

    ob_start();
    require 'config.php';
    ob_end_flush();

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
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-light">Admin Panel</h4>
        <a href="#accountReports">Reports</a>
        <a href="#coachRequest">Coach Request</a>
        <a href="#coachReviews">Coach Review</a>
        <a href="#modifyGame">Game Review</a>
    </div>

    <!-- Account Reports -->
    <div class="content" id="accountReports">
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
    </div>


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
                    $clientBoosterRequest = mysqli_query($conn ,"SELECT * FROM client_booster WHERE status = 'Pending' ORDER BY client_booster_id ASC");
                    while ($boosterRowsRequest = mysqli_fetch_assoc($clientBoosterRequest)) {
                        $boosterIGNRequest = $boosterRowsRequest['IGN'];
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
                                        <h5 class="modal-title" id="reviewModalLabelRequest">Request Details: <?php echo $boosterIGNRequest; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="coach1.jpg" alt="CoachOne" class="modal-profile-pic">
                                        <p><strong>Coach ID:</strong> <?php echo $boosterRowsRequest['client_booster_id'] ?></p>
                                        <p><strong>Client ID:</strong> <?php echo $boosterUIDRequest ?></p>
                                        <p><strong>IGN:</strong> <?php echo $boosterIGNRequest ?></p>
                                        <p><strong>Game:</strong> <?php echo $gameRequest ?></p>
                                        <p><strong>Rank:</strong> <?php echo $gameRankRequest ?></p>
                                        <p><strong>Status:</strong> <?php echo $statusRequest ?></p>
                                        <p><strong>UID Screenshot:</strong> <a href="<?php echo $uidScreenshotRequest ?>" target="_blank">View Screenshot</a></p>
                                        <p><strong>Rank Screenshot:</strong> <a href="<?php echo $gameRankScreenshotRequest ?>" target="_blank">View Screenshot</a></p>
                                        <p><strong>Price:</strong> <?php echo $priceRequest ?></p>
                                        <p><strong>Client ID:</strong> <?php echo $boosterRowsRequest['client_id']  ?></p>
                                        <p><strong>Coach Name:</strong> <?php echo $boosterIGNRequest; ?></p>
                                        <p><strong>Application Date:</strong> <?php echo $applicationDateRequest; ?></p>
                                        <p><strong>Game:</strong> <?php echo $gameRequest; ?></p>
                                        <p><strong>Game Rank:</strong> <?php echo $gameRankRequest; ?></p>
                                        <p><strong>Price:</strong> <?php echo $priceRequest; ?></p>
                                        <p><strong>Status:</strong> <?php echo $statusRequest; ?></p>
                                        <p><strong>UID Screenshot:</strong></p>
                                        <img src="<?php echo $uidScreenshotRequest ?>" alt="UID Screenshot" class="modal-profile-pic">
                                        <p><strong>Game Rank Screenshot:</strong></p>
                                        <img src="<?php echo $gameRankScreenshotRequest ?>" alt="Game Rank Screenshot" class="modal-profile-pic">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
@ -227,9 +230,7 @@
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                <?php
                    <?php
                    }
                ?>
                </tbody>
@ -247,155 +248,218 @@
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile Picture</th>
                        <th>Coach IGN</th>
                        <th>Review</th>
                        <th>Date</th>
                        <th>Actions</th>
                        <th class="text-center">#</th>
                        <th class="text-center">Profile Picture</th>
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
                    $clientBooster = mysqli_query($conn ,"SELECT * FROM client_booster WHERE status != 'Pending' ORDER BY client_booster_id ASC");
                    while ($boosterRows = mysqli_fetch_assoc($clientBooster)) {
                        $boosterIGN = $boosterRows['IGN'];
                        $boosterUID = $boosterRows['coach_uid'];
                        $game = $boosterRows['game'];
                        $gameRank = $boosterRows['gamerank'];
                        $status = $boosterRows['status'];
                        $price = $boosterRows['price'];
                        $applicationDate = $boosterRows['upload_Date'];
                        $uidScreenshot = "clientBooster/" . $boosterIGN . "/" . $boosterRows['game_uid_screenshot'];
                        $gameRankScreenshot = "clientBooster/" . $boosterIGN . "/" . $boosterRows['game_rank_screenshot'];
                        $rowNumber += 1;
                ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="coach1.jpg" alt="CoachOne" class="profile-pic"></td>
                        <td>CoachOne</td>
                        <td>Excellent coach!</td>
                        <td>2024-07-06</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal1">View Info</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><img src="coach2.jpg" alt="CoachTwo" class="profile-pic"></td>
                        <td>CoachTwo</td>
                        <td>Very helpful and friendly.</td>
                        <td>2024-07-05</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal2">View Info</button></td>
                        <th scope="row" class="text-center"><?php echo $boosterRows['client_booster_id'] ?></th>
                        <td class="text-center"><img src="coach1.jpg" alt="CoachOne" class="profile-pic"></td>
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
                                        <img src="<?php echo $uidScreenshot ?>" alt="UID Screenshot" class="modal-profile-pic">
                                        <p><strong>Game Rank Screenshot:</strong></p>
                                        <img src="<?php echo $gameRankScreenshot ?>" alt="Game Rank Screenshot" class="modal-profile-pic">
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

    <!-- Game Reviews -->

    <!-- Modify Game -->
    <div class="content" id="modifyGame" style="display:none;">
        <div class="header">
            <h1>Game Review</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addGameModal">ADD GAME</button>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Game Picture</th>
                        <th>Game Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="game1.jpg" alt="Game One" class="profile-pic"></td>
                        <td>Game One</td>
                        <td>Exciting and fun game.</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editGameModal1">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><img src="game2.jpg" alt="Game Two" class="profile-pic"></td>
                        <td>Game Two</td>
                        <td>Challenging and engaging.</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editGameModal2">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        <div class="mt-4">
            <div class="game-box">
                <div class="row">
                    <div class="col-md-3">
                        <img src="game1.jpg" alt="League of Legends">
                    </div>
                    <div class="col-md-9">
                        <h3>League of Legends</h3>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
            <div class="game-box">
                <div class="row">
                    <div class="col-md-3">
                        <img src="game2.jpg" alt="Dota 2">
                    </div>
                    <div class="col-md-9">
                        <h3>Dota 2</h3>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Game Modal -->
    <div class="modal fade" id="editGameModal1" tabindex="-1" aria-labelledby="editGameModalLabel1" aria-hidden="true">
    <!-- Report Modal 1 -->
    <div class="modal fade" id="reportModal1" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel1">Edit Game: Game One</h5>
                    <h5 class="modal-title" id="reportModalLabel">Report Details: JohnDoe123</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editGameForm1">
                        <div class="form-group">
                            <label for="gameName1">Game Name</label>
                            <input type="text" class="form-control" id="gameName1" value="Game One">
                        </div>
                        <div class="form-group">
                            <label for="gameDescription1">Description</label>
                            <textarea class="form-control" id="gameDescription1" rows="3">Exciting and fun game.</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameImage1">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage1">
                        </div>
                    </form>
                    <img src="profile1.jpg" alt="JohnDoe123" class="modal-profile-pic">
                    <p><strong>Reported User:</strong> JohnDoe123</p>
                    <p><strong>Report Type:</strong> Spam</p>
                    <p><strong>Report Date:</strong> 2024-07-06</p>
                    <p><strong>Reason:</strong> User was spamming messages in chat.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges(1)">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editGameModal2" tabindex="-1" aria-labelledby="editGameModalLabel2" aria-hidden="true">
    <!-- Report Modal 2 -->
    <div class="modal fade" id="reportModal2" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel2">Edit Game: Game Two</h5>
                    <h5 class="modal-title" id="reportModalLabel">Report Details: JaneSmith456</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editGameForm2">
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
                    <form>
                        <div class="form-group">
                            <label for="gameName2">Game Name</label>
                            <input type="text" class="form-control" id="gameName2" value="Game Two">
                            <label for="gameName">Game Name</label>
                            <input type="text" class="form-control" id="gameName" placeholder="Enter game name">
                        </div>
                        <div class="form-group">
                            <label for="gameDescription2">Description</label>
                            <textarea class="form-control" id="gameDescription2" rows="3">Challenging and engaging.</textarea>
                            <label for="gameImage">Game Image</label>
                            <input type="file" class="form-control" id="gameImage">
                        </div>
                        <div class="form-group">
                            <label for="gameImage2">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage2">
                            <label for="gameDescription">Game Description</label>
                            <textarea class="form-control" id="gameDescription" rows="3" placeholder="Enter game description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Game</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges(2)">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function saveChanges(gameId) {
            var gameName = document.getElementById('gameName' + gameId).value;
            var gameDescription = document.getElementById('gameDescription' + gameId).value;
            var gameImage = document.getElementById('gameImage' + gameId).files[0];
            // Perform AJAX request to save changes (implement this function on the server-side)
            console.log('Saving changes for game ' + gameId + ':', gameName, gameDescription, gameImage);
        }
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
</body>
</html>



