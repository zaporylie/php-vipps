<?php

namespace zaporylie\Vipps\Tests\Unit\Authentication;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;
use zaporylie\Vipps\Authentication\TokenMemoryCacheStorage;
use zaporylie\Vipps\Authentication\TokenStorageInterface;
use zaporylie\Vipps\Exceptions\Authentication\InvalidArgumentException;
use zaporylie\Vipps\Model\Authorization\ResponseGetToken;

class TokenMemoryCacheStorageTest extends TestCase
{

    /**
     * @var \zaporylie\Vipps\Authentication\TokenMemoryCacheStorage
     */
    protected $token;

    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        AnnotationRegistry::registerLoader('class_exists');
        $this->serializer = SerializerBuilder::create()->build();
        $this->token = new TokenMemoryCacheStorage();
    }

    /**
     * @param string $time
     *
     * @return \zaporylie\Vipps\Model\Authorization\ResponseGetToken
     */
    protected function getToken($time = 'now')
    {
        return $this->serializer->deserialize(
            json_encode([
                'access_token' => 'test_access_token',
                'token_type' => 'test_token_type',
                'resource' => 'test_resource',
                'expires_in' => 123,
                'ext_expires_in' => 123,
                'expires_on' => (new \DateTime($time))->format('U'),
                'not_before' => (new \DateTime($time))->format('U'),
            ]),
            ResponseGetToken::class,
            'json'
        );
    }

    /**
     * @covers \zaporylie\Vipps\Authentication\TokenMemoryCacheStorage
     */
    public function testToken()
    {
        // Test setter.
        $this->assertInstanceOf(TokenStorageInterface::class, $this->token->set($token = $this->getToken()));

        // Test getter.
        $this->assertEquals($token, $this->token->get());

        // Test expiration.
        sleep(1);
        $this->assertFalse($this->token->has());

        // Test missing.
        $this->assertFalse($this->token->has());

        // Test clear.
        $this->token->set($this->getToken());
        $this->assertNotNull($this->token->get());
        $this->assertInstanceOf(TokenStorageInterface::class, $this->token->clear());
        $this->expectException(InvalidArgumentException::class);
        $this->token->get();
    }
}
