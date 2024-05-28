//saGoogle
$.ajaxSetup({
  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

function decodeJwtResponse(token) {
  let base64Url = token.split('.')[1];
  let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  let jsonPayload = decodeURIComponent(
    atob(base64)
      .split('')
      .map(function (c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
      })
      .join('')
  );
  return JSON.parse(jsonPayload);
}

window.onSignIn = googleUser => {
  var user = decodeJwtResponse(googleUser.credential);

  if (user) {
    $.ajax({
      url: '/google',
      method: 'post',
      data: { email: user.email },
      beforeSend: function () {},
      success: function (response) {
        console.log(response);
        if (response.status_code == 0) {
          $('#error').html('<div class="alert alert-success">Redirecting... Please wait..</div>').show();
          window.location.href = '/dashboard-analytics';
        } else {
          $('#error').text('Account Not Found. Pease Register!').show();
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  } else {
    $('#error').html('Account Not Found. Pease Register!').show();
  }
};
