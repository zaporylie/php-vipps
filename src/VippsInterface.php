<?php

namespace Vipps;

/**
 * Interface VippsInterface
 * @package Vipps
 */
interface VippsInterface {

  /**
   * @param string $method
   *   HTTP method: GET, POST, PUT
   * @param string $uri
   *   Resource path.
   * @param array $payload
   *   Payload array.
   *
   * @return mixed
   *
   * @throws Exceptions\VippsException
   */
  public function request($method, $uri, array $payload = []);

  /**
   * Return merchant credential: serial number.
   * @return string
   */
  public function getMerchantSerialNumber();

  /**
   * Return merchant credential: merchant id.
   * @return string
   */
  public function getMerchantID();

  /**
   * Return merchant credential: token.
   * @return string
   */
  public function getToken();
}
