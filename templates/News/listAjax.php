<div class="col-md-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($model['news'] as $news) : ?>
                <tr>
                    <td><?php echo $news->title; ?></td>
                    <td><?php echo $news->getAuthor()->nickname; ?></td>
                    <td>
                        <a href="/?controller=news&action=edit&id=<?php echo $news->id; ?>">edit</a>
                        |
                        <a href="/?controller=news&action=deleteAjax&id=<?php echo $news->id; ?>&layout=Ajax" onclick="News.deleteNews(this); return false">delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>