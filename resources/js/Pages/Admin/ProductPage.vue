
<template>
    <Head title="Dashboard" />

    <AdminLayout>

        <div class="flex justify-center mt-8 mx-auto ">
            <div class="flex flex-col items-center w-2/3 h-2/3 mx-5 p-5
            bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <!-- Zdjęcie -->
                <img :src="'data:image/pag;base64,' + mainPhoto" alt="Product Image" class="w-2/3   h-96 m-10 object-cover">
                <!-- Przewijana lista -->
                <div class="overflow-y-auto">
                    <ul class="flex ">
                        <li v-for="photo in photos" @click="changeMainPhoto(photo)"
                            class="flex justify-center items-center w-[80px] h-[80px] mx-3 bg-gray-200 rounded-lg cursor-pointer overflow-hidden hover:brightness-75 transition duration-300">
                            <img :src="'data:image/pag;base64,' + photo" alt="next-photo"
                                class="w-full h-full object-cover">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col justify-between w-60 right-column p-4 bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <div>
                    <p class="text-gray-700 text-sm border-b border-gray-400">{{ product.category }}</p>

                    <h2 class="text-xl font-bold mb-4">{{ product.name }}</h2>
                    <p class="text-gray-700 mb-10">{{ product.description }}</p>

                    <div class="flex items-center mb-10">
                        <label for="quantity" class="mr-5 font-medium text-gray-600">Price:</label>
                        <p class="text-xl font-bold"> {{ product.price }} PLN</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center mb-10">
                        <label for="quantity" class="mr-10 font-bold text-gray-600">Quantity:</label>
                        <input v-model="setQuantity" type="number" min="1" class="text-center w-full border rounded-md">
                    </div>
                    <AddToCartBtn  :product="product" :quantity="setQuantity" />
                </div>
            </div>
        </div>
        <!-- {{ product }} -->
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ProductCard from '@/Components/App/ProductCard.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import AddToCartBtn from '@/Components/App/AddToCartBtn.vue';

const props = defineProps({
    product: Object,
    photos: Object
})

const setQuantity = ref(1)
const mainPhoto = ref(props.photos[0])


function changeMainPhoto(photo) {
    mainPhoto.value = photo;
}







</script>