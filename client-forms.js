$(document).ready(function() {
    // Submit clicked
    $(document).on("click", ".taq-submit", function() {
        // Get the name of the client, class, and file
        var formNumber = $("#form-number").val();
        var clientName = $("#client-name").val().toUpperCase();
        var className = $("#class-name").val();
        var description = $("#class-description").val();
        var fileName = $("#file-name").val();
        var demqa_db = $('#demqa-db').val();
        var prod_db = $('#prod-db').val();
        var status = true;

        // Need the form number
        if (!$('#form-number').val()) {
            $('#form-number').css('border-color', 'red');
            status = false;
        }

        // Need at least three characters
        if ($('#client-name').val().length < 3) {
            $('#client-name').css('border-color', 'red');
            status = false;
        }

        // Need a class name
        if ($('#class-name').val().length < 6) {
            $('#class-name').css('border-color', 'red');
            status = false;
        }

        // Need a class description
        if ($('#class-description').val().length < 10) {
            $('#class-description').css('border-color', 'red');
            status = false;
        }

        if (status === false) {
            bootbox.alert('Please fix the inputs highlighted in red.');
            // Stop the submit
            return false;
        }

        // The (relative) directories we will look or or create
        var clientFormsDirectory = 'client-forms/' + clientName;
        var classDirectory = 'classes/' + clientName;

        // SQL file directory and template
        if (folderPath(clientFormsDirectory) == true) {
            if (createSqlTemplate(clientFormsDirectory, formNumber, clientName, fileName, className, demqa_db, prod_db) == false) {
                bootbox.alert('Could not create ' + clientFormsDirectory + '/' + formNumber + '-client-forms.sql');
            }
        } else {
            bootbox.alert('Could not find or create ' + clientFormsDirectory);
        }

        // Class file directory and template
        if (folderPath(classDirectory) == true) {
            if (createClassTemplate(description, clientName, className) == false) {
                bootbox.alert('Could not create ' + classDirectory + '/' + className + '.class.php');
            }
        } else {
            bootbox.alert('Could not find or create ' + classDirectory);
        }
    });

    // Reset clicked
    $(document).on("click", ".taq-reset", function() {

    });

    /**
     * Check for the existence of a directory or create it
     * 
     * @param {*} path The path we want to look for/create the folder in
     */
    function folderPath(path) {
        $.ajax({
            type: 'GET',
            url: 'directory.php',
            data: {
                folder: path
            },
            async: false,
            success: function(data) {
                if (data == 'true') {
                    result = true;
                }
            },
            error: function(data) {
                if (data == 'false') {
                    result = false;
                }
            }
        });

        return result;
    }

    /**
     * Create the custom SQL template (starter) file
     * 
     * @param {*} directory The directory to place the SQL template file in
     * @param {*} form The number of the form
     * @param {*} client The client name
     * @param {*} file The name of the file associated with this form, plus file extension
     * @param {*} theClass The name of the class
     * @param {*} demqa The name of the demqa database
     * @param {*} prod The name of the prod database
     */
    function createSqlTemplate(directory, form, client, file, theClass, demqa, prod) {
        $.ajax({
            type: 'GET',
            url: 'createSQL.php',
            data: {
                action: 'createSQL',
                directory: directory,
                form: form,
                client: client,
                file: file,
                class: theClass,
                demqa: demqa,
                prod: prod
            },
            async: false,
            success: function(data) {
                if (data == 'true') {
                    result = true;
                }
            },
            error: function(data) {
                if (data == 'false') {
                    result = false;
                }
            }
        });

        return result;
    }

    /**
     * Create the custom class.php file

     * @param {*} description A brief description of what this class does
     * @param {*} client The client name
     * @param {*} className The name of the class
     */
    function createClassTemplate(description, client, className) {
        $.ajax({
            type: 'GET',
            url: 'createClass.php',
            data: {
                action: 'createClass',
                description: description,
                client: client,
                class: className
            },
            async: false,
            success: function(data) {
                if (data == 'true') {
                    result = true;
                }
            },
            error: function(data) {
                if (data == 'false') {
                    result = false;
                }
            }
        });

        return result;
    }
});