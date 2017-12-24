<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Swagger\Annotations as SWG;

class DefaultController extends Controller
{
    /**
     * @Route("/api/shops", name="homepage")
     * @Method("GET")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the rewards of an user"
     * )
     * @SWG\Tag(name="Shops")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return ['success' => 1];
    }
}
