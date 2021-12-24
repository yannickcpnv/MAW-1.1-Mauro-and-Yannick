document.querySelectorAll('.popup-confirm').forEach(element => {
  console.debug('test')
  element.addEventListener('click', event => {
    if (!confirm(element.dataset.confirm)) {
      event.preventDefault()
    }
  })
})