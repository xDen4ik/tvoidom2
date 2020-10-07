<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 * Modified by Mnu
 * License: GPL-3.0-or-later
 * More info in license.txt
*/

if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
?>
<h1><?php _e('Help', profilepic_plugin()); ?></h1>
<div class="row">
    <div class="col-12">
        <p>Как получить URL картинки пользователя ?</p>
		<p>Используйте функцию:</p>
        <p><pre><code><span class="php-tag">&lt;?php</span> echo profilepic_user_url(<var>$user</var>); <span class="php-tag">?&gt;</span></code></pre></p>
            <var>$user</var> - замените на один из вариантов, указанных ниже:
            <ul>
                <li><var>osc_logged_user_id()</var> - используйте, чтобы выводить картинку пользователя вошедшего в свою учетную запись ( например, в личном кабинете)</li>
                <li><var>osc_item_user_id()</var> - для того чтобы выводить картинку пользователя на странице объявления</li>
                <li><var>osc_comment_user_id()</var> - выводить картинку пользователя, оставившего комментарий</li>
                <li><var>osc_user_id()</var> - выводить картинку в публичном профиле пользователя</li>
            </ul>
        </p>
		<p>Пример вывода картинки на странице объявления:</p>
		<p><pre><code>&lt;img src="<span class="php-tag">&lt;?php</span> echo profilepic_user_url(<var>osc_item_user_id()</var>); <span class="php-tag">?&gt;</span>"&gt;</code></pre></p>
    </div>
</div>
