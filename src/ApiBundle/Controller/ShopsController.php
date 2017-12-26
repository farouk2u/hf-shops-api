<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Shop;
use ApiBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;

class ShopsController extends Controller
{
    /**
     * @Route("shops", name="shops_list", methods={"GET"})
     * @SWG\Get(
     *     path="/api/shops",
     *     operationId="shopsList",
     *     description="Get lis of shops",
     *     produces={"application/json"},
     *     tags={"Shops"},
     *
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function indexAction()
    {
        $shopsRepo =  $this->getDoctrine()->getManager()->getRepository('ApiBundle:Shop');

        $shops = $shopsRepo->findAll();

        return [
            'totalCount' => count($shops),
            'shops' => $shops
        ];
    }



    /**
     *@Route("shops/{id}/like", methods={"POST"})
     *@SWG\Post(
     *     path="/api/shops/{id}/like",
     *     operationId="shopsList",
     *     description="Like shop",
     *     produces={"application/json"},
     *     tags={"Shops"},
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       description="shop id",
     *       type="integer",
     *       required=true),
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     * @param Shop $shop
     * @return User
     */
    public function likeAction(Shop $shop)
    {
        if(!$shop) {
            // @TODO : throw exception
        }

        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $user->removeDisLikedShop($shop); // Remove from disLiked Shops if exists
        $user->addLikedShop($shop);

        $em =  $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();

        return $user;
    }

    /**
     * @Route("shops/{id}/like", methods={"DELETE"})
     * @SWG\Delete(
     *     path="/api/shops/{id}/like",
     *     operationId="shopsList",
     *     description="Like shop",
     *     produces={"application/json"},
     *     tags={"Shops"},
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       description="shop id",
     *       type="integer",
     *       required=true),
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     * @param Shop $shop
     * @return Shop
     */
    public function unlikeAction(Shop $shop)
    {
        if(!$shop) {
            // @TODO : throw exception
        }

        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();


        $user->removeLikedShop($shop);

        $em =  $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $shop;
    }

    /**
     * @Route("shops/{id}/dislike", methods={"POST"})
     * @SWG\Post(
     *     path="/api/shops/{id}/dislike",
     *     operationId="shopDisLike",
     *     description="disLike shop",
     *     produces={"application/json"},
     *     tags={"Shops"},
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       description="shop id",
     *       type="integer",
     *       required=true),
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     * @param Shop $shop
     * @return User
     */
    public function dislikeAction(Shop $shop)
    {
        if(!$shop) {
            // @TODO : throw exception
        }

        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $user->removeLikedShop($shop); // Remove from liked Shops if exists
        $user->addDisLikedShop($shop);

        $em =  $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();

        return $user;
    }

    /**
     *@Route("shops/{id}", name="shop_details", methods={"GET"})
     *@SWG\Get(
     *     path="/api/shops/{id}",
     *     operationId="shopsList",
     *     description="Get single shop",
     *     produces={"application/json"},
     *     tags={"Shops"},
     *     @SWG\Parameter(
     *       name="id",
     *       in="path",
     *       description="shop id",
     *       type="integer",
     *       required=true),
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *      @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     *
     * @param $shop
     * @return Shop
     */
    public function detailsAction(Shop $shop){

        if(!$shop) {
            // @TODO : throw exception
        }

        return $shop;

    }

}
