<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('panel/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('panel/assets/images/favicon.png')}}"/>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                       <p><x-validation-errors class="mb-4" /></p>
                        <h3 class="card-title text-left mb-3">KAYIT OL</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label  for="name" value="{{ __('Name') }}">Username</label>
                                <input  id="name" type="text" name="name"  required autofocus autocomplete="name" class="form-control p_input">
                            </div>
                            <div class="form-group">
                                <label for="email" value="{{ __('Email') }}" >Email</label>
                                <input id="email"  type="email"  name="email" required autocomplete="username" class="form-control p_input">
                            </div>
                            <div class="form-group">
                                <label for="password" value="{{ __('Password') }}" >Password</label>
                                <input id="password"  type="password" name="password" required autocomplete="new-password"  class="form-control p_input">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" value="{{ __('Confirm Password') }}">Password</label>
                                <input  id="password_confirmation"  type="password" name="password_confirmation" required autocomplete="new-password"  class="form-control p_input">
                            </div>



                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ms-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-button class="btn btn-primary btn-lg ">
                                    {{ __('Kayıt Ol') }}
                                </x-button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('panel/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js --><script src="{{asset('panel/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('panel/assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('panel/assets/js/misc.js')}}"></script>
<script src="{{asset('panel/assets/js/settings.js')}}"></script>
<script src="{{asset('panel/assets/js/todolist.js')}}"></script>
<!-- endinject -->
</body>
</html>
