<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Entity\User;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use ApiBundle\Form\RegistrationType;
use Symfony\Component\Form\FormInterface;


class RegistrationController extends Controller
{


    /**
     * @Route("/register", name="user_register", methods={"POST"})
     * @SWG\Post(
     *     path="/api/register",
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
     *             property="email",
     *             type="string",
     *             example="email@mail.ma",
     *        ),
     *        @SWG\Property(
     *             type="string",
     *             property="plainPassword",
     *             type="string",
     *             example="pass123",
     *        ),
     *      )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Singed-up with success"
     *     )
     * )
     * @param Request $request
     * @return User|mixed
     * @throws \Exception
     */
    public function registerAction(Request $request)
    {

        // Get params
        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('plainPassword');

        $em = $this->getDoctrine()->getManager();
        $checkUserUsername = $em->getRepository("ApiBundle:User")->findByUsername($username);
        $checkUserEmail = $em->getRepository("ApiBundle:User")->findByEmail($email);

        if($checkUserUsername || $checkUserEmail){
            throw new \Exception("Username or email already exist",401);
        }

        /** @var \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        /** @var \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        /** @var Users $user */
        $user = $userManager->createUser();
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm(RegistrationType::class,$user);

        $form->setData($user);

        $this->processForm($request, $form);

        if (!$form->isValid()) {
            throw new BadRequestHttpException($form->getErrors(true, false));
        }

        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(
            FOSUserEvents::REGISTRATION_SUCCESS, $event
        );

        /** @var User $user */
        $user->setEnabled(1);
        $user->addRole('ROLE_USER');
        $user->setPlainPassword( $password );

        $userManager->updateUser($user);

       return $user;

    }

    /**
     * @param Request $request
     * @param  FormInterface $form
     * @internal param Request $request
     */
    private function processForm(Request $request, FormInterface $form)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            throw new BadRequestHttpException();
        }

        $form->submit($data);
    }
}
