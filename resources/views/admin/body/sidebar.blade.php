 <div class="app-sidebar-menu">
     <div class="h-100" data-simplebar>

         <!--- Sidemenu -->
         <div id="sidebar-menu">

             <div class="logo-box">
                 <a href="/" class="logo logo-light">
                     <span class="logo-sm">
                         <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="24">
                     </span>
                 </a>
                 <a href="/" class="logo logo-dark">
                     <span class="logo-sm">
                         <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                     </span>
                     <span class="logo-lg">
                         <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="24">
                     </span>
                 </a>
             </div>

             <ul id="side-menu">

                 <li class="menu-title">Menu</li>

                 <li>
                     <a href="{{ route('dashboard') }}" class="tp-link">
                         <i data-feather="home"></i>
                         <span> Dashboard </span>
                     </a>
                 </li>




                 <li class="menu-title">Pages</li>

                 <li>
                     <a href="#sidebarAuth" data-bs-toggle="collapse">
                         <i data-feather="users"></i>
                         <span> Slider Setup </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarAuth">
                         <ul class="nav-second-level">

                             <li>
                                 <a href="{{ route('get.slider') }}" class="tp-link">Setup Slider</a>
                             </li>


                         </ul>
                     </div>
                 </li>

                 <li>
                     <a href="#sidebarError" data-bs-toggle="collapse">
                         <i data-feather="alert-octagon"></i>
                         <span> Features Setup </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarError">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="{{ route('all.feature') }}" class="tp-link">All Features</a>
                             </li>
                             <li>
                                 <a href="{{ route('add.feature') }}" class="tp-link">Add Features</a>
                             </li>



                         </ul>
                     </div>
                 </li>
                 <li>
                     <a href="#sidebarBaseui" data-bs-toggle="collapse">
                         <i data-feather="alert-octagon"></i>
                         <span> Clarifis Setup </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarBaseui">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="{{ route('get.clarifis') }}" class="tp-link">Get Clarifis</a>
                             </li>




                         </ul>
                     </div>
                 </li>

                 <li>
                     <a href="#sidebarAdvancedUI" data-bs-toggle="collapse">
                         <i data-feather="cpu"></i>
                         <span> Usability Setup </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarAdvancedUI">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="{{ route('get.usability') }}" class="tp-link">Get Usability</a>
                             </li>


                         </ul>
                     </div>
                 </li>
                 <li>
                     <a href="#sidebarConnect" data-bs-toggle="collapse" aria-expanded="false">
                         <i data-feather=""></i>
                         <span> Connect Setup </span>
                         <span class="menu-arrow"></span>
                     </a>

                     <div class="collapse" id="sidebarConnect">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="{{ route('all.Connect') }}" class="tp-link">
                                     All Connects
                                 </a>
                                 <a href="{{ route('add.Connect') }}" class="tp-link">
                                     Add Connects
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
                 
                 <li>
                     <a href="#sidebarFaq" data-bs-toggle="collapse" aria-expanded="false">
                         <i data-feather=""></i>
                         <span> Faqs Setup </span>
                         <span class="menu-arrow"></span>
                     </a>

                     <div class="collapse" id="sidebarFaq">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="{{ route('all.faqs') }}" class="tp-link">
                                     All Faqs
                                 </a>
                                 <a href="{{ route('add.faqs') }}" class="tp-link">
                                     Add Faqs
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>





                 <li>
                     <a href="#sidebarIcons" data-bs-toggle="collapse">
                         <i data-feather="award"></i>
                         <span> Icons </span>
                         <span class="menu-arrow"></span>
                     </a>
                     <div class="collapse" id="sidebarIcons">
                         <ul class="nav-second-level">
                             <li>
                                 <a href="icons-feather.html" class="tp-link">Feather Icons</a>
                             </li>
                             <li>
                                 <a href="icons-mdi.html" class="tp-link">Material Design Icons</a>
                             </li>
                         </ul>
                     </div>
                 </li>









             </ul>

         </div>
         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
 </div>
