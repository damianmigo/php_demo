<div class="row">
    <div class="col-md-8 col-md-offset-2">
        
        <?php if (isset($model['errors'])) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($model['errors'] as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form class="form-horizontal" action="/?controller=news&action=<?php echo $model['news']->id == NULL ? 'create' : 'edit' ?>&id=<?php echo $model['news']->id; ?>" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="news[title]" placeholder="Enter title" maxlength="255" value="<?php echo $model['news']->title; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="5" id="description" name="news[description]"><?php echo $model['news']->description; ?></textarea>
                </div>
            </div>
            
            <?php if ($model['news']->createdAt != null) : ?>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="createdAt">Created at:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="createdAt" name="news[createdAt]" readonly="readonly" value="<?php echo $model['news']->createdAt; ?>">
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>