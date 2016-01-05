<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Article;

class PostController extends Controller
{
    /**
     * @Route("/posts", name="posts_put")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        
        $article = new Article($data['title'], $data['description']);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        
        return new JsonResponse();
    }
    
    /**
     * @Route("/posts", name="posts_get")
     * @Method({"GET"})
     */
    public function getAction()
    {
        $articles = $this->getDoctrine()
          ->getRepository('AppBundle:Article')
          ->findAll();
        
        return new JsonResponse(json_encode(array_map(function($article) {
            return $article->__toArray();
        }, $articles)));
    }
}
