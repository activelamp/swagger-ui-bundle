<?php
/**
 * Created by PhpStorm.
 * User: bezalelhermoso
 * Date: 6/25/14
 * Time: 10:02 AM
 */

namespace ActiveLAMP\Bundle\SwaggerUIBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class StaticResourcesController
 *
 * @author Bez Hermoso <bez@activelamp.com>
 */
class StaticResourcesController extends Controller
{
    public function resourceListAction(Request $request)
    {
        $dir = $this->getStaticResourcesDir();
        $filename = $this->getResourceListFilename();

        try {

            $finder = new Finder();
            $files = $finder->in($dir)->files()->name($filename);

            if (count($files) === 0) {
                throw new \Exception(sprintf('Cannot find resource list: %s', $filename));
            }

            foreach ($files as $file) {
                $response = new Response($file->getContents());
                $response->headers->set('Content-type', 'application/json');
                return $response;
            }

        } catch (\Exception $e) {
            throw $this->createNotFoundException($e->getMessage());
        }

    }

    public function apiDeclarationAction(Request $request, $resource)
    {
        $dir = $this->getStaticResourcesDir();
        $filename = $resource . '.json';

        try {

            $finder = new Finder();
            $files = $finder->in($dir)->files()->name($filename);

            if (count($files) === 0) {
                throw new \Exception(sprintf('Cannot find API declaration: %s', $filename));
            }

            foreach ($files as $file) {

                $data = json_decode($file->getContents(), true);
                $data['basePath'] = $request->getBaseUrl() . $data['basePath'];
                $response = new JsonResponse($data);
                return $response;
            }

        } catch (\Exception $e) {
            throw $this->createNotFoundException($e->getMessage());
        }
    }

    private function getStaticResourcesDir()
    {
        return $this->get('service_container')->getParameter('al_swagger_ui.static_resources_dir');
    }

    private function getResourceListFilename()
    {
        return $this->get('service_container')->getParameter('al_swagger_ui.static_resource_list_filename');
    }
}
