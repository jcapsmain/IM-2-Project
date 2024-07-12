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
<body class="bg-secondary">
    <div class="container-fluid bg-secondary">
        <div class="row no-gutters">
            <div class="col-3 border-right bg-secondary">
                <div class="search-bar p-3">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <div class="contact-list">
                    <?php
                    // Array of users with different statuses
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
            <div class="col-9">
                <div class="message-header p-3 border-bottom bg-secondary">
                    <img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50">
                    <h5 class="ml-3" id="username">Username</h5>
                </div>
                <div class="message-body p-3 text-center bg-dark">
                    <h1 id="game-name">Game Name</h1>
                    <img id="sender-profile-image" src="resources/img_avatar2.webp" alt="Sender Profile Picture" class="rounded-circle" width="100">
                    <div class="user-info mt-3">
                        <p><strong>IGN:</strong> <span id="ign">Sender IGN</span></p>
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
    <script>
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
    </script>
</body>
</html>
