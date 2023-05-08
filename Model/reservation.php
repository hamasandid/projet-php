<?php
    class reservation{
        private ?int $idclient=null;
        private ?string $nom=null;
        private ?string $prenom=null;
        private ?string $email=null;
        private ?string $nomfilm=null;
      
        
       
        private ?DateTime $datefilm=null;
       
       
        public function __construct($idclient,$nom,$prenom,$email,$nomfilm,$datefilm)
        {   $this->idclient=$idclient;
            
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->email=$email;
            $this->nomfilm=$nomfilm;
            
            $this->datefilm=$datefilm;
            
           
        }
        /////////////////////////////////////////////////////////
        
        public function get_id()
        {
            return $this->idclient;
        }

        public function get_nom()
        {
            return $this->nom;
        }

        public function get_prenom()
        {
            return $this->prenom;
        }

        public function get_email()
        {
            return $this->email;
        }

        public function get_nomfilm()
        {
            return $this->nomfilm;
        }

        

        

        public function get_date_f()
        {
            return $this->datefilm;
        }
        
       

        
       
        ///////////////////////////////////////////////////////////
   
        /**
     * Set the value of lastName
     *
     * @return  self
     */
       
        
        
        /**
     * Set the value of lastName
     *
     * @return  self
     */ 
        public function set_nom($nom)
        {
            $this->nom=$nom;
        }

         /**
     * Set the value of lastName
     *
     * @return  self
     */
        public function set_prenom($prenom)
        {
            $this->prenom=$prenom;
        }


           /**
     * Set the value of email
     *
     * @return  self
     */
    public function set_email($email)
    {
        $this->email=$email;
    }
    
        
         /**
     * Set the value of lastName
     *
     * @return  self
     */

        public function set_nomfilm($nomfilm)
        {
            $this->nomfilm=$nomfilm;
        }

         /**
     * Set the value of lastName
     *
     * @return  self
     */
       

        public function set_date_f($datefilm)
        {
            $this->datefilm=$datefilm;
        }
    } 
?>