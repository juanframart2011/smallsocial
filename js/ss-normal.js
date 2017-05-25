




//Validacion del Login
$("#loginfrm").validate({
  rules: {
    password: "required",
    email: {
      required: true,
      email: true
    }
  }
});



//Validacion del Login
$("#registerfrm").validate({
  rules: {
    type_user: "required",
    nombre: "required",
    localidad: "required",
    day: "required",
    month: "required",
    year: "required",
    apellido: "required",

    passwordone: {
      required: true,
      maxlength: 10,
      minlength: 6
    },
    passwordtwo: {
      equalTo: "#passwordone"
    },
    email: {
      required: true,
      email: true
    }
  }
});