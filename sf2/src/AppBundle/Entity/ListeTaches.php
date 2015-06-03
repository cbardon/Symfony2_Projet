<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
  
   /** * @ORM\Entity */
   class ListeTaches 
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
       * min = 2,
     *      max = 50,
     *      minMessage = "Your list task name must be at least {{ limit }} characters long",
     *      maxMessage = "Your list task name cannot be longer than {{ limit }} characters"
     * )
       * @Assert\NotBlank()      
       */
       private $nom; 

	
       
	
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
     * Set nom
     *
     * @param string $nom
     * @return ListeTaches
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

  

   
}
