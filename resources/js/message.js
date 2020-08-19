$(document).ready(function (){
  //ajax setup for csrf token
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //Pusher Listener
  Pusher.logToConsole = true;

  var pusher = new Pusher('58eb611363d0e375ea67', {
    cluster: 'mt1'
  });

  var channel = pusher.subscribe('message-channel');
  channel.bind('sent-message-event', function(data) {
    if(my_id == data.from){
      $('#' + data.to).click();
    }else if(my_id == data.to){
      if(receiver_id == data.from){
        //if receiver is selected, reload selected user
        $('#' + data.from).click();
      }else{
        //if receiver isn't selected, add notice
        var pending = parseInt($('#' + data.from).find('.pending').html());;

        if(pending){
          $('#' + data.from).find('.pending').html(pending + 1);
        }else{
          $('#' + data.from).append('<span class="pending">1</span>');
        }
      }
    }
  });

  //chage chat user
  $('.user').click(function (){
    $('.user').removeClass('active');
    $(this).addClass('active');
    $(this).find('.pending').remove();

    receiver_id = $(this).attr('id');

    $.ajax({
      type: "get",
      url: "home/" + receiver_id,
      data: "",
      cache: false,
      success: function(data){
        $('#messages').html(data);
        scrollToBottomFunc();
      }
    });
  });

  //Sent Message by Enter key
  $(document).on('keyup', '.input-text input', function (e){
    var message = $(this).val();

    //Press Enter set message
    if(e.keyCode == 13 && message != '' && receiver_id != ''){

      //clear message text
      $(this).val('');

      var datastr = "receiver_id=" + receiver_id + "&message=" + message;
      $.ajax({
        type: "post",
        url: "message",
        data: datastr,
        cache: false,
        success: function(data){

        },
        error: function(jqXHR, status, err){

        },
        complete: function(){
          scrollToBottomFunc();
        }
      })
    }
  });

  //make a function to scroll down auto
  function scrollToBottomFunc() {
    $('.message-wrapper').animate({
      scrollTop: $('.message-wrapper').get(0).scrollHeight}, 0.001);

    $('.input-text input').focus();
  }
});
