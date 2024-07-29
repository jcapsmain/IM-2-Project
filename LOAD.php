<?php 
    require 'config.php';
    include 'navbar.php'; 

    // require 'vendor/autoload.php'; // Make sure to use the correct path to autoload.php

    // \Stripe\Stripe::setApiKey('your-secret-key-here');

    // header('Content-Type: application/json');

    // $checkoutSession = \Stripe\Checkout\Session::create([
    //     'payment_method_types' => ['card'],
    //     'line_items' => [
    //         [
    //             'price_data' => [
    //                 'currency' => 'usd',
    //                 'product_data' => [
    //                     'name' => 'Coaching Service',
    //                 ],
    //                 'unit_amount' => 1000000, // Amount in cents
    //             ],
    //             'quantity' => 1,
    //         ],
    //     ],
    //     'mode' => 'payment',
    //     'success_url' => 'https://yourdomain.com/success.html',
    //     'cancel_url' => 'https://yourdomain.com/cancel.html',
    // ]);

    // echo json_encode(['id' => $checkoutSession->id]);

    if (isset($_POST['timeIn'])) {
        $timestamp = date('Y-m-d H:i:s');
        $timeID = $_POST['timeID'];
        $timeQuery = "INSERT INTO boostsessiontime VALUES ('', '$timeID', '$timestamp', '$timestamp')";
        mysqli_query($conn, $timeQuery);
        echo "<script>alert(\"Time in at $timestamp\");</script>";

       
    }

    if (isset($_POST['timeOut'])) {
        $timestampend = date('Y-m-d H:i:s');
        $timeID1 = $_POST['timeID'];
        $timeQuery1 = "UPDATE boostsessiontime SET end_time = '$timestampend' WHERE id = (
        SELECT id 
        FROM boostsessiontime 
        WHERE boostsession_id = '$timeID1' 
        ORDER BY id DESC 
        LIMIT 1)";
        mysqli_query($conn, $timeQuery1);
        echo "<script>alert(\"Time end at $timestampend\");</script>";
       
    }

    if (isset($_POST['finishCoaching'])) {
        $sessID = $_POST['idsession'];
        $finishQuery = "UPDATE boostsession SET status = 'Done' WHERE boostSessionID = '$sessID'";
        mysqli_query($conn, $finishQuery);
        echo "<script>alert('Congratulations, Well Done');</script>";

       
    }
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
                                                        $IGN = htmlspecialchars($ignRow["username"]) . "Coach" . htmlspecialchars($ignRow["game"]);
                                                        if ($ignRow['client_ID'] != $inboxID && $ignRow["status"] == 'All Accepted' && $ignRow["boosterID"] == $boosterRow["boosterID"]) {
                                                    echo'<div class="d-flex align-items-center contact p-3 border-bottom" onclick="showMessage(\'' . htmlspecialchars($IGN, ENT_QUOTES) . '\');">';
                                    ?>
                                                    <!-- Circular Image -->
                                                    <img src="resources/img_avatar2.webp" alt="Profile Image" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 15px;">

                                                    <!-- Text Container -->
                                                    <div class="d-flex flex-column">
                                                        <?php echo'<strong><p class="mb-0 text-light">'.$ignRow["username"].'</p></strong>'; ?>
                                                        <p class="mb-0 text-light">Student</p> 
                                                    </div>
                                                    </div>
                                    <?php 
                                                    }
                                                }
                                            }   
                                        

                                        $boosterSession1 = mysqli_query($conn, "SELECT * FROM client c 
                                            JOIN client_booster cb ON c.client_ID = cb.client_id 
                                            JOIN boostsession bs ON bs.boosterID = cb.client_booster_id 
                                            WHERE bs.traineeID = '$inboxID'");
                                        
                                        while ($boosterRow1 = mysqli_fetch_assoc($boosterSession1)) {
                                            if ($boosterRow1["status"] == 'All Accepted' && $boosterRow1["client_id"] != $_SESSION["client_ID"]) {
                                                $IGN = htmlspecialchars($boosterRow1["username"]);
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
                                        }               
                                    }
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
                    $traineeID = $boosterRow['traineeID']; 
                        $ignSQL = mysqli_query($conn, "SELECT * FROM client c 
                            JOIN boostsession bs ON c.client_ID = bs.traineeID
                            WHERE bs.traineeID = '$traineeID'");
                        while($ignRow = mysqli_fetch_assoc($ignSQL)) {
                    
                            if ($ignRow['client_ID'] != $inboxID && $ignRow["status"] == 'All Accepted' && $ignRow["boosterID"] == $boosterRow["boosterID"]) {
                            $IGN = htmlspecialchars($ignRow["username"]) . "Coach" . htmlspecialchars($ignRow["game"]);
                            $startTimeFromDB = $ignRow['startTime'];
                            $endTimeFromDB = $ignRow['endTime'];
                            $startTimeFormatted = date('h:i A', strtotime($startTimeFromDB));
                            $endTimeFormatted = date('h:i A', strtotime($endTimeFromDB));
                            
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
                            <h5 class="ml-3 mb-0 text-light" id="username"><?php echo'<p>'.$ignRow["username"].'</p>';?></h5>
                        </div>

                        <!-- Content Section -->
                        <div class="p-3 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="alert alert-secondary bg-secondary text-white" role="alert">
                                        <div class="mt-3">
                                            <?php echo'<p>Game: '.$ignRow["game"].'</p>';?>
                                            <?php echo'<p>Username: '.$ignRow["username"].'</p>';?>
                                            <p>Date start: <?php echo $ignRow["startDate"];?></p>
                                            <p>Date end: <?php echo $ignRow["endDate"];?></p>
                                            <p>Time start: <?php echo $startTimeFormatted?></p>
                                            <p>Time end: <?php echo $endTimeFormatted?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="alert alert-success bg-secondary text-white" role="alert">
                                        <div class="mt-3"> 
                                            <?php
                                                $ignTime = $ignRow["boostSessionID"];
                                                echo '<form method="post" autocomplete="off" name="TimeInOut">';
                                                echo '<input name="timeID" type="hidden" value="' . $ignTime . '">';
                                                echo '<button type="submit" class="btn btn-dark mr-2" name="timeIn">Time in</button>';
                                                echo '<button type="submit" class="btn btn-dark" name="timeOut">Time out</button>';
                                                echo '</form>';
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-primary bg-secondary text-white" role="alert">
                                        <?php 
                                                   $totalTimeQuery = "
                                                   SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)))) AS total_time
                                                   FROM boostsessiontime bst JOIN boostsession bs ON bst.boostsession_id = bs.boostSessionID
                                                   WHERE bs.boostSessionID = '$ignTime'
                                               ";
                                       
                                               $result = mysqli_query($conn, $totalTimeQuery);
                                               
                                               if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $totalTime = $row['total_time'];                             
                                                    $timeInSeconds = strtotime($totalTime) - strtotime('00:00:00');
                                                    $hours = $timeInSeconds / 3600;
                                                    $costPerHour = $boosterRow["price"]; // Rate per hour
                                                    $totalCost = $hours * $costPerHour;
                                                    $totalCost = round($totalCost, 2);
                                                    if ($totalCost > 0) {
                                                        echo'<p>Total Time: '.$totalTime.'</p>';
                                                        echo'<p>Payment Due: $'.$totalCost.'</p>';
                                                    }
                                                    else {
                                                        echo'<p>Total Time: 00:00:00</p>';
                                                        echo'<p>Payment Due: 0.00</p>';
                                                    }
                                               }

                                                
                                        ?>
                                        
                                        

                                        <div class="mt-3">
                                        <?php

                                                echo '<form method="post" autocomplete="off" name="finishCoach">';
                                                echo '<input name="idsession" type="hidden" value="' . $ignTime . '">';
                                                echo '<button type="submit" id="finish-coaching" class="btn btn-dark" name="finishCoaching">Finish Coaching</button>';
                                                echo '</form> ';
                                            ?>
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
                    }
                }
                mysqli_data_seek($boosterSession1, 0);
                while ($boosterRow1 = mysqli_fetch_assoc($boosterSession1)) {
                    $sessID1 = $boosterRow1["boostSessionID"];
    
                    if ($boosterRow1["status"] == 'All Accepted' && $boosterRow1["client_id"] != $_SESSION["client_ID"]) {
                        $IGN = htmlspecialchars($boosterRow1["username"]);
                        $startTimeFromDB1 = $boosterRow1['startTime'];
                        $endTimeFromDB1 = $boosterRow1['endTime'];
                        $startTimeFormatted1 = date('h:i A', strtotime($startTimeFromDB1));
                        $endTimeFormatted1 = date('h:i A', strtotime($endTimeFromDB1));

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
                            <h5 class="ml-3 mb-0 text-light" id="username"><?php echo'<p>'.$IGN.'</p>';?></h5>
                        </div>

                        <!-- Content Section -->
                        <div class="p-3 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="alert alert-secondary bg-secondary text-white" role="alert">
                                        <div class="mt-3">
                                            <?php echo'<p>Game: '.$boosterRow1["game"].'</p>';?>
                                            <?php echo'<p>Username: '.$IGN.'</p>';?>
                                            <p>Date start: <?php echo $boosterRow1["startDate"];?></p>
                                            <p>Date end: <?php echo $boosterRow1["endDate"];?></p>
                                            <p>Time start: <?php echo $startTimeFormatted1?></p>
                                            <p>Time end: <?php echo $endTimeFormatted1?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-primary bg-secondary text-white" role="alert">
                                        <?php 
                                                    $ignTime = $boosterRow1["boostSessionID"];
                                                    $totalTimeQuery = "
                                                    SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)))) AS total_time
                                                    FROM boostsessiontime bst JOIN boostsession bs ON bst.boostsession_id = bs.boostSessionID
                                                    WHERE bs.boostSessionID = '$ignTime'
                                               ";
                                       
                                               $result = mysqli_query($conn, $totalTimeQuery);
                                               
                                               
                                               if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $totalTime = $row['total_time'];                             
                                                    $timeInSeconds = strtotime($totalTime) - strtotime('00:00:00');
                                                    $hours = $timeInSeconds / 3600;
                                                    $costPerHour = $boosterRow1["price"]; // Rate per hour
                                                    $totalCost = $hours * $costPerHour;
                                                    $totalCost = round($totalCost, 2);
                                                    if ($totalCost > 0) {
                                                        echo'<p>Total Time: '.$totalTime.'</p>';
                                                        echo'<p>Payment Due: $'.$totalCost.'</p>';
                                                    }
                                                    else {
                                                        echo'<p>Total Time: 00:00:00</p>';
                                                        echo'<p>Payment Due: 0.00</p>';
                                                    }
                                               }

                                                
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php }}?>

        </div>
    </div>

    <!-- <script src="https://js.stripe.com/v3/"></script>
    <script>
    // Your Stripe public key
    const stripe = Stripe('pk_test_51PeJpOKQLR7cI20jlv4bTAQMWS9ZmyiCwhb1eaKg0CgX9PlgPjDRkW5gXJUMrxesv6WsYYjesqQnXP1ptWV2FGRP00L4xZN24u');

    document.querySelector('#finish-coaching').addEventListener('click', function() {
        fetch('/create-checkout-session.php', {
            method: 'POST'
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(sessionId) {
            return stripe.redirectToCheckout({ sessionId: sessionId });
        })
        .then(function(result) {
            if (result.error) {
                alert(result.error.message);
            }
        })
        .catch(function(error) {
            console.error('Error:', error);
        });
    });
    </script> -->

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
