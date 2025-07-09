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
        
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
              @if (session('success'))
              <span class="alert alert-success bg-green-500 p-2">{{ session('success') }}</span>
              @endif
              @if (Session::has('fail'))
                   <span class="alert alert-danger bg-red-500 p-2">{{ Session::get('fail') }}</span>
              @endif
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Signin to your account</h2>
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