<header>
    Mariam El Machati Corrit El Yemlahi
    <nav>
        <a href="about.php">About Me</a>
        <a href="skills.php">Skills</a>
        <a href="education.php">Education</a>
        <a href="experience.php">Experience</a>
        <a href="projects.php">Projects</a>
        <a href="viewBlog.php">Blog</a>
        <!-- <a href="../login.php">Login</a> -->
    </nav>
    <?php 
        if(isset($_SESSION['loggedin'])): ?>
            <a href="logout.php">Logout</a>
            <a href="addEntry.php">Add Post</a>
            <a href="viewBlog.php">View Posts</a>
        <?php else: ?>
            <a href="login.php">Login</a>
    <?php endif; ?>
</header>