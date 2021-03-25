
        @include('tenant.layouts.partials.header')

        <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">

                  @yield('content')

               </div>
            </div>
         </div>
        @include('tenant.layouts.partials.footer')
