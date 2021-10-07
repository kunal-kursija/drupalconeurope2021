<?php

namespace Drupal\tests\drupalconeurope2021\ExistingSite;

use weitzman\DrupalTestTraits\ExistingSiteBase;

class SumDataProviderTest extends ExistingSiteBase {

  /**
   * Test Addition
   *
   * @param int $int1
   *   Integer 1.
   * @param int $int2
   *   Integer 2.
   * @param int $expected
   *   Integer 3.
   *
   * @dataProvider numberProvider
   */
  public function testAddition(int $int1, int $int2, int $expected): void {
    $this->assertEquals($expected, $int1 + $int2);
  }

  /**
   * Data provider for Addition test.
   *
   * @return array
   *   Array Of Integers.
   */
  public function numberProvider(): array {
    return [
      [1, 1, 2],
      [2, 2, 4],
      [3, 3, 6],
    ];
  }

}
