<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;

    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $userName;

    /**
     * @ORM\Column(type="text")
     */
    protected $comment;
    
    /**
     * 
     * @param \AppBundle\Entity\Article $article
     * @param string $userName
     * @param string $comment
     */
    public function __construct(Article $article, $userName, $comment)
    {
        $this->article = $article;
        $this->userName = $userName;
        $this->comment = $comment;
    }
    
    public function __toArray()
    {
        return [
            'id' => $this->id,
            'userName' => $this->userName,
            'comment' => $this->comment
        ];
    }
}