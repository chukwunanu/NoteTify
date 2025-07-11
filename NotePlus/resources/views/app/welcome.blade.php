

<!doctype html>
<html lang="en">
  <head>
    @php
        $basePath = asset('../assets');
    @endphp
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Welcome Page</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ $basePath }}/images/favicon.ico" />
      <link rel="stylesheet" href="{{ $basePath }}/css/backend-plugin.min.css?v=1.0.0">
      <link rel="stylesheet" href="{{ $basePath }}/css/backend.css?v=1.0.0">
      <link rel="stylesheet" href="{{ $basePath }}/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="{{ $basePath }}/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="{{ $basePath }}/vendor/remixicon/fonts/remixicon.css">
      <link rel="stylesheet" href="{{ $basePath }}/vendor/@icon/dripicons/dripicons.css">  </head>
  <body class="color-light ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
   
    <div class="wrapper">
        <section class="login-content">
            <div class="container-fluid h-100">
                @if (Session::has('success'))
                <span class="bg-green-400 text-white p-2">{{ Session::get('success') }}</span>
                @endif
                @if (Session::has('fail'))
                    <span class="text-white bg-red-400 p-2">{{ Session::get('fail') }}</span>
                @endif

                @if (request()->has('token'))
                    <div class="bg-gray-400 mt-3">
                        You have been invited to join a team. Please log in or register to continue.
                    </div>
                    @php
                        session(['invite_token' => request()->token]);
                    @endphp
                @endif

                <div class="row justify-content-center align-items-center height-self-center">
                    <div class="col-md-5 col-sm-12 col-12 align-self-center">
                        <div class="sign-user_card">
                            <div class="d-flex justify-content-between" style="margin-top: 0.5rem;">
                                <div>
                                    <a href="{{ route('login.index') }}" class="btn btn-primary mt-2">Login</a>
                                </div>
                                <div>
                                    <a href="{{ route('register.create') }}" class="btn btn-primary mt-2">Register</a>
                                </div>
                            </div> 
                            <h1 class="mb-2">Welcom To NoteTify</h1>
                           <p class="cnf-mail m-auto mb-1">Team-based collaborative, note taking app. Create, share and manage notes across teams</p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Backend Bundle JavaScript -->
    <script src="{{ $basePath }}/js/backend-bundle.min.js"></script>
    
    <!-- Flextree Javascript-->
    <script src="{{ $basePath }}/js/flex-tree.min.js"></script>
    <script src="{{ $basePath }}/js/tree.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="{{ $basePath }}/js/table-treeview.js"></script>
    
    <!-- SweetAlert JavaScript -->
    <script src="{{ $basePath }}/js/sweetalert.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="{{ $basePath }}/js/chart-custom.js"></script>
    
    <!-- slider JavaScript -->
    <script src="{{ $basePath }}/js/slider.js"></script>
    
    <!-- app JavaScript -->
    <script src="{{ $basePath }}/js/app.js"></script>
  </body>
</html>