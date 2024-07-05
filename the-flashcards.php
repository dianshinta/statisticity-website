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
    <link rel="stylesheet" href="the-flashcards.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=La+Belle+Aurore&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/909e7b57cd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php#home">statisticity.</a></li>
                <li><a href="home.php#about">ABOUT</a></li>
                <li><a href="home.php#contact">CONTACT</a></li>
                <li class="dropdown">
                    <a href="home.php#wycd">FEATURES</a>
                    <div class="dropdown-content">
                        <a href="forum.php">discussTIS</a>
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

    <div class="features-header">
        <h1>flashcards time!</h1>
        <p>customize your own & memorize better.</p>
    </div>

        <!-- Filter form -->
    <div class="filter-container">
        <label for="filter-major">Major:</label>
        <select id="filter-major" class="input">
            <option value="">All Majors</option>
            <option value="DIII Statistika">DIII Statistika</option>
            <option value="DIV Statistika">DIV Statistika</option>
            <option value="DIV Komputasi Statistik">DIV Komputasi Statistik</option>
            <!-- Add more majors as needed -->
        </select>
        <label for="filter-semester">Semester:</label>
        <select id="filter-semester" class="input">
            <option value="">Select Semester</option>
            <option value="1">1st semester</option>
            <option value="2">2nd semester</option>
            <option value="3">3rd semester</option>
            <option value="4">4th semester</option>
            <option value="5">5th semester</option>
            <option value="6">6th semester</option>
            <option value="7">7th semester</option>
            <option value="8">8th semester</option>
            <!-- Add more semesters as needed -->
        </select>
        <label for="filter-subject">Subject:</label>
        <select id="filter-subject" class="input">
            <option value="">All Subjects</option>
            <!-- These options will be dynamically updated based on selected major and semester -->
        </select>
        <button id="filter-btn">Filter</button>
    </div>


    <div class="container">
        <div class="add-flashcard-con">
          <button id="add-flashcard">add flashcard</button>
          <input type="hidden" id="sessionState" value="<?php echo isset($_SESSION['email']) ? 'loggedIn' : 'loggedOut'; ?>">
        </div>
        <div id="card-con">
          <div class="card-list-container"></div>
        </div>
    </div>

    <div class="question-container hide" id="add-question-card">
        <h3>Add Flashcard</h3>
        <form id="add-flashcard-form" action="add-flashcard.php" method="post">
            <div class="wrapper">
                <div class="error-con">
                    <span class="hide" id="error">Input fields cannot be empty!</span>
                </div>
                <i class="fa-solid fa-xmark" id="close-btn"></i>
            </div>
            <input type="hidden" id="flashcard-id" value="">
            <label for="major">Major:</label>
            <select id="major" class="input" name="major" required>
                <option value="">Select Major</option>
                <option value="DIII Statistika">DIII Statistika</option>
                <option value="DIV Statistika">DIV Statistika</option>
                <option value="DIV Komputasi Statistik">DIV Komputasi Statistik</option>
            </select>
            <label for="semester">Semester:</label>
            <select id="semester" class="input" name="semester" required>
                <option value="">Select Semester</option>
                <option value="1">1st semester</option>
                <option value="2">2nd semester</option>
                <option value="3">3rd semester</option>
                <option value="4">4th semester</option>
                <option value="5">5th semester</option>
                <option value="6">6th semester</option>
                <option value="7">7th semester</option>
                <option value="8">8th semester</option>
            </select>
            <label for="subject">Subject:</label>
            <select id="subject" class="input" name="subject" required>
                <option value="">Select Subject</option>
            </select>
            <label for="question">Question:</label>
            <textarea id="question" class="input" name="question" placeholder="Type the question here..." rows="2" required></textarea>
            <label for="answer">Answer:</label>
            <textarea id="answer" class="input" name="answer" placeholder="Type the answer here..." rows="4" required></textarea>
            <button id="save-btn" type="submit" style="padding: 0.5em 0.6em">Save</button>
        </form>
    </div>


    <script src="the-flashcards.js"></script>
    <script>
        document.getElementById('add-flashcard').addEventListener('click', function(event) {
            var sessionState = document.getElementById('sessionState').value;
            if (sessionState === 'loggedOut') {
                event.preventDefault();
                window.location.href = 'login.html';
            }
        });
    </script>
</body>
</html>