<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\UserDetails;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

/**
 * Class UserDetailsTest
 * @package zaporylie\Vipps\Tests\Unit\Model\Payment
 * @coversDefaultClass \zaporylie\Vipps\Model\Payment\UserDetails
 */
class UserDetailsTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\UserDetails
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->model = new UserDetails();
        $reflection = new \ReflectionClass($this->model);
        $reflectionProperty = $reflection->getProperty('bankIdVerified');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'Y');
        $reflectionProperty = $reflection->getProperty('dateOfBirth');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, '2012-02-02');
        $reflectionProperty = $reflection->getProperty('email');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'test@example.com');
        $reflectionProperty = $reflection->getProperty('firstName');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'Muchas');
        $reflectionProperty = $reflection->getProperty('lastName');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'Gracias');
        $reflectionProperty = $reflection->getProperty('mobileNumber');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, '87654321');
        $reflectionProperty = $reflection->getProperty('ssn');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, '31213121');
        $reflectionProperty = $reflection->getProperty('userId');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, '123==');
    }

    public function testBankIdVerification()
    {
        $this->assertEquals('Y', $this->model->getBankIdVerified());
    }

    public function testDateOfBirth()
    {
        $this->assertEquals('2012-02-02', $this->model->getDateOfBirth());
    }

    public function testEmail()
    {
        $this->assertEquals('test@example.com', $this->model->getEmail());
    }

    public function testFirstName()
    {
        $this->assertEquals('Muchas', $this->model->getFirstName());
    }

    public function testLastName()
    {
        $this->assertEquals('Gracias', $this->model->getLastName());
    }

    public function testMobileNumber()
    {
        $this->assertEquals('87654321', $this->model->getMobileNumber());
    }

    public function testSsn()
    {
        $this->assertEquals('31213121', $this->model->getSsn());
    }

    public function testUserId()
    {
        $this->assertEquals('123==', $this->model->getUserId());
    }
}
