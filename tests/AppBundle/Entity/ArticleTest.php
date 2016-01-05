<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Article;

class ArticleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers AppBundle\Entity\Article::__construct
     * @covers AppBundle\Entity\Article::__toArray
     */
    public function test__construct()
    {
        $testData = [
            'title' => 'sample title',
            'description' => 'sample description'
        ];

        $article = new Article($testData['title'], $testData['description']);
        $articleArray = $article->__toArray();

        $this->assertEquals($testData['title'], $articleArray['title']);
        $this->assertEquals($testData['description'], $articleArray['description']);
    }
}
