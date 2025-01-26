<?php

/** @var yii\web\View $this */

use app\models\Products;
use yii\helpers\Html;

$this->title = 'О нас';

?>
<div class="site-index">

<div class="jumbotron text-center bg-transparent mt-5 mb-5">
    <br><br><img src='https://up-shigaleva.xn--80ahdri7a.site/web/logo1.png' alt='image' style='min-width: 170px;'>
    <h1 class="display-4"><b>Меньше слов - больше цветов!</b></h1><br><br>
    <p class="lead">Забыли про день рождения подруги? Хотите сделать сюрприз любимой?</p>
    <p class="lead">Или просто нужна яркая деталь для интерьера?</p>
    <p class="lead">Тогда тебе точно к нам!</p><br><br><br>
    <h1 class="display-4 bg-secondary text-white m-0 pb-2"><b>новинки компании</b></h1>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $products = Products::find()->orderBy(['date_added'=>SORT_DESC])->limit(5)->all();
        $totalProducts = count($products);

        if($totalProducts > 0) {
            echo "<div class='carousel-item active border border-2 border-secondary' style='height: 75vh; width: 100%; 
            background-position: center; background-repeat: no-repeat; background-size: cover;
            background-image: url(http://up-shigaleva.xn--80ahdri7a.site/web/{$products[$totalProducts - 1]->photo});'>
                <div class='carousel-caption d-none d-md-block bg-white'>
                    <h4 class='text-secondary'>{$products[$totalProducts - 1]->name}</h4>
                </div>

            </div>";

            for($i = $totalProducts - 2; $i >= max(0, $totalProducts - 5); $i--) {
                echo "<div class='carousel-item border border-2 border-secondary' style='height: 75vh; width: 100%; 
                background-position: center; background-repeat: no-repeat; background-size: cover;
                background-image: url(http://up-shigaleva.xn--80ahdri7a.site/web/{$products[$i]->photo});'>
                    <div class='carousel-caption d-none d-md-block bg-white'>
                        <h4 class='text-secondary'>{$products[$i]->name}</h4>
                    </div>
                </div>";
            }
        }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Следующий</span>
  </button>
</div><br><br>
