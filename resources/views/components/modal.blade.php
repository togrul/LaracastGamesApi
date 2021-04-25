@props(['name'])

<div class="fixed top-0 left-0 flex items-center w-full h-full overflow-y-auto bg-black bg-opacity-50 shadow-lg">
     <div class="container mx-auto overflow-y-auto rounded-lg lg:px-32">
          <div class="bg-gray-900 rounded">
               <div class="flex justify-end pt-2 pr-4">
                    <button 
                         @click="{{ $name }} = false" 
                         @keydown.escape.window="{{ $name }} = false"
                         class="text-3xl leading-none hover:text-gray-300"
                         >
                         &times;</button>
               </div>
               <div class="px-8 py-8 modal-body">
                    <div class="relative pt-24 overflow-hidden responsive-container">
                       {{ $slot }}
                    </div>
               </div>
          </div>
     </div>
</div>