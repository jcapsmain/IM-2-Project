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
                                        <p><strong>Client ID:</strong> <?php echo $boosterRowsRequest['client_id']  ?></p>
                                        <p><strong>Coach Name:</strong> <?php echo $boosterIGNRequest; ?></p>
                                        <p><strong>Application Date:</strong> <?php echo $applicationDateRequest; ?></p>
                                        <p><strong>Game:</strong> <?php echo $gameRequest ?></p>
                                        <p><strong>Game Rank:</strong> <?php echo $gameRankRequest ?></p>
                                        <p><strong>Price:</strong> <?php echo $priceRequest ?></p>
                                        <p><strong>Status:</strong> <?php echo $statusRequest ?></p>
                                        <p><strong>Game UID:</strong> <a href="<?php echo $uidScreenshotRequest; ?>">View Screenshot</a></p>
                                        <p><strong>Game Rank:</strong> <a href="<?php echo $gameRankScreenshotRequest; ?>">View Screenshot</a></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="client_booster_function.php" method="POST">
                                            <input type="hidden" name="boosterIGNRequest" value="<?php echo $boosterIGNRequest ?>">
                                            <input type="hidden" name="boosterUIDRequest" value="<?php echo $boosterUIDRequest ?>">
                                            <input type="hidden" name="priceRequest" value="<?php echo $priceRequest ?>">
                                            <button type="submit" name="acceptBooster" class="btn btn-success">Accept</button>
                                            <button type="submit" name="rejectBooster" class="btn btn-danger">Reject</button>
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
                        <th>#</th>
                        <th>Profile Picture</th>
                        <th>Coach Name</th>
                        <th>Game</th>
                        <th>Rating</th>
                        <th>Review Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="profile3.jpg" alt="CoachJohn" class="profile-pic"></td>
                        <td>CoachJohn</td>
                        <td>Fortnite</td>
                        <td>4.8</td>
                        <td>2024-07-06</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal1">View Info</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><img src="profile4.jpg" alt="CoachJane" class="profile-pic"></td>
                        <td>CoachJane</td>
                        <td>League of Legends</td>
                        <td>4.5</td>
                        <td>2024-07-05</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal2">View Info</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Game Review -->
    <div class="content" id="modifyGame" style="display:none;">
        <div class="header">
            <h1>Game Review</h1>
        </div>
        <div class="game-box mt-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="game1.jpg" alt="Game One" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <h2>Game One</h2>
                    <p>Release Date: 2024-06-01</p>
                    <p>Genre: Action RPG</p>
                    <p>Platform: PC, PS5, Xbox</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editGameModal1">Edit Game</button>
                </div>
            </div>
        </div>
        <div class="game-box mt-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="game2.jpg" alt="Game Two" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <h2>Game Two</h2>
                    <p>Release Date: 2024-05-15</p>
                    <p>Genre: Strategy</p>
                    <p>Platform: PC</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editGameModal2">Edit Game</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Game Modal 1 -->
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
                    <form action="update_game.php" method="POST">
                        <input type="hidden" name="gameId" value="1">
                        <div class="form-group">
                            <label for="gameTitle1">Game Title</label>
                            <input type="text" class="form-control" id="gameTitle1" name="gameTitle" value="Game One">
                        </div>
                        <div class="form-group">
                            <label for="releaseDate1">Release Date</label>
                            <input type="date" class="form-control" id="releaseDate1" name="releaseDate" value="2024-06-01">
                        </div>
                        <div class="form-group">
                            <label for="genre1">Genre</label>
                            <input type="text" class="form-control" id="genre1" name="genre" value="Action RPG">
                        </div>
                        <div class="form-group">
                            <label for="platform1">Platform</label>
                            <input type="text" class="form-control" id="platform1" name="platform" value="PC, PS5, Xbox">
                        </div>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Game Modal 2 -->
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
                    <form action="update_game.php" method="POST">
                        <input type="hidden" name="gameId" value="2">
                        <div class="form-group">
                            <label for="gameTitle2">Game Title</label>
                            <input type="text" class="form-control" id="gameTitle2" name="gameTitle" value="Game Two">
                        </div>
                        <div class="form-group">
                            <label for="releaseDate2">Release Date</label>
                            <input type="date" class="form-control" id="releaseDate2" name="releaseDate" value="2024-05-15">
                        </div>
                        <div class="form-group">
                            <label for="genre2">Genre</label>
                            <input type="text" class="form-control" id="genre2" name="genre" value="Strategy">
                        </div>
                        <div class="form-group">
                            <label for="platform2">Platform</label>
                            <input type="text" class="form-control" id="platform2" name="platform" value="PC">
                        </div>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showSection(sectionId) {
            var sections = document.querySelectorAll('.content');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</body>
</html>
