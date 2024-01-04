<template>
    <AdminLayout>

        <div class="max-w-4xl mx-auto my-5 bg-gray-100 dark:bg-gray-600 rounded-xl p-6 shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Add product</h2>
            <!-- <form action="/text" method="post"> -->
            <form @submit.prevent="addProduct">
                <div class="flex justify-evenly">
                    <div class="min-w-80">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-600">Name:</label>
                            <input type="text" v-model="form.name" class="mt-1 p-2 w-full border rounded-md" placeholder="
Enter the name of the advertisement." required>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-600">Category:</label>
                            <select v-model="form.category" class="mt-1 p-2 w-full border rounded-md" required>
                                <option disabled value="">Please select category</option>
                                <option>PC</option>
                                <option>Laptops</option>
                                <option>Smartphones</option>
                                <option>Tablets</option>
                                <option>Watchs</option>
                                <option>Others</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-600">Avaiable quantity</label>
                            <input type="number" v-model="form.quantity" min="0" class="mt-1 p-2 w-full border rounded-md" placeholder="Wprować dostępną ilość produktów."
                                required>
                            <p class="text-red-600">{{ isCorectQuantity ? '' : 'Please provide correct quantyti!' }}</p>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-600">Price (PLN)</label>
                            <input type="number" v-model="form.price" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter price." required>
                            <p class="text-red-600">{{ isCorectPrice ? '' : 'Please provide correct price!' }}</p>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                            <textarea v-model="form.description" rows="4" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter destription of the product."
                                required></textarea>
                        </div>
                    </div>
                    <div class="min-w-80">
                        <h3 class="text-xl">Photos</h3>
                        <div class="flex justify-evenly py-5 border border-gray-300 drak:border-gray-600 rounded-xl">
                            <div class="flex flex-col gap-10">
                                <label for="photo1"
                                    class="p-10 bg-gray-200 border border-white rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />

                                    </svg>
                                    <input type="file" id="photo1" @change="onFileChnge" accept="image/png, image/jpeg"
                                        hidden>
                                </label>
                                <label for="photo2"
                                    class="p-10 bg-gray-200 border border-white rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />

                                    </svg>
                                    <input type="file" id="photo2" @change="onFileChnge" accept="image/png, image/jpeg"
                                        hidden>
                                </label>
                                <label for="photo3"
                                    class="p-10 bg-gray-200 border border-white rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />

                                    </svg>
                                    <input type="file" id="photo3" accept="image/png, image/jpeg" hidden>
                                </label>
                            </div>
                            <div class="flex flex-col gap-10">
                                <label for="photo4"
                                    class="p-10 bg-gray-200 border border-white rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />

                                    </svg>
                                    <input type="file" id="photo4" accept="image/png, image/jpeg" hidden>
                                </label>
                                <label for="photo5"
                                    class="p-10 bg-gray-200 border border-white rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />

                                    </svg>
                                    <input type="file" id="photo5" accept="image/png, image/jpeg" hidden>
                                </label>
                                <label for="photo6"
                                    class="p-10 bg-gray-200 border border-white rounded-lg cursor-pointer hover:bg-gray-300 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />

                                    </svg>
                                    <input type="file" id="photo6" accept="image/png, image/jpeg" hidden>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <DangerButton @click.prevent="cancel">cancel</DangerButton>
                    <!-- <DangerButton @click.prevent="">test API</DangerButton> -->
                    <PrimaryButton>add product</PrimaryButton>
                </div>


            </form>

        </div>




    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { router, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ref } from 'vue';
import { watchEffect } from 'vue';
import { watch } from 'vue';

const form = useForm({
    name: '',
    category: '',
    quantity: '',
    price: '',
    description: '',
    photos: [],
})

let isCorectPrice = ref(true);
let isCorectQuantity = ref(true);

// function api() {
//     const formData = new FormData()
//     formData.append('files', form.photos)

//     fetch('http://localhost/api/save-photo', {
//         method: 'POST',
//         body: formData
//     }).then(respons => {
//         if(!respons.ok){
//             throw new Error('response is not ok')
//         }
//         return respons.text()
//     })
//     .then(data => {
//         console.log(data);

//     }).catch(error => {
//         console.error(error)
//     })
// }

function uploadPhoto() {

    const formData = new FormData();
    formData.append('photo', form.photos);

    router.post(route('uplodad.photo'), formData
         ).then(respone => {
            console.log(respone.data);
         })
}

watch(form.photos, uploadPhoto);

watchEffect(() => {
    let decimal = form.price.toString().split(/[.,]/)
    if ((decimal.length > 1 && decimal[1].length > 2) || decimal.length > 2) {
        isCorectPrice.value = false
    } else {
        isCorectPrice.value = true
    }

    isCorectQuantity.value = form.quantity < 0 ? false : true



})

function cancel() {
    console.log('wyczyść form i cofij');
    //router.get(route('do dodania'));
}

function addProduct() {
    form.post(route('create.add.product'));
}

const onFileChnge = (e) => {
    form.photos.push(e.target.files)
}




</script>