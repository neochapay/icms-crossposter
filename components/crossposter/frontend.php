<?php
function crossposter()
{
  $inCore = cmsCore::getInstance();
  $inPage = cmsPage::getInstance();
  $inUser = cmsUser::getInstance();

  $inCore->loadModel('crossposter');
  $model = new cms_model_crossposter();

  if($inUser->id == 0)
  {
    $inCore->redirect('/'); exit;
  }
 
  $do = $inCore->request('do', 'str', 'view');

  if ($do == 'view')
  {
    $inPage->setTitle("Кросспостинг");
    
    $posters = $model->getPoster($inUser->id);
    $is_admin = $inUser->is_admin;
    
    $smarty = $inCore->initSmarty('components', 'com_crossposter_view.tpl');
    $smarty->assign('posters', $posters);
    $smarty->assign('is_admin', $is_admin);
    $smarty->display('com_crossposter_view.tpl');

    return;
  }

  if ($do == 'add')
  {
    $is_send = $inCore->inRequest('send');
    $inPage->setTitle("Добавить кросспостинг");

    if (!$is_send)
    {
      $smarty = $inCore->initSmarty('components', 'com_crossposter_add.tpl');
      $smarty->display('com_crossposter_add.tpl');
    }
    else
    {
      $type = $inCore->request('type', 'str');
      if($type)
      {
	switch($type)
	{
	  case livejournal:
	    $smarty = $inCore->initSmarty('components', 'com_crossposter_add_livejournal.tpl');
	    $smarty->display('com_crossposter_add_livejournal.tpl');
	    break;
	}
      }
      else
      {
	$service = $inCore->request('service', 'str');
	$login = $inCore->request('login', 'str');
	$pass = $inCore->request('pass', 'str');
	$user_id = $inUser->id;
	if (!$login || !$pass || !$service)
	{
	  cmsCore::addSessionMessage('Ой, что то не было заполнено...', 'error');
	  $inCore->redirectBack(); exit;
	}

	$poster_id = $model->addPoster($service, $user_id, $login, $pass);

	if ($poster_id)
	{
	  cmsCore::addSessionMessage('Кросспостинг добавлен!', 'success');
	}
	else
	{
	  cmsCore::addSessionMessage('Ой, что то пошло не так!', 'error');
	}

	$inCore->redirect('/crossposter'); exit;
      }
    } 
  }

  if ($do == 'delete')
  {
    $poster_id = $inCore->request('poster_id', 'int', 0);
    
    if (!$poster_id || !$inUser->is_admin) 
    {
      $inCore->redirectBack(); exit;
    }    
    
    $model->deletePoster($poster_id);
    $inCore->redirectBack(); exit;
  }
}
?>