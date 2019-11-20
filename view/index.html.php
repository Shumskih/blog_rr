<?php require_once ROOT . '/view/includes/head.html.php'?>
<?php require_once ROOT . '/view/includes/header.html.php'?>

<main class="container">
    <div class="card-deck">
    <?php if (isset($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <div class="card mb-2">
                <a href="/article?id=<?php echo $article['id']; ?>">
                    <img alt="<?php echo $article['title'] ?>"
                         class="card-img-top" src="https://picsum.photos/id/<?php echo $article['id']; ?>/300/200?grayscale&blur=2">
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $article['title']; ?></h5>
                    <p class="card-text"><?php echo $article['preview']; ?></p>
                    <a href="/article?id=<?php echo $article['id']; ?>">Read more...</a>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><?php echo $article['date']; ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
</main>

<?php require_once ROOT . '/view/includes/footer.html.php' ?>
