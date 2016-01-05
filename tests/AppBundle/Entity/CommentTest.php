<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Article;

class CommentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers AppBundle\Entity\Article::__construct
     * @covers AppBundle\Entity\Article::__toArray
     */
    public function test__construct()
    {
        $testData = [
            'userName' => 'some user name',
            'comment' => 'sample comment'
        ];

        $article = new Article('some title', 'some description');
        $comment = new Comment($article, $testData['userName'], $testData['comment']);
        $commentArray = $comment->__toArray();

        $this->assertEquals($testData['userName'], $commentArray['userName']);
        $this->assertEquals($testData['comment'], $commentArray['comment']);
    }
}
