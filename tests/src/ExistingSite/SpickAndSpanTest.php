<?php

namespace Drupal\tests\drupalconeurope2021\ExistingSite;

use weitzman\DrupalTestTraits\Entity\UserCreationTrait;
use weitzman\DrupalTestTraits\ExistingSiteBase;

class SpickAndSpanTest extends ExistingSiteBase {

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
   * @param string $role
   *   Role.
   * @param array $pages
   *   Page Details.
   *
   * @throws \Behat\Mink\Exception\ExpectationException
   *   Exception on storage failure.
   * @throws \Drupal\Core\Entity\EntityStorageException
   *   Failed Expectation.
   *
   * @dataProvider pageProvider
   */
  public function testAccess(string $role, array $pages): void {
    $this->loggedInUser->addRole($role);
    $this->loggedInUser->save();

    foreach ($pages as $page) {
      $this->drupalGet($page['url']);
      $this->assertSession()->statusCodeEquals($page['code']);
    }
  }

  /**
   * Data provider to return static information to tests.
   *
   * @return array
   *   Role & Page Information.
   */
  public function pageProvider(): array {
    return [
      [
        'editor',
        [
          ['url' => 'page_a', 'code' => 200],
          ['url' => 'page_b', 'code' => 403],
        ],
      ],
      [
        'moderator',
        [
          ['url' => 'page_a', 'code' => 200],
          ['url' => 'page_b', 'code' => 200],
        ],
      ],
    ];
  }

}
