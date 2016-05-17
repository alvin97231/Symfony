<?php

namespace restBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($foo, $foofoo)
    {
        $arr['foo'] = $foo;
        $arr['foofoo'] = $foofoo;
        $response = new Response();
        $response->setContent(json_encode($arr));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');
        
        return $response;
    }
}
