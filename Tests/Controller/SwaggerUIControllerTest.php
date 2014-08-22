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

    public function testExternalUrl()
    {
        $client = static::createClient(array('environment' => 'external'));
        $crawler = $client->request('GET', '/documentation/');

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $this->assertRegExp('#url:\s?"http:\\\/\\\/petstore.swagger.wordnik.com\\\/api\\\/api-docs"#', $content);
    }
} 