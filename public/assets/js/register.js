$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#registerForm').on('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    // Get form data
    var formData = $(this).serialize();
    console.log(formData);

    // Send AJAX request
    $.ajax({
      url: '/register',
      type: 'POST',
      data: formData,
      success: function (response) {
        // Handle success response
        console.log(response);

        window.location.href = '/';
      },
      error: function (xhr, status, error) {
        // Handle error response
        console.error(xhr.responseText);
        // Optionally, you can display an error message to the user
        alert('An error occurred. Please try again later.');
      }
    });
  });
});
