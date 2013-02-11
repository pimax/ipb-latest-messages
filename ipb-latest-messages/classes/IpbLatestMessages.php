<?php

class IpbLatestMessages
{
    protected $config;
    
    protected $_db = null;
    
    public function __construct($config)
    {
        $this->config = $config;
    }
    
    public function getMessages()
    {
        $aResult = array();
        $result = $this->getDb()->query("SELECT tid as id, title FROM ".$this->config['db_prefix']."topics ORDER BY last_post DESC LIMIT ".$this->config['posts_count']);
        while($row = $result->fetch())
        {
            $topicstrip = iconv("cp1251", "utf8", $row['title']);
            if (strlen($topicstrip) > $this->config['topic_maxlength']) {
                $topicstrip = $this->substr($topicstrip, 0, $this->config['topic_maxlength']);
            }

            $aResult[] = new IpbPost($this->config['forum_url'], $topicstrip, $row['id']);
        }
        
        return $aResult;
    }

    public function show()
    {
        include dirname(__FILE__).'/../views/'.$this->config['view'].'/index.php';
    }
    
    public function getTitle()
    {
        return $this->config['title'];
    }
    
    public function getForumUrl()
    {
        return $this->config['forum_url'];
    }
    
    public function showTitle()
    {
        return (bool) $this->config['show_title'];
    }
    
    protected function getDb()
    {
        if ($this->_db == null) 
        {
            try
            {
                $this->_db = new PDO('mysql:host='.$this->config['db_host'].';dbname='.$this->config['db_name'],$this->config['db_username'],$this->config['db_password']);
                
                $this->_db->query("SET names cp1251");
            }
            catch(PDOException $e)
            {
                die("Error: ".$e->getMessage());
            }
        }
        
        return $this->_db;
    }
    
    protected function substr($sString, $nStart = 0, $nMaxLen = 250)
	{
        $sString = strip_tags($sString);
        $sString = mb_substr($sString, $nStart, $nMaxLen, "utf8");
        
        $nPos = max(mb_strrpos($sString, ',', "utf8"), mb_strrpos($sString, '.', "utf8"), mb_strrpos($sString, '!', "utf8"), mb_strrpos($sString, '?', "utf8"), mb_strrpos($sString, ' ', "utf8"));
        $sString = mb_substr($sString, 0, $nPos, "utf8");
        
        if (mb_strrpos($sString, ',', "utf8") == mb_strlen($sString, "utf8") - 1 || mb_strrpos($sString, '.', "utf8") == mb_strlen($sString, "utf8") - 1 || mb_strrpos($sString, '!', "utf8") == mb_strlen($sString, "utf8") - 1 || mb_strrpos($sString, '?', "utf8") == mb_strlen($sString, "utf8") - 1) {
            $sString = mb_substr($sString, 0, mb_strlen($sString, "utf8") - 1, "utf8");
        }
        
        return $sString.'...';
	}
}