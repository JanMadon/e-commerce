
<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <div class="grid gap-4 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-3">
            <!-- Product Item -->
            <ProductCard v-for="(photo, index) in photos" :key="index" :photo="photo" :product="products[index-1]"
            @addToCart="selectedProduct"></ProductCard>
        </div>
        <!-- {{ p }} -->

    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProductCard from '@/Components/App/ProductCard.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    products: Object,
    photos: Object
})

function selectedProduct(product) {
    console.log(product)
    // add ONE item to cart
    router.post(route('addToCart'), {
        id: product.id,
        quantity: 1
     });
}





</script>