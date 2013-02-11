<?php

class IpbPost
{
    protected $forum_url;
    
    protected $title;
    
    protected $id;
    
    public function __construct($forum_url, $title, $id) 
    {
        $this->forum_url = $forum_url;
        $this->title = $title;
        $this->id = $id;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getFullUrl()
    {
        return $this->forum_url."index.php?showtopic=".$this->id."&view=getlastpost";
    }
}