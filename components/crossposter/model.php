<?php
if(!defined('VALID_CMS')) { die('ACCESS DENIED'); }
 
class cms_model_crossposter{
 
    function __construct(){
        $this->inDB = cmsDatabase::getInstance();
    }


    public function addPoster($type, $user_id, $login, $pass)
    {
      $test_sql = "SELECT * FROM cms_crosspost WHERE user_id = '{$user_id}' AND type = '{$type}' AND login = '{$login}'";
      $test = $this->inDB->query($test_sql);
      if($this->inDB->num_rows($test) == 0)
      {
	$md5_pass = md5($pass);
	$sql = "INSERT INTO cms_crosspost (type, user_id, login, pass) VALUES ('{$type}', '{$user_id}' , '{$login}' , '{$md5_pass}')";
	$this->inDB->query($sql);
	if ($this->inDB->error()) { return false; }
	return $this->inDB->get_last_id('cms_crosspost');
      }
      else
      {
	return false;
      }
    }

    public function deletePoster($poster_id)
    {
      $sql = "DELETE FROM cms_crosspost WHERE id = '{$poster_id}'";
      $this->inDB->query($sql);
      if ($this->inDB->error()) { return false; }
      return $this->inDB->get_last_id('cms_crosspost');
    }

    public function getPoster($user_id) 
    {
      $inCore = cmsCore::getInstance();
 
      $sql = "SELECT * FROM cms_crosspost WHERE user_id = '{$user_id}'";
 
      $result = $this->inDB->query($sql);
      if ($this->inDB->error()) { return false; }
      if (!$this->inDB->num_rows($result)) { return false; }
      $posters = array();

	while ($poster = $this->inDB->fetch_assoc($result))
	{
	    if($poster['type'] == "lj")
	    {
	      $poster['url'] = "http://".$poster['login'].'.livejournal.com';
	    }
            $posters[] = $poster;
        }
 
        return $posters;
 
    }

    public function addPost($post_id)
    {
      $sql = "INSERT INTO cms_crosspost_post (post_id) VALUES ('{$post_id}')";
      $result = $this->inDB->query($sql);
      if($this->inDB->error())
      {
	return false;
      }
      return true;
    }

    public function getPost($post_id)
    {
      $sql = "SELECT * FROM cms_crosspost_post WHERE post_id = $post_id";
      $result = $this->inDB->query($sql);
      if ($this->inDB->error())
      {
	return false;
      }
      if (!$this->inDB->num_rows($result))
      {
	return $sql;
      }
      return true;
    }
}
?>