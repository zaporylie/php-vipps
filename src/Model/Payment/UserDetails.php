<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class CustomerInfo
 *
 * @package Vipps\Model\Payment
 */
class UserDetails
{

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $bankIdVerified;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $dateOfBirth;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $email;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $firstName;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $lastName;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $mobileNumber;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $ssn;

  /**
   * @var string
   * @Serializer\Type("string")
   */
  protected $userId;

  /**
   * @return string
   */
  public function getBankIdVerified() {
    return $this->bankIdVerified;
  }

  /**
   * @param string $bankIdVerified
   *
   * @return $this
   */
  public function setBankIdVerified($bankIdVerified) {
    $this->bankIdVerified = $bankIdVerified;
    return $this;
  }

  /**
   * @return string
   */
  public function getDateOfBirth() {
    return $this->dateOfBirth;
  }

  /**
   * @param string $dateOfBirth
   *
   * @return $this
   */
  public function setDateOfBirth($dateOfBirth) {
    $this->dateOfBirth = $dateOfBirth;
    return $this;
  }

  /**
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param string $email
   *
   * @return $this
   */
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  /**
   * @return string
   */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
   * @param string $firstName
   *
   * @return $this
   */
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
    return $this;
  }

  /**
   * @return string
   */
  public function getLastName() {
    return $this->lastName;
  }

  /**
   * @param string $lastName
   *
   * @return $this
   */
  public function setLastName($lastName) {
    $this->lastName = $lastName;
    return $this;
  }

  /**
   * Gets mobileNumber value.
   *
   * @return string
   */
  public function getMobileNumber()
  {
    return $this->mobileNumber;
  }

  /**
   * Sets mobileNumber variable.
   *
   * @param string $mobileNumber
   *
   * @return $this
   */
  public function setMobileNumber($mobileNumber)
  {
    $this->mobileNumber = $mobileNumber;
    return $this;
  }

  /**
   * @return string
   */
  public function getSsn() {
    return $this->ssn;
  }

  /**
   * @param string $ssn
   *
   * @return $this
   */
  public function setSsn($ssn) {
    $this->ssn = $ssn;
    return $this;
  }

  /**
   * @return string
   */
  public function getUserId() {
    return $this->userId;
  }

  /**
   * @param string $userId
   *
   * @return $this
   */
  public function setUserId($userId) {
    $this->userId = $userId;
    return $this;
  }
}
