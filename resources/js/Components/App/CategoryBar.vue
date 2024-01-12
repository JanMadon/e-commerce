<template>
    <div class="flex text-white bg-slate-700 w-full pl-10">
                <div @mouseover="showList = true" @mouseleave="showList = false" :class="{ hover: showList }">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Electronics
                    </NavLink>
                    <ul v-if="showList" class="absolute flex flex-col text-white bg-slate-700 w-full w-min z-10">
                        <NavLink :href="route('dashboard')">
                            Laptops
                        </NavLink>
                        <NavLink :href="route('dashboard')">
                            Kayboards
                        </NavLink>
                        <NavLink :href="route('dashboard')">
                            Smartphone
                        </NavLink>
                    </ul>
                </div>
                <NavLink :href="route('dashboard')">
                    Office
                </NavLink>
                <NavLink :href="route('dashboard')">
                    Gameing
                </NavLink>
                <NavLink :href="route('admin.usersList')">
                    Desks
                </NavLink>
            </div>
</template>

<script setup>
    import { ref } from 'vue';
    import NavLink from '../NavLink.vue';
    

    const showList = ref(false)

</script>