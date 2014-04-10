<h1 class="con_heading">Кросспостинг</h1>
<p>Функция кросспостинга позволяет автоматически размещать Ваши записи в блоге на различных сервисах.<br /></p>
{if $posters}
  {foreach key=id item=posters from=$posters}
    <div class="action_entry act_add_user">
      <div class="action_date"><a href="/crossposter/delete{$posters.id}.html">удалить</a></div>
      <div class="action_title"><a href="{$posters.url}">{$posters.url}</a></div>
    </div>
  {/foreach}
{else}
Кросспостинг не настроен
{/if}
<br />
<div class="usr_wall_addlink" style="float:left">
  <a href="/crossposter/add.html" id="addlink">
    <span>Добавить кросспостинг</span>
  </a>
</div>