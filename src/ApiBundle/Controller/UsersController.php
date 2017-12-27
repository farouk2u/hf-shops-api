<?php

namespace ApiBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Swagger\Annotations as SWG;
use ApiBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\Model;


class UsersController extends Controller
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
     *             example="user1@email.com",
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
    public function authAction()
    {

        // Fake Empty function to generate @ApiDoc
        return new JsonResponse([]);
    }


    /**
     * @Route("me/shops/liked", name="liked_shops_list", methods={"GET"})
     * @SWG\Get(
     *     path="/api/me/shops/liked",
     *     operationId="shopsList",
     *     description="Get lis of liked shops",
     *     produces={"application/json"},
     *     tags={"Users"},
     *
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function likedShopsAction()
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $shops = $user->getLikedShops();

        return [
            'totalCount' => count($shops),
            'shops' => $shops
        ];
    }



    /**
     * @Route("me/shops/disliked", name="disliked_shops_list", methods={"GET"})
     * @SWG\Get(
     *     path="/api/me/shops/disliked",
     *     operationId="shopsList",
     *     description="Get lis of disliked shops",
     *     produces={"application/json"},
     *     tags={"Users"},
     *
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function disLikedShopsAction()
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $shops = $user->getDisLikedShops();

        return [
            'totalCount' => count($shops),
            'shops' => $shops
        ];
    }

    /**
     * @Route("me", name="me", methods={"GET"})
     * @SWG\Get(
     *     path="/api/me",
     *     operationId="shopsList",
     *     description="Get Current user",
     *     produces={"application/json"},
     *     tags={"Users"},
     *
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function meAction()
    {
        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $user;

    }

}
