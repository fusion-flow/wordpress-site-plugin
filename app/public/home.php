<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources</title>
</head>

<body>

    <header>
        <h1>Choose from below</h1>
    </header>

    <div class="Resources">
        <div>
            <a href="/resource.php?type=<?php echo urlencode("Communication Support"); ?>">
                <p>Communication Support</p>
            </a></section>
        </div>
        <div>
            <a href="/resource.php?type=<?php echo urlencode("Therapy"); ?>">
                <p>Therapy</p>
            </a>
        </div>
        <div>
            <a href="/resource.php?type=<?php echo urlencode("Emotions and Social Life"); ?>">
                <p>Emotions and Social Life</p>
            </a>
        </div>
        <div>
            <a href="/resource.php?type=<?php echo urlencode("Getting on with life"); ?>">
                <p>Getting on with life</p>
            </a></section>
        </div>
        <div>
            <a href="/resource.php?type=<?php echo urlencode("Help with technology"); ?>">
                <p>Help with technology</p>
            </a>
        </div>
        <div>
            <a class="more-link" href="' . get_permalink() . '">Click me!</a>
        </div>
    </div>

</body>

</html>