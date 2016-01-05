function addCommentToList(comment) {
  var $commentTemplate = $('.comment-template');
  var $comments = $('.article-comments');

  var $comment = $commentTemplate.clone().removeClass('hidden comment-template');
  $comment.html(comment.userName + ' >> ' + comment.comment);

  $comments.append($comment);
}

function loadArticleComments(articleId) {
  console.log('loadArticleComments');
  $.get('/articles/' + articleId + '/comments')
  .done(function(comments) {
    $('.article-comments').empty();
    JSON.parse(comments).forEach(addCommentToList);
  });
}

function commentSubmitHandler() {
  event.preventDefault();
  
  var commentData = getFormData($('#comment-form'));
  $.ajax({
    url: '/comments',
    method: 'PUT',
    data: JSON.stringify(commentData)
  }).done(function() {
    addCommentToList(commentData);
    cleanCommentFormValues();
  });
}

function cleanCommentFormValues() {
  $('#comment-form')[0].reset();
}