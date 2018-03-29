<?php
if (NULL !=$_GET['action'] && $_GET['action'] == 'createClass') {

    $description = (NULL != $_GET['description']) ? $_GET['description'] : 'empty';
    $client = (NULL != $_GET['client']) ? $_GET['client'] : 'empty';
    $class = (NULL != $_GET['class']) ? $_GET['class'] : 'empty';

    if ($description != 'empty' && $client != 'empty' && $class != 'empty') {
        if (createSqlTemplate($description, $client, $class) == TRUE) {
            echo 'true';
        }
    }
    else {
        echo 'false';
    }
}

function createSqlTemplate($description, $client, $class) {
    // Open the templates/template.sql file.
    if ($class_file = fopen("templates/template.class.php", "r")) {

        $writeTo = fopen("classes/" . $client . "/" . $class . ".class.php", "w") 
        or die ("Unable to create Class file!");

        while (!feof($class_file)) {
            $line = fgets($class_file);
            // Replace some placeholders with real values.
            $line = str_replace("#CLIENT-NAME", $client, $line);
            $line = str_replace("#WHAT-THIS-CLASS-DOES", $description, $line);
            $line = str_replace("#CLASS-NAME", $class, $line);

            
            // Write the line to the file.
            fwrite($writeTo, $line);
        }

        // Should be done; clean up.
        fclose($writeTo);
        $class_file = NULL;
        return TRUE;
    }
    else {
       return FALSE;
    }
}
    
?>