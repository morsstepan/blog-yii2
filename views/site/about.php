<!--main content start-->
<?php use yii\helpers\Url; ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?= Url::toRoute(['site/category', 'id' => $user->id]); ?>"> <?= $user->name; ?></a></h6>

                            <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view', id => $article->id]); ?>"><?= $user->name; ?></a></h1>


                        </header>
                        <div class="entry-content">
                            <?= $user->name; ?>
                        </div>

                    </div>
                </article>
            </div>
            <?= $this->render('/partials/sidebar', [
                'popular' => $popular,
                'recent' => $recent,
                'categories' => $categories
            ]);?>
        </div>
    </div>
</div>
<!-- end main content-->