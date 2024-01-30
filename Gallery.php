<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
  <link href="style.css" rel="stylesheet">
    
</head>
<body>

  <header>
      <nav>
          <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="Story.php">Story</a></li>
              <li><a href="Memories.html">Memories</a></li>
              <li><a href="Gallery.php">Gallery</a></li>
              <li><a href="Contact.html">Contact</a></li>
          </ul>
      </nav>
  </header>
  
    <h1>Gallery</h1>
    <div class="scrollable-container">
        <div class="scrollable-gallery">
            <?php
            // Directory where images are stored
            $imageDirectory = 'images/';

            // Get all image files from the directory
            $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif,JPG}', GLOB_BRACE);

            // Output each image in a grid
            foreach ($images as $image) {
                echo '<div class="gallery-item">';
                echo '<img src="' . $image . '" alt="Gallery Image">';
                echo '</div>';
            }
            ?>
        </div>
    </div>

  <footer>
      <!-- Empty footer -->
  </footer>
</body>
</html>