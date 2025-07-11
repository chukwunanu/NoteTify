<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     @vite('resources/css/app.css')
    <title>Register</title>
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
         @if (Session::has('success'))
           <span class="bg-green-400 text-white p-2 mb-2">{{ Session::get('success') }}</span>
        @endif
        @if (Session::has('fail'))
             <span class="text-white bg-red-400 p-2 mb-2">{{ Session::get('fail') }}</span>
        @endif
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            {{-- <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" /> --}}
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create an account</h2>
          </div>
      
          <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('register.store') }}" method="POST">
                @csrf
              <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
                <div class="mt-2">
                  <input type="text" name="name" id="name" autocomplete="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                @error('name')
                   <p class="text-xs text-red-500 font-semibold mt-2">{{ $message }}</p>
                @enderror
              </div>

              <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                  <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                @error('email')
                   <p class="text-xs text-red-500 font-semibold mt-2">{{ $message }}</p>
                @enderror
              </div>
          
              <div class="row">
                <div class="col-lg-6">
                  <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                <div class="mt-2">
                  <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                 @error('password')
                   <p class="text-xs text-red-500 font-semibold mt-2">{{ $message }}</p>
                @enderror
              </div>

               <div class="col-lg-6">
                  <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                <div class="mt-2">
                  <input type="password" name="password_confirmation" id="password-confirmation" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                 @error('password_confirmation')
                   <p class="text-xs text-red-500 font-semibold mt-2">{{ $message }}</p>
                @enderror
              </div>
              </div>
              
              @if(session()->has('invite_token'))
                  <input type="hidden" name="invite_token" value="{{ session('invite_token') }}">
              @endif
              <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign up</button>
              </div>
            </form>
        
            <p class="mt-10 text-center text-sm/6 text-gray-500">
              Already have an account?
              <a href="{{ route('login.index') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
          </div>
        </div>

    </div>
  </main>
</div>

</body>
</html>