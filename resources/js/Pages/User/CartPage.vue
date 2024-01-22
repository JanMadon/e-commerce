
<template>
    <GuestUserLayout>
        <div v-if="!order.detals_order" class="flex flex-col items-center mt-3 mx-auto ">
            <div class="flex w-2/3 p-2">
                <h2 class="text-2xl font-bold text-left">Your Catr Items</h2>
            </div>
            <div class="flex justify-between  w-2/3 h-2/3  p-2
            bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <p class="text-center w-full text-gray-900">You don't have any items in cart</p>
            </div>
        </div>
        
     
        <div v-else class="flex flex-col items-center mt-3 mx-auto ">
            <div class="flex w-2/3 p-2">
                <h2 class="text-2xl font-bold text-left">Your Catr Items</h2>
            </div>
            <div v-for="(detalOrder, index) in order.detals_order" class="flex justify-between  w-2/3 h-2/3 mx-5 p-5
            bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <div class="flex">
                    <div
                        class="w-[80px] h-[80px] mx-3 bg-gray-200 rounded-lg cursor-pointer overflow-hidden   hover:brightness-75 transition duration-300">
                        <img :src="'data:image/pag;base64,' + detalOrder.product.photo" alt="next-photo"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col justify-between">
                        <h3 class="text-lg font-bold">{{ detalOrder.product.name }}</h3>
                        <p class="text-xs">Price per item: PLN {{ detalOrder.product.price }} </p>
                        <div class="flex items-end">
                            <label for="quantityfor" class="mr-1 text-sm text-gray-600">Quantity:</label>
                            <input :value="detalOrder.quantity" @input="event => updateTotalPrice(event, index)" type="number"
                                min="1" class="text-center w-16 border rounded-sm h-7">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-between items-end">
                    <p class="text-lg font-bold "> {{ detalOrder.quantity * detalOrder.product.price }} PLN</p>
                    <div>
                    </div>
                    <DangerButton @click.prevent="deleteDetal(detalOrder.id, index)" class="px-0">
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
                            <p @click="() => showModalToogle = !showModalToogle" class="cursor-pointer text-blue-600">
                                detals delivery
                            </p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-bold text-lg">PLN {{ parseInt(tatalPrice) }} </p>
                    <select v-model="shipingMethod" name="" id="" class="py-1 text-sm rounded">
                        <option v-if="cenSelectFreeSheping" value="lockerFree">Parcel locker - PLN {{
                            shipingPrice.lockerFree }}</option>
                        <option v-else value="locker">Parcel locker - PLN {{ shipingPrice.locker }}</option>
                        <option value="curier"> Courier delivery - PLN {{ shipingPrice.curier }}</option>
                        <option value="self"> Self pickup - PLN {{ shipingPrice.self }}</option>
                        <option value="-"> Please choose a shiping option</option>
                    </select>
                    <div @click="() => showModal = true" class="cursor-pointer mt-3">
                        <p class="text-xs text-green-700">You can choose free parcel locker shipping!</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center  w-2/3 h-2/3  p-2
            bg-gray-100 border border-gray-300 rounded-xl shadow-2xl">
                <p v-if="showError" class="text-center w-full text-red-600">Please provide correct quantyti!</p>
                <PrimaryButton v-else class=" justify-center w-1/2 bg-orange-400 hover:bg-orange-600 focus:bg-orange-600"
                    @click.prevent="pay">
                    Proceed to Checkout
                </PrimaryButton>
            </div>
        </div>

        <WarehouseAddressModal :typeModal="shipingMethod" :showModalAgain="showModalToogle" />
        <Modal :show="payModal">
            <div class="bg-white p-10 rounded-md shadow-md">
                <div class="flex items-center justify-center mb-4">
                    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
                </div>
                <p class="m-10 text-center">You will be redirected to the payment page...</p>
            </div>
        </Modal>
        <Modal :show="errModal" @close="() => errModal = false">
            <div class="bg-white p-10 rounded-md shadow-md">
                <div class="flex items-center justify-center mb-4">
                    <div class="error ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
                </div>
                <p class="m-10 text-center">Something went wrong, please try again later.</p>
            </div>
        </Modal>
    </GuestUserLayout>
</template>

<script setup>
import GuestUserLayout from '@/Layouts/GuestUserLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import WarehouseAddressModal from '@/Components/App/WarehouseAddressModal.vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { ref, watch, onMounted} from 'vue';
import {showSuccessNotification, showErrorNotification} from '@/event-bus'



const props = defineProps({
    order: Object,
})
const tatalPrice = ref();
const showError = ref(false);
const cenSelectFreeSheping = ref(false)
const shipingMethod = ref('-');
const showModalToogle = ref(false);
const payModal = ref(false);
const errModal = ref(false);

const shipingPrice = ref({
    lockerFree: 0,
    locker: 10,
    curier: 20,
    self: 0,
    '-': 0
})


function pay() {
    if (shipingMethod.value === '-') {
            showErrorNotification(`Please select your shipping method.`)
        return
    }
    payModal.value = true;
    axios.post(route('cart.payOrder'), { data: props.order })
        .then(response => window.location.href = response.data.paymentPage)
        .catch(error => {
            payModal.value = false;
            errModal.value = true
            console.log(error)
        });
}

function setLockerAddress() {

}

watch(shipingMethod, () => {
    updatCart();
    calculate();
})

function updateTotalPrice(event, index) {
    props.order.detals_order[index].quantity = parseInt(event.target.value)
    updatCart(index)
    calculate()
}

function deleteDetal(detalId, index) {
    console.log(detalId, index)
    axios.delete(route('cart.deleteProduct', {detalId: detalId}))
        .then(response => {
            console.log(response)
            if (response.data.detalId == detalId) {
                props.order.detals_order.splice(index, 1)
                if(response.data.countDetal === 1){
                    props.order.detals_order = null
                }
            }
            showSuccessNotification(`Product removed from cart.`)
            calculate()
        })
        .catch(error => {
            showErrorNotification(`Something went wrong, please try again.`)
        })
    }
    
    function updatCart(index) {
        const detal = props.order.detals_order[index]
        if(detal){
            router.patch(route('cart.updateOrder'), {
                productId: detal.product.id,
                quantity: detal.quantity,
                shipingMethod: shipingMethod.value
            },{
                onSuccess: () => {
                    showSuccessNotification(`The number of products in the cart has been increased.`)   
                },
                onError: () => {
                    showErrorNotification(`Something went wrong, please try again later.`)
                }
            })
    } else {
        router.patch(route('cart.setShipmentMethod'), {
            shipingMethod: shipingMethod.value
        },{
            onSuccess: () => {
                    showSuccessNotification(`Selected shipping method: ${shipingMethod.value}`)   
                },
            onError: () => {
                showErrorNotification(`Something went wrong, please try again later.`)
            }
        })
    }
}

const calculate = () => {
    tatalPrice.value = 0
    for (const product of props.order.detals_order) {
        if (product.quantity <= 0) {
            showError.value = true;
            break
        } else {
            showError.value = false;
        }
        tatalPrice.value += (product.quantity * product.product.price)
        cenSelectFreeSheping.value = tatalPrice.value > 500;
    }
    if (typeof parseInt(shipingPrice.value[shipingMethod.value]) === "number") {
        tatalPrice.value += parseInt(shipingPrice.value[shipingMethod.value])
    }
}

onMounted(() => {
    if(props.order.hasOwnProperty('detals_order'))
        calculate()
})

</script>

<style>
/* Animacja ładowania */
@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.loader {
    border-top-color: #3498db;
    animation: spin 1s infinite linear;
}

.error {
    border-top-color: #d43128;
    animation: spin-reverse 1s infinite linear;
}
</style>