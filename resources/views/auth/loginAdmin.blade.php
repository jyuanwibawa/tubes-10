<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-border-gray: #D9D9D9;
            --color-primary-green: #4D6D3B;
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
    <div class="max-w-full min-h-screen flex justify-center items-center">
        <div class="flex flex-row">
            <img src="{{ asset('images/login.png') }}" alt="" class="rounded-s-[20px]">
            <div class="rounded-e-[20px] flex justify-center items-center p-12 shadow-lg">
                <div class="flex flex-col w-full">
                    <p class="font-poppins font-bold text-[32px]">Login</p>
                    <p class="font-poppins text-[14px] mb-[12px]">Login sekarang dan mulai kelola data website!</p>
                    @if (session('error'))
                        <p class="bg-red-300 text-red-500 font-poppins font-medium text-[12px] mb-[12px] border border-red-500 w-full text-center py-4">
                            {{ session('error') }}
                        </p>
                    @endif
                    <form action="/admin/login" method="POST" class="flex flex-col gap-y-[12px] mb-[4px]">
                        @csrf
                        <input type="email" placeholder="Masukkan alamat email" name="email" class="border border-border-gray p-4 placeholder:font-poppins placeholder:text-[12px] rounded-[8px] focus:outline-primary-green">
                        <div class="relative w-full">
                            <input type="password" id="inputPassword" name="password" placeholder="Masukkan password" class="w-full border border-border-gray p-4 placeholder:font-poppins placeholder:text-[12px] rounded-[8px] focus:outline-primary-green">
                            <button type="button" id="togglePassword" class="absolute right-4 top-4 hover:cursor-pointer">
                                <img src="{{ asset('images/eye-open.svg') }}" id="eyeIcon" alt="" class="w-7">
                            </button>
                        </div>
                        <button type="submit" class="flex justify-center items-center bg-primary-green text-white font-poppins text-[16px] py-4 rounded-[8px] hover:scale-105 hover:duration-300 hover:cursor-pointer">Kirim</button>
                    </form>
                    <p class="font-poppins text-[12px] self-center">Belum punya akun? <a href="{{ route('auth.admin.register') }}" class="text-primary-green">Daftar Sekarang</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            let passwordInput = document.getElementById("inputPassword");
            let eyeIcon = document.getElementById("eyeIcon");
    
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "{{ asset('images/eye-close.svg') }}"; // Ganti dengan ikon mata tertutup
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "{{ asset('images/eye-open.svg') }}"; // Kembali ke ikon mata terbuka
            }
        });
    </script>
</body>
</html>