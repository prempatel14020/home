<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        input[type="file"] {
            margin: 10px 0;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery img {
            width: 150px;
            height: 150px;
            margin: 5px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Image Upload Gallery</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Upload Image</button>
        </form>
        <h2>Uploaded Images</h2>
        <div class="gallery">
            <?php
            $images = glob("uploads/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            foreach ($images as $image) {
                echo "<img src='$image' alt='Image'>";
            }
            ?>
        </div>
    </div>
</body>

</html>