<?php


namespace ActiveLAMP\Bundle\SwaggerUIBundle\Tests\Controller;

use ActiveLAMP\Bundle\SwaggerUIBundle\Tests\WebTestCase;

class SwaggerUIControllerTest extends WebTestCase
{
    public function testSwaggerUIPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/documentation/');

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertCount(1, $crawler->filter('#message-bar'));
        $this->assertCount(1, $crawler->filter('#swagger-ui-container'));

        $content = $response->getContent();
        $this->assertRegExp('#url:\s?"\\\/static-api-docs"#', $content);
        $this->assertRegExp('/dom_id:\s?"swagger-ui-container"/', $content);
        $this->assertRegExp('/docExpansion:\s?"full"/', $content);
        $this->assertRegExp('/sorter:\s?"alpha"/', $content);
        $this->assertRegExp('/booleanValues:\s?[0,\s?1]/', $content);
        $this->assertRegExp('/highlightSizeThreshold:\s?100/', $content);
    }

    public function testOauth()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/documentation/');

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertCount(1, $crawler->filter('#message-bar'));
        $this->assertCount(1, $crawler->filter('#swagger-ui-container'));

        $content = $response->getContent();
        $this->assertRegExp('/realm:\s?"foobar"/', $content);
        $this->assertRegExp('/initOAuth\({/', $content);
        $this->assertRegExp('/clientId:\s?8324737/', $content);
        $this->assertRegExp('/appName:\s?"ActiveLAMP Swagger UI"/', $content);
        $this->assertRegExp('/src="(.*)swagger-oauth.js"/', $content);
        $this->assertNotRegExp(
             '/window\.authorizations\.add\("key"/',
                 $content
        );
    }

    public function testExternalUrl()
    {
        $client = static::createClient(array('environment' => 'external'));
        $client->request('GET', '/documentation/');

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $this->assertRegExp('#url:\s?"http:\\\/\\\/petstore.swagger.wordnik.com\\\/api\\\/api-docs"#', $content);
    }

    public function testHttpAuth()
    {
        $client = static::createClient(array('environment' => 'external'));
        $client->request('GET', '/documentation/');

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $this->assertRegExp(
             '/window\.authorizations\.add\("key", new ApiKeyAuthorization\("api_key", key, "header"\)\);/',
             $content
        );
        $this->assertNotRegExp('/src="(.*)swagger-oauth.js"/', $content);
    }
} 