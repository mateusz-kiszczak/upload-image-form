<?php
  $message              = '';
  $moved                = false;
  $latest_img           = '';
  $error                = '';
  $upload_path          = 'uploads/img/';
  $max_size             = 5242880;
  $allowed_types        = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
  $allowed_extentions   = ['jpeg', 'jpg', 'png', 'gif'];
  $all_img                = scandir($upload_path);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for size error.
    $error = ($_FILES['image']['error'] === 1) ? 'too big ' : ''; 

    if ($_FILES['image']['error'] === 0) {
      // Check file size.
      $error .= ($_FILES['image']['size'] <= $max_size) ? '' : 'too big';
      // Check media types.
      $type    = mime_content_type($_FILES['image']['tmp_name']);
      $error  .= in_array($type, $allowed_types) ? '' : 'wrong type';
      // Check file extention.
      $extention = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
      $error    .= in_array($extention, $allowed_extentions) ? '' : 'wrong file extension';

      // Upload message
      $message    = '<span>File:</span> ' . $_FILES['image']['name'] . '<br>';
      $message   .= '<span>Size:</span> ' . $_FILES['image']['size'] . ' bytes';
      
      if (!$error) {
        $filename     = create_filename($_FILES['image']['name'], $upload_path);
        $destination  = $upload_path . $filename;
        $moved        = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
      }
    } else {
      $message = 'This file could not be uploaded.';
    }

    if ($moved) {
      $message .= '<br><span>Status:</span> Success';
      $latest_img = '<img src="' . $destination . '"/>';
    } else {
      $message .= '<br><span>Status:</span> Failed';
    }
  }
?>

<section id="img-section" class="form-section form-section--active">
  <h2>Upload Image</h2>
  <p class="upload-message"> <?= $message ?> </p>
  <form class="form" action="index.php" method="POST" enctype="multipart/form-data">
    <div>
      <label class="form__label" for="image">Upload file:</label>
      <input class="form__choose-image" type="file" name="image" accept="image/*" id="image">
      <input class="form__upload" type="submit" value="upload">
    </div>
  </form>
  <section>
    <h3>Current upload</h3>
    <div class="img-section__latest-img">
      <?= $latest_img ?>
    </div>
  </section>
  <section>
    <h3>All saved images</h3>
    <div class="img-section__saved-img">
      <?php 
        for ($i = 2; $i < count($all_img); $i++) {
          echo '<div><img src="' . $upload_path . $all_img[$i] . '"></div>';
        }
      ?>
    </div>
  </section>
</section>
