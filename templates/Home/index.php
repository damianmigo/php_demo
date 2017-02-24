<?php foreach ($model['news'] as $news) : ?>
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $news->title; ?></h2>
            <p class="blog-post-meta"><?php echo $news->createdAt; ?> by <?php echo $news->getAuthor()->nickname; ?></p>
            <p><?php echo $news->description; ?></p>
        </div>
    </div>
</div>
<?php endforeach; ?>