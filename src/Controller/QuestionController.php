<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class QuestionController
{
    public function homepage()
    {
        return new Response('what a bewitching controller we have conjured!');
    }
}