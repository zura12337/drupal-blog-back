<?php

namespace Drupal\om_site_settings\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Omedia Site Settings routes.
 */
class OmSiteSettingsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
