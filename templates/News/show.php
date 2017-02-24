<script type="text/javascript" src="/static/news.js"></script>
<h1>News</h1>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary pull-right" href="/?controller=news&action=create">Create news</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        Sort by:
        <select id="sortBy" onchange="News.loadNews($(this).val())">
            <option value="created_at" selected="selected">Created at</option>
            <option value="title">Title</option>
            <option value="authors.nickname">Author</option>
        </select>
    </div>
</div>
<div class="row" id="news"></div>