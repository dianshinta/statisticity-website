<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statisticity";

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the thread ID from the URL
$thread_id = $_GET['id'];

// Fetch thread data from the database
$sql = "SELECT * FROM threads WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $thread_id);
$stmt->execute();
$result = $stmt->get_result();
$thread = $result->fetch_assoc();
$thread['comments'] = json_decode($thread['comments'], true);

$stmt->close();

// If a comment is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['email'])) {
    // Get the comment content
    $comment_content = $_POST['comment'];
    $comment_author = $_SESSION['email'];
    $comment_date = date('Y-m-d H:i:s');

    // Create a new comment array
    $new_comment = array(
        'author' => $comment_author,
        'content' => $comment_content,
        'date' => $comment_date
    );

    // Add the new comment to the comments array
    if (!is_array($thread['comments'])) {
        $thread['comments'] = [];
    }
    $thread['comments'][] = $new_comment;

    // Update the comments in the database
    $comments_json = json_encode($thread['comments']);
    $sql_update_comments = "UPDATE threads SET comments = ? WHERE id = ?";
    $stmt_update_comments = $conn->prepare($sql_update_comments);
    $stmt_update_comments->bind_param("si", $comments_json, $thread_id);
    $stmt_update_comments->execute();
    $stmt_update_comments->close();

    // Redirect to avoid resubmission on page refresh
    header("Location: thread.php?id=$thread_id");
    exit();
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
    <link rel="stylesheet" href="thread.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=La+Belle+Aurore&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
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
                if(isset($_SESSION['email'])) {
                    echo '<li><a href="logout.php">LOGOUT</a></li>';
                } else {
                    echo '<li><a href="login.html">LOGIN</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <div class="features-header">
        <h1>discusSTIS!</h1>
        <p>learn together, grow together.</p>
        <br><hr>
    </div>

    <div class="main">
        <div class="header">
            <h4 class="title"><?php echo htmlspecialchars($thread['content']); ?></h4>
            <p class="author">by <?php echo htmlspecialchars($thread['author']); ?></p>
        </div>

        <div class="bottom">
            <p class="subject"><?php echo htmlspecialchars($thread['subject']); ?></p>
            <p class="timestamp"><?php echo date('d/m/Y H:i:s', strtotime($thread['date'])); ?></p>
            <p class="comment-count"><?php echo count($thread['comments']); ?> comments</p>
        </div>
        
        <form method="post" id="comment-form">
            <textarea name="comment" required></textarea>
            <button type="submit" id="add-comment" class="add-comment">add comment</button>
        </form>
        <input type="hidden" id="sessionState" value="<?php echo isset($_SESSION['email']) ? 'loggedIn' : 'loggedOut'; ?>">
        <div class="comments">
            <?php if(is_array($thread['comments'])): ?>
                <?php foreach ($thread['comments'] as $comment): ?>
                    <div class="comment">
                        <div class="top-comment">
                            <p class="user"><?php echo htmlspecialchars($comment['author']); ?></p>
                            <p class="comment-ts"><?php echo date('d/m/Y H:i:s', strtotime($comment['date'])); ?></p>
                        </div>
                        <div class="comment-content"><?php echo htmlspecialchars($comment['content']); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/909e7b57cd.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addCommentButton = document.querySelector('#add-comment');
            const commentForm = document.querySelector('#comment-form');
            const sessionState = document.querySelector('#sessionState').value;

            commentForm.addEventListener('submit', function(event) {
                if (sessionState === 'loggedOut') {
                    event.preventDefault();
                    window.location.href = 'login.html';
                }
            });
        });
    </script>
</body>
</html>
