var $_GET = {};
var loadingModal, errorModal

function readGet() {
  if (document.location.toString().indexOf('?') !== -1) {
    var query = document.location
      .toString()
      // get the query string
      .replace(/^.*?\?/, '')
      // and remove any existing hash string (thanks, @vrijdenker)
      .replace(/#.*$/, '')
      .split('&');
    for (var i = 0, l = query.length; i < l; i++) {
      var aux = decodeURIComponent(query[i]).split('=');
      $_GET[aux[0]] = aux[1];
    }
  }
}

// FORMACION
var formationIndex = 1
function addFormationFields() {
  const lastElement = document.querySelector(`div#formation-${formationIndex}`)
  formationIndex++

  var newFields = document.createElement("div")
  newFields.id = `formation-${formationIndex}`
  newFields.innerHTML =
    `<br><h5>Nombre</h5>
    <span id="formationName-${formationIndex}"></span>
    <h5>Centro realizado</h5>
    <span id="formationCenter-${formationIndex}"></span>
    <h5>Periodo</h5>
    <span id="formationPeriod-${formationIndex}"></span>`
  lastElement.after(newFields)
}

// EXPERIENCIA
var experienceIndex = 1
function addExperienceFields() {
  const lastElement = document.querySelector(`div#experience-${experienceIndex}`)
  experienceIndex++

  var newFields = document.createElement("div")
  newFields.id = `experience-${experienceIndex}`
  newFields.innerHTML =
    `<br><div id="experience-${experienceIndex}">
  <h5>Puesto</h5>
  <span id="experienceName-${experienceIndex}"></span>
  <h5>Empresa</h5>
  <span id="experienceCenter-${experienceIndex}"></span>
  <h5>Periodo</h5>
  <span id="experiencePeriod-${experienceIndex}"></span>
  </div>`
  lastElement.after(newFields)
}

// OTROS
var otherIndex = 1
function addOtherFields() {
  const lastElement = document.querySelector(`div#other-${otherIndex}`)
  otherIndex++

  var newFields = document.createElement("div")
  newFields.id = `other-${otherIndex}`
  newFields.innerHTML =
    `<div id="other-${otherIndex}">
    <b><span id="otherName-${otherIndex}"></span>: </b><span class="nobold" id="otherDescription-${otherIndex}"></span>
  </div>`
  lastElement.after(newFields)
}

function makeCv(data) {
  fieldsArray = JSON.parse(data)

  // CREA TODOS LOS CAMPOS
  for (var i = 1; i < fieldsArray.formations; i++) { addFormationFields() }

  for (var i = 1; i < fieldsArray.experiences; i++) { addExperienceFields() }

  for (var i = 1; i < fieldsArray.others; i++) { addOtherFields() }

  // RELLENA LOS CAMPOS
  Object.entries(fieldsArray).forEach(([k, v]) => {
    $(`span#${k}`).text(v)
  });

  setTimeout(() => {
    loadingModal.hide()
  }, 500)
}

$(document).ready(async function () {
  loadingModal = new bootstrap.Modal('#loadingModal', {
    keyboard: false,
    backdrop: 'static'
  })
  errorModal = new bootstrap.Modal('#errorModal', {
    keyboard: false,
    backdrop: 'static'
  })

  loadingModal.show()

  readGet()

  const target = $_GET['id'] || $('input[type="hidden"][name="userId"]').val()
  if (!target) {
    errorModal.show()
    return
  }
  $.ajax({
    type: 'POST',
    url: '/controller/cvHandler.php',
    data: {
      'action': 'fetchUserCv',
      'userId': target
    },
    success: (res) => {
      if (res) {
        makeCv(res)
      } else {
        setTimeout(() => {
          loadingModal.hide()
        }, 500)
        errorModal.show()
      }
    }
  })
})
