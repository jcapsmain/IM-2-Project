<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKBD | Landing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <style>
        @keyframes imageCycle {
            0% { background-image: url('resources/Landing_Content/CS2.jpeg'); }
            25% { background-image: url('resources/Landing_Content/OW2.jpg'); }
            50% { background-image: url('resources/Landing_Content/RB6.jpg'); }
            75% { background-image: url('resources/Landing_Content/RKL.jpg'); }
            100% { background-image: url('resources/Landing_Content/CS2.jpeg'); }
        }
        body, html {
            height: 100%;
            margin: 0;  
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #0b1d28;              /* Right about here naa ang Animation code*/
            background-image: url('resources/Landing_Content/CS2.jpeg');
            background-size: cover;
            background-position: center;
            animation: imageCycle 20s infinite;
            animation-timing-function: ease-in-out;
            font-family: 'Audiowide', cursive;
            color: #e0e6ed;
        }
        .container-box {
            width: 70%;
            max-width: 700px;
            height: auto;
            padding: 30px;
            background-color: rgba(16, 43, 63, 0.85);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            text-align: center;
        }
        .header {
            margin-bottom: 1.5rem;
        }
        .header h1 {
            font-size: 2.2em;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .header h2 {
            font-size: 1.2em;
            font-weight: lighter;
            color: #c0c0c0;
        }
        .button {
            margin-top: 2rem;
            padding: 15px 30px;
            font-size: 1.2em;
            font-weight: bold;
            background-color: #007bff;
            color: #e0e6ed;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .subtext {
            font-size: 1em;
            color: #c0c0c0;
            margin-top: 1rem;
        }
        footer {
            width: 100%;
            height: 50px;
            text-align: center;
            padding: 10px 0;
            background-color: #102b3f;
            color: #e0e6ed;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container container-box">
        <div class="header">
            <h1>Welcome to SKBD.gg</h1>
            <h2>We do not condone illegal activities</h2>
        </div>
        <a href="Homepage.php" class="button">Let's Get Started</a>
        <div class="subtext">
            <p>Boost your gaming experience with top-notch coaching and player guides.</p>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 GameBoosting.gg. All rights reserved.</p>
    </footer>
</body>
</html>
