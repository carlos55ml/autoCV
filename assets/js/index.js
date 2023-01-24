$(document).ready(async function() {
  const isLogged = document.getElementById('isLogged')
  if(!isLogged) {
    setTimeout(()=> {
      const welcomeModal = new bootstrap.Modal('#welcomeModal', {
        keyboard: false,
        backdrop: 'static'
      })
      welcomeModal.show()
    }, 5000)
  }

  
})