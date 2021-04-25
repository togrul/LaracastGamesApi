<x-app-layout>
     <div class="container px-4 mx-auto">
          <h2 class="font-semibold tracking-wide text-blue-500 uppercase">Popular Games</h2>
          <livewire:popular-games />

           <div class="flex flex-col my-10 lg:flex-row">
               <div  class="w-full mr-0 lg:w-3/4 lg:mr-32 recently-reviewed">
                    <h2 class="font-semibold tracking-wide text-blue-500 uppercase">
                         Recently Reviewed
                    </h2>
                    <livewire:recently-reviewed /> 
               </div>
              
               <div class="w-full mt-12 lg:w-1/4 most-anticipated lg:mt-0">
                    <h2 class="font-semibold tracking-wide text-blue-500 uppercase">
                         Most anticipated
                    </h2>
                    <livewire:most-anticipated />

                    <h2 class="mt-12 font-semibold tracking-wide text-blue-500 uppercase">
                        Coming soon
                    </h2>
                    <livewire:coming-soon />
               </div>
               
          </div>
     </div>
     <!-- End container -->

   
</x-app-layout>