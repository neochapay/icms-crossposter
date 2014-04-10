<?php
class p_crossposting extends cmsPlugin 
{

// ==================================================================== //

    public function __construct(){
        
        parent::__construct();

        // Информация о плагине

        $this->info['plugin']           = 'p_crossposting';
        $this->info['title']            = 'Кросспостинг';
        $this->info['description']      = 'Кросспостинг в ЖЖ';
        $this->info['author']           = 'NeoChapay';
        $this->info['version']          = '0.1';

        // События, которые будут отлавливаться плагином

        $this->events[]                 = 'ADD_POST_DONE';

    }

    public function execute($event, $item)
    {

        parent::execute();

        switch ($event)
	{
	  case 'ADD_POST_DONE': 
// 	    $output = $item;
	    $this->crossposting($item);
	    break;
        }
        return;
    }

    public function crossposting($post)
    {
      $inCore = cmsCore::getInstance();
      $inUser = cmsUser::getInstance();
      
      $inCore->loadModel('crossposter');
      $model = new cms_model_crossposter();
      $posters = $model->getPoster($inUser->id);
      $need_post = $model->getPost($post['id']);
      $cfg = $inCore->loadComponentConfig('crossposter');
      $prefix = $cfg['post_prefix'];

//       die(print_r($post));
      
      if($posters and $need_post)
      {
	foreach ($posters as $xposter)
	{
	  $title = stripslashes($post['title']);
	  $mess = str_replace('\r\n', "", $post['content_html']);
	  $mess = stripslashes($mess);
	  $mess = str_replace("/go/url=", "", $mess);
	  $mess = str_replace('<img src="/', '<img src="http://'.$_SERVER['HTTP_HOST'].'/', $mess);
	  if($prefix)
	  {
	    $mess = $prefix.$mess;
	  }
	  
	  if($xposter['type'] == "lj")
	  {
	    $login = $xposter['login'];
	    $pass = $xposter['pass'];

	    include('components/crossposter/include/class-IXR.php');
	    include('components/crossposter/include/lj.class.php');
	    $ljc = new LJClient($login, $pass, "www.livejournal.com", "");
	    $r = $ljc->login();
//Подготовливаем данные
	    $date = time();
	    $jdata = array();
	    $jdata['subject'] = $title;
	    $jdata['event'] = $mess;
	    $jdata['year'] = date ('Y',$date);
	    $jdata['mon'] = date ('n',$date);
	    $jdata['day'] = date ('j',$date);
	    $jdata['hour'] = date ('G',$date);
	    $jdata['min'] = date ('i',$date);
	    $jdata['security'] = 'public';
	    $jdata['allowmask'] = 0;
	    $jdata['itemid'] = '';
//Метаданные
	    $jmeta = array ();
	    if($post['comments'])
	    {
	      $jmeta['opt_nocomments'] = 0;
	    }
	    else
	    {
	      $jmeta['opt_nocomments'] = 1;
	    }
	    $jmeta['opt_backdated'] = 0;
	    $jmeta['opt_preformatted'] = true;
	    $jmeta['picture_keyword'] = stripslashes ($pic_keys);
	    $jmeta['taglist'] = stripslashes($post['tags']);
	    $jmeta['current_music'] =  stripslashes ($post['music']); 
//Отправляем
	    $r = $ljc->postevent($jdata, $jmeta);
	    
	    if($r[0] == '1')
	    {
	      cmsCore::addSessionMessage('Пост успешно размещён в ЖЖ', 'success');
	    }
	    else
	    {
	      print_r($jdata);
	      cmsCore::addSessionMessage('Ошибка кросспостинга в ЖЖ ' , 'error');
	    }
	  }
	}
      }
    }
  }
?>