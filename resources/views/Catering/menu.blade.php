@extends('layouts/contentNavbarLayout')

@section('title', 'Packages Menu')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light"></span>Packages Menu</h4>

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add Reservation</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reserveForm" action="{{ route('add.reservations') }}">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="row">
                        <div class="col mb-4 mt-2">
                            <div class="form-floating form-floating-outline">
                                <span id="fullname" name="fullname"
                                    class="form-control">{{ auth()->user()->fullname }}</span>
                                <label for="fullname">Fullname</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <span id="email" name="email" class="form-control">{{ auth()->user()->email }}</span>
                                <label for="email">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <span id="contact" name="contact"
                                    class="form-control">{{ auth()->user()->contact }}</span>
                                <label for="contact">Contact</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="address">
                                <label for="address">Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-2 form-floating form-floating-outline">
                            <select class="form-select" id="packages" name="packages" placeholder="Packages"
                                aria-label="Default select example">
                                <option selected> </option>
                                <option value="wedding">Wedding</option>
                                <option value="debut">Debut</option>
                                <option value="privateparty">Private Party</option>
                            </select>
                            <label for="packages">Event Package</label>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-4">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="date" name="date" class="form-control" placeholder="xxxx@xxx.xx">
                                <label for="date">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add-reservation-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Examples -->
<div class="row mb-5">
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            <img class="card-img-top" src="{{asset('assets/img/elements/wedding.jpg')}}" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Wedding Catering Package</h5>
                <p class="card-text">
                    The ideal catering package for soon-to-wed couples for a minimum of 100 guests, which includes:
                    Full-Service Catering, Reception Set-Up and Design, An Events Planner is assigned to facilitate
                    the planning and execution of your event, Choice of complimentary wedding essentials. This package
                    starts at P80,000 only can accommodate 200 people.
                </p>
                <button class="dt-button create-new btn btn-primary reserve-btn" data-package="wedding" data-user-id="{{ auth()->user()->id }}"
                    type="button" >
                    <span>
                        <span class="d-none d-sm-inline-block">Reserve Now</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            <img class="card-img-top" src="{{asset('assets/img/elements/debut.jpg')}}" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Debut Catering Package</h5>
                <p class="card-text">
                    The ideal catering package for soon-to-wed couples for a minimum of 100 guests, which includes:
                    Full-Service Catering, Reception Set-Up and Design, An Events Planner is assigned to facilitate
                    the planning and execution of your event, Choice of complimentary event essentials. This package
                    starts at P60,000 only can accommodate 150 people.
                </p>
                <button class="dt-button create-new btn btn-primary reserve-btn" data-package="debut" data-user-id="{{ auth()->user()->id }}"
                    type="button" >
                    <span>
                        <span class="d-none d-sm-inline-block">Reserve Now</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            <img class="card-img-top" src="{{asset('assets/img/elements/wedding.jpg')}}" alt="Card image cap" />
            <div class="card-body">
                <h5 class="card-title">Private Party Catering Package</h5>
                <p class="card-text">
                    The recommended and affordable catering package for your special event, which includes:
                    Full-Service Catering, Reception Set-Up and Design, An Events Planner assigned to facilitate the
                    planning and execution of your event. This package starts at P30,000 only can accommodate 100
                    people.
                </p>
                <button class="dt-button create-new btn btn-primary reserve-btn" data-package="privateparty" data-user-id="{{ auth()->user()->id }}"
                    type="button" >
                    <span>
                        <span class="d-none d-sm-inline-block">Reserve Now</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    
    $(document).ready(function() {
        $('.reserve-btn').on('click',  function() {
            let package = $(this).data('package');

            $('#packages').attr('disabled', true);
            $('#packages').val(package).trigger('change');
            $('#basicModal').modal('show');
        });


        $('#reserveForm').submit(function (e) {
    e.preventDefault();

    let _token = $('input[name="_token"]').val();
    let user_id = $('#user_id').val();
    let fullName = $('#fullname').val();
    let email = $('#email').val();
    let contact = $('#contact').val();
    let address = $('#address').val();
    let package = $('#packages').val();
    let reservationDate = $('#date').val();

    $.ajax({
      url: $(this).attr('action'),
      method: 'post',
      dataType: 'json',
      data: { _token, user_id, fullName, email, contact, address, package, reservationDate },
      beforeSend: () => {
        $('.is-invalid').removeClass('is-invalid');
        $('#add-reservation-btn').attr('disabled', true);
        $('#add-reservation-btn').html(`<span class="spinner-border text-primary"></span Adding...`);
      },
      success: response => {
        $('#add-reservation-btn').attr('disabled', false);
        $('#add-reservation-btn').html(`SAVE`);

        let package = $('#packages').val('').trigger('change');
        let reservationDate = $('#date').val('');

        Swal.fire({
          title: 'Success!',
          text: 'Reservation saved!',
          icon: 'success'
        }).then(result => {
          window.location.reload();
        });
      },
      error: (jqXHR, textStatus) => {
        if (jqXHR.status === 422) {
          let errors = jqXHR.responseJSON?.errors;
          console.log(jqXHR);
          Swal.fire({
            title: 'Error!',
            text: 'Please fill all required fields!',
            icon: 'warning'
          });

          if ('address' in errors) {
            $('#address').addClass('is-invalid');
          }

          if ('package' in errors) {
            $('#packages').addClass('is-invalid');
          }

          if ('reservationDate' in errors) {
            $('#date').addClass('is-invalid');
          }
        } else if (jqXHR.status === 409) {
          Swal.fire({
            title: 'Error!',
            text: jqXHR.responseJSON?.message,
            icon: 'warning'
          });
        } else {
          Swal.fire({
            title: 'Error!',
            text: 'Unable to create reservation. Please refresh the page and try again.',
            icon: 'warning'
          });
        }

        $('#add-reservation-btn').attr('disabled', false);
        $('#add-reservation-btn').html(`SAVE`);
      }
    });
  });
    });
</script>

@endsection