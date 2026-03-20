<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Rukman Bernard Fernando Pulle">
    <meta name="description"
        content="This web application empowers students to track and grow their skills for academic and career success.">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/tailwind.css')
    
    <title>NKA HUB</title>
</head>

<body class="bg-gradient-to-t from-blue-500 to-slate-300">
    <x-app-name />

    {{-- banner information --}}
    <section class="">
        <div class="flex flex-col sm:flex-row sm:mb-10 gap-4 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="sm:rotate-6 sm:hover:rotate-0 sm:duration-150 relative mx-auto max-w-sm rounded-3xl p-0.5 shadow-md shadow-lime-800 bg-red-700 border-4 border-pink-500">
                <div class="p-7 rounded-3xl">
                    <h1 class="font-bold text-xl text-black mb-2">Students' Skills</h1>
                    <p class="text-slate-200">Ignite your future by tracking and growing your skills—boost your confidence, career potential, and academic success, all in one place.</p>
                </div>
            </div>

            <div
                class="relative mx-auto max-w-sm rounded-3xl p-0.5 bg-green-700 border-4 border-red-900 shadow-md shadow-neutral-900">
                <div class="p-7 rounded-3xl">
                    <h1 class="font-bold text-xl mb-2 text-black">Skill Shortage</h1>
                    <p class="text-slate-200">Closing the skill gap starts here. Empower learners through focused training, industry-aligned education, and real-world readiness.</p>
                </div>
            </div>

            <div
                class="relative mx-auto max-w-sm rounded-3xl sm:-rotate-6 sm:hover:rotate-0 sm:duration-150 p-0.5 bg-yellow-600 border-4 border-green-500 shadow-md shadow-orange-900">
                <div class="p-7 rounded-3xl">
                    <h1 class="font-bold text-xl mb-2 text-black">Skill Training</h1>
                    <p class="text-slate-200">Master the skills that matter. Our structured training sharpens your abilities, fuels confidence, and prepares you for what’s next.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- end of banner information --}}

    {{-- cards --}}
    <section class="">
        <div class="flex flex-col sm:flex-row mt-10 gap-4 mx-auto max-w-7xl items-center grow">

            {{-- student image and button --}}
            <div
                class="overflow-hidden sm:h-[410px] basis-1/4 max-w-sm bg-gradient-to-r from-yellow-600 to-red-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">
                <img class="rounded-t-3xl w-full" src="{{ asset('images/student.jpg') }}" alt="" />
                <div class="p-5">
                    <div class="flex justify-end">
                        <a href="{{ route('student.login') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Enter</a>
                    </div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white">Student Section</h5>
                    <p class="font-normal text-slate-200 dark:text-gray-400">Ready to grow? Dive into the Skill Tracker and unlock your potential. Log in to shape your journey—one skill at a time.</p>
                </div>
            </div>
            {{-- end of student image and button --}}

            {{-- admin image and button --}}
            <div
                class="overflow-hidden sm:h-[410px] basis-1/4 max-w-sm bg-gradient-to-r from-green-600 to-yellow-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">
                <img class="rounded-t-3xl w-full" src="{{ asset('images/admin.jpg') }}" alt="" />
                <div class="p-5">
                    <div class="flex justify-end">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Enter</a>
                    </div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-black dark:text-white">Admin Section</h5>
                    <p class="font-normal text-slate-200 dark:text-gray-400">Lead with purpose. Empower learners, track progress, and drive innovation through a powerful skill development platform.</p>
                </div>
            </div>
            {{-- end of admin image and button --}}

            {{-- Skill Employer card --}}
            <div
                class="overflow-hidden sm:h-[410px] basis-1/4 max-w-sm bg-gradient-to-r from-red-600 to-yellow-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">
                <img class="rounded-t-3xl w-full" src="{{ asset('images/employer.jpg') }}" alt="" />
                <div class="p-5">
                    <div class="flex justify-end">
                        <a href="{{ route('employer.login') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Enter</a>
                    </div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Employer Section</h5>
                    <p class="mb-3 font-normal text-slate-200 dark:text-gray-400">Discover emerging talent and track progress with ease. The Skill Tracker bridges the gap between education and the workplace.</p>
                </div>
            </div>
            {{-- end of skill tool card --}}

            {{-- university picture --}}
            <div
                class="overflow-hidden sm:h-[410px] basis-1/4 max-w-sm bg-gradient-to-r from-red-600 to-green-600 border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700">
                <img class="rounded-t-3xl w-full" src="{{ asset('images/university.jpg') }}" alt="" />
                <div class="p-5">
                    <div class="flex justify-end">
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Enter</a>
                    </div>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">Guest Section</h5>
                    <p class="mb-3 font-normal text-slate-200 dark:text-gray-400">Explore the future of learning. Discover the skills that shape tomorrow, today—right here at NKA.</p>
                </div>
            </div>
            {{-- end of university picture --}}
        </div>
    </section>

    {{-- testimonials --}}
    <section class="">
        <div class="flex flex-col sm:mt-10 sm:mb-9 mt-10 sm:flex-row max-w-[400px] relative mx-auto gap-6 sm:max-w-7xl items-center">
            <div class="max-w-7xl mx-auto">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-gradient-to-r from-red-600 to-green-600 ring-1 ring-gray-900/5 rounded-full leading-none flex items-top justify-start space-x-6">
                        <div class="flex items-center">
                            <img class="rounded-full h-24 mr-2" src="{{ asset('images/student-01.jpg') }}" alt="">
                            <div class="flex flex-col">
                                <h3 class="font-bold">Ms. Ann Livera</h3>
                                <p class="font-semibold text-slate-800 mr-2">Simplified skill tracking and powerful resources—Skill Tool is a game-changer for every student!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-gradient-to-r from-red-600 to-yellow-600 ring-1 ring-gray-900/5 rounded-full leading-none flex items-top justify-start space-x-6">
                        <div class="flex items-center">
                            <img class="rounded-full h-24 mr-2" src="{{ asset('images/student-02.jpg') }}" alt="">
                            <div class="flex flex-col">
                                <h3 class="font-bold">Mr. Tony Brown</h3>
                                <p class="font-semibold text-slate-800 mr-2">Easy to use, rich in features. Skill Tool makes student development simple and impactful.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-gradient-to-r from-green-600 to-yellow-600 ring-1 ring-gray-900/5 rounded-full leading-none flex items-top justify-start space-x-6">
                        <div class="flex items-center">
                            <img class="rounded-full h-24 mr-2" src="{{ asset('images/student-03.jpg') }}" alt="">
                            <div class="flex flex-col">
                                <h3 class="font-bold">Mr. Lean Witerbrow</h3>
                                <p class="font-semibold text-slate-800 mr-2">Seamless, smart, essential. Skill Tool is a must-have for every learner chasing excellence.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end of testimonials --}}

    {{-- footer --}}
    {{-- <section class="">
        <div class="flex flex-row justify-center mt-5">
            <div>
                <p>© 2024 | Crafted with passion by R. B. Fernando – All rights reserved.</p>
            </div>
        </div>
    </section> --}}
    <footer class="text-center mt-10 text-sm text-gray-700 dark:text-gray-400">
        © 2024 Negombo Knowledge Academy (NKA). All rights reserved. Unauthorized use or duplication is prohibited under the Copyright Act No. 36 of 2003 (Sri Lanka).
    </footer>

    {{-- end of footer --}}
</body>

</html>
