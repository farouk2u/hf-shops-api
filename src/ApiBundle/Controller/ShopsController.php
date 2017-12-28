<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Shop;
use ApiBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     *     @SWG\Parameter(name="latitude", in="query", required=true, type="string", default="31.6609186", description="latitude"),
     *     @SWG\Parameter(name="longitude", in="query", required=true, type="string", default="-8.022834999999999", description="longitude"),
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN", description="Authorization"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function indexAction(Request $request)
    {

        // Get geo coordinates
        $latitude = $request->query->get('latitude');
        $longitude = $request->query->get('longitude');


        $shops = $this->getDoctrine()->getRepository('ApiBundle:Shop')
                                       ->findAllOrderedByDistance($latitude, $longitude);


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
            throw new NotFoundHttpException("Shop not found");
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
            throw new NotFoundHttpException("Shop not found");
        }

        /** @var User $user */
        $user = $this->get('security.token_storage')->getToken()->getUser();


        $user->removeLikedShop($shop);

        $em =  $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $user;
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
            throw new NotFoundHttpException("Shop not found");
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
            throw new NotFoundHttpException("Shop not found");
        }

        return $shop;

    }

}
