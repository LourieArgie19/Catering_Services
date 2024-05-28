$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  // Handle form submission for adding a reservation
  $('#reserveForm').on('submit', function (e) {
    e.preventDefault();

    $('#reserveForm').on('submit', function (e) {
      e.preventDefault();

      var formData = {
        _token: $('input[name="_token"]').val(),
        user_id: $('#user_id').val(),
        address: $('#address').val(),
        packages: $('#packages').val(),
        date: $('#date').val()
      };

      console.log('Submitting form data:', formData);

      $.ajax({
        type: 'POST',
        url: '/reservations', // Adjust this URL to your actual endpoint
        data: formData,
        success: function (response) {
          console.log('Response from server:', response);
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message
          }).then(() => {
            // Reload the reservations
            fetchReservations();
            // Close the modal
            $('#basicModal').modal('hide');
          });
        },
        error: function (xhr) {
          console.log('Error response from server:', xhr);
          if (xhr.status === 409) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'The selected date is already reserved. Please choose another date.'
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong. Please try again.'
            });
          }
        }
      });
    });
  });
});
