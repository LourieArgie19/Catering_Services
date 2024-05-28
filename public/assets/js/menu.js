$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function fetchMenu() {
    $.ajax({
      type: 'GET',
      url: '/fetch-Menu',
      dataType: 'json',
      success: function (response) {
        // Clear the existing table data
        $('tbody').empty();

        // Iterate over each billing record in the response and append it to the table
        $.each(response.munes, function (key, menu) {
          var actions =
            '<div class="dropdown">' +
            '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>' +
            '<div class="dropdown-menu">' +
            '<a class="dropdown-item edit-user" data-id="' +
            menu.id +
            '"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>' +
            '<a class="dropdown-item delete-user" data-id="' +
            menu.id +
            '"><i class="mdi mdi-trash-can-outline me-1"></i> Delete</a>' +
            '</div>' +
            '</div>';
          $('tbody').append(
            '<tr data-id="' +
              menu.id +
              '">' +
              '<td>' +
              user.fullname +
              '</td>' +
              '<td>' +
              user.email +
              '</td>' +
              '<td>' +
              user.contact +
              '</td>' +
              '<td>' +
              menu.address +
              '</td>' +
              '<td>' +
              actions +
              '</td>' +
              '</tr>'
          );
        });
      }
    });
  }

  // Call fetchBillings function after it's defined
  fetchMenu();
  // Submit registration form
  $(document).ready(function () {
    $('#reserveForm').submit(function (e) {
      e.preventDefault(); // Prevent the form from submitting in the traditional way

      var formData = $(this).serialize(); // Serialize the form data
      console.log(formData);

      // Send AJAX request
      $.ajax({
        url: '/store-user',
        type: 'POST',
        data: formData,
        success: function (response) {
          // Handle success response
          console.log(response);
          if (response.success) {
            $('#basicModal').modal('hide'); // Close the modal on successful registration
            fetchUser(); // Update user list
            Swal.fire({
              // Show success message
              icon: 'success',
              title: 'Success!',
              text: response.message,
              onClose: function () {
                $('body').removeClass('swal2-backdrop-show'); // Remove backdrop class
              }
            });
          }
        },
        error: function (xhr) {
          // Handle error response
          console.error(xhr.responseText);
          $('#basicModal').modal('hide');
          var errorMessage = xhr.responseJSON.errors
            ? Object.values(xhr.responseJSON.errors)[0][0]
            : 'An error occurred. Please try again later.';
          Swal.fire({
            // Show error message
            icon: 'error',
            title: 'Oops...',
            text: errorMessage,
            onClose: function () {
              $('body').removeClass('swal2-backdrop-show'); // Remove backdrop class
            }
          });
        }
      });
    });
  });

  // Other code for form submission, updating data, etc. remains the same as before
});
