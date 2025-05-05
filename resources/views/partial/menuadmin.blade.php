<div class="w-1/17 min-h-screen flex flex-col bg-primary-green items-center pt-6 gap-y-[12px]">
    <svg class="w-10" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
        <g id="SVGRepo_iconCarrier">
            <title>recycle</title>
            <g id="Layer_2" data-name="Layer 2">
                <g id="invisible_box" data-name="invisible box">
                    <rect width="48" height="48" fill="none"></rect>
                </g>
                <g id="Q3_icons" data-name="Q3 icons">
                    <g>
                        <path
                            d="M45.4,33l-3.9-6.2A2,2,0,1,0,38.1,29L42,35.2H25.5l2.4-2.5a2.1,2.1,0,0,0-.1-2.9A2,2,0,0,0,25,30l-5.6,5.8a2.1,2.1,0,0,0,0,2.8l5.7,5.8a1.9,1.9,0,0,0,2.8,0,1.9,1.9,0,0,0,0-2.8l-2.2-2.3H42a3.9,3.9,0,0,0,3.5-2.1A4.2,4.2,0,0,0,45.4,33Z">
                        </path>
                        <path
                            d="M19.8,14.6l4.1-7.5,7.6,11.8-3.2-.7a2.1,2.1,0,0,0-2.4,1.6,1.9,1.9,0,0,0,1.5,2.3l7.8,1.7h.4a2,2,0,0,0,1.1-.3,2,2,0,0,0,.8-1.3l1.7-8a2.1,2.1,0,0,0-1.6-2.4,2.1,2.1,0,0,0-2.4,1.6l-.6,3L27.3,4.9A3.9,3.9,0,0,0,24,3a4.2,4.2,0,0,0-3.4,1.8h0l-4.3,7.8a2,2,0,0,0,3.5,1.9Z">
                        </path>
                        <path
                            d="M16.3,19.8a1.8,1.8,0,0,0-.9-1.3,1.9,1.9,0,0,0-1.5-.3L6.1,19.7a2.1,2.1,0,0,0-1.5,2.4,1.9,1.9,0,0,0,2.3,1.5l2.6-.5L2.7,32.9a4.2,4.2,0,0,0-.2,4.3A3.9,3.9,0,0,0,6,39.3h7.1a2,2,0,1,0,0-4H6l7.2-10.3.6,3.7a2,2,0,0,0,2,1.6h.4a2.1,2.1,0,0,0,1.6-2.4Z">
                        </path>
                    </g>
                </g>
            </g>
        </g>
    </svg>
    <div class="border-b border-border-gray w-[70%]"></div>

    <!-- Menu Items -->
    <div class="flex flex-col w-full px-4">
        <div class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link text-white flex items-center justify-center gap-2" href="{{ route('admin.dashboard') }}">
                <svg class="w-5" fill="#ffffff" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"
                    stroke="#ffffff">
                    <path
                        d="M960 282c529.355 0 960 430.758 960 960 0 77.139-8.922 153.148-26.541 225.882l-10.504 43.144h-560.188c-27.106 74.88-79.85 140.838-155.52 181.045-47.887 25.185-101.647 38.625-155.633 38.625-123.445 0-236.047-67.651-293.76-176.64-5.873-11.18-11.859-25.75-17.845-43.03H37.045l-10.504-43.144C8.922 1395.148 0 1319.14 0 1242c0-529.242 430.645-960 960-960Zm168.17 1229.026c47.66-49.355 61.214-125.139 27.331-189.064-42.24-79.51-403.765-413.59-403.765-413.59s73.638 486.776 115.765 566.287c7.341 13.892 16.941 25.525 27.219 36.367h-.904c2.033 2.146 4.518 3.614 6.551 5.534 4.63 4.405 9.374 8.47 14.344 12.198 3.727 2.823 7.68 5.308 11.52 7.68 5.195 3.162 10.39 6.098 15.924 8.81 4.292 1.92 8.584 3.726 13.101 5.42 5.422 1.92 10.956 3.727 16.716 5.083a159.91 159.91 0 0 0 14.23 3.049c5.76.904 11.407 1.468 17.167 1.694 2.824.113 5.535.79 8.245.79 1.92 0 3.84-.677 5.76-.677 8.245-.226 16.377-1.355 24.508-2.936 3.727-.791 7.567-1.13 11.294-2.146 11.746-3.163 23.266-7.229 34.335-13.214h.338v-.113c15.7-8.245 28.687-19.2 40.32-31.172Zm361.524-625.807 112.715-112.715-119.717-119.831-112.828 112.715 119.83 119.83Zm-614.4-254.457h169.412V471.29H875.294v159.473ZM430.306 885.22l119.83-119.83-112.715-112.716-119.83 119.83L430.306 885.22Z">
                    </path>
                </svg>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </div>
        <!-- Nav Item Articles -->
        <div class="nav-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a class="nav-link text-white flex items-center justify-center gap-2" href="{{ route('admin.home') }}">
                <svg class="w-5" fill="#ffffff" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"
                    stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M960 282c529.355 0 960 430.758 960 960 0 77.139-8.922 153.148-26.541 225.882l-10.504 43.144h-560.188c-27.106 74.88-79.85 140.838-155.52 181.045-47.887 25.185-101.647 38.625-155.633 38.625-123.445 0-236.047-67.651-293.76-176.64-5.873-11.18-11.859-25.75-17.845-43.03H37.045l-10.504-43.144C8.922 1395.148 0 1319.14 0 1242c0-529.242 430.645-960 960-960Zm168.17 1229.026c47.66-49.355 61.214-125.139 27.331-189.064-42.24-79.51-403.765-413.59-403.765-413.59s73.638 486.776 115.765 566.287c7.341 13.892 16.941 25.525 27.219 36.367h-.904c2.033 2.146 4.518 3.614 6.551 5.534 4.63 4.405 9.374 8.47 14.344 12.198 3.727 2.823 7.68 5.308 11.52 7.68 5.195 3.162 10.39 6.098 15.924 8.81 4.292 1.92 8.584 3.726 13.101 5.42 5.422 1.92 10.956 3.727 16.716 5.083a159.91 159.91 0 0 0 14.23 3.049c5.76.904 11.407 1.468 17.167 1.694 2.824.113 5.535.79 8.245.79 1.92 0 3.84-.677 5.76-.677 8.245-.226 16.377-1.355 24.508-2.936 3.727-.791 7.567-1.13 11.294-2.146 11.746-3.163 23.266-7.229 34.335-13.214h.338v-.113c15.7-8.245 28.687-19.2 40.32-31.172Zm361.524-625.807 112.715-112.715-119.717-119.831-112.828 112.715 119.83 119.83Zm-614.4-254.457h169.412V471.29H875.294v159.473ZM430.306 885.22l119.83-119.83-112.715-112.716-119.83 119.83L430.306 885.22Z"
                            fill-rule="evenodd"></path>
                    </g>
                </svg>
                <span>{{ __('Artikel') }}</span>
            </a>
        </div>

    </div>

    <div class="border-b border-border-gray w-[70%]"></div>

    <!-- Pickup Requests Menu -->
    <div class="flex flex-col w-full px-4 mt-4">
        <!-- Nav Item Pickup Requests -->
        <div class="nav-item {{ request()->routeIs('admin.pickup-requests') ? 'active' : '' }}">
            <a class="nav-link text-white flex items-center justify-center gap-2"
                href="{{ route('admin.pickup-requests') }}">
                <svg class="w-5" fill="#ffffff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M19 7h-3V5.5A2.5 2.5 0 0 0 13.5 3h-3A2.5 2.5 0 0 0 8 5.5V7H5a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-8a3 3 0 0 0-3-3zm-9-1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V7h-4zM8 18v-5h2v5zm3 0v-5h2v5zm5 0h-2v-5h2z">
                        </path>
                    </g>
                </svg>
                <span>{{ __('Pickup Requests') }}</span>
            </a>
        </div>
    </div>

    <div class="flex flex-col w-full px-4 mt-4">
        <!-- Nav Item Sampah -->
        <div class="nav-item {{ request()->routeIs('admin.sampah') ? 'active' : '' }}">
            <a class="nav-link text-white flex items-center justify-center gap-2" href="{{ route('admin.sampah') }}">
                <svg class="w-5" fill="#ffffff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M19 7h-3V5.5A2.5 2.5 0 0 0 13.5 3h-3A2.5 2.5 0 0 0 8 5.5V7H5a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-8a3 3 0 0 0-3-3zm-9-1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V7h-4zM8 18v-5h2v5zm3 0v-5h2v5zm5 0h-2v-5h2z">
                        </path>
                    </g>
                </svg>
                <span>{{ __('Sampah') }}</span>
            </a>
        </div>
    </div>

    <div class="border-b border-border-gray w-[70%]"></div>
</div>