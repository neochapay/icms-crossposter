<h1 class="con_heading">Добавить кросспостинг</h1>
 
<form action="" method="post">
  <div id="about">
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
	<td width="300" valign="top">
	  <strong>Логин: </strong><br />
          <span class="usr_edithint">Имя пользовтаеля</span>
        </td>
        <td valign="top">
	   <input name="service" type="hidden" value="lj"/>
	   <input name="login" type="text" class="text-input" style="width:300px"/>
	</td>
      </tr>
      <tr>
	<td width="300" valign="top">
	  <strong>Пароль: </strong><br />
          <span class="usr_edithint">пароль на сервисе кросспостинга</span>
        </td>
        <td valign="top">
	   <input name="pass" type="password" class="text-input" style="width:300px"/>
	</td>
      </tr>
    </table>
  </div>
  <div style="padding:5px; padding-bottom:15px; margin-bottom:5px;">
    <input style="font-size:16px" name="send" type="submit" id="save" value="Добавить" />
  </div>
</form>