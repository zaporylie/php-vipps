<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class LogisticsOption.
 *
 * @package Vipps\Model\Checkout
 */
class LogisticsOption
{

    /**
     * @var \zaporylie\Vipps\Model\Checkout\RequestAmount
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\RequestAmount")
     */
    protected $amount;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $id;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $priority;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $brand;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $product;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     */
    protected $isDefault;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * Gets amount.
     *
     * @return \zaporylie\Vipps\Model\Checkout\RequestAmount
     */
    public function getAmount(): RequestAmount
    {
        return $this->amount;
    }

    /**
     * Sets amount.
     *
     * @param \zaporylie\Vipps\Model\Checkout\RequestAmount $amount
     *
     * @return $this
     */
    public function setAmount(RequestAmount $amount): LogisticsOption
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Gets id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): LogisticsOption
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets priority.
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Sets priority.
     *
     * @param int $priority
     *
     * @return $this
     */
    public function setPriority(int $priority): LogisticsOption
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Gets brand.
     *
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * Sets brand.
     *
     * @param string $brand
     *
     * @return $this
     */
    public function setBrand(string $brand): LogisticsOption
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * Gets product.
     *
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * Sets product.
     *
     * @param string $product
     *
     * @return $this
     */
    public function setProduct(string $product): LogisticsOption
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Gets "is default" boolean value.
     *
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * Sets "is default" boolean value.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setIsDefault(bool $value): LogisticsOption
    {
        $this->isDefault = $value;
        return $this;
    }

    /**
     * Gets description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): LogisticsOption
    {
        $this->description = $description;
        return $this;
    }
}
