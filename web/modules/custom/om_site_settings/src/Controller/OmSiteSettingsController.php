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

  	$config = \Drupal::config("om_site_settings.site_settings");
		$archive_length = $config->get("archive_length");
		$website_code = $config->get("website_code");
		$website_description = strip_tags($config->get("website_description")['value']);
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t("
        <ul>
        	<li><strong>Archive Length: </strong>$archive_length</li>
        	<li><strong>Website Code: </strong>$website_code</li>
        	<li><strong>Website Description: </strong>$website_description</li>
        </ul>
      "),
    ];

    return $build;
  }

}
