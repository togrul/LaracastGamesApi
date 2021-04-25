<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Laracast video games</title>

     <link rel="stylesheet" href="{{ mix('css/app.css') }}">
     @livewireStyles
     @stack('css')
</head>
<body class="font-sans text-white bg-gray-900" x-data>
     <header class="border-b border-gray-800">
          <nav class="container flex flex-col items-center justify-between px-4 py-6 mx-auto space-y-4 lg:space-y-0 lg:flex-row">
             <div class="flex flex-col items-center space-y-4 lg:flex-row lg:space-y-0">
               <a href="/" class="">
                    <img src="{{ asset('img/logo.svg') }}" alt="laracast" class="flex-none w-32" />
               </a>
               <ul class="flex ml-0 space-x-8 lg:ml-16">
                    <li><a href="#" class="hover:text-gray-400">Games</a></li>
                    <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                    <li><a href="#" class="hover:text-gray-400">Coming soon</a></li>
               </ul>
             </div>

             <div class="flex items-center">
                  <livewire:search-dropdown />
                  <div class="flex items-center justify-center w-12 h-12 ml-6 bg-white rounded-full shadow-lg">
                       <a href="#" class="w-10 h-10">
                            <img src="{{ asset('img/avatar.svg') }}" alt="avatar" class="w-full h-full">
                         </a>
                    </div>
             </div>
          </nav>
     </header>

     <main class="py-8">
          {{ $slot }}
     </main>

     <footer class="border-t border-gray-800">
          <div class="container px-4 py-6 mx-auto">
               Powered by <a href="#" class="underline hover:text-gray-400">IGDB API</a>
          </div>
     </footer>

     <script src="{{ asset('js/app.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
     @livewireScripts
     @stack('js')
</body>
</html>