<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>pomodoro by statisticity</title>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="pomodoro.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=La+Belle+Aurore&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   
        <script src="https://kit.fontawesome.com/909e7b57cd.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="home.php">statisticity.</a></li>
                    <li><a href="home.php#about">ABOUT</a></li>
                    <li><a href="home.php#contact">CONTACT</a></li>
                    <li class="dropdown"><a href="home.php#wycd">FEATURES</a> <div class="dropdown-content">
                        <a href="forum.php">discusSTIS</a>
                        <a href="pomodoro.php">pomodoro focus timer</a>
                        <a href="the-flashcards.php">make flashcards!</a>
                    </div></li>
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '<li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>  LOGOUT</a></li>';
                    } else {
                        echo '<li><a href="login.html"><i class="fa-solid fa-right-to-bracket"></i>  LOGIN</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </header>
        <div class="features-header">
            <h1>pomodoro focus timer</h1>
            <p>focus better, work better.</p>
        </div>
        <section>
            <div class="container">
                <div class="panel">
                    <p id="work">work</p>
                    <p id="break">break</p>
                </div>
                
                <div class="timer">
                    <div class="circle">
                        <div class="time">
                            <p id="minutes"></p>
                            <p>:</p>
                            <p id="seconds"></p>
                        </div>
                    </div>
                </div>

                <div class="controls">
                    <button id="start" onclick="start()"><i class="fa-solid fa-play"></i></button>
                    <input type="hidden" id="sessionState" value="<?php echo isset($_SESSION['email']) ? 'loggedIn' : 'loggedOut'; ?>">
                    <i id="reset" class="fa-solid fa-arrow-rotate-left"></i>
                </div>
            </div>
        </section>

        <script src="pom_script.js"></script>
        <script>
            document.getElementById('start').addEventListener('click', function(event) {
                var sessionState = document.getElementById('sessionState').value;
                if (sessionState === 'loggedOut') {
                    event.preventDefault();
                    window.location.href = 'login.html';
                }
            });
        </script>
    </body>
</html>