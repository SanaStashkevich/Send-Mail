<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<h2>Отправленная заявка</h2>

<p>Имя -  <?= $this->params['name'] ?></p>
<p>Возратс -  <?= $this->params['age'] ?></p>
<p>Вес -  <?= $this->params['weight'] ?></p>
<p>Рост -  <?= $this->params['height'] ?></p>
<p>E-mail -  <?= $this->params['email'] ?></p>
<p>Город проживания -  <?= $this->params['city'] ?></p>
<p>Нужна ли техника в аренду -  <?= $this->params['equip_rent'] ?></p>
<p>Знание английского -  <?= $this->params['level_lang'] ?></p>
