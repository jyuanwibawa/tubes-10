<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="{{ asset('images/login.png') }}" rel="icon" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-border-gray: #eaecf4;
            --color-background-gray: #f8f9fc;
            --color-primary-green: #198754;
            --font-poppins: "Poppins", sans-serif;
        }

        @layer utilities {
            .font-poppins {
                font-family: var(--font-poppins);
            }
        }
    </style>

</head>

<body>
    <div class="w-full min-h-screen flex flex-row">
        {{-- LEFT SIDE --}}
        @include('partial.menuadmin')

        <div class="w-16/17 min-h-screen flex flex-col bg-background-gray">
            <div class="w-full py-6 px-10 bg-white flex flex-row justify-end items-center gap-x-5 mb-6 shadow-md">
                <div class="h-[100%] border-r-2 border-border-gray"></div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="flex flex-row items-center gap-x-2 hover:cursor-pointer">
                    <p class="font-poppins text-[12px] text-gray-600">{{ Auth::user()->name }}</p>
                    <div class="flex flex-row items-center">
                        <img src="{{ asset('images/profile.svg') }}" alt="" class="w-8">
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </div>
                </button>
            </div>

            @yield('content')

            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-35">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('auth.admin.logout') }}" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>