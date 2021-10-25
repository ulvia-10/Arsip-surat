const flashData = $('.flash-data').data('flashdata');
const flashDataError = $('.flash-data-error').data('flashdataerror');
if (flashData) {
  Swal.fire({
    title: flashData + ' Sukses',
    text: '',
    type: 'success'
  });
} else if (flashDataError) {
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: flashDataError,
  })
}
