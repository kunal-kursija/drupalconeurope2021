<?php

namespace Drupal\tests\drupalconeurope2021\ExistingSite;

use weitzman\DrupalTestTraits\Entity\UserCreationTrait;
use weitzman\DrupalTestTraits\ExistingSiteBase;

class DirtyTest extends ExistingSiteBase {

  use UserCreationTrait;

  /**
   * Represents Logged-In User.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $loggedInUser;

  /**
   * Set up dependencies.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   *   Exception on storage failure.
   */
  public function setUp(): void {
    parent::setUp();
    $this->loggedInUser = $this->createUser([], $this->randomString(5));
    $this->drupalLogin($this->loggedInUser);
  }

  /**
   * Test Editor Access.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   *   Exception on storage failure.
   * @throws \Behat\Mink\Exception\ExpectationException
   *   Failed Expectation.
   */
  public function testEditorAccess(): void {
    $this->loggedInUser->addRole('editor');
    $this->loggedInUser->save();

    $this->drupalGet('editing');
    $this->assertSession()->statusCodeEquals(200);

    $this->drupalGet('moderating');
    $this->assertSession()->statusCodeEquals(403);
  }

  /**
   * Test Moderator Access.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   *   Exception on storage failure.
   * @throws \Behat\Mink\Exception\ExpectationException
   *   Failed Expectation.
   */
  public function testModeratorAccess(): void {
    $this->loggedInUser->addRole('moderator');
    $this->loggedInUser->save();

    $this->drupalGet('editing');
    $this->assertSession()->statusCodeEquals(200);

    $this->drupalGet('moderating');
    $this->assertSession()->statusCodeEquals(200);
  }

}
