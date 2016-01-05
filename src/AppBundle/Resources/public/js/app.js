function getFormData($form){
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};

  $.map(unindexed_array, function(n, i){
    indexed_array[n['name']] = n['value'];
  });

  return indexed_array;
}

function postSubmitHandler(event) {
  event.preventDefault();
  $('#post-modal').modal('hide');
  console.log('whatever');

  $.ajax({
    url: '/posts',
    method: 'PUT',
    data: JSON.stringify(getFormData($('#post-form')))
  }).done(function() {
    $( this ).addClass( "done" );
  });
}

function loadPosts()
{
  $.get('/posts', function(data) {
    JSON.parse(data).forEach(function(article) {
      var articleNode = $('#post-template').clone();
      articleNode.attr('id', 'article-' + article.id);
      articleNode.removeClass('hidden');
      $('.title', articleNode).html(article.title);
      $('.description', articleNode).html(article.description);
      
      $('#articles').append(articleNode);
    });
  });
}

$(document).ready(function() {
  loadPosts();
  
  $('#post-form').submit(postSubmitHandler);
  $('#post-submit-button').click(postSubmitHandler);
});