<?php

namespace Drupal\drupalconeurope2021\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class to return contents of PageA.
 */
class PageA extends ControllerBase {

  /**
   * Returns Page Markup.
   *
   * @return array
   *   Markup.
   */
  public function content(): array {
    return [
      '#markup' => 'Contents of Page A.',
    ];
  }

}
