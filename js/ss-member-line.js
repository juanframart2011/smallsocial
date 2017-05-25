


function loadtimeline(){

    var senderdataload = 'page='+initial;
    $.ajax({
          type: 'POST',
          url: 'includes/ajax-loadtime.php',
          data: senderdataload,
         beforeSend: function(){
             $('#loaderlinetime').show();
          },
          success: function(data){
               setTimeout(function(){$('#loaderlinetime').hide();},1000);
               setTimeout(function(){
                $('#timeliner').append(data);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comentar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.commentfrm').on('keyup keypress', function(e) {var keyCode = e.keyCode || e.which;var formcomment = $(this).attr('data-form');if (keyCode === 13){jQuery.validator.setDefaults({debug: true,success: "valid"});var form = $('#commentfrm'+formcomment);form.validate({rules: {comentario: "required",}});var dado = form.valid();if (dado == true){var seriacomment = $('#commentfrm'+formcomment).serialize();var finalseriacomment = seriacomment+'&post='+formcomment;$.ajax({type: 'POST',url:  'includes/ajax-comments.php',data: finalseriacomment,beforeSend: function(){$('#commentfrm'+formcomment+' input').prop("disabled", true);},success: function(data){form[0].reset();$('#box-commets-body-'+formcomment).prepend(data);$('#commentfrm'+formcomment+' input').prop("disabled", false);},error: function(){}});}else{return;}e.preventDefault();return false;}});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Comentario
$('.deletecommentadmin').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdela.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
$('.deletecomment').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdelu.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.eliminarthispost').on('click', function(){var datapostdel = $(this).attr('data-post');var postdatadel = 'post='+datapostdel;$.ajax({type: 'POST',url: 'includes/ajax-deletepost.php',data: postdatadel,success: function(){setTimeout(function(){$('#post-public'+datapostdel).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});


},1000);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          },
          error: function(){

          }
    });
}

//#############################################################################################################################################
//#############################################################################################################################################
function loadtimelineprofile(){

    var senderdataload = 'page='+initialprofile+'&profile='+tokenprofile;
    $.ajax({
          type: 'POST',
          url: 'includes/ajax-loadtimeprofile.php',
          data: senderdataload,
         beforeSend: function(){
             $('#loaderlinetime').show();
          },
          success: function(data){
               setTimeout(function(){$('#loaderlinetime').hide();},1500);
               setTimeout(function(){$('#timeliner').append(data);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comentar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.commentfrm').on('keyup keypress', function(e) {var keyCode = e.keyCode || e.which;var formcomment = $(this).attr('data-form');if (keyCode === 13){jQuery.validator.setDefaults({debug: true,success: "valid"});var form = $('#commentfrm'+formcomment);form.validate({rules: {comentario: "required",}});var dado = form.valid();if (dado == true){var seriacomment = $('#commentfrm'+formcomment).serialize();var finalseriacomment = seriacomment+'&post='+formcomment;$.ajax({type: 'POST',url:  'includes/ajax-comments.php',data: finalseriacomment,beforeSend: function(){$('#commentfrm'+formcomment+' input').prop("disabled", true);},success: function(data){form[0].reset();$('#box-commets-body-'+formcomment).prepend(data);$('#commentfrm'+formcomment+' input').prop("disabled", false);},error: function(){}});}else{return;}e.preventDefault();return false;}});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Comentario
$('.deletecommentadmin').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdela.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
$('.deletecomment').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdelu.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.eliminarthispost').on('click', function(){var datapostdel = $(this).attr('data-post');var postdatadel = 'post='+datapostdel;$.ajax({type: 'POST',url: 'includes/ajax-deletepost.php',data: postdatadel,success: function(){setTimeout(function(){$('#post-public'+datapostdel).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
             },1000);
          },
          error: function(){

          }
    });
}




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.posterbtn').on('click', function(){
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $("#poster");
form.validate({
  rules: {
    posttext: "required",
  } 
});
var dado = form.valid();
if (dado == true){
        $('#noposts').hide();
        var poster = $("#poster").serialize();
        $.ajax({
          type: 'POST',
          url: 'includes/ajax-post.php',
          data: poster,
         beforeSend: function(){
             $('.posterbtn').prop("disabled", true);
          },
          success: function(data){
             $('#timeliner').prepend(data);
             $('.posterbtn').prop("disabled", false);
             form[0].reset();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Like en los post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.likethis').on('click', function(){var target = $(this).attr('data-target');var domer = $('#liker'+target);if (domer.hasClass('active')){domer.prop('disabled', true);domer.removeClass('active btn-primary').addClass('btn-default').html('<i class="fa fa-thumbs-o-up"></i> Me Gusta');like(target);checklikecomments(target);domer.prop('disabled', false);}else{domer.prop('disabled', true);domer.removeClass('btn-default').addClass('active btn-primary').html('<i class="fa fa-thumbs-o-down"></i> Ya no me gusta');like(target);checklikecomments(target);domer.prop('disabled', false);}});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comentar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.commentfrm').on('keyup keypress', function(e) {var keyCode = e.keyCode || e.which;var formcomment = $(this).attr('data-form');if (keyCode === 13){ jQuery.validator.setDefaults({debug: true,success: "valid"});var form = $('#commentfrm'+formcomment);form.validate({rules: {comentario: "required",} });var dado = form.valid();if (dado == true){var seriacomment = $('#commentfrm'+formcomment).serialize();var finalseriacomment = seriacomment+'&post='+formcomment;$.ajax({type: 'POST',url:  'includes/ajax-comments.php',data: finalseriacomment,beforeSend: function(){$('#commentfrm'+formcomment+' input').prop("disabled", true);},success: function(data){
  form[0].reset();$('#box-commets-body-'+formcomment).prepend(data);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Comentario
$('.deletecommentadmin').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdela.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
$('.deletecomment').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdelu.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('#commentfrm'+formcomment+' input').prop("disabled", false);},error: function(){showerror('Revisa tu conexion a internet');}});}else{return;}e.preventDefault();return false;}});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.eliminarthispost').on('click', function(){var datapostdel = $(this).attr('data-post');var postdatadel = 'post='+datapostdel;$.ajax({type: 'POST',url: 'includes/ajax-deletepost.php',data: postdatadel,success: function(){setTimeout(function(){$('#post-public'+datapostdel).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          },
          error: function(){
             showerror('Revisa tu conexion a internet');
          }
    });
}else{
  return;
}
});







// Cambiar imagen de perfil
$("#profilepicinput").change( function(){
  var thiselement = $(this);
  var pesoimg = this.files[0].size;
  var sizeInMB = (pesoimg / (1024*1024)).toFixed(2);
     
  if (sizeInMB > 2){
     showerror('La imagen no puede tener un tamaño superior a los 2MB.');
     $(this).val('');
     return;
  }

  //información del formulario
  var formpicture = new FormData($("#uploadpicprofilefrm")[0]);
  //hacemos la petición ajax  
  $.ajax({
      url: 'includes/ajax-img.php',  
      type: 'POST',
      // Form data
      //datos del formulario
      data: formpicture,
      //necesario para subir archivos via ajax
      cache: false,
      contentType: false,
      processData: false,
      //mientras enviamos el archivo
      beforeSend: function(){
          $('#loadingprofilepicture').show();
          $('#image-profile').addClass('opacity');
      },
      //una vez finalizado correctamente
      success: function(datapicprofile){
          $('#loadingprofilepicture').hide();
          $('#timeliner').prepend(datapicprofile);
          $('#image-profile').removeClass('opacity');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

















//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       },
      //si ha ocurrido un error
      error: function(){
          showerror('Revisa tu conexion a internet');
      }
  });
});













// Cambiar imagen de portada
$("#portadauploadinput").change( function(){
  var thiselement = $(this);
  var pesoimg = this.files[0].size;
  var sizeInMB = (pesoimg / (1024*1024)).toFixed(2);
     
  if (sizeInMB > 2){
     $('#alertimg').show();
     setTimeout(function(){$('#alertimg').fadeOut(1000);},3000);
     $(this).val('');
     return;
  }

  //información del formulario
  var formpicture = new FormData($("#portadafrm")[0]);
  //hacemos la petición ajax  
  $.ajax({
      url: 'includes/ajax-imgback.php',  
      type: 'POST',
      // Form data
      //datos del formulario
      data: formpicture,
      //necesario para subir archivos via ajax
      cache: false,
      contentType: false,
      processData: false,
      //mientras enviamos el archivo
      beforeSend: function(){
           $('#loadingprofilepicture').show();
      },
      //una vez finalizado correctamente
      success: function(datapic){
           $('#loadingprofilepicture').hide();
           $('#timeliner').prepend(datapic);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

















//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       },
      //si ha ocurrido un error
      error: function(){
          showerror('Revisa tu conexion a internet');
      }
  });
});



/// Para el Chat
$('.chatdatalink').on('click', function(){
    
    var datachat = $(this).attr('data-chat');
    var datachatname = $(this).attr('data-name');
    var appendchat = $('#chatappend');
    var chathtml = '<!-- DIRECT CHAT PRIMARY --><div  id="chater'+datachat+'"  class="box box-primary direct-chat direct-chat-primary chatbodychat"><div class="box-header with-border"><h3 class="box-title">'+datachatname+'</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool minusthis" data-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></div></div><!-- /.box-header --><div class="box-body"><!-- Conversations are loaded here --><div id="chaterbody'+datachat+'" class="direct-chat-messages"><div class="loader-inner ball-pulse loaderchat"><div></div><div></div><div></div></div><script>conversationget('+datachat+');</script></div><!--/.direct-chat-messages--></div><!-- /.box-body --><div class="box-footer"><form id="chatfrm'+datachat+'" data-idfrmchat="'+datachat+'" method="post" class="formerchatfrm"><div class="input-group chatinput"><input type="text" name="message" placeholder="Mensaje..." class="form-control"></div></form></div><!-- /.box-footer--></div><!--/.direct-chat -->';
    var chatver = $("#chater"+datachat);

    if (chatver.length){
       chatver.remove();
       appendchat.html(chathtml);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       return;
    }else{
       appendchat.html(chathtml);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('.formerchatfrm').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  var frmchat = $(this).attr('data-idfrmchat');
  if (keyCode === 13){ 


jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $('#chatfrm'+frmchat);
form.validate({
  rules: {
    message: "required",
  } 
});
var dado = form.valid();

if (dado == true){


         var serialform = form.serialize();

         if (frmchat == 1){
            var messagesend = 'chater='+frmchat+'&'+serialform+'&profile='+tokenprofile;
         }else{
            var messagesend = 'chater='+frmchat+'&'+serialform;
         }

         $.ajax({
           type: 'POST',
           url:  'includes/ajax-messagechat.php',
           data: messagesend,
           beforeSend: function(){
             $('#chatfrm'+frmchat+' input').prop("disabled", true);
           },
           success: function(data){
             form[0].reset();
             $('#chaterbody'+frmchat).append(data);
             $('#chatfrm'+frmchat+' input').prop("disabled", false);
             $('#chaterbody'+frmchat).scrollTop($('#chaterbody'+frmchat)[0].scrollHeight);
             $('#chatfrm'+frmchat+' input').focus();
           },
           error: function(){
              showerror('Revisa tu conexion a internet');
           }
        });

}else{
  return;
}

    e.preventDefault();
    return false;
  }
});



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    
});



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Para el chat full
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('.chatdatalinkfull').on('click', function(){
    
   var thechat = $(this).attr('data-chat');
   var converchatget = 'conversation='+thechat;

    $.ajax({

      type: 'POST',
      url:  'includes/ajax-conversation.php',
      data: converchatget,
      beforeSend: function(){
          $('#conversation-body').html('<div class="loader-inner ball-pulse"><div></div><div></div><div></div></div>');
      },
      success: function(data){
         setTimeout(function(){
          $('#conversation-body').html(data);
          $('#conversation-body').scrollTop($('#conversation-body')[0].scrollHeight);
          $('#full-box-message form').attr('id','chatfrm'+thechat);
          $('#full-box-message form').attr('data-idfrmchat', thechat);
          $('#full-box-message').show();
       },1000);

      },
      error: function(){
          showerror('Revisa tu conexion a internet');
      }

    });
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Para responder el chat
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$('.formerchatfrmfull').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  var frmchat = $(this).attr('data-idfrmchat');
  if (keyCode === 13){ 


jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $('#chatfrm'+frmchat);
form.validate({
  rules: {
    message: "required",
  } 
});
var dado = form.valid();

if (dado == true){


         var serialform = form.serialize();

         if (frmchat == 1){
            var messagesend = 'chater='+frmchat+'&'+serialform+'&profile='+tokenprofile;
         }else{
            var messagesend = 'chater='+frmchat+'&'+serialform;
         }

         $.ajax({
           type: 'POST',
           url:  'includes/ajax-messagechat.php',
           data: messagesend,
           beforeSend: function(){
             $('#chatfrm'+frmchat+' input').prop("disabled", true);
           },
           success: function(data){
             form[0].reset();
             $('#conversation-body').append(data);
             $('#chatfrm'+frmchat+' input').prop("disabled", false);
             $('#conversation-body').scrollTop($('#conversation-body')[0].scrollHeight);
             $('#chatfrm'+frmchat+' input').focus();
           },
           error: function(){
              showerror('Revisa tu conexion a internet');
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



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Check like Comments
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function checklikecomments(likedata){
       var dum = $('#likecomment'+likedata);
       var likedatasender = 'like='+likedata;
       $.ajax({
           type: 'POST',
           url: 'includes/ajax-likecheck.php',
           data: likedatasender,
           beforeSend: function(){
              dum.html(' ');
              dum.html('<i class="fa fa-cog fa-spin"></i>');
           },
           success: function(data){
              setTimeout(function(){dum.html(data);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




















//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           },500);
              return;
           },
           error: function(){
              showerror('Revisa tu conexion a internet');
           }
    });
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





// funcion para los archivos
$('.uploadarchive').on('click', function(){

jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $('#attachmentfrm');
form.validate({
  rules: {
    descripcion: "required",
    archivo: "required"
  } 
});
var dado = form.valid();

if (dado == true){

//información del formulario
var formarchive = new FormData($("#attachmentfrm")[0]);

$.ajax({
      url: 'includes/ajax-attachment.php',  
      type: 'POST',
      // Form data
      //datos del formulario
      data: formarchive,
      //necesario para subir archivos via ajax
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(){
          $('#thefilattch').hide();
          $('#loadeingarchive').show();
      },
      success: function(data){
         
          if (data == ""){
              $('#attachmentfrm')[0].reset();
              $('#thefilattch').show();
              $('#loadeingarchive').hide();
          }else{
              $('#ModalDocumment').modal('toggle');
              $('#attachmentfrm')[0].reset();
              $('#thefilattch').show();
              $('#loadeingarchive').hide();
              $('#timeliner').prepend(data);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comentar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.commentfrm').on('keyup keypress', function(e) {var keyCode = e.keyCode || e.which;var formcomment = $(this).attr('data-form');if (keyCode === 13){jQuery.validator.setDefaults({debug: true,success: "valid"});var form = $('#commentfrm'+formcomment);form.validate({rules: {comentario: "required",}});var dado = form.valid();if (dado == true){var seriacomment = $('#commentfrm'+formcomment).serialize();var finalseriacomment = seriacomment+'&post='+formcomment;$.ajax({type: 'POST',url:  'includes/ajax-comments.php',data: finalseriacomment,beforeSend: function(){$('#commentfrm'+formcomment+' input').prop("disabled", true);},success: function(data){form[0].reset();$('#box-commets-body-'+formcomment).prepend(data);$('#commentfrm'+formcomment+' input').prop("disabled", false);},error: function(){}});}else{return;}e.preventDefault();return false;}});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Comentario
$('.deletecommentadmin').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdela.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
$('.deletecomment').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdelu.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          }

      },
      error: function(){
         showerror('Revisa tu conexion a internet');
      }
});
}else{
  return;
}


});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.showthepictureitem').on('click', function(){

   var item = $(this).attr('data-id');
   var sender = 'data='+item;

    $.ajax({
      url: 'includes/ajax-showimage.php',  
      type: 'POST',
      data: sender,
      beforeSend: function(){
         $('#picturebodymodaldiv').html(' ');
         $('#picturebodymodaldiv').html('<div class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div>');
      },
      success: function(data){
         $('#picturebodymodaldiv').html(' ');
         $('#picturebodymodaldiv').append(data);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comentar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.commentfrm').on('keyup keypress', function(e) {var keyCode = e.keyCode || e.which;var formcomment = $(this).attr('data-form');if (keyCode === 13){jQuery.validator.setDefaults({debug: true,success: "valid"});var form = $('#commentfrm'+formcomment);form.validate({rules: {comentario: "required",}});var dado = form.valid();if (dado == true){var seriacomment = $('#commentfrm'+formcomment).serialize();var finalseriacomment = seriacomment+'&post='+formcomment;$.ajax({type: 'POST',url:  'includes/ajax-comments.php',data: finalseriacomment,beforeSend: function(){$('#commentfrm'+formcomment+' input').prop("disabled", true);},success: function(data){form[0].reset();$('#box-commets-body-'+formcomment).prepend(data);$('#commentfrm'+formcomment+' input').prop("disabled", false);},error: function(){}});}else{return;}e.preventDefault();return false;}});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Comentario
$('.deletecommentadmin').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdela.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
$('.deletecomment').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdelu.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


         
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      },
      error: function(){
        showerror('Revisa tu conexion a internet.');
      }
     });


});






//#############################################################################################################################################
//#############################################################################################################################################
function loadtimelinefeed(){

    var senderdataload = 'page='+initialfeed;
    $.ajax({
          type: 'POST',
          url: 'includes/ajax-loadtimefeed.php',
          data: senderdataload,
         beforeSend: function(){
             $('#loaderlinetime').show();
          },
          success: function(data){
               setTimeout(function(){$('#loaderlinetime').hide();},1500);
               setTimeout(function(){$('#timeliner').append(data);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comentar Post
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.commentfrm').on('keyup keypress', function(e) {var keyCode = e.keyCode || e.which;var formcomment = $(this).attr('data-form');if (keyCode === 13){jQuery.validator.setDefaults({debug: true,success: "valid"});var form = $('#commentfrm'+formcomment);form.validate({rules: {comentario: "required",}});var dado = form.valid();if (dado == true){var seriacomment = $('#commentfrm'+formcomment).serialize();var finalseriacomment = seriacomment+'&post='+formcomment;$.ajax({type: 'POST',url:  'includes/ajax-comments.php',data: finalseriacomment,beforeSend: function(){$('#commentfrm'+formcomment+' input').prop("disabled", true);},success: function(data){form[0].reset();$('#box-commets-body-'+formcomment).prepend(data);$('#commentfrm'+formcomment+' input').prop("disabled", false);},error: function(){}});}else{return;}e.preventDefault();return false;}});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Eliminar Comentario
$('.deletecommentadmin').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdela.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
$('.deletecomment').on('click', function(){var cmt = $(this).attr('data-comment');var sendercmt = 'comentario='+cmt;$.ajax({type: 'POST',url:  'includes/ajax-commentsdelu.php',data: sendercmt,beforeSend(){$('#commentario-per-'+cmt).addClass('opacity');},success: function(){$('#commentario-per-'+cmt).addClass('animated bounceOut').fadeOut(1000);setTimeout(function(){$('#commentario-per-'+cmt).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('.eliminarthispost').on('click', function(){var datapostdel = $(this).attr('data-post');var postdatadel = 'post='+datapostdel;$.ajax({type: 'POST',url: 'includes/ajax-deletepost.php',data: postdatadel,success: function(){setTimeout(function(){$('#post-public'+datapostdel).remove();},1500);},error: function(){showerror('Revisa tu conexion a internet');}});});


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
             },1000);
          },
          error: function(){

          }
    });
}