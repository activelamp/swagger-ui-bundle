<?php

namespace ActiveLAMP\Bundle\SwaggerUIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SwaggerUIController extends Controller
{
    public function indexAction(Request $request)
    {
        $url = $this->get('service_container')->getParameter('al_swagger_ui.resource_list_url');

        $url = sprintf('%s://%s%s', $request->getScheme(), $request->getHttpHost(), $url);

        return $this->render('ALSwaggerUIBundle:SwaggerUI:index.html.twig', array(
            'resource_list_url' => $url,
        ));
    }
}
