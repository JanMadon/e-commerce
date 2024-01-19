
<template>
    <Head title="Dashboard" />

    <AdminLayout>

        <div class="flex flex-col items-center border">
            <div v-for="(product, index) in products.data" class="flex justify-between  w-2/3 h-2/3 m-2 p-5
            bg-gray-100 border border-gray-300 shadow-2xl">
                <div class="flex">
                    <div class="w-[90px] h-[90px] mx-3 bg-gray-200 overflow-hidden">
                        <img :src="'data:image/pag;base64,' + product.photo" alt="next-photo"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col ml-5">
                        <p>Name: {{ product.name }}</p>
                        <p>Status: {{ product.status }}</p>
                        <p>Price PLN: {{ product.price }}</p>
                    </div>
                    <div class="flex flex-col ml-10">
                        <p>created at: {{ product.created_at.slice(0, 10) }}</p>
                        <p>In stock: {{ product.quantity }}</p>
                        <p>Pieces sold:</p>
                    </div>
                </div>
                <div class="flex flex-col-reverse justify-between items-end">

                    <div class="flex">
                        <PrimaryButton @click="() => stock(product)">
                            stock
                        </PrimaryButton>
                        <SecondaryButton @click="() => status(product, 'hidden')" class="mx-2">
                            hide
                        </SecondaryButton>
                        <DangerButton @click="() => status(product, 'deleted')" class=" px-5 py-2">
                            delete
                        </DangerButton>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="showModal">
            <div class="flex text-xl">
                <div class="flex flex-col ml-10 w-1/2">
                    <div class="my-2">
                        <p class="font-bold">Name: </p>
                        <p>{{ selectedProduct.name }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Description: </p>
                        <p>{{ selectedProduct.description }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Status: </p>
                        <p>{{ selectedProduct.status }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Price PLN: </p>
                        <p>{{ selectedProduct.price }}</p>
                    </div>
                </div>
                <div class="flex flex-col ml-16">
                    <div class="my-2">
                        <p class="font-bold">Created at: </p>
                        <p>{{ selectedProduct.created_at.slice(0,10) }}</p>
                        <p>{{ selectedProduct.created_at.slice(11,19) }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Updated at: </p>
                        <p>{{ selectedProduct.updated_at.slice(0,10) }}</p>
                        <p>{{ selectedProduct.updated_at.slice(11,19) }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Pieces sold: </p>
                        <p>{{ selectedProduct.sold ?? 0 }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">In stock: </p>
                        <p>{{ selectedProduct.quantity }}</p>
                    </div>
                </div>
            </div>
            <label class="ml-28"  for="">Change quantity in stock</label>
            <div class="flex">
                <input v-model="toUpdate" product min="1" class="ml-16 h-8 text-center">
                <div class="flex justify-between mb-4 px-5 w-full ">
                    <PrimaryButton @click="updateStock('quantity')">
                        change
                    </PrimaryButton>
                    <SecondaryButton @click="closeModal">
                        close
                    </SecondaryButton>
                </div>
            </div>
        </Modal>

    </AdminLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import axios from 'axios';
import { showSuccessNotification } from '@/event-bus';


const props = defineProps({
    products: Object,
})

const showModal = ref(false)
const selectedProduct = ref()
const toUpdate = ref()

const status = (product, toValue) => {
    selectedProduct.value = product
    toUpdate.value = toValue
    updateStock('status')
}

const stock = product => {
    selectedProduct.value = product
    toUpdate.value = product.quantity
    showModal.value = true
}

const closeModal = () => {
    showModal.value = false
    selectedProduct.value = null
    toUpdate.value = 0
}

const updateStock = (type) => {
    axios.patch(route('product.update', selectedProduct.value.id), 
    {
        'type': type,
        'newValue': toUpdate.value
    }).then((respone)=>{
        console.log(respone)
        closeModal()
        showSuccessNotification();
        //location.reload()
    }).catch((error)=>{
        console.log(error)
    })
}

// const updateStock = (type) => {
//     router.patch(route('product.update', selectedProduct.value.id), {
//         'type': type,
//         'newValue': toUpdate.value,
//     },{
//         onSuccess: () => {
//             closeModal()
//             console.log('success')
//         },
//         onError: (e)=> {
//             console.log(e)
//         }
        
//     })
// }

</script>