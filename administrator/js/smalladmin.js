$('.edituser').on('click', function(){
    var atributo = $(this).attr('data-id');
    var sender = 'process=1&usuario='+atributo;

    $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: sender,
         beforeSend: function(){
            $('#data-append').html(' ');
         },
         success: function(data){
            $('#data-append').html(data);
            $('#myModal').modal('show');
//-----------------------------------------------------------------------------

// Cambiar datos basicos
$('.cambiardatosuser').on('click', function(){


jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $("#frmeditusr");
form.validate({
  rules: {
      nombre: "required",
      apellido: "required",
      permalink: "required",
      activo: "required",
      rango: "required",
  } 
});
var dado = form.valid();
if (dado == true){

     var former = $('#frmeditusr');
     var serialusr = former.serialize();
     var sendpro = 'process=2&'+serialusr;
     var dateboton = $(this);

     $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: sendpro,
         beforeSend: function(){
            former.hide();
            dateboton.hide();
            former.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
         },
         success: function(){
            $('#loadingloader').remove();
            former.show();
            dateboton.show();
         },
         error: function(){

         }
     });

}else{
  return;
}

});



// Eliminar Imagen
$('.deleteimguser').on('click', function(){
    
     var usuariodatapic = $(this).attr('data-user');
     var procesopic = 'process=3&usuario='+usuariodatapic;

     $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: procesopic,
         beforeSend: function(){
            $('#imageprofilechange').addClass('opacityimgload');
            $('#imageprofilechange').parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
         
         },
         success: function(data){
            $('#loadingloader').remove();
            $('#imageprofilechange').attr('src', '../sau-content/images/profile-normal.png');
            $('#imageprofilechange').removeClass('opacityimgload');
         },
         error: function(){

         }
     });
});



// chage profile img
$('.changeimguser').on('click', function(){
   $('#changeprofile').click();
});

// Cambiar imagen de perfil
$("#changeprofile").change( function(){

  pesoimg = this.files[0].size;
  var sizeInMB = (pesoimg / (1024*1024)).toFixed(2);
     
  if (sizeInMB > 2){
     $('#alertimg').show();
     setTimeout(function(){$('#alertimg').fadeOut(1000);},3000);
     $(this).val('');
     return;
  }

  //información del formulario
  var formpicture = new FormData($("#profileserialize")[0]);
  //hacemos la petición ajax  
  $.ajax({
      url: 'admin.process.php', 
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
          $('#imageprofilechange').addClass('opacityimg');
          $('#imageprofilechange').parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
      },
      //una vez finalizado correctamente
      success: function(data){

         if (data == 1){
           $('#alertimg').show();
           setTimeout(function(){$('#alertimg').fadeOut(1000);},3000);
           $(this).val('');
         }else{
           $('#imageprofilechange').attr('src', data);
           $('#imageprofilechange').removeClass('opacityimg');
           $('#loadingloader').remove();
           $(this).val('');
         }
       },
      //si ha ocurrido un error
      error: function(){
      }
  });
});


// Cambiar password
$('.changeuserpassadm').on('click', function(){
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var formerpassuser = $("#userchangepass");
formerpassuser.validate({
  rules: {
    newpassword: "required",
    passtwo: {
      equalTo: "#newpassequal",
      required: true,
    }    
  }
});
var dadodale = formerpassuser.valid();
if (dadodale == true){
        var sriapre1 = $("#userchangepass").serialize();
        var updaoption1 = 'process=5&'+sriapre1;
        var botonepass = $(this);

        $.ajax({
           type: 'POST',
           url: 'admin.process.php',
           data: updaoption1,
           beforeSend: function(){

              formerpassuser.hide();
              botonepass.hide();
              formerpassuser.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
           
           },
           success: function(data){

              $('#loadingloader').remove();
              $("#userchangepass")[0].reset();
              botonepass.show();
              formerpassuser.show();

           },error: function(){

           }
      });
}else{
  return;
}
});


// Cambio de email  ////////////////////////////////////////////////////////////////
$('.cambiaremailadmbutton').on('click', function(){
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $("#changeemailadm");
form.validate({
  rules: {
    email: {
      required: true,
      email: true
    }
  } 
});
var dado = form.valid();
if (dado == true){
     var former = $('#changeemailadm');
     var serialusr = former.serialize();
     var sendpro = 'process=16&'+serialusr;
     var dateboton = $(this);
     $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: sendpro,
         beforeSend: function(){
            former.hide();
            dateboton.hide();
            former.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
         },
         success: function(data){
            alert(data);
            $('#loadingloader').remove();
            former.show();
            dateboton.show();
         },
         error: function(){
         }
     });
}else{
  return;
}
});


//-----------------------------------------------------------------------------
         },
         error: function(){

         }
    });
});


$('.crearnuevousuario').on('click', function(){
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $("#newuseradminfrm");
form.validate({
  rules: {
      nombre: "required",
      apellido: "required",
      email: "required",
      contrasena: "required",
      activo: "required",
      rango: "required",
      day: "required",
      month: "required",
      year: "required",
  } 
});
var dado = form.valid();
if (dado == true){
     var former = $('#newuseradminfrm');
     var serialusr = former.serialize();
     var sendpro = 'process=6&'+serialusr;
     var dateboton = $(this);
     $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: sendpro,
         beforeSend: function(){
            former.hide();
            dateboton.hide();
            former.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
         },
         success: function(data){
            alert(data);
            $('#loadingloader').remove();
            former.show();
            dateboton.show();
            $('#NewUserModal').modal('toggle');
            former[0].reset();
            //location.reload();
         },
         error: function(){

         }
     });

}else{
  return;
}
});


$('.vercomentarios').on('click', function(){
    
     var publicacion = $(this).attr('data-id');
     var procesdelpubli = 'process=14&publicacion='+publicacion;

     $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: procesdelpubli,
         beforeSend: function(){
           $('#data-append').html(' ');
           $('#trpublicacion'+publicacion).addClass('opacityimgload');
         },
         success: function(data){
           $('#data-append').append(data);
           $('#trpublicacion'+publicacion).removeClass('opacityimgload');
           $('#myModal').modal('show');
//-----------------------------------------------------------------------

$('.deletecomment').on('click', function(){
   var comment = $(this).attr('data-comment');
   var doompost = $('#time-comment-'+comment);
   $(this).addClass('animated zoomOut');
   var deletesender = 'process=15&delete='+comment;
   $.ajax({
      type: 'POST',
      url: 'admin.process.php',
      data: deletesender,
      beforeSend: function(){
        doompost.prepend('<div id="loaders"><div class="loader-inner line-scale-pulse-out-rapid"><div></div><div></div><div></div><div></div><div></div></div></div>');
      },
      success: function(){
        doompost.addClass('animated bounceOut').fadeOut(1000);
        setTimeout(function(){doompost.remove();},2000);
      },
      error: function(){

      }
   });
});

//-----------------------------------------------------------------------
         },
         error: function(){

         }
     });
});



$('.editpublicacion').on('click', function(){

     var publicacion = $(this).attr('data-id');
     var procespubli = 'process=8&publicacion='+publicacion;

     $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: procespubli,
         beforeSend: function(){
           $('#data-append').html(' ');
           $('#trpublicacion'+publicacion).addClass('opacityimgload');
         },
         success: function(data){
           $('#data-append').html(' ');
           $('#trpublicacion'+publicacion).removeClass('opacityimgload');
           $('#data-append').append(data);
           $('#myModal').modal('show');
//-----------------------------------------------------------------------
$('.savepublicacion').on('click', function(){
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $("#publicacioneditfrm");
form.validate({
  rules: {
      publicacion: "required",
  } 
});
var dado = form.valid();
if (dado == true){
     var former = $('#publicacioneditfrm');
     var serialusr = former.serialize();
     var sendpro = 'process=9&'+serialusr;
     var dateboton = $(this);
     $.ajax({
         type: 'POST',
         url: 'admin.process.php',
         data: sendpro,
         beforeSend: function(){
            former.hide();
            dateboton.hide();
            former.parent().append('<p></p><div id="loadingloader" class="loader-inner line-scale"><div></div><div></div><div></div><div></div><div></div></div><p></p>');
         },
         success: function(){
            $('#loadingloader').remove();
            former.show();
            dateboton.show();
            $('#myModal').modal('toggle');
         },
         error: function(){

         }
     });

}else{
  return;
}
});
//-----------------------------------------------------------------------
         },
         error: function(){
         }
     });
});