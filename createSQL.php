<?php
if (NULL !=$_GET['action'] && $_GET['action'] == 'createSQL') {

    $directory = (NULL != $_GET['directory']) ? $_GET['directory'] : 'empty';
    $formNum = (NULL != $_GET['form']) ? $_GET['form'] : 'empty';
    $client = (NULL != $_GET['client']) ? $_GET['client'] : 'empty';
    $file = (NULL != $_GET['file']) ? $_GET['file'] : '';
    $class = (NULL != $_GET['class']) ? $_GET['class'] : 'empty';
    $demqa_db = (NULL !=$_GET['demqa']) ? $_GET['demqa'] : 'empty';
    $prod_db = (NULL !=$_GET['prod']) ? $_GET['prod'] : 'empty';

    if ($directory != 'empty' && $formNum != 'empty' && $client != 'empty' && $class != 'empty') {
        if (createSqlTemplate($directory, $formNum, $client, $file, $class, $demqa_db, $prod_db) == TRUE) {
            echo 'true';
        }
        else {
            echo 'false';
        }
    }
}

function createSqlTemplate($directory, $formNum, $client, $file, $class, $demqa_db, $prod_db) {
    // Open the templates/template.sql file.
    if ($sql_file = fopen("templates/template.sql", "r")) {

        $writeTo = fopen("client-forms/" . $client . "/" . $formNum . "-client-forms.sql", "w") 
        or die ("Unable to create SQL file!");

        // Set a few values.
        $form_field_id = $formNum * 100;
        $form_step_id = $formNum * 100;
        $form_step_id_2 = ($formNum * 100) + 1;

        while (!feof($sql_file)) {
            $line = fgets($sql_file);
            // Replace some placeholders with real values.
            $line = str_replace("#CLIENT-NAME", $client, $line);

            if (strlen($demqa_db)) {
                $line = str_replace("#ADD-DEMQA-DB-NAME", $demqa_db, $line);
            }
            
            if (strlen($prod_db)) {
                $line = str_replace("#ADD-PROD-DB-NAME", $prod_db, $line);
            }
            
            $line = str_replace("#FILE-NAME", $file, $line);
            $line = str_replace("#FORM-NUMBER", $formNum, $line);
            $line = str_replace("#CLASS-NAME", $class, $line);
            $line = str_replace("#FIRST-FIELD-ID", $form_field_id, $line);
            // This line has to be done first because it's similar to the following line.
            $line = str_replace("#TWO-FORM-STEP-ID", $form_step_id_2 , $line);
            $line = str_replace("#FORM-STEP-ID", $form_step_id, $line);
            $line = str_replace("id#", "id" . $formNum);
            
            // Write the line to the file.
            fwrite($writeTo, $line);
        }

        // Should be done; clean up.
        fclose($writeTo);
        $sql_file = NULL;
        return TRUE;
    }
    else {
        return FALSE;
    }
}
    
?>