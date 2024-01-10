
<template>
    <AdminLayout>

        <div class="flex flex-col items-center mt-3 mx-auto ">
            <div class="flex w-2/3 p-2">
                <h2 class="text-2xl font-bold text-left">Your Catr Items</h2>
            </div>
            <div v-for="(product, index) in products" class="flex justify-between  w-2/3 h-2/3 mx-5 p-5
            bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <div class="flex">
                    <div
                        class="w-[80px] h-[80px] mx-3 bg-gray-200 rounded-lg cursor-pointer overflow-hidden   hover:brightness-75 transition duration-300">
                        <img :src="'data:image/pag;base64,' + product.photo" alt="next-photo"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col justify-between">
                        <h3 class="text-lg font-bold">{{ product.name }}</h3>
                        <p class="text-xs">Price per item: {{ product.price }} PLN</p>
                        <div class="flex items-end">
                            <label for="quantityfor" class="mr-1 text-sm text-gray-600">Quantity:</label>
                            <input :value="product.quantity" @input="event => updateTotalPrice(event, index)" type="number"
                                min="1" class="text-center w-16 border rounded-sm h-7">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-between items-end">
                    <!-- <p class="text-lg font-bold "> {{product.price * setQuantity[0][index].quantity}} PLN</p> -->
                    <p class="text-lg font-bold "> {{ product.quantity * product.price }} PLN</p>
                    <div>
                    </div>
                    <DangerButton @click.prevent="deleteProduct(product)" class="px-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </DangerButton>
                </div>

            </div>
            <div class="flex justify-between  w-2/3 h-2/3 mx-5 p-5
            bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <div>
                    <p class="font-bold">Total price:</p>
                    <div class="mt-5 text-sm text-center font-bold">Shipping
                        <div class="flex text-xs gap-4 font-normal">
                            <p>price: {{ shipingPrice[shipingMethod] ?? 'select option' }}</p>
                            <p class="cursor-pointer text-blue-600"> detals </p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-lg">PLN {{ tatalPrice }} </p>
                    <select v-model="shipingMethod" name="" id="" class="py-1 text-sm rounded">
                        <option v-if="cenSelectFreeSheping" value="lockerFree">Parcel locker - PLN {{
                            shipingPrice.lockerFree }}</option>
                        <option v-else value="locker">Parcel locker - PLN {{ shipingPrice.locker }}</option>
                        <option value="curier"> Courier delivery - PLN {{ shipingPrice.curier }}</option>
                        <option value="self"> Self pickup - PLN {{ shipingPrice.self }}</option>
                        <option value="dsf"> Please choose a shiping option</option>
                    </select>
                    <div @click="() => showModal = true" class="cursor-pointer mt-3">
                        <p class="text-xs text-green-700">You can choose free parcel locker shipping!</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-between  w-2/3 h-2/3  p-2
            bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <p v-if="showError" class="text-center w-full text-red-600">Please provide correct quantyti!</p>
                <PrimaryButton v-else
                    class=" flex justify-center w-full bg-orange-400 hover:bg-orange-600 focus:bg-orange-600"
                    @click.prevent="payOrder">
                    Proceed to Checkout
                </PrimaryButton>
            </div>
        </div>
        <WarehouseAddressModal :typeModal="shipingMethod" />
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ProductCard from '@/Components/App/ProductCard.vue';
import { Head, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ref } from 'vue';
import AddToCartBtn from '@/Components/App/AddToCartBtn.vue';
import { watch } from 'vue';
import { watchEffect } from 'vue';
import { computed } from 'vue';
import WarehouseAddressModal from '@/Components/App/WarehouseAddressModal.vue';

const props = defineProps({
    products: Object,
    order: Object
})
const tatalPrice = ref(0);
const showError = ref(false);
const cenSelectFreeSheping = ref(false)
const showModalType = ref(false);
const shipingMethod = ref('');
const shipingPrice = ref({
    lockerFree: 0,
    locker: 10,
    curier: 20,
    self: 0,
});
const typeModal = ref({
    lockerFree: 'locker',
    locker: 'locker',
    curier: 'address',
    self: 'warehouse',
})

const address = ref();
const lockerAddress = ref() 

watch(shipingMethod, showModal)
function showModal() {
}

function setLockerAddress() {

}

function setAddress() {

}



function calculate() {
    tatalPrice.value = 0
    for (const product of props.products) {
        if (product.quantity <= 0) {
            showError.value = true;
            break
        } else {
            showError.value = false;
        }
        tatalPrice.value += (product.quantity * product.price)
        cenSelectFreeSheping.value = tatalPrice.value > 500;
    }
}
calculate()

function updateTotalPrice(event, index) {
    props.products[index].quantity = parseInt(event.target.value)
    calculate()
    updatCart(index)
}

function deleteProduct(product) {
    router.delete(route('cart.deleteProduct', { productId: product.id }))
}

function updatCart(index) {

    router.patch(route('cart.updateOrder'), props.products[index])
}

function payOrder() {

    router.post(route('cart.makeOrder'), { data: props.order })
}





</script>