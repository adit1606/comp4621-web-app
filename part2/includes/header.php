<?php
// shared header for every page
// set $pageTitle, $current and $useJquery before including this

date_default_timezone_set('America/Vancouver');

function navClass($page, $current) {
    return $page == $current ? ' class="current"' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aditya Subramaniam | <?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="css/style.css">
<?php if (!empty($useJquery)): ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php endif; ?>
    <script src="js/script.js"></script>
</head>
<body class="theme-court preload">

    <header>
        <h1>Aditya Subramaniam</h1>
        <p>Computing Science student &middot; Kamloops, BC</p>
        <p>Server date and time: <?php echo date('l, F j, Y \a\t g:i:s A T'); ?></p>
    </header>

    <nav>
        <ul>
            <li><a href="index.php"<?php echo navClass('profile', $current); ?>>My Profile</a></li>
            <li><a href="course.php"<?php echo navClass('course', $current); ?>>COMP 4621</a></li>
            <li><a href="contact.php"<?php echo navClass('contact', $current); ?>>Contact Me</a></li>
            <li><a href="messages.php"<?php echo navClass('messages', $current); ?>>Messages</a></li>
            <li><a href="../part3/counter.html">Click Counter</a></li>
        </ul>
    </nav>

    <main>
