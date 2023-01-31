/**
 * ELEMENTOS
 */
var loadingModal


/**
 * FORMACION
 */
var formationIndex = 1

function addFormationFields() {
  const lastElement = document.querySelector(`div#formation-${formationIndex}`)
  formationIndex++
  if (formationIndex > 5) {
    window.alert("No puedes crear mas de 5 distinciones de Formacion.")
    return
  }
  $(`input[type="hidden"][name="formations"]`).val(formationIndex)

  var newFields = document.createElement("div")
  newFields.id = `formation-${formationIndex}`
  newFields.innerHTML =
    `<hr><div id="formation-${formationIndex}">
  <label for="formationName-${formationIndex}" class="form-label">Titulo</label>
  <input type="text" class="form-control" id="formationName-${formationIndex}" name="formationName-${formationIndex}" placeholder="Primaria">
  <label for="formationCenter-${formationIndex}" class="form-label">Centro o Universidad</label>
  <input type="text" class="form-control" id="formationCenter-${formationIndex}" name="formationCenter-${formationIndex}" placeholder="IES San Idelfonso">
  <label for="formationPeriod-${formationIndex}" class="form-label">Periodo</label>
  <input type="text" class="form-control" id="formationPeriod-${formationIndex}" name="formationPeriod-${formationIndex}" placeholder="Sep 2010 - Jul 2016">
  </div>`
  lastElement.after(newFields)
}

function removeFormationFields() {
  if (formationIndex > 1) {
    $(`div#formation-${formationIndex}`).remove()
    formationIndex--
    $(`input[type="hidden"][name="formations"]`).val(formationIndex)

  }
}
$('button#addFormation').click(addFormationFields)
$('button#removeFormation').click(removeFormationFields)


/**
 * EXPERIENCIA
 */
var experienceIndex = 1

function addExperienceFields() {
  const lastElement = document.querySelector(`div#experience-${experienceIndex}`)
  experienceIndex++
  if (experienceIndex > 5) {
    window.alert("No puedes crear mas de 5 distinciones de Experiencia Profesional.")
    return
  }
  $(`input[type="hidden"][name="experiences"]`).val(experienceIndex)

  var newFields = document.createElement("div")
  newFields.id = `experience-${experienceIndex}`
  newFields.innerHTML =
    `<hr><div id="experience-${experienceIndex}">
    <label for="experienceName-${experienceIndex}" class="form-label">Puesto</label>
    <input type="text" class="form-control" id="experienceName-${experienceIndex}" name="experienceName-${experienceIndex}" placeholder="Tecnico">
    <label for="experienceCenter-${experienceIndex}" class="form-label">Empresa</label>
    <input type="text" class="form-control" id="experienceCenter-${experienceIndex}" name="experienceCenter-${experienceIndex}" placeholder="Coca Cola SA">
    <label for="experiencePeriod-${experienceIndex}" class="form-label">Periodo</label>
    <input type="text" class="form-control" id="experiencePeriod-${experienceIndex}" name="experiencePeriod-${experienceIndex}" placeholder="Sep 2010 - Jul 2016">
  </div>`
  lastElement.after(newFields)
}

function removeExperienceFields() {
  if (experienceIndex > 1) {
    $(`div#experience-${experienceIndex}`).remove()
    experienceIndex--
    $(`input[type="hidden"][name="experiences"]`).val(experienceIndex)

  }
}
$('button#addExperience').click(addExperienceFields)
$('button#removeExperience').click(removeExperienceFields)

/**
 * OTROS
 */
var otherIndex = 1

function addOtherFields() {
  const lastElement = document.querySelector(`div#other-${otherIndex}`)
  otherIndex++
  if (otherIndex > 5) {
    window.alert("No puedes crear mas de 5 distinciones de Otros.")
    return
  }
  $(`input[type="hidden"][name="others"]`).val(otherIndex)

  var newFields = document.createElement("div")
  newFields.id = `other-${otherIndex}`
  newFields.innerHTML =
    `<hr><div id="other-${otherIndex}">
    <label for="otherName-${otherIndex}" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="otherName-${otherIndex}" name="otherName-${otherIndex}" placeholder="Ingles">
    <label for="otherDescription-${otherIndex}" class="form-label">Descripcion</label>
    <input type="text" class="form-control" id="otherDescription-${otherIndex}" name="otherDescription-${otherIndex}" placeholder="Nivel Alto">
  </div>`
  lastElement.after(newFields)
}

function removeOtherFields() {
  if (otherIndex > 1) {
    $(`div#other-${otherIndex}`).remove()
    otherIndex--
    $(`input[type="hidden"][name="others"]`).val(otherIndex)

  }
}
$('button#addOther').click(addOtherFields)
$('button#removeOther').click(removeOtherFields)

/**
 * Relleno
 */

async function fillFields(json) {
  fieldsArray = JSON.parse(json)

  for (var i = 1; i < fieldsArray.formations; i++) {
    addFormationFields()
  }
  delete fieldsArray.formations

  for (var i = 1; i < fieldsArray.experiences; i++) {
    addExperienceFields()
  }
  delete fieldsArray.experiences

  for (var i = 1; i < fieldsArray.others; i++) {
    addOtherFields()
  }
  delete fieldsArray.others



  Object.entries(fieldsArray).forEach(([k, v]) => {
    $(`input[name="${k}"]`).val(v)
  });

  setTimeout(() => {
    loadingModal.hide();
  }, 500)
}

$(document).ready(async function () {
  const userId = $('input[type="hidden"][name="userId"]').val()
  loadingModal = new bootstrap.Modal('#loadingModal', {
    keyboard: false,
    backdrop: 'static'
  })

  loadingModal.show()

  $.ajax({
    type: 'POST',
    url: '/controller/cvHandler.php',
    data: {
      'action': 'fetchUserCv',
      'userId': userId
    },
    success: (res) => {
      if (res) {
        fillFields(res)
      } else {
        console.error("CV DEL USUARIO NO ENCONTRADO");
      }
    }
  })
})