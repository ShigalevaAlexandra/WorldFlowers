<?php

use app\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог';

?>
<div class="products-index">

    <br><br><h1><?= Html::encode($this->title) ?></h1><br>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h4>Сортировка</h4><br>

    <div class="input-group mb-3 d-flex flex-row gap-2">
        <div class="input-group mb-3" style="width:max-content;">
            <div class='d-flex align-items-center'>
                <div class="input-group-text px-4 bg-secondary text-light ">цена</div>
                <a class="btn btn-outline-secondary" href="https://up-shigaleva.xn--80ahdri7a.site/products/catalog?sort=price" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                    </svg>
                </a>
                <a class="btn btn-outline-secondary"  href="https://up-shigaleva.xn--80ahdri7a.site/products/catalog?sort=-price" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="input-group mb-3" style="width:max-content;">
            <div class='d-flex align-items-center'>
                <div class="input-group-text px-4 bg-secondary text-light ">наименование</div>
                <a class="btn btn-outline-secondary" href="https://up-shigaleva.xn--80ahdri7a.site/products/catalog?sort=name" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                    </svg>
                </a>
                <a class="btn btn-outline-secondary"  href="https://up-shigaleva.xn--80ahdri7a.site/products/catalog?sort=-name" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="input-group mb-3" style="width:max-content;">
            <div class='d-flex align-items-center'>
                <div class="input-group-text px-4 bg-secondary text-light ">страна поставщика</div>
                <a class="btn btn-outline-secondary" href="https://up-shigaleva.xn--80ahdri7a.site/products/catalog?sort=country_origin" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708z"/>
                    </svg>
                </a>
                <a class="btn btn-outline-secondary"  href="https://up-shigaleva.xn--80ahdri7a.site/products/catalog?sort=-country_origin" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="input-group mb-3 d-flex flex-row gap-2">
        <div class="input-group mb-3" style="width:max-content;">
            <div class='d-flex align-items-center'>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false">фильтрация по категориям</button>
                    <ul class="dropdown-menu">
                        <?php
                            $categories = \app\models\Categories::find() -> all();

                            if (isset($categories) && !empty($categories)) {
                                foreach ($categories as $category) {
                                    echo '<li>' . Html::a(
                                        Html::encode($category->name), 
                                        ['products/catalog', 'ProductsSearch[category_id]' => $category->id_category], 
                                        ['class' => 'dropdown-item']
                                    ) . '</li>';
                                }
                            } else {
                                echo '<li><a class="dropdown-item" href="#">Нет доступных категорий</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    /* @var $this yii\web\View */
    /* @var $searchModel app\models\ProductsSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */

    $products = array_reverse($dataProvider->getModels());

    echo "<div class='d-flex flex-row flex-wrap justify-content-start  border-info align-itemsend'>";
    
    foreach ($products as $product) {
        if ($product->count > 0) {
            echo "<div class='card m-1' style='width: 22%; min-width: 390px;'>
            <a href='/products/view?id_product={$product->id_product}'><img src='https://up-shigaleva.xn--80ahdri7a.site/web/{$product->photo}' class='card-img-top'
            style='max-height: 500px;' alt='image'></a>
                <div class='card-body'>
                    <h5 class='card-title'>{$product->name}</h5><br>
                    <p class='text-secondary'><b>{$product->price} руб</b></p><br>";
                    echo (Yii::$app->user->isGuest ? "<a href='/products/view?id_product={$product->id_product}' class='btn btn-outline-secondary'>Просмотр товара</a>" :
                        "<br><div class='d-flex gap-4 align-items-center' style='margin-top:auto;'>
                            <a href='/products/view?id_product={$product->id_product}' class='0 btn btn-outline-secondary'>Просмотр товара</a>
                            <p onclick='add_product({$product->id_product}, 1)' class='btn btn-secondary mt-3'>Добавить в корзину</p>
                        </div>");
                echo "</div>
            </div>";
        }
    }
    echo "</div>";
?>

<script>
    function add_product(id, items){
        let form=new FormData();
        form.append('product_id', id);
        form.append('count', items);

        let request_options={method: 'POST', body: form};
        fetch('https:///up-shigaleva.xn--80ahdri7a.site/carts/create', request_options)
        .then(response=>response.text())
        .then(result=>{
            console.log(result)
            let title=document.getElementById('staticBackdropLabel');
            let body=document.getElementById('modalBody');
            
            if (result=='false'){
                title.innerText='Ошибка';
                body.innerHTML="<p>Ошибка добавления товара, вероятно, товар уже раскупили</p>"
            } else {
                title.innerText='В корзине новый товар';
                body.innerHTML="<p>Товар успешно добавлен в корзину</p>"
            }

            let myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
            myModal.show();
        })
    } 
</script>
