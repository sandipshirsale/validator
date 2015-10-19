<?php

/*
 * This file is part of the codeace/validator package.
 *
 * (c) Sandip Shirsale <sandipshirsale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phpunit\validator;

use codeace\validator\validator;

/**
 * Class StopWatchTest
 * @package Phpunit\validator
 * @group codeace
 * @group codeace_validator
 * @group codeace_validator_validator
 */
class validatorTest extends \PHPUnit_Framework_TestCase
{
  
    private $valid;

    public function setUp()
    {
        $this->valid = new validator();
    }

    public function tearDown()
    {
        $this->valid = null;
    }

    /* ******************/
    /* Constructor test */
    /* ******************/
    /**
     * @group codeace_validator_validator_constructor
     */
    public function testStopWatchHaveDefaultWatch()
    {
        $default_email = $this->valid->is_valid_email('');

        $this->assertNotNull($default_email, "No email address enter");
        $this->assertInstanceOf('codeace\validator\validator', $default_email, "Not an instance of Watch");

    }


}