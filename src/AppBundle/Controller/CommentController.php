<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Comment;

class CommentController extends Controller
{
    /**
     * @Route("/comments", name="comments_put")
     * @Method({"PUT"})
     */
    public function putAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        
        $article = $this->getDoctrine()
          ->getRepository('AppBundle:Article')
          ->find($data['articleId']);
        
        $comment = new Comment($article, $data['userName'], $data['comment']);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        
        return new JsonResponse();
    }
    
    /**
     * @Route("/articles/{articleId}/comments", name="comments_get")
     * @Method({"GET"})
     */
    public function getAction($articleId)
    {
        $comments = $this->getDoctrine()
          ->getRepository('AppBundle:Comment')
          ->findBy(array('article' => $articleId));
        
        return new JsonResponse(json_encode(array_map(function($comment) {
            return $comment->__toArray();
        }, $comments)));
    }
}
