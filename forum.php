<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statisticity";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all threads from the database
$sql = "SELECT id, content, author, date, subject, comments FROM threads";
$result = $conn->query($sql);

$threads = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['comments'] = json_decode($row['comments'], true);
        $threads[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pomodoro by statisticity</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="forum.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=La+Belle+Aurore&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Wix+Madefor+Text:ital,wght@0,400..800;1,400..800&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
    <div class="features-header">
        <h1>discusSTIS!</h1>
        <p>learn together, grow together.</p>
    </div>

    <!-- Form to add a new thread -->
    <div class="new-thread">
        <form id="newThreadForm" action="add-thread.php" method="post">
            <textarea id="threadContent" name="content" placeholder="your question here" required></textarea><br>
            <input type="text" id="threadAuthor" name="author" placeholder="author" required><br>
            <div class="choose-subject">
                <select id="threadMajor" name="major" required>
                    <option value="">select major</option>
                    <option value="DIII Statistika">DIII Statistika</option>
                    <option value="DIV Statistika">DIV Statistika</option>
                    <option value="DIV Komputasi Statistik">DIV Komputasi Statistik</option>
                </select>
                <select id="threadSemester" name="semester" required>
                    <option value="">select semester</option>
                    <option value="1">1st semester</option>
                    <option value="2">2nd semester</option>
                    <option value="3">3rd semester</option>
                    <option value="4">4th semester</option>
                    <option value="5">5th semester</option>
                    <option value="6">6th semester</option>
                    <option value="7">7th semester</option>
                    <option value="8">8th semester</option>
                </select>
                <select id="threadSubject" name="subject">
                    <option value="">select subject</option>
                </select>
            </div>
            <button type="submit">add question</button>
        </form>
        <input type="hidden" id="sessionState" value="<?php echo isset($_SESSION['email']) ? 'loggedIn' : 'loggedOut'; ?>">
    </div>
    
    <div class="filter-container">
        <form id="filter-form">
            <label for="filter-major">Major:</label>
            <select id="filter-major" class="input">
                <option value="">all majors</option>
                <option value="DIII Statistika">DIII Statistika</option>
                <option value="DIV Statistika">DIV Statistika</option>
                <option value="DIV Komputasi Statistik">DIV Komputasi Statistik</option>
            </select>
            <label for="filter-semester">Semester:</label>
            <select id="filter-semester" class="input">
                <option value="">all semesters</option>
                <option value="1">1st Semester</option>
                <option value="2">2nd Semester</option>
                <option value="3">3rd Semester</option>
                <option value="4">4th Semester</option>
                <option value="5">5th Semester</option>
                <option value="6">6th Semester</option>
                <option value="7">7th Semester</option>
                <option value="8">8th Semester</option>
            </select>
            <label for="filter-subject">Subject:</label>
            <select id="filter-subject" class="input">
                <option value="">all subjects</option>
            </select>
            <button type="button" id="filter-btn">Filter</button>
        </form>
    </div>
    
    <div class="search-container">
        <input type="text" id="search-input" placeholder="search for threads...">
        <button type="button" id="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>

    <div>
        <ol id="threadList"></ol>
    </div>

    <script src="https://kit.fontawesome.com/909e7b57cd.js" crossorigin="anonymous"></script>
    <script src="forum.js"></script>
    <script>
        var threads = <?php echo json_encode($threads); ?>;
        document.addEventListener('DOMContentLoaded', () => {
            renderThreads(threads);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const newThreadForm = document.querySelector('#newThreadForm');
            const sessionState = document.querySelector('#sessionState').value;

            newThreadForm.addEventListener('submit', function(event) {
                if (sessionState === 'loggedOut') {
                    event.preventDefault();
                    window.location.href = 'login.html';
                }
            });
        });
    </script>
</body>
</html>
