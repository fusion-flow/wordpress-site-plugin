<?php 

$resources = array(
    [
        "title"=>"Community Aphasia Groups",
        "description"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Magna fermentum iaculis eu non diam phasellus vestibulum lorem. Sem integer vitae justo eget. Posuere ac ut consequat semper viverra nam libero justo. Sed odio morbi quis commodo odio. Adipiscing diam donec adipiscing tristique risus nec. Metus aliquam eleifend mi in. Enim neque volutpat ac tincidunt vitae semper quis. Vestibulum morbi blandit cursus risus at. Tempor orci eu lobortis elementum nibh. Arcu dictum varius duis at consectetur. Diam quis enim lobortis scelerisque fermentum dui faucibus. Convallis tellus id interdum velit laoreet id donec. Placerat in egestas erat imperdiet sed euismod nisi. Interdum velit laoreet id donec ultrices tincidunt. Egestas diam in arcu cursus euismod quis viverra nibh."
    ],
    [
        "title"=>"Interact Ability",
        "description"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Magna fermentum iaculis eu non diam phasellus vestibulum lorem. Sem integer vitae justo eget. Posuere ac ut consequat semper viverra nam libero justo. Sed odio morbi quis commodo odio. Adipiscing diam donec adipiscing tristique risus nec. Metus aliquam eleifend mi in. Enim neque volutpat ac tincidunt vitae semper quis. Vestibulum morbi blandit cursus risus at. Tempor orci eu lobortis elementum nibh. Arcu dictum varius duis at consectetur. Diam quis enim lobortis scelerisque fermentum dui faucibus. Convallis tellus id interdum velit laoreet id donec. Placerat in egestas erat imperdiet sed euismod nisi. Interdum velit laoreet id donec ultrices tincidunt. Egestas diam in arcu cursus euismod quis viverra nibh."
    ],
);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources</title>
</head>

<body>

    <header>
        <h1>Communication Support Resources</h1>
    </header>

    <?php
        foreach ($resources as $resource) {
            echo "<h2>{$resource['title']}</h2>";
            echo "<p>{$resource['description']}</p>";
            echo "<hr>"; // Optional separator
        }
    ?>
</body>

</html>


