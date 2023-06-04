<?php
  function create_filename($filename, $upload_path) {
    $basename   = pathinfo($filename, PATHINFO_FILENAME);
    $extension  = pathinfo($filename, PATHINFO_EXTENSION);
    // Clean $basename from special characters.
    $basename   = preg_replace('/[^A-z0-9]/', '-', $basename);

    // Manage files with duplicate names by adding 'counter' to the file's name.
    $i = 0;   // Counter
    while (file_exists($upload_path . $filename)) {
      $i = $i + 1;
      $filename = $basename . $i . '.' . $extension;
    }

    return $filename;
  }
?>
