<?php
/**
 * Standard acknowledgement RSI ClientForm sublass.
 * @package WebForm\Form\ClientForm\RSI
 */

/**
 *
 * @package WebForm\Form\ClientForm\RSI
 */
class RSI_WebForm_Form_ClientForm_StandardAcknowledgement extends WebForm_Form_ClientForm {
    
    /**
     * Load the contents of a particular form step.
     *
     * @param int $step
     */
    public function loadFormStep( $step = 1 ) {
        parent::loadFormStep( $step );
        
        $this->application = ( isset( $_SESSION['application'] ) ? $_SESSION['application'] : $this->application );        
        if( $step == 1 && isset( $_SESSION['jobSeeker'] ) ) {
            // Replace tokens in text block
            $intro = $this->contents[0];
            // Replace "pdf download" link in text block
            $this->contents[0]->replace(array(
                '[PdfUrl]' => WebForm_Form_ClientForm::getPdfUrl( 'jobseeker', $this->application, NULL, $this->formId, WebForm_Form_ClientForm::PDF_DOWNLOAD )
            ));
        }
    }
}
?>
