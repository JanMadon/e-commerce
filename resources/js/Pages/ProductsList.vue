
<template>
    <Head title="Dashboard" />

    <GuestUserLayout>
        <div class="grid gap-4 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-3">
            <!-- Product Item -->
            <ProductCard v-for="(photo, index) in photos" :key="index" :photo="photo" :product="products[index-1]"
           ></ProductCard>
        </div>
        <!-- {{ p }} -->
    </GuestUserLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import ProductCard from '@/Components/App/ProductCard.vue';
import GuestUserLayout from '@/Layouts/GuestUserLayout.vue';
import { useAttrs } from 'vue';

const props = defineProps({
    products: Object,
    photos: Object
})

</script>