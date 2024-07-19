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
                    WHERE bs.traineeID = $inboxID OR (bs.boosterID = cb.client_booster_id AND cb.client_id = $inboxID)");
                
                while ($boosterRow = mysqli_fetch_assoc($boosterSession)) {
                    // Extract variables for each session
                    $traineeID = $boosterRow['traineeID'];
                    $ignSQL = mysqli_query($conn, "SELECT * FROM client c 
                        JOIN boostsession bs ON c.client_ID = bs.traineeID 
                        WHERE bs.traineeID = '$traineeID'");
                    $ignRow = mysqli_fetch_assoc($ignSQL);
                    $numbRow = $boosterRow['boostSessionID'];
                    if($boosterRow['traineeID'] != $_SESSION["client_ID"] && $ignRow["status"] == 'On hold') {
                        // Output the contact list item
                        $IGN = htmlspecialchars($ignRow["username"]);
                        echo '<div class="contact p-3 border-bottom" onclick="showMessage(\'' . $IGN . '\');">';
                        // Add profile image if needed: echo '<img src="' . $boosterRow['profile_image'] . '" alt="User Image" class="rounded-circle" width="50">';
                        echo '<div class="contact-info ml-3">';
                        echo '<h5>' . $IGN . '</h5>';
                        echo '<p>Coaching Request</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    else if($boosterRow["status"] == 'Coach Accepted' && $boosterRow["client_id"] != $_SESSION["client_ID"]) {
                        $IGN = htmlspecialchars($boosterRow["username"]);
                        // Output the contact list item
                        echo '<div class="contact p-3 border-bottom" onclick="showMessage(\'' . $IGN . '\');">';
                        // Add profile image if needed: echo '<img src="' . $boosterRow['profile_image'] . '" alt="User Image" class="rounded-circle" width="50">';
                        echo '<div class="contact-info ml-3">';
                        echo '<h5>' . $IGN . '</h5>';
                        echo '<p>Request Accepted</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    else if($boosterRow["status"] == 'Coach Rejected' && $boosterRow["client_id"] != $_SESSION["client_ID"]) {
                        $IGN = htmlspecialchars($boosterRow["username"]);
                        // Output the contact list item
                        echo '<div class="contact p-3 border-bottom" onclick="showMessage(\'' . $IGN . '\');">';
                        // Add profile image if needed: echo '<img src="' . $boosterRow['profile_image'] . '" alt="User Image" class="rounded-circle" width="50">';
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

            // Output message details for each session
            while ($boosterRow = mysqli_fetch_assoc($boosterSession)) {
                $traineeID = $boosterRow['traineeID'];
                $ignSQL = mysqli_query($conn, "SELECT * FROM client c 
                    JOIN boostsession bs ON c.client_ID = bs.traineeID 
                    WHERE bs.traineeID = $traineeID");
                $ignRow = mysqli_fetch_assoc($ignSQL);
                
                if($boosterRow['traineeID'] != $_SESSION["client_ID"]) {
                    $IGN = htmlspecialchars($ignRow["username"]);
                    $sessID = $ignRow["boostSessionID"];
                    echo '<div class="col-9 position-fixed end-0 top-0 pt-5 mt-5" id="' . $IGN . '" style="display:block;">';
                    echo '<div class="message-header p-3 border-bottom bg-secondary">';
                    echo '<img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">';
                    echo '<h5 class="ml-3" id="username">Username</h5>';
                    echo '</div>';
                    echo '<div class="message-body p-3 text-center bg-dark">';
                    echo '<h1 id="game-name">' . $ignRow["game"] . '</h1>';
                    echo '<img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">';
                    echo '<div class="user-info mt-3">';
                    echo '<p><strong>Username:</strong> <span id="ign">' . $IGN . '</span></p>';
                    echo '<p><strong>UID:</strong> <span id="uid">Sender UID</span></p>';
                    echo '<p><strong>Game Rank:</strong> <span id="game-rank">Sender Game Rank</span></p>';
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
                else if($boosterRow["status"] = 'Coach Accepted') {
                    $IGN = htmlspecialchars($boosterRow["username"]);
                    $sessID = $boosterRow["boostSessionID"];
                    echo '<div class="col-9 position-fixed end-0 top-0 pt-5 mt-5" id="' . $IGN . '" style="display:block;">';
                    echo '<div class="message-header p-3 border-bottom bg-secondary">';
                    echo '<img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">';
                    echo '<h5 class="ml-3" id="username">Username</h5>';
                    echo '</div>';
                    echo '<div class="message-body p-3 text-center bg-dark">';
                    echo '<h1 id="game-name">' . $boosterRow["game"] . '</h1>';
                    echo '<img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">';
                    echo '<div class="user-info mt-3">';
                    echo '<p>Your request has been accepted by ' . $IGN . '.</p>';
                    echo '<p>Contact me at: ' . $boosterRow["email"] . '.</p>';
                    echo '<p id="additional-info" class="mt-3"></p>';
                    echo '</div>';

                    echo '<div class="action-buttons mt-4" id="action-buttons">';

                    echo '<form method="post" autocomplete="off" name="acceptCoachSubmits">';
                    echo '<input name="acceptCoach" type="hidden" value="' . $sessID . '">';
                    echo '<button class="btn btn-success mr-2" name="acceptCoachSubmit">Accept Coach</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                else if($boosterRow["status"] = 'Coach Rejected') {
                    $IGN = htmlspecialchars($boosterRow["username"]);
                    echo '<div class="col-9 position-fixed end-0 top-0 pt-5 mt-5" id="' . $IGN . '" style="display:block;">';
                    echo '<div class="message-header p-3 border-bottom bg-secondary">';
                    echo '<img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">';
                    echo '<h5 class="ml-3" id="username">Username</h5>';
                    echo '</div>';
                    echo '<div class="message-body p-3 text-center bg-dark">';
                    echo '<h1 id="game-name">' . $boosterRow["game"] . '</h1>';
                    echo '<img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">';
                    echo '<div class="user-info mt-3">';
                    echo '<p>Your request has been rejected by ' . $IGN . '.</p>';
                    echo '<p id="additional-info" class="mt-3"></p>';
                    echo '</div>';
                    echo '<div class="action-buttons mt-4" id="action-buttons">';
                    // Buttons will be dynamically added here
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

            }
            ?>
        </div>
    </div>
    <!-- <script>
        const users = <?php echo json_encode($users); ?>;

        function showRequest(index) {
            const user = users[index];
            document.getElementById('profile-image').src = user.profile_image;
            document.getElementById('username').innerText = user.username;
            document.getElementById('game-name').innerText = user.game_name;
            document.getElementById('sender-profile-image').src = user.profile_image;
            document.getElementById('ign').innerText = user.ign || ''; // Display empty string if undefined
            document.getElementById('uid').innerText = user.uid || ''; // Display empty string if undefined
            document.getElementById('game-rank').innerText = user.game_rank || ''; // Display empty string if undefined

            const additionalInfo = document.getElementById('additional-info');
            const actionButtons = document.getElementById('action-buttons');

            if (user.status === 'Coaching request') {
                additionalInfo.innerHTML = ''; // Clear additional info if not needed

                // Show IGN, UID, Game Rank, and add the action buttons
                document.getElementById('ign').parentNode.style.display = 'block';
                document.getElementById('uid').parentNode.style.display = 'block';
                document.getElementById('game-rank').parentNode.style.display = 'block';

                // Add Accept and Reject buttons
                actionButtons.innerHTML = `
                    <button class="btn btn-success mr-2">Accept</button>
                    <button class="btn btn-danger">Reject</button>
                `;
            } else {
                // Hide IGN, UID, Game Rank, and remove the action buttons
                document.getElementById('ign').parentNode.style.display = 'none';
                document.getElementById('uid').parentNode.style.display = 'none';
                document.getElementById('game-rank').parentNode.style.display = 'none';

                // Clear action buttons
                actionButtons.innerHTML = '';

                // Handle additional info based on status
                if (user.status === 'Request Accepted') {
                    additionalInfo.innerHTML = `
                        <p>Your request has been accepted by Coach Name.</p>
                        <p>Contact me at: ${user.coach_email}</p>
                        <p>${user.coach_bio}</p>
                    `;
                } else if (user.status === 'Request Rejected') {
                    additionalInfo.innerHTML = `<p>Your request was rejected by ${user.coach_username}.</p>`;
                } else {
                    additionalInfo.innerHTML = ''; // Clear additional info if not needed
                }
            }
        }
    </script> -->

    

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
