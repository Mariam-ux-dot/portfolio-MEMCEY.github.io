<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/blog.css">
    <link rel="stylesheet" href="/css/mobile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;700&family=Staatliches&family=Play&display=swap">
    <title>Blog Posts</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <?php if(isset($_SESSION['post_error'])): ?>
    <div class="error-message">
        <?php echo $_SESSION['post_error']; 
        unset($_SESSION['post_error']); ?>
    </div>
    <?php endif; ?>

    <?php
        session_start();
        require_once 'db_connect.php';
        
        /* if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header("Location: login.php");
            exit();
        } */

        $monthsQuery = "SELECT DISTINCT 
                        DATE_FORMAT(post_date, '%Y-%m') as month_value,
                        DATE_FORMAT(post_date, '%M %Y') as month_display 
                        FROM posts 
                        ORDER BY post_date DESC";
        $monthsResult = $conn->query($monthsQuery);

        $selectedMonth = isset($_GET['month']) ? $conn->real_escape_string($_GET['month']) : '';

        $sql = "SELECT * FROM posts";
        if (!empty($selectedMonth)) {
            $sql .= " WHERE DATE_FORMAT(post_date, '%Y-%m') = '$selectedMonth'";
        }
        $result = $conn->query($sql);

        $posts = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }

        /**
         * Sorts an array of posts by date using bubble sort algorithm
         */
        function bubbleSortPostsByDate($posts, $ascending = false) {
            $n = count($posts);
            for ($i = 0; $i < $n; $i++) {
                for ($j = 0; $j < $n - $i - 1; $j++) {
                    $date1 = strtotime($posts[$j]['post_date']);
                    $date2 = strtotime($posts[$j + 1]['post_date']);
                    
                    if ($ascending ? $date1 > $date2 : $date1 < $date2) {
                        $temp = $posts[$j];
                        $posts[$j] = $posts[$j + 1];
                        $posts[$j + 1] = $temp;
                    }
                }
            }
            return $posts;
        }

        $sortedPosts = bubbleSortPostsByDate($posts, false);
    ?>

    <main>
        <article>
            <aside class="user-status">
                <p>Welcome, <span id="username"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Guest'; ?></span></p>
            </aside>

            <?php if(isset($_SESSION['loggedin'])): ?>
                <div>
                    <a href="logout.php">Logout</a> 
                    <a href="addEntry.php">Add Post</a>
                </div>
            <?php endif;?>

            <h1>Blog Posts</h1>
            <div>
                <form method="GET" action="viewblog.php">
                    <label>Filter by Month:</label>
                    <select name="month" id="month-select">
                        <option value="">All Posts</option>
                        <?php while($month = $monthsResult->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($month['month_value']); ?>"
                                <?php echo ($selectedMonth == $month['month_value']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($month['month_display']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <input type="submit" value="Apply Filter">
                </form>
            </div>
            <section class="blog-container">
                <?php if (count($sortedPosts) > 0): ?>
                    <?php foreach ($sortedPosts as $row): ?>
                        <div class="blog-post">
                            <h3><?php echo $row['title']; ?></h3>
                            <p class="date">
                                <?php echo date('F j, Y \a\t g:i a', strtotime($row['post_date'])), " UTC"; ?>
                            </p>
                            <div class="post-content">
                                <?php echo $row['content']; ?>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No blog posts yet.</p>
                <?php endif; ?>
            </section>
        </article>
    </main>
    
    <?php include 'footer.php'; ?>
</body>
</html>