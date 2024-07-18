<?php
    ob_start();
    require 'config.php';
    include 'navbar.php';
    include 'messagepopup.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/coachRegistration.css">

</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Coach Registration</h2>
            </div>
            <div class="card-body">
                <form action="process_registration.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">

                        <label for="ign">IGN (In-Game Name)</label>
                        <input type="text" class="form-control" id="ign" name="ign" required>
                    
                        <label for="game">Game</label>
                        <input type="text" class="form-control" id="game" name="game" required>
                    
                        <label for="rank">Game Rank</label>
                        <input type="text" class="form-control" id="rank" name="rank" required>
                    
                        <label for="uid_screenshot">Game UID Screenshot</label>
                        <input type="file" class="form-control-file" id="uid_screenshot" name="uid_screenshot" required>
                        <small class="form-text text-muted">Upload a screenshot showing your UID or player ID.</small>
                    
                        <label for="rank_screenshot">Game Rank Screenshot</label>
                        <input type="file" class="form-control-file" id="rank_screenshot" name="rank_screenshot" required>
                        <small class="form-text text-muted">Upload a screenshot showing your rank or achievements.</small>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
