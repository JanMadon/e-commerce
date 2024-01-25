<template>
    <div class="flex">
        <!-- admin panel -->

        <AdminBar v-show="showAdminPanel" />

        <div class="w-full min-h-screen bg-gray-300 dark:bg-gray-800 ">
            <nav class="bg-gray-800 dark:bg-gray-800 border-gray-100">

                <div class="flex justify-between">
                    <div class="flex text-white">
                        <button @click="showAdminPanel = !showAdminPanel">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                        <div class="px-5 py-2">
                            <Link :href="route('home')" class="flex flex-col">
                            <ApplicationLogo class="block h-9 w-auto   dark:text-gray-200" />
                            <p class="text-white">E-commerce</p>
                            </Link>
                        </div>
                    </div>
                    <div class="flex ">
                        <a :href="(route('cart'))" class="flex items-center text-white px-3 hover:bg-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mr-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            Cart
                        </a>
                        <div class="flex items-center h-full hover:bg-gray-900">
                            <div>
                                <span @click="showProfil = !showProfil" class="inline-flex">
                                    <button type="button" name="my-account-list" class="flex items-center px-3 py-2 text-white ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="mr-2 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        My Account
                                        <svg class="ms-2 -me-0.5 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                                <ul v-show="showProfil"
                                    class="absolute bg-gray-800 mt-4">
                                    <NavLink name="my-account-list" :href="route('profile.edit')" class="w-full hover:bg-slate-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="mr-2 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        My Profile
                                    </NavLink>
                                    <NavLink name="my-account-list" :href="route('my.order')" class="w-full hover:bg-slate-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="mr-2 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                        </svg>
                                        My Orders
                                    </NavLink>
                                    <NavLink name="my-account-list" :href="route('logout')" method="post" as="button"
                                        class="w-full hover:bg-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="mr-2 w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                        </svg>
                                        Log Out
                                    </NavLink>
                                </ul>

                            </div>
                        </div>
                        <div class="flex h-full px-2 hover:bg-gray-900 text-white">
                            <button @click="toggleDark()">
                                <svg v-if="isDark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            <CategoryBar />

            <main class="mb-60">
                <slot />
            </main>
        </div>
    </div>
    <Notification />
    <FooterComponets/>

</template>

<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import FooterComponets from '@/Components/FooterComponets.vue'
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { useDark, useToggle } from '@vueuse/core'
import Notification from '@/Components/App/Notification.vue'
import AdminBar from '@/Components/App/AdminBar.vue';
import CategoryBar from '@/Components/App/CategoryBar.vue';
import { watchEffect } from 'vue';
import { onMounted } from 'vue';


const showingNavigationDropdown = ref(false);
const dark = ref(false)
const isDark = useDark();
const toggleDark = useToggle(isDark);
const showProfil = ref(false);
const showAdminPanel = ref(true);

const clickedElement = ref()


onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

const handleClickOutside = (event) => {
    if(event.target.name !== 'my-account-list'){
        showProfil.value = false
    }
};

</script>
