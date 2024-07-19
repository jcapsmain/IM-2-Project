<?php 
    require 'config.php';
    include 'navbar.php'; 
?>
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
        .border-right {
            border-right: 2px solid #ccc; /* Adjust border color and width */
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
                        <div class="row mt-3">
                            <div class="col-12 no-padding">
                                <div class="d-flex align-items-center">
                                    <!-- Circular Image -->
                                    <img src="resources/img_avatar2.webp" alt="Profile Image" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 15px;">

                                    <!-- Text Container -->
                                    <div class="d-flex flex-column">
                                        <strong><p class="mb-0 text-light">Username</p></strong>
                                        <p class="mb-0 text-light">Time</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Nested Rows -->
                    </div>
                </div>
            </div>

            <!-- Right Container -->
            <div class="col-md-9 no-padding">
                <div class="card full-height bg-dark">
                    <div class="card-body no-padding">
                        <!-- Header Section -->
                        <div class="p-3 border-bottom bg-secondary d-flex align-items-center" style="width: 100%;">
                            <!-- Profile Image -->
                            <img id="profile-image" src="resources/img_avatar2.webp" alt="User Image" class="rounded-circle" width="50" height="50">

                            <!-- Username -->
                            <h5 class="ml-3 mb-0 text-light" id="username">Username</h5>
                        </div>

                        <!-- Content Section -->
                        <div class="p-3 mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="alert alert-secondary bg-secondary text-white" role="alert">
                                        <div class="mt-3">
                                            <h1>Game: Valorant</h1>
                                            <p>IGN: Username</p>
                                            <p>UID: 123456789</p>
                                            <p>DATE started: DATE</p>
                                            <p>Schedule: TIME</p>
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
        </div>
    </div>
</body>
</html>
