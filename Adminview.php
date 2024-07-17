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
        <a href="#coachReviews">Review</a>
        <a href="#modifyGame">Modify</a>
    </div>
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
                        <!-- <td><img src="profile1.jpg" alt="JohnDoe123" class="profile-pic"></td> -->
                        <td>JohnDoe123</td>
                        <td>Spam</td>
                        <td>2024-07-06</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reportModal1">View Info</button></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <!-- <td><img src="profile2.jpg" alt="JaneSmith456" class="profile-pic"></td> -->
                        <td>JaneSmith456</td>
                        <td>Harassment</td>
                        <td>2024-07-05</td>
                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reportModal2">View Info</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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
                        <th class="text-center">Coach IGN</th>
                        <th class="text-center">Application Date</th>
                        <th class="text-center">Game</th>
                        <th class="text-center">Game Rank</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $rowNumber = 0;
                    $clientBooster = mysqli_query($conn ,"SELECT * FROM client_booster");
                    while ($boosterRows = mysqli_fetch_assoc($clientBooster)) {
                        $boosterIGN = $boosterRows['IGN'];
                        $boosterUID = $boosterRows['coach_uid'];
                        $game = $boosterRows['game'];
                        $gameRank = $boosterRows['gamerank'];
                        $status = $boosterRows['status'];
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
                        <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#reviewModal1">View Info</button></td>
                    </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content" id="modifyGame" style="display:none;">
        <div class="header">
            <h1>Modify Game</h1>
        </div>
        <div class="mt-4">
            <!-- Game boxes representing current games -->
            <div class="game-box">
                <img src="game1.jpg" alt="Game 1">
                <h3>Game Title 1</h3>
                <p>Game Description 1</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modifyGameModal1">Edit</button>
            </div>
            <div class="game-box">
                <img src="game2.jpg" alt="Game 2">
                <h3>Game Title 2</h3>
                <p>Game Description 2</p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modifyGameModal2">Edit</button>
            </div>
        </div>
    </div>

    <!-- Report Modal 1 -->
    <div class="modal fade" id="reportModal1" tabindex="-1" aria-labelledby="reportModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModal1Label">Report Details: JohnDoe123</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- <img src="profile1.jpg" alt="JohnDoe123" class="modal-profile-pic"> -->
                    <p><strong>Reported Account:</strong> JohnDoe123</p>
                    <p><strong>Report Type:</strong> Spam</p>
                    <p><strong>Date:</strong> 2024-07-06</p>
                    <p><strong>Details:</strong> User has been reported for sending unsolicited messages repeatedly.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Take Action</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal 2 -->
    <div class="modal fade" id="reportModal2" tabindex="-1" aria-labelledby="reportModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModal2Label">Report Details: JaneSmith456</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- <img src="profile2.jpg" alt="JaneSmith456" class="modal-profile-pic"> -->
                    <p><strong>Reported Account:</strong> JaneSmith456</p>
                    <p><strong>Report Type:</strong> Harassment</p>
                    <p><strong>Date:</strong> 2024-07-05</p>
                    <p><strong>Details:</strong> User has been reported for sending threatening messages to other users.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Take Action</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal 1 -->
    <div class="modal fade" id="reviewModal1" tabindex="-1" aria-labelledby="reviewModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModal1Label">Review Details: CoachOne</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="coach1.jpg" alt="CoachOne" class="modal-profile-pic">
                    <p><strong>Coach Name:</strong> CoachOne</p>
                    <p><strong>Application Date:</strong> 2024-07-06</p>
                    <p><strong>Experience:</strong> 5 years</p>
                    <p><strong>Skills:</strong> Strategy, Communication</p>
                    <p><strong>Qualifications:</strong> Certified Professional Coach, Former Team Leader</p>
                    <p><strong>References:</strong> Available upon request</p>
                    <p><strong>Cover Letter:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Take Action</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal 2 -->
    <div class="modal fade" id="reviewModal2" tabindex="-1" aria-labelledby="reviewModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModal2Label">Review Details: CoachTwo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="coach2.jpg" alt="CoachTwo" class="modal-profile-pic">
                    <p><strong>Coach Name:</strong> CoachTwo</p>
                    <p><strong>Application Date:</strong> 2024-07-05</p>
                    <p><strong>Experience:</strong> 3 years</p>
                    <p><strong>Skills:</strong> Team Management, Leadership</p>
                    <p><strong>Qualifications:</strong> Certified Leadership Coach, Former Captain</p>
                    <p><strong>References:</strong> Available upon request</p>
                    <p><strong>Cover Letter:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. Cras venenatis euismod malesuada.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Take Action</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modify Game Modal 1 -->
    <div class="modal fade" id="modifyGameModal1" tabindex="-1" aria-labelledby="modifyGameModal1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyGameModal1Label">Modify Game: Game Title 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="gameTitle1">Game Title</label>
                            <input type="text" class="form-control" id="gameTitle1" value="Game Title 1">
                        </div>
                        <div class="form-group">
                            <label for="gameDescription1">Game Description</label>
                            <textarea class="form-control" id="gameDescription1" rows="3">Game Description 1</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameStats1">Game Stats</label>
                            <textarea class="form-control" id="gameStats1" rows="3">Game Stats 1</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameImage1">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage1">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modify Game Modal 2 -->
    <div class="modal fade" id="modifyGameModal2" tabindex="-1" aria-labelledby="modifyGameModal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyGameModal2Label">Modify Game: Game Title 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="gameTitle2">Game Title</label>
                            <input type="text" class="form-control" id="gameTitle2" value="Game Title 2">
                        </div>
                        <div class="form-group">
                            <label for="gameDescription2">Game Description</label>
                            <textarea class="form-control" id="gameDescription2" rows="3">Game Description 2</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameStats2">Game Stats</label>
                            <textarea class="form-control" id="gameStats2" rows="3">Game Stats 2</textarea>
                        </div>
                        <div class="form-group">
                            <label for="gameImage2">Game Image</label>
                            <input type="file" class="form-control-file" id="gameImage2">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidebar a').on('click', function() {
                $('.content').hide();
                const target = $(this).attr('href');
                $(target).show();
            });

            // Show the default content
            $('#accountReports').show();
        });
    </script>
</body>
</html>
