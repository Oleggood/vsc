<script setup>
import {Head, Link} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Vyatka"/>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >


                <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="hidden font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Dashboard</Link
                    >

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Log in</Link
                        >
                    </template>
                </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <svg version="1.0"
                     width="50.000000pt" viewBox="0 0 1002.000000 1014.000000"
                     preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,1014.000000) scale(0.100000,-0.100000)"
                       fill="#7f1d1d" stroke="none">
                        <path d="M3550 9930 c-161 -166 -347 -765 -520 -1680 -17 -91 -38 -196 -45
-235 -19 -97 -93 -548 -101 -617 l-7 -57 39 -10 c194 -51 719 -126 1169 -167
241 -21 931 -30 1148 -15 413 30 728 82 1001 165 68 21 83 29 80 44 -2 9 -33
170 -69 357 -64 342 -75 394 -140 694 -141 652 -285 1167 -385 1376 -42 88
-96 157 -141 180 -42 22 -116 19 -174 -9 -72 -34 -150 -95 -321 -253 -176
-162 -254 -223 -345 -268 -129 -65 -245 -66 -379 -3 -67 32 -91 54 -390 365
-134 139 -190 173 -302 181 l-67 5 -51 -53z"/>
                        <path d="M2600 6540 c-686 -151 -1342 -335 -1730 -487 -322 -127 -510 -257
-510 -355 0 -119 291 -279 746 -412 542 -158 1142 -269 1924 -356 654 -72 894
-85 1640 -85 729 0 902 9 1550 75 868 89 1758 266 2268 450 133 48 340 153
403 204 125 101 117 189 -24 289 -261 186 -894 394 -1902 626 -143 33 -301 67
-350 77 l-91 17 -69 -28 c-293 -118 -737 -203 -1295 -247 -210 -16 -788 -16
-990 0 -570 47 -1038 138 -1308 253 -56 24 -56 24 -262 -21z"/>
                        <path d="M7415 4779 c-236 -32 -438 -59 -449 -61 -17 -3 -19 -15 -21 -143 -3
-176 -39 -371 -114 -620 -21 -70 -21 -70 -118 -145 -695 -535 -1273 -1162
-1620 -1755 -340 -581 -505 -1140 -490 -1665 3 -102 9 -196 14 -209 9 -21 15
-13 72 89 417 754 1046 1347 1863 1756 409 205 896 372 1281 439 77 14 96 20
85 29 -7 7 -71 40 -143 73 -71 34 -274 130 -450 214 -176 83 -339 160 -362
171 -24 10 -43 23 -43 28 0 15 255 135 401 189 451 167 1236 343 2087 467 67
10 122 21 122 24 0 4 -19 20 -42 35 -40 26 -338 233 -848 589 -301 210 -397
277 -540 376 -69 47 -154 107 -190 131 l-65 45 -430 -57z"/>
                        <path d="M1364 4589 c-555 -478 -1020 -878 -1066 -915 -26 -22 -47 -42 -47
-45 -1 -3 70 -9 157 -12 258 -9 520 -55 1037 -182 284 -70 826 -221 1082 -301
l117 -37 -31 -26 c-16 -14 -140 -120 -273 -236 -134 -115 -314 -270 -399 -344
-86 -73 -157 -137 -159 -142 -2 -4 16 -13 40 -19 239 -59 670 -234 1238 -501
175 -82 1058 -523 1268 -634 107 -56 164 -81 167 -72 9 30 88 318 135 492 28
105 52 195 55 202 2 7 -44 49 -103 94 -539 415 -1010 909 -1419 1489 -248 353
-481 762 -633 1110 -39 91 -75 172 -79 180 -6 11 -98 28 -347 67 -186 28 -368
55 -404 58 l-65 7 -271 -233z"/>
                        <path d="M2855 4636 c-9 -81 9 -219 39 -302 56 -155 163 -271 319 -348 175
-87 448 -131 623 -101 213 38 385 152 509 342 90 137 164 178 320 178 87 0
107 -4 155 -26 78 -36 113 -70 175 -164 122 -184 311 -304 528 -334 75 -10
241 -1 347 20 161 31 313 103 412 198 130 122 188 258 195 456 2 66 0 126 -5
134 -8 11 -17 11 -58 -3 -130 -42 -475 -97 -729 -116 -175 -12 -1521 -13
-1830 0 -352 14 -710 58 -907 110 -40 11 -76 20 -80 20 -3 0 -9 -29 -13 -64z"/>
                    </g>
                </svg>

            </div>


            <div class="flex justify-center"><p class="font-bold text-red-900 text-xs">ВятСтатКонтроль</p></div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <a
                        :href="route('taskuser.index')"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
                    >
                        <div>
                            <div
                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"
                            >
                                 <span class="text-sm font-semibold text-red-500">
                                    I
                                </span>
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"-->
<!--                                    />-->
<!--                                </svg>-->
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Контроль, взаимодействие</h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Подсистема планирования, отслеживания и контроля управленческих решений.
                            </p>
                        </div>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                            />
                        </svg>
                    </a>

                    <a
                        :href="route('statistic.index')"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
                    >
                        <div>
                            <div
                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"
                            >
                                <span class="text-sm font-semibold text-red-500">
                                    II
                                </span>
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"-->
<!--                                    />-->
<!--                                </svg>-->
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Статистика, отчетность</h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                               Подсистема сбора, вывода стастистических данных, формирования периодической отчетности.
                            </p>
                        </div>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                            />
                        </svg>
                    </a>

<!--                    <a-->
<!--                        href="#"-->
<!--                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"-->
<!--                    >-->
<!--                        <div>-->
<!--                            <div-->
<!--                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"-->
<!--                            >-->
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </div>-->

<!--                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Laravel News</h2>-->

<!--                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">-->
<!--                                Laravel News is a community driven portal and newsletter aggregating all of the latest-->
<!--                                and most important news in the Laravel ecosystem, including new package releases and-->
<!--                                tutorials.-->
<!--                            </p>-->
<!--                        </div>-->

<!--                        <svg-->
<!--                            xmlns="http://www.w3.org/2000/svg"-->
<!--                            fill="none"-->
<!--                            viewBox="0 0 24 24"-->
<!--                            stroke-width="1.5"-->
<!--                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6"-->
<!--                        >-->
<!--                            <path-->
<!--                                stroke-linecap="round"-->
<!--                                stroke-linejoin="round"-->
<!--                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"-->
<!--                            />-->
<!--                        </svg>-->
<!--                    </a>-->

<!--                    <div-->
<!--                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"-->
<!--                    >-->
<!--                        <div>-->
<!--                            <div-->
<!--                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"-->
<!--                            >-->
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </div>-->

<!--                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</h2>-->

<!--                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">-->
<!--                                Laravel's robust library of first-party tools and libraries, such as-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Forge</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Vapor</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Nova</a-->
<!--                                >, and-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Envoyer</a-->
<!--                                >-->
<!--                                help you take your projects to the next level. Pair them with powerful open source-->
<!--                                libraries like-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Cashier</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Dusk</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Echo</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Horizon</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Sanctum</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="#"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                >Telescope</a-->
<!--                                >, and more.-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
<!--            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">-->
<!--                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">-->
<!--                    <div class="flex items-center gap-4">-->
<!--                        <a-->
<!--                            href="#"-->
<!--                            class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                        >-->
<!--                            <svg-->
<!--                                xmlns="#"-->
<!--                                fill="none"-->
<!--                                viewBox="0 0 24 24"-->
<!--                                stroke-width="1.5"-->
<!--                                class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400"-->
<!--                            >-->
<!--                                <path-->
<!--                                    stroke-linecap="round"-->
<!--                                    stroke-linejoin="round"-->
<!--                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"-->
<!--                                />-->
<!--                            </svg>-->
<!--                            Sponsor-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">-->
<!--                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>

    <div class="relative">
        <div class="absolute bottom-0 right-1.5">
            <span class="text-sm text-gray-400">ПО "Вятка стастистика контроль" (ВСК). 2023-2024гг.</span>
        </div>
    </div>

</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
