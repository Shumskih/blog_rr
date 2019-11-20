<h1>Articles</h1>

<?php if (isset($articles)): ?>
    <?php foreach ($articles as $article): ?>
        <ul>
            <li><?php echo $article['id']; ?></li>
            <li><?php echo $article['title']; ?></li>
            <li><?php echo $article['date']; ?></li>
            <li><?php echo $article['preview']; ?></li>
            <li><a href="/article?id=<?php echo $article['id']; ?>">Read more</a></li>
        </ul>
    <?php endforeach; ?>
<?php endif; ?>
