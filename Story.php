<!-- about.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="style.css" rel="stylesheet">
  <style>
    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #28666e;
        color: #fff;
        text-decoration: none;
        border: 2px solid #28666e; /* Add border */
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    /* Button hover effect */
    .button:hover {
        background-color: #28666e;
        border-color: #28666e; /* Change border color on hover */
    }
  </style>
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

    <main>
        <h1>About Daniel</h1>

      <p class="justified-text"> Daniel was an incredibly kind, intelligent and admirable young man. He was born in January 1997 to Aidan and Marie. Daniel was the first born and had three younger siblings, Orla, Conor and Aoife. Daniel adored his family.</p>

      <p class="justified-text"> Daniel went to school locally in Portmarnock before continuing his education in UCD where he studied Actuarial Science. He excelled in his studies and won multiple awards. Daniel had a great group of friends who he went to school with, especially Jamie and Gavin. They all graduated from UCD together in 2019. Daniel enjoyed many hobbies including poker, chess, hiking, running and kayaking. </p> 
        
      <p class="justified-text"> After finishing college he went on to work for Susquehanna International Group as a Quantitative Trader. He loved working here, it was his dream job. </p>

      <p class="justified-text"> During his first year of college in 2015, Daniel met his partner Hollie. They had an incredibly loving relationship and were truly best friends. In December 2021, they moved into their first home together. </p>

      <p class="justified-text"> On Sunday 12th June 2022 Daniel went for a run in Malahide Castle. He suffered a cardiac arrest near the cricket ground and despite the incredible efforts of those who helped him and the emergency services, he passed away. </p>

      <p class="justified-text"> We are all heartbroken by the loss of Daniel. He was a big personality with a quick wit, a gentle nature and a lot of love to give. Daniel had an incredibly bright future ahead of him.</p>

      <p class="justified-text"> The Mater Hospital Foundation do incredible work in screening for heart conditions and have been supportive of us all during this time. You can learn more about the work they do and support them at the following website.</p>
                                                                                                                                                                                                                                         <a href="https://www.materfoundation.ie/" class="button">The Mater Hospital Foundation</a>

      <p class="justified-text"> Daniel loved music and was known to have an ecclectic taste. If you would like to listen to some of his playlists, you can follow his Spotify. </p>

       <a href="https://open.spotify.com/user/11133489618" class="button"> Daniel's Spotify</a>
                                                                                                                                                                                                                                 

        <!-- Image container -->
        <div id="image-container">
            <?php
                // Directory path
                $dir = 'images/';

                // Get all files in the directory
                $files = scandir($dir);

                // Display images
                foreach($files as $file) {
                    if (in_array($file, array(".", ".."))) continue;
                    echo '<img src="' . $dir . $file . '" alt="' . $file . '">';
                }
            ?>
        </div>
    </main>

  <footer>
      <!-- Empty footer -->
  </footer>
  
</body>
</html>


