<?php

if (NULL != $_GET['folder']) {
    if (is_dir($_GET['folder'])) {
      // Directory already exists.
       echo 'true';
    }
    else {
      // Directory doesn't exist; try to create it.
      if (!mkdir($_GET['folder'], 0755, true)) {
        echo 'false';
      }
       echo 'true';
     }
}
?>