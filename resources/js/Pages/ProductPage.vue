
<template>
    <GuestUserLayout>

        <div class="flex justify-center mt-8 mx-auto ">
            <div
                class="flex flex-col items-center w-2/3 h-2/3 mx-5 p-5
             rounded-xl shadow-2xl bg-gray-100 border border-gray-300 text-gray-800 dark:bg-slate-600 dark:text-gray-100">
                <!-- Zdjęcie -->
                <img :src="'data:image/pag;base64,' + mainPhoto" alt="Product Image" class="w-2/3   h-96 m-10 object-cover">
                <!-- Przewijana lista -->
                <div class="overflow-y-auto">
                    <ul class="flex ">
                        <li v-for="photo in product.photos" @click="changeMainPhoto(photo)"
                            class="flex justify-center items-center w-[80px] h-[80px] mx-3 bg-gray-200 rounded-lg cursor-pointer overflow-hidden hover:brightness-75 transition duration-300">
                            <img :src="'data:image/pag;base64,' + photo" alt="next-photo"
                                class="w-full h-full object-cover">
                        </li>
                    </ul>
                </div>
            </div>
            <div
                class="flex flex-col justify-between w-60 right-column p-4 rounded-xl shadow-2xl bg-gray-100 border border-gray-300 text-gray-800 dark:bg-slate-600 dark:text-gray-100">
                <div>
                    <p class="mb-5  text-center  font-bold border-b border-gray-400">
                        {{ product.subcategory.category.name }} / {{ product.subcategory.name }}
                    </p>
                    <h2 class="text-xl font-bold mb-4">{{ product.name }}</h2>
                    <p class=" mb-10">{{ product.description }}</p>
                    <div class="flex items-center mb-10">
                        <label for="quantity" class="mr-5 font-medium">Price:</label>
                        <p class="text-xl font-bold">PLN {{ product.price }}</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center mb-10">
                        <label for="quantity" class="mr-10 font-bold">Quantity:</label>
                        <input v-model="setQuantity" type="number" min="1" class="text-center w-full border rounded-md">
                    </div>
                    <AddToCartBtn v-if="$page.props.auth.user" :product="product" :quantity="setQuantity" />
                    <PrimaryButton v-else @click.prevent="() => router.visit(route('login'))">
                        log in to add to cart
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </GuestUserLayout>
</template>

<script setup>
import GuestUserLayout from '@/Layouts/GuestUserLayout.vue'
import AddToCartBtn from '@/Components/App/AddToCartBtn.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
    photos: Object
})

const setQuantity = ref(1)
const mainPhoto = ref(props.product.photos[0])

function changeMainPhoto(photo) {
    mainPhoto.value = photo;
}

</script>