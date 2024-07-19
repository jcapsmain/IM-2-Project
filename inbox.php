<?php 
    require 'config.php';
    include 'navbar.php'; 
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
                    // Array of users with different statuses
                    $inboxID = $_SESSION["client_ID"];
                    $boosterSession = mysqli_query($conn, "SELECT * FROM client c JOIN client_booster cb ON c.client_ID = cb.client_id JOIN boostsession bs ON 
                    bs.boosterID = cb.client_booster_id WHERE bs.traineeID = $inboxID OR (bs.boosterID = cb.client_booster_id AND cb.client_id = $inboxID) AND bs.status = 'On Hold'");
                    while ($boosterRow = mysqli_fetch_assoc($boosterSession)) {
                        if($boosterRow['boosterID'] == $inboxID) {
                            $traineeID = $boosterRow['traineeID'];
                            $ignSQL = mysqli_query($conn, "SELECT * FROM client c JOIN boostsession bs ON 
                            c.client_ID = bs.traineeID WHERE bs.traineeID = $traineeID");
                            $ignRow = mysqli_fetch_assoc($ignSQL);
                            $IGN = $ignRow["username"];
                            $inboxRequest = 'Coaching Request';
                            $numbRow = $boosterRow['boostSessionID'];
                            echo '<div class="contact p-3 border-bottom" onclick="showRequest(\'' . htmlspecialchars($IGN) . '\', \'' . htmlspecialchars($inboxRequest) . '\', \'' . $numbRow. '\')">';
                            // echo '<img src="' . $boosterRow['profile_image'] . '" alt="User Image" class="rounded-circle" width="50">';
                            echo '<div class="contact-info ml-3">';
                            echo '<h5>' . $IGN . '</h5>';
                            echo '<p>'. $inboxRequest .'</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                        else {
                            $IGN = $boosterRow["IGN"];
                            $inboxRequest = 'Request Accepted';
                            echo '<div class="contact p-3 border-bottom" onclick="showRequest(\'' . htmlspecialchars($IGN) . '\', \'' . htmlspecialchars($inboxRequest) . '\')">';
                            // echo '<img src="' . $boosterRow['profile_image'] . '" alt="User Image" class="rounded-circle" width="50">';
                            echo '<div class="contact-info ml-3">';
                            echo '<h5>' . $IGN . '</h5>';
                            echo '<p>' . $inboxRequest . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }

                    }
                    
                    $users = [
                        [
                            'username' => 'Username',
                            'game_name' => 'Game Name',
                            'ign' => 'IGN',
                            'uid' => 'UID',
                            'game_rank' => 'Rank',
                            'profile_image' => 'resources/img_avatar2.webp',
                            'status' => 'Coaching request'
                        ],
                        [
                            'username' => 'Username',
                            'game_name' => 'Game Name',
                            'status' => 'Request Accepted',
                            'coach_email' => 'coach@example.com',
                            'coach_bio' => 'Coaches other soacial media links',
                            'profile_image' => 'resources/img_avatar2.webp'
                        ],
                        [
                            'username' => 'Username',
                            'game_name' => 'Game Name',
                            'status' => 'Request Rejected',
                            'coach_username' => 'Coach Name',
                            'profile_image' => 'resources/img_avatar2.webp'
                        ]
                    ];

                    // Display contacts
                    foreach ($users as $index => $user) {
                        echo '<div class="contact p-3 border-bottom" onclick="showRequest(' . $index . ')">';
                        echo '<img src="' . $user['profile_image'] . '" alt="User Image" class="rounded-circle" width="50">';
                        echo '<div class="contact-info ml-3">';
                        echo '<h5>' . $user['username'] . '</h5>';
                        echo '<p>' . $user['status'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-9 position-fixed end-0 top-0 pt-5 mt-5">
                <div class="message-header p-3 border-bottom bg-secondary">
                    <img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">
                    <h5 class="ml-3" id="username">Username</h5>
                </div>
                <div class="message-body p-3 text-center bg-dark">
                    <h1 id="game-name">Game Name</h1>
                    <img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">
                    <div class="user-info mt-3">
                        <p><strong>IGN/Username:</strong> <span id="ign">Sender IGN</span></p>
                        <p><strong>UID:</strong> <span id="uid">Sender UID</span></p>
                        <p><strong>Game Rank:</strong> <span id="game-rank">Sender Game Rank</span></p>
                        <p id="additional-info" class="mt-3"></p>
                    </div>
                    <div class="action-buttons mt-4" id="action-buttons">
                        <!-- Buttons will be dynamically added here -->
                    </div>
                </div>
            </div>
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

    <script>
        function showRequest(IGN, inboxRequest, numbRow) {
            
            const actionButtons = document.getElementById('action-buttons');

            if (inboxRequest === 'Coaching Request') {
                // Assuming you have elements with IDs 'ign', 'uid', 'game-rank', 'additionalInfo', and 'actionButtons'
                document.getElementById('ign').innerHTML = IGN;
                document.getElementById('ign').parentNode.style.display = 'block';
                

                // Show IGN, UID, Game Rank, and add the action buttons
                document.getElementById('uid').parentNode.style.display = 'block';
                document.getElementById('game-rank').parentNode.style.display = 'block';

                                // Clear previous buttons (if any)
                actionButtons.innerHTML = '';

                // Create Accept button
                var acceptButton = document.createElement('button');
                acceptButton.className = 'btn btn-success mr-2';
                acceptButton.textContent = 'Accept';
                acceptButton.onclick = function() {
                    acceptRequest(numbRow); // Example: Call acceptRequest function
                };
                actionButtons.appendChild(acceptButton);

                // Create Reject button
                var rejectButton = document.createElement('button');
                rejectButton.className = 'btn btn-danger';
                rejectButton.textContent = 'Reject';
                rejectButton.onclick = function() {
                    rejectRequest(numbRow); // Example: Call rejectRequest function
                };
                actionButtons.appendChild(rejectButton);
            }
        }

            // Example function for accepting the request
            function acceptRequest(numbRow) {
                console.log('Accept button clicked with numbRow: ' + numbRow);
                <?php 
                    $acceptRequest = mysqli_query($conn, "SELECT * FROM boostsession WHERE boostsessionID = 'echo'");
                ?>
                
                // Implement logic for accepting the request
            }

            // Example function for rejecting the request
            function rejectRequest(numbRow) {
                console.log('Reject button clicked with numbRow: ' + numbRow);
                // Implement logic for rejecting the request
        }
        
    </script>
    
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
