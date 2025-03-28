
<template>
    <GuestUserLayout>
        <nav class="flex items-center justify-between mb-3 bg-slate-100  text-gray-600 dark:bg-slate-500 dark:text-gray-100">
            <SearchFrom :placeholder="'Search product by name'" />
            <div v-show="category" class="flex pr-10 ">
                <a :href="route('home', category)">
                    {{ category }}
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                </svg>
                {{ subcategory ? subcategory : 'all' }}
            </div>
        </nav>

        <div v-if="products.data.length">
            <div class="grid gap-4 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 px-5 ">
                <ProductCard v-for="(product, index) in products.data" :key="index" :product="product"></ProductCard>
            </div>
            <Paginator  v-if="products.last_page > 1" :items="products.links" />
        </div>
        <p v-else class="mt-16 text-center text-gray-600 dark:text-gray-100">Sorry, we couldn't find any offers</p>

    </GuestUserLayout>
</template>

<script setup>
import GuestUserLayout from '@/Layouts/GuestUserLayout.vue';
import ProductCard from '@/Components/App/ProductCard.vue';
import SearchFrom from '@/Components/App/SearchFrom.vue';
import Paginator from '@/Components/App/Paginator.vue';
import { onMounted } from 'vue';
import { ref } from 'vue';

const props = defineProps({
    products: Object,
})

const category = ref()
const subcategory = ref()


onMounted(() => {
    const baseUrl = window.location.origin.toString() + "/shop";
    let currentUrl = window.location.href
    if (window.location.search) {
        currentUrl = currentUrl.replace(window.location.search, '')
    }
    const categoryPath = currentUrl.replace(baseUrl, '').slice(1);
    const segments = categoryPath.split('/');

    category.value = segments[0] ? decodeURIComponent(segments[0]) : '';
    subcategory.value = segments[1] ? decodeURIComponent(segments[1]) : '';

})




</script>
