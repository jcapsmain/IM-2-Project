<?php
    ob_start();
    
    require 'config.php';
    include 'navbar.php';

    if(!empty($_SESSION["client_ID"])){
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var createAccount = document.getElementById('start_now');
                    createAccount.style.display = 'none';
                });
            </script>
        ";
    }

    



    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKBD | Home</title>

    <!-- External CSS links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Homepage.css">
    <link rel="stylesheet" href="css/footer.css">
    
</head>
<body class="pt-5 mt-4">

    <!-- Main Carousel -->
    <div class="container-fluid p-0">
        <div id="HeadCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-content text-start transparent-background">
                <div class="carousel-caption">
                    <h1>These are our available games for coaching</h1>
                    <p>If you wish to become a coach or become a trainee
                    to cultivate your skills<br></br> in the game of your choice 
                    then feel free to join our program here.</p>
                </div>
                <div class="carousel-buttons">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createAccountModal" id="start_now">Start Now</button>
                </div>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="resources/slide-1.png" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="resources/slide-2.jpg" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="resources/slide-3.jpg" class="d-block w-100" alt="Slide 3">
                </div>
            </div>
        </div>
    </div>

        <!-- List of Available Games -->
        <div class="container mt-5">
            <div class="row">
                <?php
                    $gameQuerry = mysqli_query($conn ,"SELECT g.gameDescription, COUNT(client_booster_id) AS availCoach, g.image_path 
                    FROM game g JOIN client_booster cb ON g.gameDescription = cb.game WHERE cb.status = 'Available' GROUP BY g.gameDescription ORDER BY g.gameDescription ASC");
                    while ($gameRows = mysqli_fetch_assoc($gameQuerry)) {
                        // Process each row of game data here
                        $gameName = urlencode($gameRows['gameDescription']);
                        // Generate HTML or perform operations with $gameRows data
                        $imageSrc = $gameRows['image_path'];
                ?>
                <div class="col-md-3 mb-4">
                    <a href="games.php?game=<?php echo htmlspecialchars($gameName); ?>">            
                        <div class="card text-white">
                        <?php echo '<img src="' . $imageSrc . '" class="card-img" alt="' . htmlspecialchars($gameName) . '">'; ?>
                            <div class="card-img-overlay transparent-background">
                                <h5 class="card-title"><?php echo $gameRows["gameDescription"]; ?></h5>
                                <p class="card-text">Available Coaches: <?php echo $gameRows["availCoach"]; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                    }
                ?>
                
                <!-- Add Game -->
                                
                <div class="col-md-3 mb-4">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addGameModal">
                        <div class="card bg-dark text-white">
                            <div class="card-img-overlay text-box">
                                <h5 class="card-title mt-5">Add Game<br>+</h5>
                            </div>
                        </div>
                    </button>
                </div>

                <div class="modal fade" id="addGameModal" tabindex="-1" aria-labelledby="addGameModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addGameModalLabel">Add New Game</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="gameName" class="form-label">Game Name</label>
                                        <input type="text" class="form-control" id="gameName" name="gameName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gameRanks" class="form-label">Game Ranks</label>
                                        <input type="text" class="form-control" id="gameRanks" name="gameRanks">
                                        <div id="gameRanksHelp" class="form-text">Enter comma-separated values (e.g., Gold, Silver, Bronze)</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gameImage" class="form-label">Image Upload</label>
                                        <input type="file" class="form-control" id="gameImage" name="gameImage">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="js/Homepage.js"></script>
    </body>
    <footer class="footer">
        <div class="footer__addr">
            <h1 class="footer__logo">Something</h1>
                
            <h2>Contact</h2>
            
            <address>
            5534 Somewhere In. The World 22193-10212<br>
                
            <a class="footer__btn" href="https://web.facebook.com/FranZTahadlangiTgwapo">Email Us</a>
            </address>
        </div>
        
        <ul class="footer__nav">
            <li class="nav__item">
            <h2 class="nav__title">Media</h2>

            <ul class="nav__ul">
                <li>
                <a href="#">Online</a>
                </li>

                <li>
                <a href="#">Print</a>
                </li>
                    
                <li>
                <a href="#">Alternative Ads</a>
                </li>
            </ul>
            </li>
            
            <li class="nav__item nav__item--extra">
            <h2 class="nav__title">Technology</h2>
            
            <ul class="nav__ul nav__ul--extra">
                <li>
                <a href="#">Hardware Design</a>
                </li>
                
                <li>
                <a href="#">Software Design</a>
                </li>
                
                <li>
                <a href="#">Digital Signage</a>
                </li>
                
                <li>
                <a href="#">Automation</a>
                </li>
                
                <li>
                <a href="#">Artificial Intelligence</a>
                </li>
                
                <li>
                <a href="#">IoT</a>
                </li>
            </ul>
            </li>
            
            <li class="nav__item">
            <h2 class="nav__title">Legal</h2>
            
            <ul class="nav__ul">
                <li>
                <a href="#">Privacy Policy</a>
                </li>
                
                <li>
                <a href="#">Terms of Use</a>
                </li>
                
                <li>
                <a href="#">Sitemap</a>
                </li>
            </ul>
            </li>
        </ul>
        
        <div class="legal">
            <p>&copy; 2019 Something. All rights reserved.</p>
            
            <div class="legal__links">
            <span>Made with <span class="heart">♥</span> remotely from Anywhere</span>
            </div>
        </div>
        </footer>
</html>
