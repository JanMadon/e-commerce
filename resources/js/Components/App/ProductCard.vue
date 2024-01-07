<template>
    <div class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white">
                <a :href="route('show.product', product.id)"
                    class="flex justify-center aspect-w-3 aspect-h-2 block overflow-hidden">
                    <img alt="product" class=" object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform"
                    :src="'data:image/jpeg;base64,' + photo">
                </a>
                <div class="p-4">
                    <h3 class="text-lg">
                        <a href="https://lcommerce.net/product/2022-apple-macbook-pro-laptop-with-m2-chip-13-inch-retina-display">
                            {{product.name}}
                        </a>
                    </h3>
                    <p>
                        {{product.description}}
                    </p>

                    <h5 class="font-bold">$ {{ product.price }}</h5>
                </div>
                <div class="flex justify-between items-end t-10 py-3 px-4">
                    <AddToCartBtn :product="product" :quantity="1"/>
                </div>
            </div>
           
</template>

<script setup>
import PrimaryButton from '../PrimaryButton.vue';
import { router } from '@inertiajs/vue3';
import {showSuccessNotification} from '@/event-bus.js';
import AddToCartBtn from './AddToCartBtn.vue';


const emit = defineEmits('addToCart');

const props = defineProps({
    photo: String,
    product: Object
})

</script>