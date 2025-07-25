<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Show Team Details Page</title>
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
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            {{-- <img class="size-8" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" /> --}}
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Home</a>
              <a href="{{ route('notes.index') }}" class="{{ request()->routeIs('notes.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Projects</a>
              <a href="{{ route('teams.index') }}" class="{{ request()->routeIs('teams.index') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"> Teams</a>
              {{-- <a href="#" class="{{ request()->is('calendar*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"> Calendar</a> --}}
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">View notifications</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
              </svg>
            </button>

            <!-- Profile dropdown -->
            <div class="relative ml-3">
              <div>
                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-hidden focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="absolute -inset-1.5"></span>
                  
                </button>
                @auth
              <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"">Logout</button>
              </form>
                @endAuth

              </div>

              <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Reports</a>
      </div>
      <div class="border-t border-gray-700 pt-4 pb-3">
        <div class="flex items-center px-5">
          <div class="shrink-0">
            <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
          </div>
          <div class="ml-3">
            <div class="text-base/5 font-medium text-white">Tom Cook</div>
            <div class="text-sm font-medium text-gray-400">tom@example.com</div>
          </div>
          <button type="button" class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
          </button>
        </div>
        <div class="mt-3 space-y-1 px-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
        </div>
      </div>
    </div>
  </nav>

  <header class="bg-white shadow-sm">
    <div class="mx-auto mt-8 max-w-7xl px-4 py-3 sm:px-6 lg:px-8 flex justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">NoteTify</h1>
        <form action="{{ route('invites.store', $team->id) }}" method="POST">
          @csrf
          <input type="hidden" name="user_id" value="{{ auth()->id() }}">
          <input type="hidden" name="team_id" value="{{ $team->id }}">
            <input class="py-3 border-none rounded-md pr-3" type="email" name="email" placeholder="Enter email address"/>
          <button type="submit" class="rounded-md font-bold text-2xl px-3 py-2 border bg-blue-600 text-white hover:bg-gray-200 hover:text-black">Invite</button>
          @error('email')
             <p class="text-xs text-red-500 font-semibold mt-2">{{ $message }}</p>
          @enderror
        </form>
        
    </div>
 </header>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p class="font-bold text-2xl">{{ $team->team_name ?? 'No Team' }} Team</p>
        <div class="mt-3 flex items-center gap-x-6">
          <button type="button" class="rounded-md bg-green-700 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-800">
            <a href="{{ route('teams.activity_logs', $team->id) }}">Activity Logs</a>
          </button>
        </div>
    </div>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 mt-3">
              <!-- Your content -->
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
                
              <form action="{{ route('notes.store') }}" method="POST" class="bg-gray-100 shadow-sm ring-1 ring-gray-900/10 sm:rounded-lg p-4">
                @csrf
                <input type="hidden" name="team_id" value="{{ session('active_team_id') }}">

                <div class="space-y-4">
                    <div class="border-b border-gray-900/10 pb-4">
                    
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        
                          <div class="col-span-full mt-2">
                              <input type="text" id="title" name="title" placeholder="Title of your note" class="block w-full rounded-md bg-white mb-1 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 placeholder:font-bold focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                              <textarea name="content" id="content" rows="3" placeholder="Write your notes here..." class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                            </div>
                          </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </div>
            </form>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
        @foreach ($notes as $note)
       
          <!-- Card -->
          <div class="bg-gray-300 mb-3 rounded-xl shadow hover:bg-gray-100 transition duration-300">
          
            <div class="p-4 ">
              <p class="text-black mb-4 font-bold">
                {{ $note->title }}
              </p>
              <h3 class="mb-2">{{ $note->created_by }}</h3>
              <div class="flex justify-between items-center text-sm text-gray-500">
                <div class="space-x-2">
                  <button class="px-3 py-1 border rounded text-sm hover:bg-gray-200"><a href="{{ route('notes.show', $note->id) }}">View</a></button>
                  <button class="px-3 py-1 border rounded text-sm hover:bg-gray-200"><a href="{{ route('notes.edit', $note->id) }}">Edit</a></button>
                  <form class="inline" action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?');">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 border rounded text-sm bg-red-500 hover:bg-red-800 text-white">
                      Delete
                    </button>
                  </form>
                </div>
                <span>{{ $note->created_at }}</span>
              </div>
            </div>
          </div>

        @endforeach
      </div>
      
    <h2 class="text-2xl font-bold mt-3 mb-6">Members of this Team</h2>

    <table class="min-w-full bg-white border border-gray-300 rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-3 px-4 text-left">Name</th>
                <th class="py-3 px-4 text-left">Profession</th>
                <th class="py-3 px-4 text-left">Email</th>
                <th class="py-3 px-4 text-left">Role</th>
                <th class="py-3 px-4 text-left">Joined</th>
                <th class="py-3 px-4 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($team->users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $user->name }}</td>
                    <td class="py-2 px-4">{{ $user->profession }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">{{ ucfirst($user->pivot->role) }}</td>
                    <td class="py-2 px-4">{{ $user->pivot->created_at ? $user->pivot->created_at->format('M d, Y') : '—' }}</td>
                    <td class="py-2 px-4">
                      <form action="{{ route('team-member.remove', [$team->id, $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">
                          Remove
                        </button>
                      </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 px-4 text-center text-gray-500">No members found in this team.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

        </div>

    </div>


    </main>
</div>

</body>
</html>