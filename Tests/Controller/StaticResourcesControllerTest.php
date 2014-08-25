<?php


namespace ActiveLAMP\Bundle\SwaggerUIBundle\Tests\Controller;

use ActiveLAMP\Bundle\SwaggerUIBundle\Tests\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * The JSON files used for testing the StaticResourcesController are directly derived from the Swagger documents
 * used by http://petstore.swagger.wordnik.com/, and are produced by https://github.com/wordnik/rails-petstore
 *
 * @author Bez Hermoso <bez@activelamp.com>
 */
class StaticResourcesControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testResourceListRoute()
    {
        $this->client->request('GET', '/static-api-docs/');
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
             json_decode(file_get_contents(__DIR__ . '/../Application/Resources/swagger-docs/api-docs.json')),
             json_decode($response->getContent())
        );
    }

    /**
     * @dataProvider dataApiDeclarations
     *
     * @param $resource
     */
    public function testApiDeclarations($resource)
    {
        $this->client->request('GET', '/static-api-docs/' . $resource);
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals(
             json_decode(file_get_contents(__DIR__ . '/../Application/Resources/swagger-docs/' . $resource . '.json')),
             json_decode($response->getContent())
        );
    }

    public function dataApiDeclarations()
    {
        return array(
            array('pet'),
            array('user'),
            array('store'),
        );
    }

    /**
     * @dataProvider dataInvalidApiDeclarations
     *
     * @param $resource
     */
    public function testInvalidApiDeclarations($resource)
    {
        $this->client->request('GET', '/static-api-docs/' . $resource);
        $response = $this->client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function dataInvalidApiDeclarations()
    {
        return array(
            array('pets'),
            array('users'),
            array('stores'),
        );
    }
} 