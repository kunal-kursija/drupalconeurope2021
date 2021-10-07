<?php

namespace Drupal\drupalconeurope2021\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class to return contents of '/Editing'.
 */
class Editing extends ControllerBase {

  /**
   * Returns Page Markup.
   *
   * @return array
   *   Markup.
   */
  public function content(): array {
    return [
      '#markup' => "Contents of Page '/Editing'.",
    ];
  }

}
