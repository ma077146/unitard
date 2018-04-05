<?php
  /**
   * Allows job seeker to download the benefits overview TWS ClientForm subclass.
   * @package WebForm\Form\ClientForm\TWS
   */

  /**
   *
   * @package WebForm\Form\ClientForm\TWS
   */
  class TWS_WebForm_Form_ClientForm_ThreeWireBenefitsOverview extends WebForm_Form_ClientForm {

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
