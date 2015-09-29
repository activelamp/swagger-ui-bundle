<?php

namespace ActiveLAMP\Bundle\SwaggerUIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Bez Hermoso <bez@activelamp.com>
 */
class SwaggerUIController extends Controller
{
    public function indexAction(Request $request)
    {
        $docUrl = $this->get('service_container')->getParameter('al_swagger_ui.resource_list');
        $jsConfig = $this->get('service_container')->getParameter('al_swagger_ui.js_config');
        $authConfig = $this->get('service_container')->getParameter('al_swagger_ui.auth_config');

        if (preg_match('/^(https?:)?\/\//', $docUrl)) {
            // If https://..., http://..., or //...
            $url = $docUrl;
        } elseif (strpos($docUrl, '/') === 0) {
            //If starts with "/", interpret as an asset.
            $url = $this->get('templating.helper.assets')->getUrl($docUrl);
        } else {
            // else, interpret as route-name.
            $url = $this->generateUrl($docUrl);
        }

        $url = rtrim($url, '/');

        return $this->render('ALSwaggerUIBundle:SwaggerUI:index.html.twig', array(
            'resource_list_url' => $url,
            'js_config' => $jsConfig,
            'auth_config' => $authConfig
        ));
    }
}
