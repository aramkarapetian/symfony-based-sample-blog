function disableLoader() {
  $('#article-loading-progress-bar').hide();
}

$(document).ready(function() {
  loadArticles();
  
  setupArticleModalHandlers();
});