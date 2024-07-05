<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>statisticity</title>
        <link rel="stylesheet" href="home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=La+Belle+Aurore&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/909e7b57cd.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="#home">statisticity.</a></li>
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                    <li class="dropdown"><a href="#wycd">FEATURES</a> 
                        <div class="dropdown-content">
                            <a href="forum.php">discusSTIS</a>
                            <a href="pomodoro.php">pomodoro focus timer</a>
                            <a href="the-flashcards.php">make flashcards!</a>
                        </div>
                    </li>
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

        <section id="home">
            <div class="welcoming-words">
                <p>welcome to</p>
                <h1>statisticity</h1>
            </div>
            <div class="home-quote">
                empower learning, foster growth.
            </div>
        </section>

        <section id="about">
            <div class="about-header">
                <p>about</p>
                <h1>statisticity.</h1>
            </div>
            <div class="about-content">
                <p><span>statisticity.</span>&nbsp;is the brainchild of Putu Dian Shinta Prativi, a Statistical Computing student at STIS Polytechnic of Statistics, 
                    created during her sophomore year as the final project for the Web Programming lecture. As a passionate advocate for student productivity and growth, 
                    Shinta recognized the need for a dedicated platform where students could collaborate, discuss, and enhance their learning experience.
                    At <span> statisticity.</span>, we offer a plethora of invaluable tools tailored to your needs! From studySpot for collaborative learning to the 
                    Pomodoro Focus Timer, Flashcards, and customizable Study Goals, our platform is designed to streamline your academic journey.
                    With <span> statisticity.</span>, we aspire to simplify lectures, boost study efficiency, and facilitate effective learning. Here's to making 
                    learning a breeze and achieving academic success! Happy studying, stat!
            </div>
        </section>

        <section id="contact">
            <div class="contact-header">
                <p>have something to say?</p>
                <h1>contact us here.</h1>
            </div>
            <div class="content-container">
                <div class="contact-content1">
                    <p><span><i class="fa-solid fa-location-dot"></i></span> Jl Otto Iskandardinata 64C, East Jakarta</p>
                    <p><span><i class="fa-solid fa-envelope"></i> 222212822@stis.ac.id</span></p>
                    <p><span><i class="fa-brands fa-whatsapp"></i></span> +6282243868580</p>
                    <p><span><i class="fa-brands fa-instagram"></i></span> @statisticity</p>
                </div>
                
            </div>
        </section>

        <section id="wycd">
            <div class="wycd-header">
                <p>here are the</p>
                <h1>things you can do!</h1>
            </div>

            <div class="card-container">
                <a href="forum.php">
                    <div class="card-item">
                        discusSTIS
                        <p><br>discusSTIS is a place where you can ask anything about any lectures and then be answered by fellow stats.
                            if you are willing to help your friends too, you can also answer your fellow stats' questions and be
                            their hero!
                        </p>
                    </div>
                </a>
                <a href="pomodoro.php">
                    <div class="card-item">
                        pomodoro focus timer
                        <p><br>be more focus when studying, doing homework, and working on anything with pomodoro focus timer. you have 25 minutes
                            to focus on your work and then 5 minutes break to rest yourself. it helps you work efficiently and effectively!
                        </p>
                    </div>
                </a>
                <a href="the-flashcards.php">
                    <div class="card-item">
                        make flashcards
                        <p><br>having trouble with memorizing your lectures? making flashcards is one of the method that is proven to help you study
                        and memorize better! make your own flashcards and nail those exams!
                        </p>
                    </div>
                </a>
            </div>
        </section>

        <footer>
            <span><a href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCJlJWFhCPfpRbjrTpMpGWFRgnHvSBczMGTqhKhzdfnVQrZJbPXFFvxCxDTGdzGgztXJBLJq" 
                target="_blank"><i class="fa-solid fa-envelope"></i></a></span><span> <a href="https://wa.me/082243868580?text=I%20got%20a%20message%20for%20you%20about%20statisticity!" 
                target="_blank"><i class="fa-brands fa-whatsapp"></i></a> <a href="https://www.instagram.com/direct/t/shiinn97" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </span>
            <p>created by Putu Dian Shinta Prativi</p>
        </footer>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for all anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
        </script>
    </body>
</html>