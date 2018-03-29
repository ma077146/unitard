-- Release Notes --
-- Make sure to update the client.conf file to add this line -> define( 'CLIENT_CODEREF', 'RSI');
-- Copy over files to clients directory - ps-client-forms.css and ps-client-forms.js
-- Copy up PDF forms in the clients directory /pdf_files

-- need to add DB name 
-- for demqa - #ADD-DEMQA-DB-NAME
-- for production - #ADD-PROD-DB-NAME

replace into .client_forms
(client_forms_id, class_name, is_active) VALUES
(1, 'StandardAcknowledgement', 1),
(2, 'StandardAcknowledgement', 1),
(3, 'StandardAcknowledgement', 1);


replace into .client_forms_pdf
(client_forms_id, language_id, pdf) VALUES
(1, 1, 'AC_Background_Consent.pdf'),
(2, 1, 'CAPPS_Employees_Only_CONFIDENTIALITYAGREEMENT_8-16-2017.pdf'),
(3, 1, 'RSIEH_Employees_Only_CONFIDENTIALITYAGREEMENT_8-16-2017.pdf');

-- SELECT * FROM .form_fields;
-- replace into .form_fields
-- (form_fields_id, field_type, html_name, html_field_attributes, html_wrapper_attributes, field_type_settings, options_group_id, default_value, is_encrypted) VALUES
-- (100, 'Text', 'employee_name', NULL, NULL, NULL, NULL, '$jobseeker->getFormattedName()', 0);

-- SELECT * FROM .form_fields_options;
-- replace into .form_fields_options
-- (form_fields_options_id, options_group_id, option_value, display_order, is_active) VALUES
-- (1, 3, 'yes', 1, 1), 
-- (2, 3, 'no', 2, 1), 
-- (3, 2, '2', 2, 1), 
-- (4, 2, '3', 3, 1), 
-- (5, 2, '1', 1, 1);

-- SELECT * FROM .form_steps;
replace into .form_steps
(form_steps_id, form_reference_id, form_reference_code, step, actor) VALUES
(100, 1, 'client_form', 1, 'job_seeker'),
(105, 2, 'client_form', 1, 'job_seeker'),
(110, 3, 'client_form', 1, 'job_seeker');

-- SELECT * FROM .form_steps_contents;
replace into .form_steps_contents
(form_steps_contents_id, form_steps_id, form_fields_id, mlcode_html_block_label, display_order, parent, is_required, is_active, default_value, visibility) VALUES
(100, 100, NULL, 'background_consent_form_text', 2, 0, 0, 1, NULL, 1),
(105, 105, NULL, 'capps_confidentiality_agreement_text', 2, 0, 0, 1, NULL, 1),
(110, 110, NULL, 'rsieh_confidentiality_agreement_text', 2, 0, 0, 1, NULL, 1);

-- replace into .form_steps_contents_coordinates
-- (form_reference_id, form_reference_code, form_steps_contents_id, data_key, entry_number, language_id, pdf_page, x, y, x2, y2, pdflib_options) VALUES
-- (1, 'client_form', 69, 0, 1, 1, 1, 450, 610, 0, 0, 'fontsize=10');

replace into .multilingual_static_text
(ml_page_id, page_item, language_id, text) VALUES
-- Form 1 background check consent
(51, 'form_id1_title', 1, 'AC Background Consent Form'),
(51, 'form_id1_wizard_instructions', 1, ''),
(52, 'background_consent_form_text', 1, '<div class="message download"><p>Please download and read, and complete the <a href="[PdfUrl]">AC Background Check Consent Form (PDF)</a></p></div>'),

-- Form 2 CAPPS confidentiality agreement
(51, 'form_id2_title', 1, 'CAPPS Employee Confidentiality Agreement'),
(51, 'form_id2_wizard_instructions', 1, ''),
(52, 'capps_confidentiality_agreement_text', 1, '<div class="message download"><p>Please download and read, and complete the <a href="[PdfUrl]">CAPPS Employee Confidentiality Agreement (PDF)</a></p></div>'),

-- Form 3 RSIEH confidentiality agreement
(51, 'form_id3_title', 1, 'RSIEH Employee Confidentiality Agreement'),
(51, 'form_id3_wizard_instructions', 1, ''),
(52, 'rsieh_confidentiality_agreement_text', 1, '<div class="message download"><p>Please download and read, and complete the <a href="[PdfUrl]">RSIEH Employee Confidentiality Agreement (PDF)</a></p></div>');
 
