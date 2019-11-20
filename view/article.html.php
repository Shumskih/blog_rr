<?php require_once ROOT . '/view/includes/head.html.php' ?>

<?php if (isset($article)): ?>
    <h1 class="text-center"><?php echo $article->getTitle(); ?></h1>
            <ul>
                <li><?php echo $article->getDate(); ?></li>
                <li><?php echo $article->getText(); ?></li>
            </ul>
<?php endif; ?>

<?php require_once ROOT . '/view/includes/footer.html.php' ?>