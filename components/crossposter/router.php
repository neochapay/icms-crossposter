<?php
function routes_crossposter()
{
  $routes[] = array(
    '_uri' => '/^crossposter\/delete([0-9]+).html$/i',
    'do' => 'delete',
    1 => 'poster_id'
    );
  $routes[] = array(
    '_uri'  => '/^crossposter\/add.html$/i',
    'do' => 'add'
    );
  $routes[] = array(
    '_uri' => '/^crossposter\/view.html$/i',
    'do' => 'view'
    );
  $routes[] = array(
    '_uri' => '/^crossposter\/vk([0-9]+)\/(.*)$/i',
    'do' => 'vkontakte_reg',
    1 => 'user_id',
    2 => 'code'
    );

  return $routes;
}
// http://yamolodoi.ru/crossposter/vkontakte/7021091/f4158cf294e3cbe1d9
?>