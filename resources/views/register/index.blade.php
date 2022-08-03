<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Matin Register</title>
  <!-- base:css -->
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('template/template/vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('template/template/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template/template/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('template/template/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <!-- <img src="../../images/logo-dark.svg" alt="logo"> -->
              </div>
              <h4>Register</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              @if(session()->has('message'))
              <div class="alert alert-success" role="alert">
                {{ session()->get('message')}}
              </div>
              @endif
              <form action="{{ route('register.store') }}" class="pt-3" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter Full Name" required>

                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter Email" required>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter Password" required>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="phone" id="phone" placeholder="Enter Phone Number" required>

                </div>
                <!-- <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div> -->
                <div class="form-group">
                    <input type="file" class="form-control form-control-lg" name="photo">
                </div>

                <div class="mt-3">
                  <!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="">SIGN UP</a> -->
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="{{ route('login.index')}}" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{ asset('template/template/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('template/template/js/off-canvas.js') }}"></script>
  <script src="{{ asset('template/template/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('template/template/js/template.js') }}"></script>
  <script src="{{ asset('template/template/js/settings.js') }}"></script>
  <script src="{{ asset('template/template/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
