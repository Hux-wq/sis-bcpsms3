<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <div class="flex items-center w-full p-1 pl-6" style="display: flex; align-items: center; padding: 3px; width: 40px; background-color: transparent; height: 4rem;">
        <div class="flex items-center justify-center" style="display: flex; align-items: center; justify-content: center;">
            <img src="https://elc-public-images.s3.ap-southeast-1.amazonaws.com/bcp-olp-logo-mini2.png" alt="Logo" style="width: 30px; height: auto;">
        </div>
      </div>

      <div style="display: flex; flex-direction: column; align-items: center; padding: 16px;">
        <div style="display: flex; align-items: center; justify-content: center; width: 96px; height: 96px; border-radius: 50%; background-color: #334155; color: #e2e8f0; font-size: 48px; font-weight: bold; text-transform: uppercase; line-height: 1;">
            LC
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; margin-top: 24px; text-align: center;">
            <div style="font-weight: 500; color: #fff;">
                Name
            </div>
            <div style="margin-top: 4px; font-size: 14px; color: #fff;">
                ID
            </div>
        </div>
    </div>

    <hr class="sidebar-divider">
    <li class="nav-heading">Dashboard</li>

    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('dashboard')">
        <i class="fa-solid fa-chart-pie"  style="width: 15px"></i>
      <span>
          {{ __('Dashboard') }}
      </span>
    </x-nav-link>

    <hr class="sidebar-divider">
    <li class="nav-heading">Students</li>

    <x-nav-link :href="route('admin.student')" :active="request()->routeIs('student')">
        <i class="fa-solid fa-graduation-cap" style="width: 15px"></i>
        {{ __('Students') }}
    </x-nav-link>


    <hr class="sidebar-divider">
    <li class="nav-heading">Document</li>
    
    <x-nav-link :href="route('admin.document')" :active="request()->routeIs('document')">
        <i class="fa-solid fa-folder" style="width: 15px,"></i>
        {{ __('Documents') }}
    </x-nav-link>

    <x-nav-link :href="route('admin.document')" :active="request()->routeIs('request')">
        <i class="fa-solid fa-magnifying-glass" style="width: 15px;"></i>
        {{ __('Requests') }}
    </x-nav-link>

    <x-nav-link :href="route('admin.document')" :active="request()->routeIs('students')">
        <i class="fa-solid fa-chart-simple"></i>
        {{ __('Reports') }}
    </x-nav-link>

    
    <hr class="sidebar-divider">
    <li class="nav-heading">settings</li>

    <x-responsive-nav-link>
        <div class="nav-link">
            <i class="fa-solid fa-arrow-right-from-bracket text-light" style="width: 15px;"></i>
            
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="bg-transparent m-0 p-0 w-100">
                @csrf
                <button type="submit" class="p-0 m-0 w-100 text-start" onclick="confirmLogout(event)">
                    <span class="text-light">{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>
    </x-responsive-nav-link>
    
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            
            Swal.fire({
                title: "Logout?", 
                text: "You are about to logout!", 
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('logout-form').submit();
                    
                    // Show success message
                    Swal.fire({
                        title: "Logged Out!",
                        text: "You have been successfully logged out.",
                        icon: "success"
                    });
                }
            });
        }

    </script>

 
    </ul>

  </aside>