<div class="navbar sticky top-0 z-50 backdrop-blur-md select-none">
    <div class="flex-1">
      {{-- <label tabindex="0" class="btn btn-ghost btn-sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
        </label> --}}
        <div class="w-12 lg:w-64 flex items-center">
            <label class="btn btn-ghost swap lg:hidden swap-rotate">

                <!-- this hidden checkbox controls the state -->
                <input type="checkbox" class="btn-sidebar" />

                <!-- hamburger icon -->
                <svg class="swap-off fill-current w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>

                <!-- close icon -->
                <svg class="swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><polygon points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49"/></svg>

              </label>
              <span class="pl-4 text-lg font-semibold hidden lg:block transition-all duration-200 ease-nav-brand">MyStock</span>
            {{-- <img src="{{ asset('image/logo.png') }}" alt="" class="w-24 mx-5 "> --}}
        </div>
        @php
            $url = request()->route()->uri();
            $segments = explode('/', $url);
            $firstSegment = isset($segments[0]) ? $segments[0] : '';
            $decodedSegment = urldecode($firstSegment);
            $formattedSegment = str_replace('-', ' ', ucwords($decodedSegment));
        @endphp

        <div class="pl-3 ">
            <span class="opacity-50 text-slate-700">Pages </span> / {{ $formattedSegment }}
            <p class="font-semibold -mt-1"> {{ $formattedSegment }}</p>
        </div>
    </div>

    <div class="flex-none">
      <div class="">
          @auth
          <span class="mx-5 transition flex items-center">
              {{-- {{Auth::user()->username}} --}}


              {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
              </svg>
              <p>Sign Out</p> --}}


              {{-- <span class="font-semibold
                  {{ (Auth::user()->level_user->nama_level === 'admin') ? 'text-error' : '' }}
                  {{ (Auth::user()->level_user->nama_level === 'manajemen') ? 'text-success' : '' }}
                  {{ (Auth::user()->level_user->nama_level === 'kaprog') ? 'text-info' : '' }}
              ">
                  {{ Auth::user()->level_user->nama_level }}
              </span> --}}

          </span>
          @endauth
      </div>

      {{-- <button data-toggle-theme="light,dark" class="btn btn-sm btn-outline mx-5" data-act-class="ACTIVECLASS">theme</button> --}}

      {{-- <div class="dropdown dropdown-bottom dropdown-end">
          <label tabindex="0" class="btn btn-sm btn-outline mx-5">Theme</label>
          <ul tabindex="0" class="dropdown-content menu p-2 shadow-2xl bg-base-100 rounded-box w-52">
          <li>
              <button data-set-theme="light" data-act-class="ACTIVECLASS">light</button>
          </li>
          <li>
              <button data-set-theme="dark" data-act-class="ACTIVECLASS">Dark</button>
          </li>
          <li>
              <button data-set-theme="cyberpunk" data-act-class="ACTIVECLASS">Cyberpunk</button>
          </li>
          <li>
              <button data-set-theme="valentine" data-act-class="ACTIVECLASS">Valentine</button>
          </li>
          <li>
              <button data-set-theme="night" data-act-class="ACTIVECLASS">Night</button>
          </li>
          <li>
              <button data-set-theme="dracula" data-act-class="ACTIVECLASS">dracula</button>
          </li>
          <li>
              <button data-set-theme="black" data-act-class="ACTIVECLASS">black</button>
          </li>
          <li>
              <button data-set-theme="luxury" data-act-class="ACTIVECLASS">luxury</button>
          </li>
          <li>
              <button data-set-theme="wireframe" data-act-class="ACTIVECLASS">wireframe</button>
          </li>
          <li>
              <button data-set-theme="synthwave" data-act-class="ACTIVECLASS">synthwave</button>
          </li>
          <li>
              <button data-set-theme="halloween" data-act-class="ACTIVECLASS">halloween</button>
          </li>
          </ul>
      </div> --}}
      <form action="/logout" method="POST">
        @csrf

       <div class="dropdown dropdown-end">


        <label tabindex="0" class="">
          <div class="flex items-center gap-1 hover:opacity-70 transition px-3 text-slate-600 font-semibold text-base">
             @auth
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
              </svg>
              <p>Sign Out</p>
             @endauth
          </div>
        </label>

          <ul tabindex="0" class="mt-3 p-3 shadow-lg menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
              @auth
                      <p class="text-base leading-none font-medium">{{Auth::user()->username}}</p>
                      <p class="mb-3 text-sm font-normal
                          {{ (Auth::user()->level_user->nama_level === 'admin') ? 'text-error' : '' }}
                          {{ (Auth::user()->level_user->nama_level === 'manajemen') ? 'text-success' : '' }}
                          {{ (Auth::user()->level_user->nama_level === 'kaprog') ? 'text-info' : '' }}
                      ">{{Auth::user()->level_user->nama_level}}</p>
                      <div class="mb-4 text-sm font-light">
                          <p>{{Auth::user()->email}}</p>
                      </div>
              @endauth

              <button class="btn btn-sm btn-primary">Logout</button>
          </ul>

      </div>
    </div>
  </form>
  </div>
