<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/main.js" defer></script>
</head>

<body>
    <h1>Image Gallery</h1>
    <div class="gallery">
        <?php
        $thumb_image = 'img/thumb_img/'; // dir containing all of my thumb_images thumb_images
        $thumb_images = glob($thumb_image . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        
        foreach ($thumb_images as $image) {

            echo '<img src="' . $image . '" alt="Image" onclick="openModal(this.src)">';
        }

        $full_image = 'img/thumb_img/'; // dir containing all of my full_images full_images
        $full_images = glob($full_image . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
        ?>
    </div>

    <div class="modal" id="modal" onclick="closeModal()">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modalImage" src="" alt="Full Size Image">
    </div>


</body>

</html>