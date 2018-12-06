<?php

namespace AppBundle\Form\Data;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Représente les paramètres d'une recherche sur les documents
 */
class DocumentSearch {

    /**
     * @var int
     * @JMS\Type("int")
     * @Assert\Type("int")
     */
    private $page ;
    
    /**
     * @var array
     * @JMS\Type("array")
     * @Assert\Type("array")
     */
    private $sort ;

    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\Type("string")
     */
    private $type ;
    
    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\Type("string")
     */
    private $sup_cat ;
    
    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\Type("string")
     */
    private $title ;
    
    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\Type("string")
     */
    private $organisme ;

    /**
     * @var string
     * @JMS\Type("string")
     * @Assert\Type("string")
     */
    private $geometry ;

    public function __construct() {
        //$this->page = 0;
        $this->sort = ["_score" => ["order" => "desc"]];
    }

    /**
     * @return int
     */ 
    function getPage() {
        return $this->page;
    }

    
    /**
     *  @return self
     */
    function setPage($page) {
        $this->page = $page;
        return $this;
    }


    /**
     * @return array
     */ 
    function getSort() {
        return $this->sort;
    }

    
    /**
     *  @return self
     */
    function setSort($sort) {
        $this->sort = $sort;
        return $this;
    }


    /**
     * @return boolean
     */
    public function hasType(){
        return ! empty($this->type);
    }

        
    /**
     * @return string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
    
    /**
     * @return boolean
     */
    public function hasSupCat(){
        return ! empty($this->sup_cat);
    }

        
    /**
     * @return string
     */ 
    public function getSupCat()
    {
        return $this->sup_cat;
    }

    /**
     * Set the value of sup_cat
     *
     * @return  self
     */ 
    public function setSupCat($sup_cat)
    {
        $this->sup_cat = $sup_cat;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasTitle(){
        return ! empty($this->title);
    }
    
    
    /**
     * Get the value of title
     * 
     * @return string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
 
    /**
     * @return boolean
     */
    public function hasOrganisme(){
        return ! empty($this->organisme);
    }    

    /**
     * Get the value of organisme
     */ 
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * Set the value of organisme
     *
     * @return  self
     */ 
    public function setOrganisme($organisme)
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasGeometry(){
        return ! empty($this->geometry);
    }    

    /**
     * Get the value of Geometry
     */ 
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * Set the value of Geometry
     *
     * @return  self
     */ 
    public function setGeometry($geometry)
    {
        $this->geometry = $geometry;

        return $this;
    }
}

