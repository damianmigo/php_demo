var News = {};

News.loadUrl = "/?controller=news&action=listAjax&layout=Ajax&order_by=";

News.deleteNews = function(aElem) {
    if (confirm('Are you sure?')) {
        $.get($(aElem).attr('href'), function(data) {
            News.loadNews($('sortBy').val());
        });
    }
};

News.loadNews = function(news_order_by) {
    $.get(News.loadUrl + news_order_by, function(data) {
        $("#news").html(data);
    });
};

$(function() {
    News.loadNews('created_at');
});