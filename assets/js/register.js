$(document).ready(function() {
  const errorInfo = document.getElementById('errorInfo')
  const validUserRegex = "^(?=.{6,12}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$"
  const validPassRegex = "^(?=.*?[a-z])(?=.*?[0-9]).{6,}$"
  const xssRegex = "(\b)(on\S+)(\s*)=|javascript|<(|\/|[^\/>][^>]+|\/[^>][^>]+)>|<|>"
 
  var isFormValid = false;
  
  function checkForm(isValid) {
    if (isValid) {
      errorInfo.innerHTML = ""
    }
    $('button[type="submit"]').toggleClass("disabled", !isValid)
    return
  }

  function checkUser() {
    var userInput = $('#userInput').val()
    $.ajax({
      type: 'POST',
      url: '/controller/userHandler.php',
      data: {
        'action': 'checkExist',
        'username': userInput
      },
      success: (res) => {
        if(res == 'true') {
          isFormValid = false
          errorInfo.innerHTML = "El usuario ya existe."
          checkForm(isFormValid)
        }
      }
    })
  }

  $('input.form-control').on("input", function() {
    var userInput = $('#userInput').val()
    var passwdInput = $('#passwordInput').val()
    var repeatPasswd = $('#passwordInputRep').val()
    isFormValid = true

    if (!userInput.match(validUserRegex)) {
      isFormValid = false
      errorInfo.innerHTML = "El usuario debe contener entre 6 y 12 caracteres, <br> entre a-z, A-Z, 0-9, '_', '.', empezar y terminar por caracteres alfanumericos, <br> y no __ o .. ."
    } else {
      checkUser()
    }
    if (passwdInput !== repeatPasswd) {
      isFormValid = false
      errorInfo.innerHTML = "Las contraseñas no coinciden."
    }
    if (!passwdInput.match(validPassRegex)) {
      isFormValid = false
      errorInfo.innerHTML = "La contraseña debe contener al menos 6 caracteres, <br> una letra y un numero."
    }
    if (userInput.match(xssRegex) || passwdInput.match(xssRegex)) {
      isFormValid = false
      errorInfo.innerHTML = "Caracter no permitido."
    }
    if (userInput.length < 6 || passwdInput.length < 6) {
      isFormValid = false
      errorInfo.innerHTML = "Los campos deben tener al menos 6 caracteres."
    }
    if (!userInput || !passwdInput) {
      isFormValid = false
      errorInfo.innerHTML = "Debes rellenar todos los campos."
    }
    checkForm(isFormValid)
  })

  checkForm(isFormValid)

  $('#loginForm').submit(function(e) {
    if (!isFormValid) {
      e.preventDefault()
      window.alert("Error en el formulario. Corrigelos.")
    }
  })

})