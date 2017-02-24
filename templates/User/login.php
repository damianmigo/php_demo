<h1>Login</h1>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        
        <?php if (isset($model['invalid_credentials'])) : ?>
            <div class="alert alert-danger">
                Invalid credentials.
            </div>
        <?php endif; ?>
        
        <form class="form-horizontal" action="/?controller=user&action=login" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>