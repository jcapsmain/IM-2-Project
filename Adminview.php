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
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

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
                        <th>#</th>
                        <th>Profile Picture</th>
                        <th>Coach IGN</th>
                        <th>Review</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Game Reviews -->
    <div class="content" id="modifyGame" style="display:none;">
        <div class="header">
            <h1>Game Review</h1>
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
        </div>
    </div>

    <!-- Edit Game Modal -->
    <div class="modal fade" id="editGameModal1" tabindex="-1" aria-labelledby="editGameModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel1">Edit Game: Game One</h5>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges(1)">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editGameModal2" tabindex="-1" aria-labelledby="editGameModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel2">Edit Game: Game Two</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editGameForm2">
                        <div class="form-group">
                            <label for="gameName2">Game Name</label>
                            <input type="text" class="form-control" id="gameName2" value="Game Two">
                        </div>
                        <div class="form-group">
                            <label for="gameDescription2">Description</label>
                            <textarea class="form-control" id="gameDescription2" rows="3">Challenging and engaging.</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameImage2">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage2">
                        </div>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function saveChanges(gameId) {
            var gameName = document.getElementById('gameName' + gameId).value;
            var gameDescription = document.getElementById('gameDescription' + gameId).value;
            var gameImage = document.getElementById('gameImage' + gameId).files[0];
            // Perform AJAX request to save changes (implement this function on the server-side)
            console.log('Saving changes for game ' + gameId + ':', gameName, gameDescription, gameImage);
        }
    </script>
</body>
</html>
