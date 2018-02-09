<!--main content start-->
<?php use yii\helpers\Url; ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <img src="<?= $user->getImage(); ?>" class="avatar img-circle" alt="avatar" style="width: 50%; height: 50%">
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h1 class="entry-title"><?= $user->getFullName(); ?></h1>
                        </header>
                        <a href="<?= Url::toRoute(['site/edit', 'id' => $user->id]); ?>"class="btn send-btn">Change</a>
                        <div class="entry-content">
                            <h4><?= $user->getFormattedUsername(); ?></h4>
                            <h4><?= $user->getFormattedName(); ?></h4>
                            <h4><?= $user->getFormattedSurname(); ?></h4>
                            <h4><?= $user->getFormattedPatronymic(); ?></h4>
                            <h4><?= $user->getFormattedEmail(); ?></h4>
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