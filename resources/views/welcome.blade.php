<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Barbershop De Mink - Stap binnen en laat ons u stijlvol maken!</title>
    <link rel="icon" type="image/x-icon" href="/assets/logo-wit.png">
    <meta name="description" content="Barbershop De Mink in Zevenaar: knippen, fades, baard trimmen en hot towel shave. Persoonlijk advies, vakmanschap en ontspannen sfeer. Plan direct je afspraak.">
    <meta name="keywords" content="barbershop zevenaar, herenkapper zevenaar, kapper zevenaar, baard trimmen zevenaar, hot towel shave, knippen heren, fades, barber, baard verzorgen, afspraak barbershop, barbershop de mink">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="preload" href="{{ asset('fontawesome/css/all.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
      <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    </noscript>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      {{-- Laat hier je bestaande Tailwind fallback <style> staan (die mega lange block), ik heb 'm hier weggelaten voor leesbaarheid. --}}
      <style>
        /* Tailwind fallback (zoals in je huidige file) */
      </style>
    @endif

    <style>
      html { scroll-behavior: smooth; }

      .faq-item.is-open .faq-title { color: #bc9355; }
      .faq-item.is-open .faq-icon { transform: rotate(180deg); color: #bc9355; }

      #mobile-menu{
        transition: transform .35s ease-in-out, opacity .2s ease-in-out;
        transform: translateY(-100%);
        opacity: 0;
        pointer-events: none;
      }
      #mobile-menu.active{
        transform: translateY(0);
        opacity: 1;
        pointer-events: auto;
      }
    </style>
  </head>

  <body class="bg-[#141008]">

    @php
      // TODO: vervang later door echte barber booking links
      $bookingBart   = 'https://barbershop-de-mink.salonized.com/widget_bookings/new';
      $bookingSamuel = 'https://samuel-barbershopdemink.bjootify.com/';
      $bookingIan    = 'https://ian-barbershopdemink.bjootify.com/';
    @endphp

    <div class="grain pointer-events-none"></div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" class="block md:hidden fixed inset-0 z-[200] bg-[#141008]">
      <div class="w-full h-auto py-8 px-4">
        <div class="max-w-[1400px] mx-auto grid grid-cols-5 flex items-center">
          <div>
            <img src="/assets/logo-wit.png" alt="Barbershop De Mink" class="max-w-14">
          </div>
          <div class="col-span-3 flex items-center justify-center"></div>
          <div class="flex items-center justify-end">
            <button id="mobile-menu-close" class="block md:hidden">
              <i class="fa-solid fa-xmark text-white"></i>
            </button>
          </div>
        </div>
      </div>
      <ul class="flex flex-col items-center gap-8 text-white text-sm font-semibold pt-10">
        <li><a href="/" class="hover:text-[#bc9355] transition duration-300">Home</a></li>
        <li><a href="#diensten" class="hover:text-[#bc9355] transition duration-300">Diensten</a></li>
        <li><a href="#barbers" class="hover:text-[#bc9355] transition duration-300">Barbers</a></li>
        <li><a href="#faq" class="hover:text-[#bc9355] transition duration-300">FAQ</a></li>
        <li><a href="#reviews" class="hover:text-[#bc9355] transition duration-300">Reviews</a></li>
      </ul>
      <div class="w-full h-[5px] bg-[#bc9355] absolute bottom-0"></div>
    </div>

    {{-- Header --}}
    <div class="w-full h-auto py-8 px-4">
      <div class="max-w-[1400px] mx-auto grid grid-cols-5 flex items-center">
        <div>
          <img src="/assets/logo-wit.png" alt="Barbershop De Mink" class="max-w-14">
        </div>

        <div class="col-span-3 flex items-center justify-center">
          <ul class="hidden md:flex items-center gap-8 text-white text-sm font-semibold">
            <li><a href="/" class="hover:text-[#bc9355] transition duration-300">Home</a></li>
            <li><a href="#diensten" class="hover:text-[#bc9355] transition duration-300">Diensten</a></li>
            <li><a href="#barbers" class="hover:text-[#bc9355] transition duration-300">Barbers</a></li>
            <li><a href="#faq" class="hover:text-[#bc9355] transition duration-300">FAQ</a></li>
            <li><a href="#reviews" class="hover:text-[#bc9355] transition duration-300">Reviews</a></li>
          </ul>
        </div>

        <div class="flex items-center justify-end">
          <button id="mobile-menu-open" class="block md:hidden">
            <i class="fa-solid fa-bars text-white"></i>
          </button>

          {{-- ✅ Trigger -> modal (niet direct naar booking) --}}
          <a
            href="#"
            data-booking-trigger
            class="hidden md:block px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold"
          >
            Afspraak plannen
          </a>
        </div>
      </div>
    </div>

    {{-- Hero --}}
    <div class="w-full h-auto px-4">
      <div class="max-w-[1400px] mx-auto flex flex-col gap-8">
        <div class="w-full h-[850px] md:h-[450px] rounded-3xl bg-cover bg-center relative" style="background-image: url('/assets/hero-home.webp')">
          <div class="w-full h-full bg-[#141008]/40 md:justify-center flex flex-col justify-between px-6 md:px-8 py-16 md:py-0 md:grid md:grid-cols-3">

            <div class="md:col-span-2 md:h-full flex flex-col justify-center">
              <h1 class="hero-title text-[36px] md:text-[45px] lg:text-[65px] font-[700] text-white mb-8 leading-[1] text-center md:text-start">
                Stap binnen en laat ons <br class="hidden md:block">u <span class="backdrop-underline hero-underline">stijlvol</span> maken.
              </h1>

              <p class="hero-sub text-sm text-white opacity-80 text-center md:text-start md:max-w-[500px] mb-4">
                Bij ons draait alles om stijl. Van klassieke snitten tot moderne looks,
                wij creëren moeiteloos stijlvolle verschijningen die jouw persoonlijkheid accentueren.
                Stap binnen en ontdek de kunst van verfijnde grooming
              </p>

              <div class="hero-ctas flex flex-col md:flex-row items-center justify-center md:justify-start gap-2 md:gap-4">
                {{-- ✅ Trigger -> modal --}}
                <a
                  href="#"
                  data-booking-trigger
                  class="w-fit px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold"
                >
                  Afspraak plannen
                </a>

                <a href="#diensten" class="w-fit px-6 py-2 rounded-full bg-[#141008] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold">
                  Diensten bekijken
                </a>
              </div>
            </div>

            <div class="md:py-8 flex flex-col md:items-end items-center ">
              <div class="flex items-center justify-end md:gap-6">
                <video class="w-1/2 mr-4 md:max-w-[12rem] rounded-xl border border-[#bc9355]" src="/assets/reels/day-at-shop.mp4" autoplay loop muted playsinline></video>
                <video class="w-1/2 -mr-2 md:max-w-[12rem] rounded-xl border border-[#bc9355]" src="/assets/reels/lil-bro.mp4" autoplay loop muted playsinline></video>
              </div>

              <a href="https://www.instagram.com/barbershopdemink/" target="_blank" class="mt-4 flex items-center gap-4 text-white hover:text-[#bc9355] transition duration-300">
                <h6 class="text-lg">Een kijkje in onze Barbershop?</h6>
                <i class="fa-brands fa-instagram text-[18px]"></i>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>

    {{-- Diensten --}}
    <div id="diensten" class="w-full h-auto pt-30 pb-15 px-4">
      <div class="max-w-[1400px] mx-auto flex flex-col gap-12">
        <h2 class="text-4xl md:text-5xl text-white text-center font-[500]">
          Tarieven die passen bij<br><span class="text-[#947341]">vakmanschap</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-12">

          <div class="w-full bg-[#1c160b] rounded-3xl p-8 flex flex-col justify-between">
            <div>
              <h2 class="text-2xl text-[#bc9355] text-center font-[700] mb-6">Knippen</h2>
              <div class="flex flex-col gap-4 mb-8">
                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">Knippen & Stylen - Man</p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">25,-</h6>
                </div>

                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">
                    Knippen & Stylen - Kind<br><span class="text-xs opacity-50">Tot / met 12 jaar</span>
                  </p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">22,50</h6>
                </div>
              </div>
            </div>

            {{-- ✅ Trigger -> modal --}}
            <a
              href="#"
              data-booking-trigger
              class="w-full px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white text-center font-semibold"
            >
              Plan nu mijn afspraak
            </a>
          </div>

          <div class="w-full bg-[#1c160b] rounded-3xl p-8 flex flex-col justify-between">
            <div>
              <h2 class="text-2xl text-[#bc9355] text-center font-[700] mb-6">Baard</h2>
              <div class="flex flex-col gap-4 mb-8">

                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">Knippen & Stylen - Baard</p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">35,-</h6>
                </div>

                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">Trimmen Baard</p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">12,50</h6>
                </div>

                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">Hot Towel Shave</p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">22,50</h6>
                </div>

              </div>
            </div>

            {{-- ✅ Trigger -> modal --}}
            <a
              href="#"
              data-booking-trigger
              class="w-full px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white text-center font-semibold"
            >
              Plan nu mijn afspraak
            </a>
          </div>

          <div class="w-full bg-[#1c160b] rounded-3xl p-8 flex flex-col justify-between">
            <div>
              <h2 class="text-2xl text-[#bc9355] text-center font-[700] mb-6">Overige</h2>
              <div class="flex flex-col gap-4 mb-8">

                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">Contouren</p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">10,-</h6>
                </div>

                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">
                    Speciale behandeling<br><span class="text-xs opacity-50">Alles voor haar & baard + drankje</span>
                  </p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">50,-</h6>
                </div>

                <div class="grid grid-cols-5 gap-4 flex items-center">
                  <p class="text-sm text-white col-span-3">Waxen Neus</p>
                  <hr class="col-span-1 border-[#947341]">
                  <h6 class="text-base text-white col-span-1 text-end">3,-</h6>
                </div>

              </div>
            </div>

            {{-- ✅ Trigger -> modal --}}
            <a
              href="#"
              data-booking-trigger
              class="w-full px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white text-center font-semibold"
            >
              Plan nu mijn afspraak
            </a>
          </div>

        </div>
      </div>
    </div>

    {{-- Intro collage --}}
    <div class="w-full h-auto bg-[#1c160b] py-15 px-4">
      <div class="max-w-[1400px] mx-auto flex flex-col items-center gap-12">
        <div class="w-full flex flex-col md:flex-row md:items-end md:justify-between">
          <h2 class="text-4xl md:text-5xl text-white font-[500] mb-4 md:mb-0">
            Meer dan<br class="hidden md:block"> een <span class="text-[#947341]">knipbeurt</span>
          </h2>
          <p class="text-sm text-white opacity-80 max-w-[500px] md:text-end">
            Een knipbeurt is bij ons een beleving. Persoonlijk advies, vakmanschap en een ontspannen sfeer staan altijd centraal.
          </p>
        </div>

        <div class="w-full flex flex-col grid grid-cols-2 md:grid-cols-5 md:gap-14 gap-6 md:flex-row md:items-center md:justify-between">
          <img src="/assets/intro-1.webp" class="md:max-w-[15rem] rounded-3xl">
          <img src="/assets/intro-2.webp" class="md:max-w-[15rem] rounded-3xl">
          <img src="/assets/intro-3.webp" class="md:max-w-[15rem] rounded-3xl">
          <img src="/assets/intro-4.webp" class="md:max-w-[15rem] rounded-3xl">
          <img src="/assets/intro-5.webp" class="hidden md:block md:max-w-[15rem] rounded-3xl">
        </div>
      </div>
    </div>

    {{-- Barbers --}}
    <div id="barbers" class="w-full h-auto py-15 px-4">
      <div class="max-w-[1400px] mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
        <h2 class="text-4xl md:text-5xl text-white text-center font-[500] md:col-span-3 mb-6 md:mb-0">
          Barbers met passie voor<br><span class="text-[#947341]">hun specialisme</span>
        </h2>

        <div class="bg-[#1c160b] rounded-3xl p-8">
          <div class="w-full aspect-square rounded-2xl bg-cover bg-center mb-6" style="background-image: url('/assets/bartminkman.jpeg')"></div>
          <h2 class="text-2xl text-[#bc9355] text-left font-[700] mb-6">Bart Minkman</h2>
          <p class="text-sm text-white opacity-80 mb-8">
            Mijn naam is Bart Minkman, eigenaar van Barbershop De Mink. Gepassioneerd barbier, docent bij Graafschap College en trainer op locatie. U bent welkom voor koffie, een goed gesprek en vakwerk.
          </p>

          {{-- ❗️NIET aanpassen: "Afspraak plannen bij ..." moet direct link blijven --}}
          <div class="flex items-center justify-between gap-4">
            <a href="https://barbershop-de-mink.salonized.com/widget_bookings/new" target="_blank" class="w-fit px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold">
              Afspraak plannen bij Bart
            </a>
            <a href="https://www.instagram.com/barbershopdemink/" target="_blank" class="w-8 h-8 bg-[#947341] hover:bg-[#bc9355] transition duration-300 rounded-full flex items-center justify-center">
              <i class="fa-brands fa-instagram text-white"></i>
            </a>
          </div>
        </div>

        <div class="bg-[#1c160b] rounded-3xl p-8">
          <div class="w-full aspect-square rounded-2xl bg-cover bg-bottom mb-6" style="background-image: url('/assets/samuel.jpeg')"></div>
          <h2 class="text-2xl text-[#bc9355] text-left font-[700] mb-6">Samuël Latul</h2>
          <p class="text-sm text-white opacity-80 mb-8">
            Mijn naam is Samuël Latul, zelfstandig barbier bij Barbershop De Mink. Ik ga voor strakke fades, scherpe lijnen en een verzorgde baard. U bent welkom voor koffie, eerlijk advies en vakwerk.
          </p>

          {{-- ❗️NIET aanpassen --}}
          <div class="flex items-center justify-between gap-4">
            <a href="https://samuel-barbershopdemink.bjootify.com/" target="_blank" class="w-fit px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold">
              Afspraak plannen bij Samuël
            </a>
            <a href="https://www.instagram.com/barbersl.7/" target="_blank" class="w-8 h-8 bg-[#947341] hover:bg-[#bc9355] transition duration-300 rounded-full flex items-center justify-center">
              <i class="fa-brands fa-instagram text-white"></i>
            </a>
          </div>
        </div>

        <div class="bg-[#1c160b] rounded-3xl p-8">
          <div class="w-full aspect-square rounded-2xl bg-cover bg-center mb-6" style="background-image: url('/assets/ian.jpeg')"></div>
          <h2 class="text-2xl text-[#bc9355] text-left font-[700] mb-6">Ian Smits</h2>
          <p class="text-sm text-white opacity-80 mb-8">
            Mijn naam is Ian Smits, zelfstandig barbier bij Barbershop De Mink. Van klassiek tot modern: ik werk graag netjes en precies, tot in de details. U bent welkom voor koffie, een goed gesprek en een frisse look.
          </p>

          {{-- ❗️NIET aanpassen --}}
          <div class="flex items-center justify-between gap-4">
            <a href="https://ian-barbershopdemink.bjootify.com/" target="_blank" class="w-fit px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold">
              Afspraak plannen bij Ian
            </a>
            <a href="https://www.instagram.com/cutsbysmits/" target="_blank" class="w-8 h-8 bg-[#947341] hover:bg-[#bc9355] transition duration-300 rounded-full flex items-center justify-center">
              <i class="fa-brands fa-instagram text-white"></i>
            </a>
          </div>
        </div>

      </div>
    </div>

    {{-- FAQ --}}
    <div id="faq" class="w-full h-auto py-15 px-4">
      <div class="max-w-[1400px] mx-auto grid grid-cols-3 gap-6">
        <div class="col-span-3 flex flex-col md:flex-row md:items-end justify-between mb-4 md:mb-0">
          <h2 class="text-4xl md:text-5xl text-white font-[500]">Vragen?<br>wij hebben een <span class="text-[#947341]">antwoord</span></h2>
          <p class="text-sm text-white opacity-80 max-w-[500px] md:text-end mt-4 md:mt-0">
            Van afspraken maken tot onderhoud van je coupe.<br>Hier vind je snel wat je zoekt.
          </p>
        </div>

        <div class="col-span-1 h-[400px] rounded-3xl bg-cover bg-center" style="background-image: url('/assets/collage-4.webp')"></div>
        <div class="col-span-2 h-[400px] rounded-3xl bg-cover bg-center" style="background-image: url('/assets/collage-2.webp')"></div>

        <div class="col-span-3 flex flex-col gap-6">
          <div class="faq-item w-full rounded-3xl bg-[#1c160b] p-8 cursor-pointer select-none">
            <div class="flex items-center justify-between">
              <h2 class="faq-title text-lg text-white text-left font-[500] transition duration-300 max-w-[80%]">Hoe lang duurt een knipbeurt gemiddeld?</h2>
              <i class="faq-icon fa-solid fa-chevron-down text-white transition duration-300"></i>
            </div>
            <p class="faq-content hidden text-sm text-white opacity-80 mt-4">
              Een standaard knipbeurt duurt ongeveer <span class="text-[#947341]">30 tot 45 minuten</span>. Voor een combinatie van haar en baard nemen we iets langer de tijd.
            </p>
          </div>

          <div class="faq-item w-full rounded-3xl bg-[#1c160b] p-8 cursor-pointer select-none">
            <div class="flex items-center justify-between">
              <h2 class="faq-title text-lg text-white text-left font-[500] transition duration-300 max-w-[80%]">Kan ik bij jullie pinnen of alleen contant betalen?</h2>
              <i class="faq-icon fa-solid fa-chevron-down text-white transition duration-300"></i>
            </div>
            <p class="faq-content hidden text-sm text-white opacity-80 mt-4">
              Bij Barbershop De Mink kun je <span class="text-[#947341]">zowel pinnen als contant</span> betalen.
            </p>
          </div>

          <div class="faq-item w-full rounded-3xl bg-[#1c160b] p-8 cursor-pointer select-none">
            <div class="flex items-center justify-between">
              <h2 class="faq-title text-lg text-white text-left font-[500] transition duration-300 max-w-[80%]">Doen jullie ook baardbehandelingen zonder knippen?</h2>
              <i class="faq-icon fa-solid fa-chevron-down text-white transition duration-300"></i>
            </div>
            <p class="faq-content hidden text-sm text-white opacity-80 mt-4">
              <span class="text-[#947341]">Ja, dat kan zeker.</span> Je kunt bij ons ook terecht voor alleen baard trimmen, stylen of scheren.
            </p>
          </div>

          <div class="faq-item w-full rounded-3xl bg-[#1c160b] p-8 cursor-pointer select-none">
            <div class="flex items-center justify-between">
              <h2 class="faq-title text-lg text-white text-left font-[500] transition duration-300 max-w-[80%]">Wat gebeurt er als ik mijn afspraak moet annuleren of verzetten?</h2>
              <i class="faq-icon fa-solid fa-chevron-down text-white transition duration-300"></i>
            </div>
            <p class="faq-content hidden text-sm text-white opacity-80 mt-4">
              Geen probleem. We vragen je wel om dit <span class="text-[#947341]">minimaal 24 uur van tevoren</span> te doen, zodat we de plek nog kunnen vrijmaken voor iemand anders.
            </p>
          </div>

          <div class="faq-item w-full rounded-3xl bg-[#1c160b] p-8 cursor-pointer select-none">
            <div class="flex items-center justify-between">
              <h2 class="faq-title text-lg text-white text-left font-[500] transition duration-300 max-w-[80%]">Knippen jullie ook kinderen?</h2>
              <i class="faq-icon fa-solid fa-chevron-down text-white transition duration-300"></i>
            </div>
            <p class="faq-content hidden text-sm text-white opacity-80 mt-4">
              <span class="text-[#947341]">Ja, kinderen zijn bij ons van harte welkom.</span> We nemen de tijd en zorgen voor een ontspannen sfeer, ook voor de jongste klanten.
            </p>
          </div>

          <div class="flex items-center gap-4 mt-6">
            {{-- ✅ Trigger -> modal --}}
            <a
              href="#"
              data-booking-trigger
              class="w-fit px-6 py-2 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold"
            >
              Afspraak plannen
            </a>

            <a href="#diensten" class="w-fit px-6 py-2 rounded-full bg-[#947341] hover:bg-[#bc9355] transition duration-300 text-sm text-white font-semibold">
              Bekijk onze diensten
            </a>
          </div>
        </div>
      </div>
    </div>

    {{-- Reviews / Footer --}}
    <div id="reviews" class="w-full h-auto py-15 bg-[#0f0a05] px-4">
      <div class="max-w-[1400px] mx-auto">

        <div class="w-full mb-10 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-12">
          <div class="p-8 rounded-3xl bg-[#141008]">
            <div class="flex items-center justify-between">
              <h2 class="text-lg text-white text-left font-[500] transition duration-300">Romano Zemar</h2>
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
              </div>
            </div>
            <p class="text-sm text-white opacity-80 mt-4">
              <span class="text-[#947341]">Barbershop De Mink is geweldig!</span> Bart knipt niet alleen supergoed, maar zijn enthousiasme maakt het hele bezoek extra fijn. Je merkt echt dat hij passie heeft voor het vak, en dat zie je terug in het resultaat. Absoluut een aanrader!
            </p>
          </div>

          <div class="p-8 rounded-3xl bg-[#141008]">
            <div class="flex items-center justify-between">
              <h2 class="text-lg text-white text-left font-[500] transition duration-300">Nino Middelburg</h2>
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
              </div>
            </div>
            <p class="text-sm text-white opacity-80 mt-4">
              <span class="text-[#947341]">Prachtige barbershop met klassieke uitstraling.</span> Enorm tevreden over de kwaliteit en de prijs. Grote aanrader voor eenieder die van stijl en kwaliteit houdt.
            </p>
          </div>

          <div class="p-8 rounded-3xl bg-[#141008]">
            <div class="flex items-center justify-between">
              <h2 class="text-lg text-white text-left font-[500] transition duration-300">Ramon Turba</h2>
              <div class="flex items-center gap-2">
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
                <i class="fa-solid fa-star text-[#bc9355] fa-sm"></i>
              </div>
            </div>
            <p class="text-sm text-white opacity-80 mt-4">
              <span class="text-[#947341]">Veruit de beste barber van Zevenaar en omgeving.</span> Er word goed met je omgegaan en geluisterd naar de wensen. Daarnaast een super mooie zaak, en een goed kapsel! Mij zie je zeker snel terug!
            </p>
          </div>
        </div>

        <div class="w-full flex items-center justify-between mb-10">
          <div>
            <div class="flex items-center gap-4 mb-6">
              <img src="/assets/logo-wit.png" alt="Barbershop De Mink" class="max-w-14">
              <h6 class="text-xl text-white">Barbershop De Mink</h6>
            </div>
            <p class="text-sm text-white opacity-80 max-w-[500px]">
              Bij ons draait alles om stijl. Van klassieke snitten tot moderne looks,
              wij creëren moeiteloos stijlvolle verschijningen die jouw persoonlijkheid accentueren.
              Stap binnen en ontdek de kunst van verfijnde grooming
            </p>
          </div>

          <svg class="hidden md:block max-w-[9rem] rotating-seal"
            viewBox="0 0 100 100"
            xmlns="http://www.w3.org/2000/svg">
            <path style="fill:none!important;stroke:none!important;"
              id="circlePath"
              d="
                M 10, 50
                a 40,40 0 1,1 80,0
                a 40,40 0 1,1 -80,0
              "
            />
            <text fill="#bc9355" font-size="8">
              <textPath
                href="#circlePath"
                startOffset="50%"
                text-anchor="middle"
                lengthAdjust="spacing"
                textLength="251.33"
              >
                BARBERSHOP DE MINK &nbsp;
              </textPath>
            </text>
          </svg>
        </div>

        <div class="w-full grid grid-cols-10 gap-8">
          <div class="col-span-10 md:col-span-5 flex md:gap-20 grid grid-cols-2 md:grid-cols-3 gap-6">
            <div>
              <h6 class="text-lg text-[#bc9355] mb-4">Navigatie</h6>
              <ul class="text-sm text-white font-semibold flex flex-col gap-2">
                <li><a href="/" class="hover:text-[#bc9355] transition duration-300">Home</a></li>
                <li><a href="#diensten" class="hover:text-[#bc9355] transition duration-300">Diensten</a></li>
                <li><a href="#barbers" class="hover:text-[#bc9355] transition duration-300">Barbers</a></li>
                <li><a href="#faq" class="hover:text-[#bc9355] transition duration-300">FAQ</a></li>
                <li><a href="#reviews" class="hover:text-[#bc9355] transition duration-300">Reviews</a></li>
              </ul>
            </div>

            <div>
              <h6 class="text-lg text-[#bc9355] mb-4">Diensten</h6>
              <ul class="text-sm text-white font-semibold flex flex-col gap-2">
                <li><a href="#diensten" class="hover:text-[#bc9355] transition duration-300">Knippen</a></li>
                <li><a href="#diensten" class="hover:text-[#bc9355] transition duration-300">Baard</a></li>
                <li><a href="#diensten" class="hover:text-[#bc9355] transition duration-300">Overige</a></li>
              </ul>
            </div>

            <div>
              <h6 class="text-lg text-[#bc9355] mb-4">Bedrijfsgegevens</h6>
              <ul class="text-sm text-white font-normal flex flex-col gap-2">
                <li>Barbershop De Mink</li>
                <li>Schilderspoort 4</li>
                <li class="mb-2">6901 DR Zevenaar</li>
                <li>KVK: 91577748</li>
              </ul>
            </div>
          </div>

          <div class="col-span-10 md:col-span-5">
            <div class="w-full h-full rounded-3xl overflow-hidden border border-white/10 shadow-sm">
              <iframe
                title="Barbershop De Mink - Locatie"
                class="w-full h-full"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q=Schilderspoort%204,%206901%20DR%20Zevenaar&output=embed"
              ></iframe>
            </div>
          </div>
        </div>

        <hr class="border-white/10 my-10">

        <div class="w-full flex flex-col md:flex-row items-center justify-center md:justify-between">
          <p class="text-xs text-white opacity-50">Copyright © Barbershop De Mink</p>
          <p class="text-xs text-white opacity-50">
            Website gemaakt door <a href="https://www.halfmanmedia.nl" target="_blank" class="hover:text-[#bc9355] transition duration-300">HalfmanMedia</a>
          </p>
        </div>

      </div>
    </div>

    <div class="w-full h-[5px] bg-[#bc9355]"></div>

    {{-- ✅ Booking modal (opent via alle data-booking-trigger knoppen) --}}
    <div
      id="bookingModal"
      class="fixed inset-0 z-[300] hidden items-center justify-center p-4"
      aria-hidden="true"
    >
      {{-- Backdrop --}}
      <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" data-modal-close></div>

      {{-- Panel --}}
      <div
        data-modal-panel
        class="relative w-full max-w-lg rounded-3xl bg-[#1c160b] border border-white/10 shadow-2xl overflow-hidden"
      >
        <div class="p-6 border-b border-white/10 flex items-center justify-between gap-4">
          <div class="min-w-0">
            <h3 class="text-white text-xl font-[700] leading-tight">Bij wie wil je een afspraak?</h3>
            <p class="text-sm text-white/70 mt-1">Kies je favoriete barber.</p>
          </div>

          <button
            type="button"
            class="shrink-0 cursor-pointer w-10 h-10 rounded-full bg-[#141008] hover:bg-[#947341] transition duration-300 flex items-center justify-center"
            data-modal-close
            aria-label="Sluiten"
          >
            <i class="fa-solid fa-xmark text-white"></i>
          </button>
        </div>

        <div class="p-6 grid gap-3">
          <a
            href="{{ $bookingBart }}"
            target="_blank"
            class="w-full px-6 py-4 rounded-2xl bg-[#141008] hover:bg-[#947341] transition duration-300 text-white font-semibold flex items-center justify-between"
          >
          <div class="flex items-center gap-4">
            <div class="w-7 h-7 bg-cover bg-center rounded-xl" style="background-image: url('assets/bartminkman.jpg')"></div>
            <span>Bart</span>
          </div>
            <i class="fa-solid fa-arrow-right fa-xs text-white/70"></i>
          </a>

          <a
            href="{{ $bookingSamuel }}"
            target="_blank"
            class="w-full px-6 py-4 rounded-2xl bg-[#141008] hover:bg-[#947341] transition duration-300 text-white font-semibold flex items-center justify-between"
          >
          <div class="flex items-center gap-4">
            <div class="w-7 h-7 bg-cover bg-bottom rounded-xl" style="background-image: url('assets/samuel.jpeg')"></div>
            <span>Samuël</span>
          </div>
            <i class="fa-solid fa-arrow-right text-white/70"></i>
          </a>

          <a
            href="{{ $bookingIan }}"
            target="_blank"
            class="w-full px-6 py-4 rounded-2xl bg-[#141008] hover:bg-[#947341] transition duration-300 text-white font-semibold flex items-center justify-between"
          >
          <div class="flex items-center gap-4">
            <div class="w-7 h-7 bg-cover bg-center rounded-xl" style="background-image: url('assets/ian.jpeg')"></div>
            <span>Ian</span>
          </div>
            <i class="fa-solid fa-arrow-right text-white/70"></i>
          </a>

          <button
            type="button"
            class="mt-2 cursor-pointer w-full px-6 py-3 rounded-full bg-[#bc9355] hover:bg-[#947341] transition duration-300 text-sm text-white font-semibold"
            data-modal-close
          >
            Sluiten
          </button>
        </div>
      </div>
    </div>

    @verbatim
      <script>
      document.addEventListener('DOMContentLoaded', () => {
        gsap.registerPlugin(ScrollTrigger);

        const seal = document.querySelector('.rotating-seal');
        if (!seal) return;

        gsap.set(seal, { transformOrigin: '50% 50%' });

        const spin = gsap.to(seal, {
          rotation: 360,
          duration: 30,
          ease: 'none',
          repeat: -1
        });

        let revertTween;

        function boostSpin(boostScale = 3.0) {
          gsap.to(spin, {
            timeScale: boostScale,
            duration: 0.18,
            ease: 'power2.out',
            overwrite: true
          });

          if (revertTween) revertTween.kill();

          revertTween = gsap.to(spin, {
            timeScale: 1,
            duration: 0.9,
            ease: 'power3.out',
            delay: 0.25
          });
        }

        ScrollTrigger.create({
          start: 0,
          end: 'max',
          onUpdate(self) {
            const v = Math.abs(self.getVelocity());
            const boost = gsap.utils.clamp(1.2, 4.0, 1.2 + (v / 2000) * 2.8);
            boostSpin(boost);
          }
        });
      });
      </script>

      <script>
      document.addEventListener('DOMContentLoaded', () => {
        const h1 = document.querySelector('.hero-title');
        if (h1) {
          const splitToLetters = (el) => {
            const walk = (node) => {
              if (node.nodeType === 3) {
                const text = node.nodeValue;
                const frag = document.createDocumentFragment();

                for (const char of text) {
                  if (char === ' ') {
                    frag.appendChild(document.createTextNode(' '));
                    continue;
                  }
                  const s = document.createElement('span');
                  s.className = 'char';
                  s.textContent = char;
                  frag.appendChild(s);
                }
                node.replaceWith(frag);
              } else if (node.nodeType === 1) {
                const tag = node.tagName.toLowerCase();
                if (tag === 'script' || tag === 'style') return;
                Array.from(node.childNodes).forEach(walk);
              }
            };
            Array.from(el.childNodes).forEach(walk);
          };

          splitToLetters(h1);

          gsap.set(h1.querySelectorAll('.char'), {
            opacity: 0,
            y: 14,
            display: 'inline-block',
            willChange: 'transform, opacity'
          });

          gsap.to(h1.querySelectorAll('.char'), {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: 'power3.out',
            stagger: 0.018,
            delay: 0.15
          });

          const p = document.querySelector('.hero-sub');
          if (p) {
            gsap.set(p, {
              opacity: 0,
              y: 14,
              willChange: 'transform, opacity'
            });

            gsap.to(p, {
              opacity: 0.8,
              y: 0,
              duration: 0.8,
              ease: 'power3.out',
              delay: 1
            });
          }
        }
      });
      </script>

      <script>
      document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll('.faq-item');

        items.forEach((item) => {
          item.addEventListener('click', () => {
            const isOpen = item.classList.contains('is-open');

            items.forEach(i => {
              i.classList.remove('is-open');
              const c = i.querySelector('.faq-content');
              if (c) c.classList.add('hidden');
            });

            if (!isOpen) {
              item.classList.add('is-open');
              const content = item.querySelector('.faq-content');
              if (content) content.classList.remove('hidden');
            }
          });
        });
      });
      </script>

      <script>
      document.addEventListener('DOMContentLoaded', () => {
        const menu = document.getElementById('mobile-menu');
        const openBtn = document.getElementById('mobile-menu-open');
        const closeBtn = document.getElementById('mobile-menu-close');

        if (!menu || !openBtn || !closeBtn) return;

        const lockScroll = (locked) => {
          document.documentElement.classList.toggle('overflow-hidden', locked);
          document.body.classList.toggle('overflow-hidden', locked);
        };

        const openMenu = () => {
          menu.classList.add('active');
          openBtn.setAttribute('aria-expanded', 'true');
          menu.setAttribute('aria-hidden', 'false');
          lockScroll(true);
        };

        const closeMenu = () => {
          menu.classList.remove('active');
          openBtn.setAttribute('aria-expanded', 'false');
          menu.setAttribute('aria-hidden', 'true');
          lockScroll(false);
        };

        openBtn.addEventListener('click', (e) => {
          e.preventDefault();
          openMenu();
        });

        closeBtn.addEventListener('click', (e) => {
          e.preventDefault();
          closeMenu();
        });

        menu.querySelectorAll('a').forEach((a) => {
          a.addEventListener('click', () => closeMenu());
        });

        document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape') closeMenu();
        });
      });
      </script>

      <script>
      document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('bookingModal');
        if (!modal) return;

        const panel = modal.querySelector('[data-modal-panel]');
        const closeEls = modal.querySelectorAll('[data-modal-close]');
        const triggers = document.querySelectorAll('[data-booking-trigger]');

        let lastFocus = null;

        const lockScroll = (locked) => {
          document.documentElement.classList.toggle('overflow-hidden', locked);
          document.body.classList.toggle('overflow-hidden', locked);
        };

        const openModal = () => {
          lastFocus = document.activeElement;

          modal.classList.remove('hidden');
          modal.classList.add('flex');
          modal.setAttribute('aria-hidden', 'false');
          lockScroll(true);

          const closeBtn = modal.querySelector('[data-modal-close]');
          if (closeBtn) closeBtn.focus();
        };

        const closeModal = () => {
          modal.classList.add('hidden');
          modal.classList.remove('flex');
          modal.setAttribute('aria-hidden', 'true');
          lockScroll(false);

          if (lastFocus && typeof lastFocus.focus === 'function') {
            lastFocus.focus();
          }
        };

        triggers.forEach((btn) => {
          btn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
          });
        });

        closeEls.forEach((el) => {
          el.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal();
          });
        });

        modal.addEventListener('click', (e) => {
          if (!panel) return;
          if (!panel.contains(e.target)) closeModal();
        });

        document.addEventListener('keydown', (e) => {
          if (e.key === 'Escape' && modal.classList.contains('flex')) {
            closeModal();
          }
        });
      });
      </script>
    @endverbatim

  </body>
</html>