-- Release Notes --
-- Make sure to update the client.conf file to add this line -> define( 'CLIENT_CODEREF', 'MAINSCAPE');
-- Copy over files to clients directory - ps-client-forms.css and ps-client-forms.js
-- Copy up PDF forms in the clients directory /pdf_files

-- need to add DB name 
-- for qa/demqa - frs_Mainscape_qa
-- for production - ercfrs_mainscape_inc

REPLACE INTO .client_forms
(client_forms_id, class_name, is_active) VALUES
(12, 'Form8850', 1);


REPLACE INTO .client_forms_pdf
(client_forms_id, language_id, pdf) VALUES
(12, 1, 'Form-8850.pdf');

-- SELECT * FROM .form_fields;
REPLACE INTO .form_fields
(form_fields_id, field_type, html_name, html_field_attributes, html_wrapper_attributes, field_type_settings, options_group_id, default_value, is_encrypted) VALUES
(1200, 'Text', 'employee_name', NULL, NULL, NULL, NULL, '$jobseeker->getFormattedName()', 0);

-- SELECT * FROM .form_fields_options;
REPLACE INTO .form_fields_options
(form_fields_options_id, options_group_id, option_value, display_order, is_active) VALUES
(1, 3, 'yes', 1, 1), 
(2, 3, 'no', 2, 1), 
(3, 2, '2', 2, 1), 
(4, 2, '3', 3, 1), 
(5, 2, '1', 1, 1);

-- SELECT * FROM .form_steps;
REPLACE INTO .form_steps
(form_steps_id, form_reference_id, form_reference_code, step, actor) VALUES
(1200, 12, 'client_form', 1, 'job_seeker'),
(1201, 12, 'client_form', 2, 'admin');

-- SELECT * FROM .form_steps_contents;
REPLACE INTO .form_steps_contents
(form_steps_contents_id, form_steps_id, form_fields_id, mlcode_html_block_label, display_order, parent, is_required, is_active, default_value, visibility) VALUES
(1, 1, NULL, 'form_text', 2, 0, 0, 1, NULL, 1);

REPLACE INTO .form_steps_contents_coordinates
(form_reference_id, form_reference_code, form_steps_contents_id, data_key, entry_number, language_id, pdf_page, x, y, x2, y2, pdflib_options) VALUES
(12, 'client_form', 69, 0, 1, 1, 1, 450, 610, 0, 0, 'fontsize=10');

REPLACE INTO .multilingual_static_text
(ml_page_id, page_item, language_id, text) VALUES
-- Form 1 background check consent
(51, 'form_id1_title', 1, 'Form Title Here'),
(51, 'form_id1_wizard_instructions', 1, ''),
(52, 'form_text', 1, '<div class="message download"><p>Please download and read, and complete the <a href="[PdfUrl]">Form Title Here (PDF)</a></p></div>');