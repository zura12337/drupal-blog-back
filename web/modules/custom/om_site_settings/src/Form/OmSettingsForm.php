<?php

namespace Drupal\om_site_settings\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Omedia Site Settings form.
 */
class OmSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'om_site_settings_om_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['archive_length'] = [
      '#type' => 'number',
      '#title' => $this->t('Archive Length'),
      '#required' => TRUE,
    ];

    $form['website_code'] = [
      '#type' => 'textfield',
        '#title' => $this->t("Website Code"),
        "#required" => TRUE,
    ];
    $form["website_description"] = [
        "#type" => "text_format",
        "#title" => $this->t("Website Description"),
        "#required" => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (mb_strlen($form_state->getValue('message')) < 10) {
      $form_state->setErrorByName('name', $this->t('Message should be at least 10 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');
  }

}
