
<template>
    <Head title="Dashboard" />

    <AdminLayout>
        sacasc
        <!-- {{ p }} -->
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ProductCard from '@/Components/App/ProductCard.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
    photos: Object
})






</script>