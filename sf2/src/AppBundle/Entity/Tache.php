<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
  
   /** * @ORM\Entity */
   class Tache 
   { 
	  /**  
      * @ORM\GeneratedValue     
      * @ORM\Id  
      * @ORM\Column(type="integer")     
      **/
      private $id;
      
      /**
       * @ORM\Column (type="string")
       *   @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your task name must be at least {{ limit }} characters long",
     *      maxMessage = "Your task  name cannot be longer than {{ limit }} characters")
       * @Assert\NotBlank()
       */
       private $nomTache; 

       
       /**
       * @ORM\Column(type="boolean")  
       */
		private $etat;
		
		/**
       * @ORM\ManyToOne(targetEntity="ListeTaches")
       *  @Assert\NotBlank()
       */
		private $liste;
		
	    /**
     * Constructor
     */
    public function __construct()
    {
        $this->liste = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomTache
     *
     * @param string $nomTache
     * @return Tache
     */
    public function setNomTache($nomTache)
    {
        $this->nomTache = $nomTache;

        return $this;
    }

    /**
     * Get nomTache
     *
     * @return string 
     */
    public function getNomTache()
    {
        return $this->nomTache;
    }

  
    /**
     * Set etat
     *
     * @param boolean $etat
     * @return Tache
     */
    public function setEtat($etat = null)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Add liste
     *
     * @param \AppBundle\Entity\ListeTaches $liste
     * @return Tache
     */
    public function addListe(\AppBundle\Entity\ListeTaches $liste)
    {
        $this->liste[] = $liste;

        return $this;
    }

    /**
     * Remove liste
     *
     * @param \AppBundle\Entity\ListeTaches $liste
     */
    public function removeListe(\AppBundle\Entity\ListeTaches $liste)
    {
        $this->liste->removeElement($liste);
    }

    /**
     * Get liste
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListe()
    {
        return $this->liste;
    }

    /**
     * Set liste
     *
     * @param \AppBundle\Entity\ListeTaches $liste
     * @return Tache
     */
    public function setListe(\AppBundle\Entity\ListeTaches $liste = null)
    {
        $this->liste = $liste;

        return $this;
    }
}
