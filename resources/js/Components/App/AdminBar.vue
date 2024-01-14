<template>
    <div class="flex flex-col items-center w-48 bg-slate-700 text-white" >
        <p class="m-5 font-bold text-xl"> Admin Panel</p>
        <div class="flex flex-col w-full">
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" >
                Dashboard
            </NavLink>
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Shop
            </NavLink>
            <NavLink :href="route('list.products')" :active="route().current('list.products')">
                Products list
            </NavLink>
            <NavLink :href="route('form.add.product')" :active="route().current('form.add.product')">
                Add products
            </NavLink>
            <NavLink :href="route('categories.index')" :active="route().current('categories.index')">
                Categories & Subcategories
            </NavLink>
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Orders
            </NavLink>
            <NavLink :href="route('admin.usersList')" :active="route().current('admin.usersList')">
                Users
            </NavLink>
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Raporsts
            </NavLink>
        </div>
    </div>
</template>

<script setup>
import NavLink from '../NavLink.vue';

</script>