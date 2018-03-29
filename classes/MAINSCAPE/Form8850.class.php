<?php
  /**
   * Required Form MAINSCAPE ClientForm subclass.
   * @package WebForm\Form\ClientForm\MAINSCAPE
   */

  /**
   *
   * @package WebForm\Form\ClientForm\MAINSCAPE
   */
  class MAINSCAPE_WebForm_Form_ClientForm_Form8850 extends WebForm_Form_ClientForm {

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
