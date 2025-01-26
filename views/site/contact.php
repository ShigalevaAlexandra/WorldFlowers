<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Где нас найти';

?>
<div class="site-contact">
    <br><br><h1><?= Html::encode($this->title) ?></h1><br><br>
    <div class="container">
        <div class="site-contact">
            <div id="map" style="width: 100%; height: 500px;"></div><br>
            <p>пр. Авиаконструкторов, 28, лит. А, Санкт-Петербург, Россия, 197373</p><br><br>
            <h4>Контактные данные:</h4><br>
            <p>world.flower@shop.ru</p>
            <p>+7(999)999-99-99</p>

            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
            <script type="text/javascript">
                ymaps.ready(init);
                function init() {
                    var myMap = new ymaps.Map("map", {
                        center: [60.023619, 30.228534], 
                        zoom: 16
                    });

                    var myPlacemark = new ymaps.Placemark([60.023619, 30.228534], {
                        hintContent: 'Наш адрес',
                        balloonContent: 'пр. Авиаконструкторов, 28, лит. А, Санкт-Петербург, Россия, 197373'
                    });

                    myMap.geoObjects.add(myPlacemark);
                }
            </script>    
        </div>
</div>
