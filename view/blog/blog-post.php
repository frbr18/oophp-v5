<article>
    <header>
        <h1><?= $content->title ?></h1>
        <p><i>Published: <time datetime="<?= $content->published ?>" pubdate><?= $content->published ?></time></i></p>
    </header>
    <?= $content->data ?>
</article>
