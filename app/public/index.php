<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
// define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';

?>

<?php
echo "Silence is golden.";
echo "<script>console.log('this is a Variable: ' );</script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Home Page</title>
</head>
<body>

    <header>
        <h1>Welcome to My Website</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>About Us</h2>
            <p>This is a simple home page created using PHP and HTML.</p>
        </section>

        <section>
            <h2>Contact Us</h2>
            <p>You can reach us at <a href="mailto:info@example.com">info@example.com</a>.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 My Website. All rights reserved.</p>
    </footer>

</body>
</html>

<script> 
 console.log('this is a Variable:');
</script>
