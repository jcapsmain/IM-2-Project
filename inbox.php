<?php 
    ob_start();
    require 'config.php';
    include 'navbar.php'; 

    if (isset($_POST['acceptSubmit'])) {
        $accept = $_POST['accept'];
        $acceptQuery = "UPDATE boostsession SET status = 'Coach Accepted' WHERE boostSessionID = '$accept'";
        mysqli_query($conn, $acceptQuery);
       
    }
    if (isset($_POST['acceptCoachSubmit'])) {
        $acceptCoach = $_POST['acceptCoach'];
        $acceptCoachQuery = "UPDATE boostsession SET status = 'All Accepted' WHERE boostSessionID = '$acceptCoach'";
        mysqli_query($conn, $acceptCoachQuery);
       
    }
    if (isset($_POST['rejectSubmit'])) {
        $reject = $_POST['reject'];
        $rejectQuery = "UPDATE boostsession SET status = 'Coach Rejected' WHERE boostSessionID = '$reject'";
        mysqli_query($conn, $rejectQuery);
    }
    if (isset($_POST['removeSubmit'])) {
        $reject = $_POST['remove'];
        $rejectQuery = "DELETE FROM boostsession WHERE boostSessionID = '$reject'";
        mysqli_query($conn, $rejectQuery);
    }

    ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="stylesheet" href="css/inbox.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-secondary pt-5 mt-5">
    <div class="container-fluid bg-secondary">
        <div class="row no-gutters">
            <div class="col-3 border-right bg-secondary">
                <div class="search-bar p-3">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <div class="contact-list">
                <?php
                    // Fetch data from the database
                    $inboxID = $_SESSION["client_ID"];
                    $boosterSession = mysqli_query($conn, "SELECT * FROM client c 
                        JOIN client_booster cb ON c.client_ID = cb.client_id 
                        JOIN boostsession bs ON bs.boosterID = cb.client_booster_id 
                        WHERE c.client_id = '$inboxID'");

                    

                    while ($boosterRow = mysqli_fetch_assoc($boosterSession)) {

                        // Extract variables for each session
                        $traineeID = $boosterRow['traineeID'];

                        // Check if traineeID has already been processed


                            $ignSQL = mysqli_query($conn, "SELECT * FROM client c 
                                JOIN boostsession bs ON c.client_ID = bs.traineeID 
                                WHERE bs.traineeID = '$traineeID'");

                            while ($ignRow = mysqli_fetch_assoc($ignSQL)) {
                                // Output the contact list item based on conditions
                                if ($ignRow['client_ID'] != $inboxID && $ignRow["status"] == 'On hold' && $ignRow["boosterID"] == $boosterRow["boosterID"]) {
                                    $IGN = htmlspecialchars($ignRow["username"]) . " " . htmlspecialchars($ignRow["game"]);
                                    echo '<div class="contact p-3 border-bottom" onclick="showMessage(\'' . $IGN . '\');">';
                                    echo '<div class="contact-info ml-3">';
                                    echo '<h5>' . $ignRow["username"] . '</h5>';
                                    echo '<p>Coaching Request</p>';
                                    echo '</div>';
                                    echo '</div>';
                                }


                                 
                            }
                        }
                    
                    $boosterSession1 = mysqli_query($conn, "SELECT * FROM client c 
                        JOIN client_booster cb ON c.client_ID = cb.client_id 
                        JOIN boostsession bs ON bs.boosterID = cb.client_booster_id 
                        WHERE bs.traineeID = '$inboxID'");
                    
                    while ($boosterRow1 = mysqli_fetch_assoc($boosterSession1)) {

                    if ($boosterRow1["status"] == 'Coach Accepted' && $boosterRow1["client_id"] != $_SESSION["client_ID"]) {
                        $IGN = htmlspecialchars($boosterRow1["username"]). " " . htmlspecialchars($boosterRow1["game"]);
                        echo '<div class="contact p-3 border-bottom" onclick="showMessage(\'' . $IGN . '\');">';
                        echo '<div class="contact-info ml-3">';
                        echo '<h5>' . $IGN . '</h5>';
                        echo '<p>Request Accepted</p>';
                        echo '</div>';
                        echo '</div>';
                    } else if ($boosterRow1["status"] == 'Coach Rejected' && $boosterRow1["client_id"] != $_SESSION["client_ID"]) {
                        $IGN = htmlspecialchars($boosterRow1["username"]). " " . htmlspecialchars($boosterRow1["game"]);
                        echo '<div class="contact p-3 border-bottom" onclick="showMessage(\'' . $IGN . '\');">';
                        echo '<div class="contact-info ml-3">';
                        echo '<h5>' . $IGN . '</h5>';
                        echo '<p>Request Rejected</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    }
                    ?>
            </div>

            <?php
            // Reset the mysqli pointer to reuse the result set
            mysqli_data_seek($boosterSession, 0);
            mysqli_data_seek($boosterSession1, 0);


            // Output message details for each session
            while ($boosterRow = mysqli_fetch_assoc($boosterSession)) {
                $traineeID = $boosterRow['traineeID']; 
                    $ignSQL = mysqli_query($conn, "SELECT * FROM client c 
                        JOIN boostsession bs ON c.client_ID = bs.traineeID 
                        WHERE bs.traineeID = '$traineeID'");
                    while($ignRow = mysqli_fetch_assoc($ignSQL)) {
                
                    if ($ignRow['client_ID'] != $inboxID && $ignRow["status"] == 'On hold' && $ignRow["boosterID"] == $boosterRow["boosterID"]) {
                    $startTimeFromDB = $ignRow['startTime'];
                    $endTimeFromDB = $ignRow['endTime'];
                    $startTimeFormatted = date('h:i A', strtotime($startTimeFromDB));
                    $endTimeFormatted = date('h:i A', strtotime($endTimeFromDB));
                    $IGN = htmlspecialchars($ignRow["username"]) . " " . htmlspecialchars($ignRow["game"]);
                    $sessID = $ignRow["boostSessionID"];
                    echo '<div class="col-9 position-fixed end-0 top-0 pt-5 mt-5" id="' . $IGN . '" style="display:block;">';
                    echo '<div class="message-header p-3 border-bottom bg-secondary">';
                    echo '<img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">';
                    echo '<h5 class="ml-3" id="username">' . $ignRow["username"] . '</h5>';
                    echo '</div>';
                    echo '<div class="message-body p-3 text-center bg-dark">';
                    echo '<h1 id="game-name">' . $boosterRow["game"] . '</h1>';
                    echo '<img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">';
                    echo '<div class="user-info mt-3">';
                    echo '<p><strong>Username:</strong> <span id="ign">' . $ignRow["username"] . '</span></p>';
                    echo '<p><strong>Game Rank:</strong> <span id="uid">' . $ignRow["gameRank"] . '</span></p>';
                    echo '<p><strong>Starting Date:</strong> <span id="uid">' . $ignRow["startDate"] . '</span></p>';
                    echo '<p><strong>Ending Date:</strong> <span id="uid">' . $ignRow["endDate"] . '</span></p>';
                    echo '<p><strong>Start Time:</strong> <span id="game-rank">' . $startTimeFormatted . '</span></p>';
                    echo '<p><strong>End Time:</strong> <span id="game-rank">' . $endTimeFormatted . '</span></p>';
                    echo '<p id="additional-info" class="mt-3"></p>';
                    echo '</div>';
                    echo '<div class="action-buttons mt-4" id="action-buttons">';

                    echo '<form method="post" autocomplete="off" name="acceptSubmits">';
                    echo '<input name="accept" type="hidden" value="' . $sessID . '">';
                    echo '<button class="btn btn-success mr-2" name="acceptSubmit">Accept</button>';
                    echo '</form>';

                    echo '<form method="post" autocomplete="off" name="rejectSubmits">';
                    echo '<input name="reject" type="hidden" value="' . $sessID . '">';
                    echo '<button class="btn btn-danger" name="rejectSubmit">Reject</button>';
                    echo '</form>';

                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }}
            while ($boosterRow1 = mysqli_fetch_assoc($boosterSession1)) {
                $sessID1 = $boosterRow1["boostSessionID"];

            if($boosterRow1["status"] == 'Coach Accepted' && $boosterRow1["client_id"] != $_SESSION["client_ID"] ) {
                    $IGN = htmlspecialchars($boosterRow1["username"]). " " . htmlspecialchars($boosterRow1["game"]);
                    $sessID = $boosterRow1["boostSessionID"];
                    echo '<div class="col-9 position-fixed end-0 top-0 pt-5 mt-5" id="' . $IGN . '" style="display:block;">';
                    echo '<div class="message-header p-3 border-bottom bg-secondary">';
                    echo '<img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">';
                    echo '<h5 class="ml-3" id="username">' . $boosterRow1["username"] . '</h5>';
                    echo '</div>';
                    echo '<div class="message-body p-3 text-center bg-dark">';
                    echo '<h1 id="game-name">' . $boosterRow1["game"] . '</h1>';
                    echo '<img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">';
                    echo '<div class="user-info mt-3">';
                    echo '<p>Your request has been accepted by ' . $boosterRow1["username"] . '.</p>';
                    echo '<p>Contact me at: ' . $boosterRow1["email"] . '.</p>';
                    echo '<p id="additional-info" class="mt-3"></p>';
                    echo '</div>';

                    echo '<div class="action-buttons mt-4" id="action-buttons">';

                    echo '<form method="post" autocomplete="off" name="acceptCoachSubmits">';
                    echo '<input name="acceptCoach" type="hidden" value="' . $sessID1 . '">';
                    echo '<button class="btn btn-success mr-2" name="acceptCoachSubmit">Accept Coach</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                else if($boosterRow1["status"] == 'Coach Rejected') {
                    $IGN = htmlspecialchars($boosterRow1["username"]). " " . htmlspecialchars($boosterRow1["game"]);
                    echo '<div class="col-9 position-fixed end-0 top-0 pt-5 mt-5" id="' . $IGN . '" style="display:block;">';
                    echo '<div class="message-header p-3 border-bottom bg-secondary">';
                    echo '<img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">';
                    echo '<h5 class="ml-3" id="username">' . $boosterRow1["username"] . '</h5>';
                    echo '</div>';
                    echo '<div class="message-body p-3 text-center bg-dark">';
                    echo '<h1 id="game-name">' . $boosterRow1["game"] . '</h1>';
                    echo '<img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">';
                    echo '<div class="user-info mt-3">';
                    echo '<p>Your request has been rejected by ' . $boosterRow1["username"] . '.</p>';
                    echo '<p id="additional-info" class="mt-3"></p>';
                    echo '</div>';
                    echo '<div class="action-buttons mt-4" id="action-buttons">';

                    echo '<form method="post" autocomplete="off" name="acceptCoachSubmits">';
                    echo '<input name="remove" type="hidden" value="' . $sessID1 . '">';
                    echo '<button class="btn mr-2 btn-danger" name="removeSubmit">Remove</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function showMessage(targetId) {
        var sections = document.querySelectorAll('.col-9.position-fixed');

        sections.forEach(function(section) {
            if (section.id === targetId) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
