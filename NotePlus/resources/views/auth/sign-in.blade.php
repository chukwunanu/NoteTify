<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Login Page</title>
</head>
<body>
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<div class="min-h-full">

  <header class="bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">NoteTify</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
              <!--
          This example requires updating your template:
            
          ```
          <html class="h-full bg-white">
          <body class="h-full">
          ```
        -->
        
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
              @if (Session::has('success'))
                  <div class="mb-2 p-2 bg-green-300 max-w-7xl flex justify-between items-center" id="successMsg">
                      <span class="text-white">{{ Session::get('success') }}</span>
                      <button onclick="document.getElementById('successMsg').style.display='none'" class="text-white font-bold ml-4">×</button>
                  </div>
              @endif
                
              @if (Session::has('fail'))
                  <div class="mb-2 p-2 bg-red-300 max-w-7xl flex justify-between items-center" id="failMsg">
                      <span class="text-white">{{ Session::get('fail') }}</span>
                      <button onclick="document.getElementById('failMsg').style.display='none'" class="text-white font-bold ml-4">×</button>
                  </div>
              @endif

              @if(request()->has('token'))
                  <div class="bg-gray-400 mt-2">
                      You have been invited to join a team. Log in to accept the invitation.
                  </div>
                  @php
                      session(['invite_token' => request()->token]);
                  @endphp
              @endif
              
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            {{-- <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" /> --}}
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
          </div>
      
          <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login.store') }}" method="POST">
                @csrf

              <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                  <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                @error('email')
                   <p class="text-xs text-red-500 font-semibold mt-2">{{ $message }}</p>
                @enderror
              </div>
          
                <div >
                  <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                <div class="mt-2">
                  <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                 @error('password')
                   <p class="text-xs text-red-500 font-semibold mt-2">{{ $message }}</p>
                @enderror
            </div>
              @if(session()->has('invite_token'))
                  <input type="hidden" name="invite_token" value="{{ session('invite_token') }}">
              @endif
              <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
              </div>
            </form>
        
            <p class="mt-10 text-center text-sm/6 text-gray-500">
              Don't have an account?
              <a href="{{ route('register.create') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign up</a>
            </p>
          </div>
        </div>

    </div>
  </main>
</div>

</body>
</html>