$(function(){

$('.add-to-cart').click(function(e){

  var me = $(this);
  var book_id = me.data('book-id');
  var user_id = me.data('user-id');

  $.ajax({
    type: 'post',
    url: 'http://localhost/Library/component/helper/helper.php',
    data : {user_id:user_id,book_id:book_id},
    success : function(response){
      if(response)
      var res = JSON.parse(response);
      alert(res.msg);
      location.reload();
    }
  });

});


});

