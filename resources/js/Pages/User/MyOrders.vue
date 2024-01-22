<template>
    <GuestUserLayout>
        <template #header>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">Employees list</h1>
        </template>
        <nav class="flex items-center justify-between p-1 bm-3">

        </nav>

        <div class="flex justify-center overflow-auto">

            <table class="bg-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-gray-200 font-bold">
                    <tr>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            <p> Order Id number </p>
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Date of payment
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Amound paid
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Shiping Method
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Payment
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Status
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-center">
                            Options
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in orders.data" :id=index
                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ order.id }}
                        </td>
                        <td v-if="order.payd_at"
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{ order.payd_at }}
                        </td>
                        <td v-else class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 text-center
                        transition duration-900 ease-in-out hover:bg-gray-200 ">
                            <a :href="route('cart')"> pay now </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{ order.amount_paid }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{ order.shiping_method }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  text-center"
                            :class="order.payment == 'accepted' ? 'text-green-600': 'text-gray-900',
                            order.payment == 'rejected' ? 'text-red-600': 'text-gray-900'">
                            {{ order.payment }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{order.status}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 text-center ">
                            <a class="text-blue-500" @click="(event) => select(event, order)" >datails</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>        
        <DetailsOrderModal :showModal="showDetals" :selectedOrder="selectedOrder"/>
        <PaymentModal :modalCase="props.payment" />

    </GuestUserLayout>
</template>

<script setup>
import { ref } from 'vue';
import DetailsOrderModal from '@/Components/App/DetailsOrderModal.vue';
import PaymentModal from '@/Components/App/PaymentModal.vue'
import GuestUserLayout from '@/Layouts/GuestUserLayout.vue';


const props = defineProps({
    orders: Object,
    payment: String
})

const showDetals = ref(false)
const selectedOrder = ref()

function select(event, order) {
    selectedOrder.value = order
    showDetals.value = true
}

</script>

<style scoped>

</style>
