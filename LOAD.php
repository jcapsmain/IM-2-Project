<?php 
    require 'config.php';
    include 'navbar.php'; 
?>

<style>
    .contact {
        cursor: pointer; /* Set pointer cursor */
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOAD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .no-padding {
            padding: 0 !important;
            margin: 0 !important;
        }
        .full-height {
            height: calc(100vh - 100px); /* Adjust the 70px value based on the height of your navbar */
            overflow-y: auto; /* Enable vertical scrolling */
        }
    </style>
</head>
<body class="bg-secondary pt-5 mt-5">
    <div class="container-fluid no-padding">
        <div class="row no-gutters">
            <!-- Left Container -->
            <div class="col-md-3 no-padding border-right">
                <div class="card full-height bg-secondary">
                    <div class="card-body">
                        <div class="search-bar p-3">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <!-- Nested Rows inside Left Container -->
                        <div class="row mt-3 border-bottom">
                            <div class="col-12 no-padding">
                                
                                    <?php
                                    // Fetch data from the database
                                    $loadID = $_SESSION["client_ID"];
                                    $boosterSession = mysqli_query($conn, "SELECT * FROM client c 
                                        JOIN client_booster cb ON c.client_ID = cb.client_id 
                                        JOIN boostsession bs ON bs.boosterID = cb.client_booster_id 
                                        WHERE bs.status = 'All Accepted'");
                                        while ($boosterRow = mysqli_fetch_assoc($boosterSession)) {
                                            if($boosterRow['traineeID'] != $_SESSION["client_ID"]) {
                                                $traineeID = $boosterRow['traineeID'];
                                                $ignSQL = mysqli_query($conn, "SELECT * FROM client c 
                                                    JOIN boostsession bs ON c.client_ID = bs.traineeID 
                                                    WHERE bs.traineeID = $traineeID");
                                                $ignRow = mysqli_fetch_assoc($ignSQL);
                                                $IGN = htmlspecialchars($ignRow["username"]);
                                                $sessID = $ignRow["boostSessionID"];
                                            echo'<div class="d-flex align-items-center contact p-3 border-bottom" onclick="showMessage(\'' . htmlspecialchars($IGN, ENT_QUOTES) . '\');">';
                                
                                            
                                                ?>
                                    <!-- Circular Image -->
                                    <img src="resources/img_avatar2.webp" alt="Profile Image" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 15px;">

                                    <!-- Text Container -->
                                    <div class="d-flex flex-column">
                                        <?php echo'<strong><p class="mb-0 text-light">'.$IGN.'</p></strong>'; ?>
                                        <p class="mb-0 text-light">Coach</p> 
                                    </div>
                                    </div>
                                    <?php 
                                    }else {
                                        $IGN = $boosterRow["username"];
                                        echo'<div class="d-flex align-items-center contact p-3 border-bottom" onclick="showMessage(\'' . htmlspecialchars($IGN, ENT_QUOTES) . '\');">';
                            
                                        
                                            ?>
                                <!-- Circular Image -->
                                <img src="resources/img_avatar2.webp" alt="Profile Image" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 15px;">

                                <!-- Text Container -->
                                <div class="d-flex flex-column">
                                    <?php echo'<strong><p class="mb-0 text-light">'.$boosterRow["username"].'</p></strong>'; ?>
                                    <p class="mb-0 text-light">Trainee</p> 
                                </div>
                                </div>
                                    <?php 
                                    }}
                                    ?>
                                
                            </div>
                        </div>
                        <!-- End Nested Rows -->
                    </div>
                </div>
            </div>
            
            <?php
                // Reset the mysqli pointer to reuse the result set
                mysqli_data_seek($boosterSession, 0);

                // Output message details for each session
                while ($boosterRow = mysqli_fetch_assoc($boosterSession)) {
                    $IGN = $boosterRow["username"];
                    echo '<div class="col-md-9 no-padding position-fixed end-0 top-2 pt-5 mt-5" id="' .$IGN. '" style="display:block;">';
            ?>

            <!-- Right Container -->
            
                <div class="card full-height bg-dark">
                    <div class="card-body no-padding">
                        <!-- Header Section -->
                        <div class="p-3 border-bottom bg-secondary d-flex align-items-center" style="width: 100%;">

                            <!-- Profile Image -->
                            <img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50" height="50">

                            <!-- Username -->
                            <h5 class="ml-3 mb-0 text-light" id="username"><?php echo'<p>'.$boosterRow["username"].'</p>';?></h5>
                        </div>

                        <!-- Content Section -->
                        <div class="p-3 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="alert alert-secondary bg-secondary text-white" role="alert">
                                        <div class="mt-3">
                                        <?php echo'<p>Username: '.$IGN.'</p>';?>
                                            <p>UID: <?php echo $boosterRow["coach_uid"];?></p>
                                            <p>DATE start: <?php echo $boosterRow["startDate"];?></p>
                                            <p>DATE end: <?php echo $boosterRow["endDate"];?></p>
                                            <p>Schedule start: <?php echo $boosterRow["startTime"];?></p>
                                            <p>Schedule end: <?php echo $boosterRow["endTime"];?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="alert alert-success bg-secondary text-white" role="alert">
                                        <p>Time in Time: TIME</p>

                                        <div class="mt-3">
                                            <button type="button" class="btn btn-dark mr-2">Time in</button>
                                            <button type="button" class="btn btn-dark">Time out</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-primary bg-secondary text-white" role="alert">
                                        <p>Total Time: TIME</p>
                                        <p>Payment Due: $1000000</p>

                                        <div class="mt-3">
                                            <button type="button" class="btn btn-dark">Finish Coaching</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function showMessage(targetId) {
        var sections = document.querySelectorAll('.col-md-9');
        

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
