<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    public function showMessageNew(): Response
    {
        // Vous pouvez ajouter ici la logique pour récupérer le contenu de /message/new
        // par exemple, en effectuant une redirection interne vers la route de /message/new
        return $this->forward('App\Controller\MessageController::new');
    }
}