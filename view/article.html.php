<?php require_once ROOT . '/view/includes/head.html.php' ?>
<?php require_once ROOT . '/view/includes/header.html.php' ?>

    <main class="container">
        <?php if (isset($article)): ?>
            <div class="media">
                <img src="https://picsum.photos/id/<?php echo $article->getId(); ?>/300/200?grayscale&blur=2"
                     class="align-self-start mr-3" alt="<?php echo $article->getTitle(); ?>">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $article->getTitle(); ?></h5>
                    <small><?php echo $article->getDate(); ?></small>
                    <hr>
                    <?php echo $article->getText(); ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

<?php require_once ROOT . '/view/includes/footer.html.php' ?>