<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     * @param MailerInterface $mailer
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function contact(MailerInterface $mailer, Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
//            dd($form);
//            dd($form['name']->getData());
//            $mailer->sendMail($form->getData());

            $email = (new TemplatedEmail())
                ->from('admin@amazingweb.website')
                ->to('fernando.amazingweb@gmail.com')
                ->subject('prueba del form')

                // path of the Twig template to render
//                ->htmlTemplate('emails/user/change-password.html.twig')
                ->html('<p>Nombre: ' . $form['name']->getData() . '</p><br>
                            <p>Email: ' . $form['email']->getData() . '</p>')

                // pass variables (name => value) to the template
                ->context([
                    'user' => 'prueba',
                ]);

            $mailer->send($email);
//            $mailer->sendMail($email);
//            $this->mailer->send($email);

            $this->addFlash('success', 'Thanks for your message!');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
