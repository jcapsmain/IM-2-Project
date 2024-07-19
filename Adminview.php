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
                        <td><a href="profile1.jpg" target="_blank"><img src="profile1.jpg" alt="JohnDoe123" class="profile-pic"></a></td>
                        <td>JohnDoe123</td>
                        <td>Spam</td>
                        <td>2024-07-06</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reportModal1">View Info</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><a href="profile2.jpg" target="_blank"><img src="profile2.jpg" alt="JaneSmith456" class="profile-pic"></a></td>
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
                        <td class="text-center"><a href="coach1.jpg" target="_blank"><img src="coach1.jpg" alt="CoachOne" class="profile-pic"></a></td>
                        <td class="text-center"><?php echo $boosterIGNRequest; ?></td>
                        <td class="text-center"><?php echo $applicationDateRequest ?></td>
                        <td class="text-center"><?php echo $gameRequest ?></td>
                        <td class="text-center"><?php echo $gameRankRequest ?></td>
                        <td class="text-center"><?php echo $statusRequest ?></td>
                        <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModalRequest<?php echo $rowNumberRequest; ?>">View Info</button></td>
                    </tr>

                        <!-- Request Modal 1 -->
                        <div class="modal fade" id="reviewModalRequest<?php echo $rowNumberRequest; ?>" tabindex="-1" aria-labelledby="reviewModalLabelRequest" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabelRequest">Coach Application Review</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <h6>UID Screenshot</h6>
                                                    <a href="<?php echo $uidScreenshotRequest; ?>" target="_blank"><img src="<?php echo $uidScreenshotRequest; ?>" alt="UID Screenshot" class="modal-profile-pic"></a>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <h6>Game Rank Screenshot</h6>
                                                    <a href="<?php echo $gameRankScreenshotRequest; ?>" target="_blank"><img src="<?php echo $gameRankScreenshotRequest; ?>" alt="Game Rank Screenshot" class="modal-profile-pic"></a>
                                                </div>
                                            </div>
                                            <form method="post" action="phpFunctions/acceptBooster.php">
                                                <input type="hidden" name="uid" value="<?php echo $boosterUIDRequest ?>">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                                                </div>
                                                <button type="submit" class="btn btn-success">Accept</button>
                                            </form>
                                            <form method="post" action="phpFunctions/rejectBooster.php" class="mt-2">
                                                <input type="hidden" name="uid" value="<?php echo $boosterUIDRequest ?>">
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        </div>
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
                        <th class="text-center">Game</th>
                        <th class="text-center">Review</th>
                        <th class="text-center">Rating</th>
                        <th class="text-center">Review Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $rowNumber = 0;
                    $clientBooster = mysqli_query($conn ,"SELECT * FROM client_booster WHERE review != '' ORDER BY client_booster_id ASC");
                    while ($boosterRows = mysqli_fetch_assoc($clientBooster)) {
                        $boosterIGN = $boosterRows['IGN'];
                        $game = $boosterRows['game'];
                        $review = $boosterRows['review'];
                        $rating = $boosterRows['rating'];
                        $reviewDate = $boosterRows['review_Date'];
                        $uidScreenshot = "clientBooster/" . $boosterIGN . "/" . $boosterRows['game_uid_screenshot'];
                        $gameRankScreenshot = "clientBooster/" . $boosterIGN . "/" . $boosterRows['game_rank_screenshot'];
                        $rowNumber += 1;
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $boosterRows['client_booster_id'] ?></th>
                        <td class="text-center"><a href="coach2.jpg" target="_blank"><img src="coach2.jpg" alt="CoachTwo" class="profile-pic"></a></td>
                        <td class="text-center"><?php echo $boosterIGN; ?></td>
                        <td class="text-center"><?php echo $game ?></td>
                        <td class="text-center"><?php echo $review ?></td>
                        <td class="text-center"><?php echo $rating ?></td>
                        <td class="text-center"><?php echo $reviewDate ?></td>
                        <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal<?php echo $rowNumber; ?>">View Info</button></td>
                    </tr>

                    <!-- Review Modal -->
                    <div class="modal fade" id="reviewModal<?php echo $rowNumber; ?>" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel">Coach Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <h6>UID Screenshot</h6>
                                                <a href="<?php echo $uidScreenshot; ?>" target="_blank"><img src="<?php echo $uidScreenshot; ?>" alt="UID Screenshot" class="modal-profile-pic"></a>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <h6>Game Rank Screenshot</h6>
                                                <a href="<?php echo $gameRankScreenshot; ?>" target="_blank"><img src="<?php echo $gameRankScreenshot; ?>" alt="Game Rank Screenshot" class="modal-profile-pic"></a>
                                            </div>
                                        </div>
                                        <form method="post" action="phpFunctions/modifyBooster.php">
                                            <input type="hidden" name="uid" value="<?php echo $boosterRows['coach_uid'] ?>">
                                            <div class="form-group">
                                                <label for="review">Review</label>
                                                <textarea class="form-control" id="review" name="review"><?php echo $review ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="rating">Rating</label>
                                                <input type="number" class="form-control" id="rating" name="rating" value="<?php echo $rating ?>" min="1" max="5">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
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

    <!-- Game Review -->
    <div class="content" id="modifyGame" style="display:none;">
        <div class="header">
            <h1>Game Review</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="game-box">
                    <h5>Game 1</h5>
                    <a href="game1.jpg" target="_blank"><img src="game1.jpg" alt="Game 1"></a>
                    <button class="btn btn-info btn-block mt-3" data-toggle="modal" data-target="#gameModal1">Modify</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="game-box">
                    <h5>Game 2</h5>
                    <a href="game2.jpg" target="_blank"><img src="game2.jpg" alt="Game 2"></a>
                    <button class="btn btn-info btn-block mt-3" data-toggle="modal" data-target="#gameModal2">Modify</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Template -->
    <div class="modal fade" id="gameModal1" tabindex="-1" aria-labelledby="gameModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gameModalLabel1">Modify Game 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="game1Name">Game Name</label>
                            <input type="text" class="form-control" id="game1Name" placeholder="Enter game name">
                        </div>
                        <div class="form-group">
                            <label for="game1Description">Description</label>
                            <textarea class="form-control" id="game1Description" placeholder="Enter game description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Template -->
    <div class="modal fade" id="gameModal2" tabindex="-1" aria-labelledby="gameModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gameModalLabel2">Modify Game 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="game2Name">Game Name</label>
                            <input type="text" class="form-control" id="game2Name" placeholder="Enter game name">
                        </div>
                        <div class="form-group">
                            <label for="game2Description">Description</label>
                            <textarea class="form-control" id="game2Description" placeholder="Enter game description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add More Games -->

    <!-- Add Game Modal -->
    <div class="modal fade" id="addGameModal" tabindex="-1" aria-labelledby="addGameModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                            <label for="newGameName">Game Name</label>
                            <input type="text" class="form-control" id="newGameName" placeholder="Enter game name">
                        </div>
                        <div class="form-group">
                            <label for="newGameDescription">Description</label>
                            <textarea class="form-control" id="newGameDescription" placeholder="Enter game description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="newGameImage">Upload Game Image</label>
                            <input type="file" class="form-control-file" id="newGameImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Game</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js" integrity="sha384-pzjw8f+ua7Kw1TIqAeCXvS+Ezzf1DkP7Mc3nA2+P1ZqGp5igI0hvN+7cV7bnxj1m" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgG3A9ACjAGuV0Gf7A+BS5qGH4tawXthBgrD7lLYh5ksI4YgANM" crossorigin="anonymous"></script>
</body>
</html>





