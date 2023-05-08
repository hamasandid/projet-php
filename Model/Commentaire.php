<?php

Class Commentaire{
   private $id;
   private $id_blog;//clé etrangére
   private $message;
   private $id_user;//clé etrangére
   private $date;

   public function __construct($id_blog,$message,$id_user,$date)
   {
    $this->id_blog=$id_blog;
    $this->message=$message;
    $this->id_user=$id_user;
    $this->date=$date;
    }
    public  function getIdBlog()
    {
    return $this->id_blog;
    }
    public  function getmessage()
    {
    return $this->message;
    }
    public  function getIdUser()
    {
    return $this->id_user;
    }
    public  function getdate()
    {
    return $this->date;
    }
    public  function setIdBlog(int $id_blog)
    {
    $this->id_blog=$id_blog;
    }
    public  function setmessage(string $message)
    {
    $this->message=$message;
    }
    public  function setIdUser(int $id_user)
    {
    $this->id_user=$id_user;
    }
    public  function setdate(string $date){
        $this->date=$date;
    }




}