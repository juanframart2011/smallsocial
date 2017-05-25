

$(window).scroll(function(){
  if (typeof initial === 'undefined') {
       return;
    }else{
     if ($(window).scrollTop() == $(document).height() - $(window).height()){
      initial++;
       if (initial > totalposts){
        $('#loaderlinetime').hide();
        return;
      }else{
         loadtimeline();
      }
    } 
  }    
});



$(window).scroll(function(){
  if (typeof initialprofile === 'undefined') {
       return;
    }else{
     if ($(window).scrollTop() == $(document).height() - $(window).height()){
      initialprofile++;
       if (initialprofile > totalpostsprofile){
        $('#loaderlinetime').hide();
        return;
      }else{
         loadtimelineprofile();
      }
    } 
  }    
});



$(window).scroll(function(){
  if (typeof initialfeed === 'undefined') {
       return;
    }else{
     if ($(window).scrollTop() == $(document).height() - $(window).height()){
      initialfeed++;
       if (initialfeed > totalpostsfeed){
        $('#loaderlinetime').hide();
        return;
      }else{
         loadtimelinefeed();
      }
    } 
  }    
});


function thelikeloadtimeclick(target){

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Like en los post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  var domer = $('#liker'+target);
  if (domer.hasClass('active')){
      domer.prop('disabled', true);
      domer.removeClass('active btn-primary').addClass('btn-default').html('<i class="fa fa-thumbs-o-up"></i> Me Gusta');

       var like = 'like='+target;
       $.ajax({
         url: 'includes/ajax-like.php',  
         type: 'POST',
         data: like, 
         error: function(){
           showerror('Revisa tu conexion a internet.');
         }
       });

       var dum = $('#likecomment'+target);
       var likedatasend = 'like='+target;
       $.ajax({
           type: 'POST',
           url: 'includes/ajax-likecheck.php',
           data: likedatasend,
           beforeSend: function(){
              dum.html(' ');
              dum.html('<i class="fa fa-cog fa-spin"></i>');
           },
           success: function(data){
              setTimeout(function(){dum.html(data);},500);
           },
           error: function(){
              showerror('Revisa tu conexion a internet');
           }
       });



      domer.prop('disabled', false);
  }else{
      domer.prop('disabled', true);
      domer.removeClass('btn-default').addClass('active btn-primary').html('<i class="fa fa-thumbs-o-down"></i> Ya no me gusta');

       var like = 'like='+target;
       $.ajax({
         url: 'includes/ajax-like.php',  
         type: 'POST',
         data: like, 
         error: function(){
           showerror('Revisa tu conexion a internet.');
         }
       });

       var dum = $('#likecomment'+target);
       var likedatasend = 'like='+target;
       $.ajax({
           type: 'POST',
           url: 'includes/ajax-likecheck.php',
           data: likedatasend,
           beforeSend: function(){
              dum.html(' ');
              dum.html('<i class="fa fa-cog fa-spin"></i>');
           },
           success: function(data){
              setTimeout(function(){dum.html(data);},500);
           },
           error: function(){
              showerror('Revisa tu conexion a internet');
           }
       });

      domer.prop('disabled', false);
  }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}



function showerror(message){
   $('#theerror').fadeIn(1000);
   $('#alert-message').text(message);
   setTimeout(function(){$('#theerror').fadeOut(1000);},3000);
}



//////////////////////////////////////////////////////////////////////////////////////////////////////
$('.cambiarportada').on('click', function(){
     $('#portadauploadinput').click();
});

$('.changeprofilephoto').on('click', function(){
     $('#profilepicinput').click();
});
//////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function Like
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function like(element){
    var like = 'like='+element;
    $.ajax({
      url: 'includes/ajax-like.php',  
      type: 'POST',
      data: like, 
      error: function(){
        showerror('Revisa tu conexion a internet.');
      }
  });
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Function KnowtheLike
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function likecontentboxer(element){
    var like = 'like='+element;
    $.ajax({
      url: 'includes/ajax-knowthelikecontent.php',  
      type: 'POST',
      data: like,
      success: function(data){
          setTimeout(function(){

             $('#boxuserslike').html(' ');
             $('#boxuserslike').append(data);

          },1000);
      },
      error: function(){
        showerror('Revisa tu conexion a internet.');
      }
  });
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Like en los post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.likethis').on('click', function(){
  var target = $(this).attr('data-target');
  var domer = $('#liker'+target);
  if (domer.hasClass('active')){
      domer.prop('disabled', true);
      domer.removeClass('active btn-primary').addClass('btn-default').html('<i class="fa fa-thumbs-o-up"></i> Me Gusta');
      like(target);
      checklikecomments(target);
      domer.prop('disabled', false);
  }else{
      domer.prop('disabled', true);
      domer.removeClass('btn-default').addClass('active btn-primary').html('<i class="fa fa-thumbs-o-down"></i> Ya no me gusta');
      like(target);
      checklikecomments(target);
      domer.prop('disabled', false);
  }
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('.eliminarthispost').on('click', function(){

       var datapostdel = $(this).attr('data-post');
       var postdatadel = 'post='+datapostdel;

       $.ajax({
           type: 'POST',
           url: 'includes/ajax-deletepost.php',
           data: postdatadel,
           success: function(){
              setTimeout(function(){$('#post-public'+datapostdel).remove();},1500);
           },
           error: function(){
              showerror('Revisa tu conexion a internet');
           }
    });


});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comentar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('.commentfrm').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  var formcomment = $(this).attr('data-form');
  if (keyCode === 13){ 


jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $('#commentfrm'+formcomment);
form.validate({
  rules: {
    comentario: "required",
  } 
});
var dado = form.valid();
if (dado == true){
        var seriacomment = $('#commentfrm'+formcomment).serialize();
        var finalseriacomment = seriacomment+'&post='+formcomment;
        $.ajax({
           type: 'POST',
           url:  'includes/ajax-comments.php',
           data: finalseriacomment,
           beforeSend: function(){
             $('#commentfrm'+formcomment+' input').prop("disabled", true);
           },
           success: function(data){
             form[0].reset();
             $('#box-commets-body-'+formcomment).prepend(data);
             $('#commentfrm'+formcomment+' input').prop("disabled", false);
           },
           error: function(){

           }
        });

}else{
  return;
}
    e.preventDefault();
    return false;
  }
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



// Eliminar Comentario
$('.deletecommentadmin').on('click', function(){

   var cmt = $(this).attr('data-comment');
   var sendercmt = 'comentario='+cmt;
   $.ajax({

      type: 'POST',
      url:  'includes/ajax-commentsdela.php',
      data: sendercmt,
      beforeSend(){
         $('#commentario-per-'+cmt).addClass('opacity');
      },
      success: function(){
         $('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);
         setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);
      },
      error: function(){
          showerror('Revisa tu conexion a internet');
      }

   });
});




$('.deletecomment').on('click', function(){

   var cmt = $(this).attr('data-comment');
   var sendercmt = 'comentario='+cmt;
   $.ajax({

      type: 'POST',
      url:  'includes/ajax-commentsdelu.php',
      data: sendercmt,
      beforeSend(){
         $('#commentario-per-'+cmt).addClass('opacity');
      },
      success: function(){
         $('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);
         setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);
      },
      error: function(){
          showerror('Revisa tu conexion a internet');
      }

   });
});






function conversationget(thedata){

    var converchatget = 'conversation='+thedata;
    $.ajax({

      type: 'POST',
      url:  'includes/ajax-conversation.php',
      data: converchatget,
      success: function(data){
         setTimeout(function(){
          $('#chaterbody'+thedata).html(data);
          $('#chaterbody'+thedata).scrollTop($('#chaterbody'+thedata)[0].scrollHeight);
       },1000);

      },
      error: function(){
          showerror('Revisa tu conexion a internet');
      }

    });

}



// Saber de quienes son los likes
$('.knowthelike').on('click', function(){

   var thelike = $(this).attr('data-like');
   var thedumele = $(this);
   var senderknow = 'like='+thelike;

    $.ajax({

      type: 'POST',
      url:  'includes/ajax-knowthelike.php',
      data: senderknow,
      beforeSend: function(){
        thedumele.prop('disabled', true);
        $('#dataappendknow').html(' ');
      },
      success: function(data){
        $('#dataappendknow').append(data);
        $('#thelikesmodal').modal('show');
        thedumele.prop('disabled', false);
        likecontentboxer(thelike);

      },
      error: function(){
          showerror('Revisa tu conexion a internet');
      }
    });
});



$('.clickfollow').on('click', function(){

     var dataitem = $(this).attr('data-item');
     var datafollow = $(this).attr('data-follow');
     var followsend = 'follow='+datafollow;
     var btnfollow = $(this);

     $.ajax({
       type: 'POST',
       url:  'includes/ajax-follow.php',
       data: followsend,
       beforeSend: function(){
         btnfollow.prop('disabled', true);
       },
       success: function(data){

        if (data == 1){
           btnfollow.removeClass('btn-primary').addClass('btn-warning').html('<i class="fa fa-user-times" aria-hidden="true"></i> Dejar de Seguir');
        }else{
           btnfollow.removeClass('btn-warning').addClass('btn-primary').html('<i class="fa fa-user-plus" aria-hidden="true"></i> Seguir');
        }

        btnfollow.prop('disabled', false);

       },
       error: function(){
          showerror('Revisa tu conexion a internet');
       }

     });

});



$('.editinformation').on('click', function(){

   var visibletype = $(this).attr('data-visible');
   

  if (visibletype == 1){

      $(this).attr('data-visible', '2').addClass('active');
      $('#theinformationparentp p').hide();
      $('#theinformationparentp2 p').hide();
      $('#thenamedivedit').show();
      $('#theapododiv').show();
      $('#theselecteditdiv').show();
      $('#thedescriptioneditdiv').show();
      $('.savemyeditinformation').show();

  }else{
 
      $(this).attr('data-visible', '1').removeClass('active');
      $('#theinformationparentp p').show();
      $('#theinformationparentp2 p').show();
      $('#thenamedivedit').hide();
      $('#theapododiv').hide();
      $('#theselecteditdiv').hide();
      $('#thedescriptioneditdiv').hide();
      $('.savemyeditinformation').hide();

  }


});



$('.savemyeditinformation').on('click', function(){

jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $('#theinformationeditfrm');
form.validate({
  rules: {
    nombre: "required",
    apellido: "required",
    description: "required"
  } 
});
var dado = form.valid();
if (dado == true){
        var seriacomment = $('#theinformationeditfrm').serialize();
        $.ajax({
           type: 'POST',
           url:  'includes/ajax-updainfo.php',
           data: seriacomment,
           beforeSend: function(){
               $('#theinformationparentp p').show();
               $('#theinformationparentp2 p').show();
               $('#thenamedivedit').hide();
               $('#theapododiv').hide();
               $('#theselecteditdiv').hide();
               $('#thedescriptioneditdiv').hide();
               $('.savemyeditinformation').hide();
           },
           success: function(data){
               location.reload();
           },
           error: function(){
               showerror('Revisa tu conexion a internet');
           }
        });

}else{
  return;
}

});


// Notificaciones
function checknotification(noti){


         var notification = 'notification='+noti;
        $.ajax({
           type: 'POST',
           url:  'includes/ajax-notifications.php',
           data: notification,
           success: function(data){
               
           },
           error: function(){
               showerror('Revisa tu conexion a internet');
           }
        });

}



$(".navbar-nav>.notifications-menu>.dropdown-menu>li .menu>li>a").hover(function(){
    
      var notification =  $(this).attr('data-notif');

     if (notification == null){
          return;
     }else{
          var numbernotif = $('.notificationnumber').text();
          var parsenumber = parseInt(numbernotif);
          var restanotif = parsenumber - 1;
          if (restanotif <= 0){
             $('.notificationnumber').remove();
          }else{
             $('.notificationnumber').text(restanotif);
          }
          $(this).removeClass('noreadnotification');
          $(this).removeAttr('data-notif');
          checknotification(notification);
     }
});


function loadmorechatmessages(messages,page){

    var senderchatrequestmessages = 'conversation='+messages+'&page='+page;

    $.ajax({
          type: 'POST',
          url: 'includes/ajax-loadmessages.php',
          data: senderchatrequestmessages,
          beforeSend: function(){
              $('#getconverbtn'+page).hide();
          },
          success: function(data){
               
               if (data == null){
                  $('#getconverbtn'+page).hide();
               }else{
                  $('#conversation-body').prepend(data);
               }

          },
          error: function(){

          }
        });
};