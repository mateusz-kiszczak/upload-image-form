<?php
  require 'php/utilities.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="An example of uploading and saving files on a server side with PHP.">
  <title>Fullstack form validation</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="app-wrapper">
    <header>
      <h1>Upload to server</h1>
    </header>
    <main>
    <!-- Bookmarks - START -->
      <div class="bookmarks__wrapper">
        <section class="bookmarks">
          <h2 style="display: none;">Bookmarks</h2>
          <div id="img-bookmark" class="bookmarks__selection--active">
            <p>img</p>
          </div>
        </section>
      </div>
    <!-- Bookmarks - END -->
    
    <!-- Content - START -->
      <div class="content-wrapper">
        <?php 
          include 'php/image.php';
        ?>
      </div>
    <!-- Content - END -->       

    </main>
  </div>
</body>
</html>
        