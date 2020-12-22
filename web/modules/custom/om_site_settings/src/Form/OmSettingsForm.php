<?php

namespace Drupal\om_site_settings\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Omedia Site Settings form.
 */
class OmSettingsForm extends ConfigFormBase {


    const SETTINGS = 'om_site_settings.site_settings';
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'om_site_settings_om_settings';
  }

  protected function getEditableConfigNames() {
      return [
          static::SETTINGS,
      ];
  }


    /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);


    $form['archive_length'] = [
      '#type' => 'number',
      '#title' => $this->t('Archive Length'),
      "#default_value" => $config->get("archive_length"),
      '#required' => TRUE,
    ];

    $form['website_code'] = [
      '#type' => 'textfield',
        '#title' => $this->t("Website Code"),
        "#default_value" => $config->get("website_code"),
        "#required" => TRUE,
    ];
    $form["website_description"] = [
        "#type" => "text_format",
        "#title" => $this->t("Website Description"),
        "#default_value" => $config->get("website_description")["value"] ?? '',
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
      $archive_length = intval($form_state->getValue("archive_length"));
      $website_code = $form_state->getValue("website_code");
      if($archive_length > 100 || $archive_length < 1) {
          $form_state->setErrorByName("archive_length", $this->t("The Archive Length Should be between 1 and 100"));
      };
      if(substr($website_code, 0, 3) !== "OM-" || strlen($website_code) !== 8 || !is_numeric(substr($website_code, 3, 5))) {
          $form_state->setErrorByName("website_code", $this->t("Website Code should start with 'OM-' and end with any 5 numbers, etc. 'OM-12345'"));
      }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable(static::SETTINGS)
        ->set("archive_length", $form_state->getValue("archive_length"))
        ->set("website_code", $form_state->getValue("website_code"))
        ->set("website_description", $form_state->getValue('website_description'))
        ->save();
    $this->messenger()->addStatus($this->t('The Configuration Has Been Updated'));
    $form_state->setRedirect('om_site_settings.site_settings');
  }

}
