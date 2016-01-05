<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;
    
    /**
     * 
     * @param string $title
     * @param string $description
     */
    function __construct($title, $description = '') {
        $this->title = $title;
        $this->description = $description;
    }
    
    function __toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}