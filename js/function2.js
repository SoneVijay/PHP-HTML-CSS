$(function(){

$('.return-book').click(function(e){

  var me = $(this);
  var Book_ID = me.data('book-id');
  var tran_id = me.data('tran-id');
  //console.log(Book_ID);

  $.ajax({
    type: 'post',
    url: 'http://localhost/Library/component/helper/helper2.php',
    data : {tran_id:tran_id,Book_ID:Book_ID},
    success : function(response){
      if(response)
      var res = JSON.parse(response);
      alert(res.msg);
      location.reload();
    }
  });

});


});