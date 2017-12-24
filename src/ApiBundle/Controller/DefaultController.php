<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Model;

class DefaultController extends Controller
{
    /**
     * @Route("/oauth/v2/token", name="fake_oAuth", methods={"POST"})
     * @SWG\Post(
     *     path="/api/oauth/v2/token",
     *     operationId="registerUser",
     *     description="Register new user",
     *     produces={"application/json"},
     *     tags={"Users"},
     *     @SWG\Parameter(
     *       name="user",
     *       in="body",
     *       description="",
     *       type="json",
     *       required=true,
     *      @SWG\Schema(
     *        type="object",
     *        @SWG\Property(
     *             type="string",
     *             property="client_id",
     *             type="string",
     *             example="1_3bcbxd9e24g0gk4swg0kwgcwg4o8k8g4g888kwc44gcc0gwwk4",
     *        ),
     *        @SWG\Property(
     *             type="string",
     *             property="client_secret",
     *             type="string",
     *             example="4ok2x70rlfokc8g0wws8c8kwcokw80k44sg48goc0ok4w0so0k",
     *        ),
     *        @SWG\Property(
     *             type="string",
     *             property="grant_type",
     *             type="string",
     *             example="password",
     *        ),
     *        @SWG\Property(
     *             type="string",
     *             property="username",
     *             type="string",
     *             example="email@founders.com",
     *        ),
     *        @SWG\Property(
     *             type="string",
     *             property="password",
     *             type="string",
     *             example="pass123",
     *        ),
     *      )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Authenticated with success"
     *     )
     * )
     * @return User|mixed
     * @throws \Exception
     */
    public function authAction(){

        // Fake Empty function to generate @ApiDoc
        return new JsonResponse([]);
    }
}
