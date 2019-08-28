<?php
if (!$resultset) {
    return;
}
?>

<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="post/<?= ($row->id) ?>"><?= ($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= $row->published ?>" pubdate><?= ($row->published) ?></time></i></p>
    </header>
    <?= ($row->data) ?>
</section>
<?php endforeach; ?>

</article>
