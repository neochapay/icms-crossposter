<?php
if(!defined('VALID_CMS_ADMIN')) { die('ACCESS DENIED'); }

cpAddPathway('Кросспостинг', '?view=components&do=config&id='.$_REQUEST['id']);

$inCore->loadModel('crossposter');
$model = new cms_model_calendar();
$categories = $model->getAllCategories();
echo '<h3>Кросспостинг</h3>';

if (isset($_REQUEST['opt'])) { $opt = $_REQUEST['opt']; } else { $opt = 'list'; }

$toolmenu = array();

$toolmenu[0]['icon'] = 'save.gif';
$toolmenu[0]['title'] = 'Сохранить';
$toolmenu[0]['link'] = 'javascript:document.optform.submit();';

$toolmenu[1]['icon'] = 'cancel.gif';
$toolmenu[1]['title'] = 'Отмена';
$toolmenu[1]['link'] = '?view=components';

cpToolMenu($toolmenu);

$GLOBALS['cp_page_head'][] = '<script type="text/javascript" src="/includes/jquery/jquery.form.js"></script>';
$GLOBALS['cp_page_head'][] = '<script type="text/javascript" src="/includes/jquery/tabs/jquery.ui.min.js"></script>';
$GLOBALS['cp_page_head'][] = '<link href="/includes/jquery/tabs/tabs.css" rel="stylesheet" type="text/css" />';


//LOAD CURRENT CONFIG
$cfg = $inCore->loadComponentConfig('crossposter');

if (!isset($cfg['post_prefix'])) { $cfg['post_prefix'] = ''; }
if($opt=='saveconfig')
{
    $cfg = array();
    $cfg['post_prefix'] = $inCore->request('post_prefix', 'html');
    $inCore->saveComponentConfig('crossposter', $cfg);
    $inCore->redirectBack();
}
?>
<script type="text/javascript" src="/admin/components/calendar/colorpicker/colorpicker.js"></script>
<form action="index.php?view=components&amp;do=config&amp;id=<?php echo $_REQUEST['id'];?>" method="post" name="optform" target="_self" id="optform">
  <div id="config_tabs" style="margin-top:12px;" class="uitabs">
    <ul id="tabs">
        <li><a href="#basic"><span>Общие</span></a></li>
    </ul>
    <div id="basic">
      <table width="100%">
	<tr>
	  <td>
	    <strong>Плашка перед постом: </strong>
	  </td>
	</tr>
	<tr>
	  <td>
	    <textarea style="width: 100%" name="post_prefix"><?php print $cfg['post_prefix']?></textarea>
	  </td>
	</tr>        
      </table>
    </div>
  </div>
  <p>
    <input name="opt" type="hidden" value="saveconfig" />
    <input name="save" type="submit" id="save" value="Сохранить" />
    <input name="back" type="button" id="back" value="Отмена" onclick="window.location.href='index.php?view=components';"/>
  </p>
</form>

<script type="text/javascript">
  $('#config_tabs > ul#tabs').tabs();
</script>  