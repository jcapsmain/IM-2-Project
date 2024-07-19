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
                                        <p><strong>Client ID:</strong> <?php echo $boosterRowsRequest['client_id']  ?></p>
                                        <p><strong>Coach Name:</strong> <?php echo $boosterIGNRequest; ?></p>
                                        <p><strong>Application Date:</strong> <?php echo $applicationDateRequest ?></p>
                                        <p><strong>Game:</strong> <?php echo $gameRequest ?></p>
                                        <p><strong>Game Rank:</strong> <?php echo $gameRankRequest ?></p>
                                        <p><strong>Price:</strong> <?php echo $priceRequest ?></p>
                                        <img src="../clientBooster/<?php echo $uidScreenshotRequest ?>" class="img-fluid">
                                        <img src="../clientBooster/<?php echo $gameRankScreenshotRequest ?>" class="img-fluid">
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


    <!-- Coach Review -->
    <div class="content" id="coachReviews" style="display:none;">
        <div class="header">
            <h1>Coach Review</h1>
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
                    $rowNumber = 0;
                    $clientBooster = mysqli_query($conn ,"SELECT * FROM client_booster WHERE status = 'Approved' OR status = 'Declined' ORDER BY client_booster_id ASC");
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
                                        <h5 class="modal-title" id="reviewModalLabel">Request Details: <?php echo $boosterIGN; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="coach1.jpg" alt="CoachOne" class="modal-profile-pic">
                                        <p><strong>Coach ID:</strong> <?php echo $boosterRows['client_booster_id'] ?></p>
                                        <p><strong>Client ID:</strong> <?php echo $boosterRows['client_id']  ?></p>
                                        <p><strong>Coach Name:</strong> <?php echo $boosterIGN; ?></p>
                                        <p><strong>Application Date:</strong> <?php echo $applicationDate ?></p>
                                        <p><strong>Game:</strong> <?php echo $game ?></p>
                                        <p><strong>Game Rank:</strong> <?php echo $gameRank ?></p>
                                        <p><strong>Price:</strong> <?php echo $price ?></p>
                                        <img src="../clientBooster/<?php echo $uidScreenshot ?>" class="img-fluid">
                                        <img src="../clientBooster/<?php echo $gameRankScreenshot ?>" class="img-fluid">
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
            <h1>Modify Game</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addGameModal">Add Game</button>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="game-box">
                    <img src="game1.jpg" alt="Game One">
                    <h4 class="mt-2">Game One</h4>
                    <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#modifyGameModal1">Modify Game</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Game Modal -->
    <div class="modal fade" id="addGameModal" tabindex="-1" aria-labelledby="addGameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGameModalLabel">Add Game</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="gameName">Game Name</label>
                            <input type="text" class="form-control" id="gameName" placeholder="Enter game name">
                        </div>
                        <div class="form-group">
                            <label for="gameDescription">Game Description</label>
                            <textarea class="form-control" id="gameDescription" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameImage">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modify Game Modal -->
    <div class="modal fade" id="modifyGameModal1" tabindex="-1" aria-labelledby="modifyGameModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyGameModalLabel1">Modify Game: Game One</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="gameName1">Game Name</label>
                            <input type="text" class="form-control" id="gameName1" value="Game One">
                        </div>
                        <div class="form-group">
                            <label for="gameDescription1">Game Description</label>
                            <textarea class="form-control" id="gameDescription1" rows="3">This is the description for Game One.</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameImage1">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage1">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Coach List -->
    <div class="content" id="coachList" style="display:none;">
        <div class="header">
            <h1>Coach List</h1>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Profile Picture</th>
                        <th class="text-center">IGN</th>
                        <th class="text-center">Game</th>
                        <th class="text-center">Rank</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $rowNumber = 0;
                    $clientBooster = mysqli_query($conn ,"SELECT * FROM client_booster ORDER BY client_booster_id ASC");
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
                        <th scope="row" class="text-center"><?php echo $boosterRows['client_booster_id'] ?></th>
                        <td class="text-center"><img src="coach1.jpg" alt="CoachOne" class="profile-pic"></td>
                        <td class="text-center"><?php echo $boosterIGN; ?></td>
                        <td class="text-center"><?php echo $game ?></td>
                        <td class="text-center"><?php echo $gameRank ?></td>
                        <td class="text-center"><?php echo $price ?></td>
                        <td class="text-center"><?php echo $status ?></td>
                        <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal<?php echo $rowNumber; ?>">View Info</button></td>
                    </tr>

                        <!-- Review Modal 1 -->
                        <div class="modal fade" id="reviewModal<?php echo $rowNumber; ?>" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabel">Request Details: <?php echo $boosterIGN; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="coach1.jpg" alt="CoachOne" class="modal-profile-pic">
                                        <p><strong>Coach ID:</strong> <?php echo $boosterRows['client_booster_id'] ?></p>
                                        <p><strong>Client ID:</strong> <?php echo $boosterRows['client_id']  ?></p>
                                        <p><strong>Coach Name:</strong> <?php echo $boosterIGN; ?></p>
                                        <p><strong>Application Date:</strong> <?php echo $applicationDate ?></p>
                                        <p><strong>Game:</strong> <?php echo $game ?></p>
                                        <p><strong>Game Rank:</strong> <?php echo $gameRank ?></p>
                                        <p><strong>Price:</strong> <?php echo $price ?></p>
                                        <img src="../clientBooster/<?php echo $uidScreenshot ?>" class="img-fluid">
                                        <img src="../clientBooster/<?php echo $gameRankScreenshot ?>" class="img-fluid">
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


    <!-- Login/Signup -->
    <div class="content" id="loginSignup" style="display:none;">
        <div class="header">
            <h1>Login / Signup</h1>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Login</h2>
                <form>
                    <div class="form-group">
                        <label for="loginEmail">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Signup</h2>
                <form>
                    <div class="form-group">
                        <label for="signupEmail">Email address</label>
                        <input type="email" class="form-control" id="signupEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="signupPassword">Password</label>
                        <input type="password" class="form-control" id="signupPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="signupConfirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="signupConfirmPassword" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showContent(contentId) {
            // Hide all content divs
            const contents = document.querySelectorAll('.content');
            contents.forEach(content => content.style.display = 'none');

            // Show the selected content div
            const selectedContent = document.getElementById(contentId);
            if (selectedContent) {
                selectedContent.style.display = 'block';
            }
        }
    </script>
</body>
</html>
