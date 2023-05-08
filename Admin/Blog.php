<?php

Class Blog{
   private $id;
   private $titre;
   private $description;
   private $date;
   private $image;
   

public  function __construct($titre,$description,$date,$image)
{
    $this->titre=$titre;
    $this->description=$description;
    $this->date=$date;
    $this->image=$image;

}
public  function gettitre(){
    return $this->titre;
}
public function getdescription(){
    return $this->description;
}
public  function getdate(){
    return $this->date;
}
public  function getimage(){
    return $this->image;
}
public  function settitre(string $titre){
    $this->titre=$titre;
}
public  function setdescription(string $description){
    $this->description=$description;
}
public  function setdate(string $date){
    $this->date=$date;
}
public  function setimage(string $image){
    $this->image=$image;
}


}
?>
