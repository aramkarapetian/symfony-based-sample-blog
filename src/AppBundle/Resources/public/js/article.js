function articleSubmitHandler(event) {
  event.preventDefault();
  $('#article-modal').modal('hide');

  var artilcleData = getFormData($('#article-form'));
  $.ajax({
    url: '/articles',
    method: 'PUT',
    data: JSON.stringify(artilcleData)
  }).done(function() {
    addArticleToList(artilcleData);
  });
}

function addArticleToList(article) {
  var articleNode = $('#article-template').clone();
  articleNode.attr('id', 'article-' + article.id);
  articleNode.removeClass('hidden');
  $('.title', articleNode).html(article.title);
  $('.description', articleNode).html(article.description);

  $('#articles').append(articleNode);
}

function loadArticles()
{
  $.get('/articles', function(data) {
    JSON.parse(data).forEach(addArticleToList);
  }).done(function() {
    disableLoader();
  });
}

function openArticleDetails(event) {
  var $article = $(event.relatedTarget).closest('.article');
  var articleId = parseInt($article.attr('id').replace(/article-/, ''));

  $('.article-title', $('#details-modal')).html('# ' + $('.title', $article).html());
  $('.article-description', $('#details-modal')).html($('.description', $article).html());
  $('.article-id', $('#details-modal')).val(articleId);

  $('#comment-form').submit(commentSubmitHandler);
  $('#comment-submit-button').click(commentSubmitHandler);

  loadArticleComments(articleId);
}

function setupArticleModalHandlers() {
  $('#article-form').submit(articleSubmitHandler);
  $('#article-submit-button').click(articleSubmitHandler);
  
  $('#details-modal').on('shown.bs.modal', openArticleDetails);
}