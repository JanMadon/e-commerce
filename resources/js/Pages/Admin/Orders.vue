<template>
    <AdminLayout>
        <nav class="flex items-center justify-between bg-slate-100 mb-3 text-gray-600">
            <SearchFrom :placeholder="'Search user by login'" />
            <PaginateSelector />
            <div class="px-10">
                <select name="" id="" v-model="showOnly"
                    class="py-0 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">All</option>
                    <option value="accepted">Payment accepted</option>
                    <option value="rejected">Payment rejected</option>
                    <option value="waiting">Waiting to be sent</option>
                    <option value="sent">Orders shipped</option>
                    <option value="canceled">Orders canceled</option>
                </select>
            </div>
        </nav>

        <div class="flex justify-center overflow-auto">

            <table class="bg-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-gray-200 font-bold">
                    <tr>
                        <th class="text-gray-900 px-6 py-4 text-center w-12">
                            Order Id number
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Users
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
                    <tr v-for="(order, index) in showOlders" :id=index
                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                            {{ order.id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            <a :href="route('admin.userInfo', order.user.id)" class="text-blue-500">
                                {{ order.user.name }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{ order.payd_at }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{ order.amount_paid }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{ order.shiping_method }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  text-center" :class="order.payment == 'accepted' ? 'text-green-600' : 'text-gray-900',
                            order.payment == 'rejected' ? 'text-red-600' : 'text-gray-900'">
                            {{ order.payment }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center ">
                            {{ order.status }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 text-center ">
                            <SecondaryButton @click="(event) => select(event, order)" class="scale-75">more
                            </SecondaryButton>
                            <PrimaryButton v-show="order.payment === 'accepted' && order.status === 'waiting'"
                                @click="changeStatus(order.id, 'status', 'sent')" class="scale-75">
                                sent
                            </PrimaryButton>
                            <DangerButton v-show="order.payment === 'accepted' && order.status === 'waiting'"
                                @click="changeStatus(order.id, 'status', 'canceled')" class="px-4 py-2 scale-75">
                                cancel
                            </DangerButton>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <DetailsOrderModal :showModal="showDetals" :selectedOrder="selectedOrder" />
        <!-- {{ orders }} -->
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DetailsOrderModal from '@/Components/App/DetailsOrderModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SearchFrom from '@/Components/App/SearchFrom.vue';
import PaginateSelector from '@/Components/App/PaginateSelector.vue';
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import {showSuccessNotification, showErrorNotification} from '@/event-bus'


const props = defineProps({
    orders: Object,
})

const showDetals = ref(false)
const selectedOrder = ref()
const showOnly = ref('');

const showOlders = computed(() => {

    switch(showOnly.value){
        case 'accepted': 
            return props.orders.data.filter(order => order.payment === 'accepted');
        case 'rejected': 
            return props.orders.data.filter(order => order.payment === 'rejected');
        case 'waiting': 
            return props.orders.data.filter(order => order.status === 'waiting');
        case 'sent': 
            return props.orders.data.filter(order => order.status === 'sent');
        case 'canceled': 
            return props.orders.data.filter(order => order.status === 'canceled');
        default:
            return props.orders.data;

    }
})

function select(event, order) {
    selectedOrder.value = order
    showDetals.value = true
}

const changeStatus = (orderId, field, newValue) => {
    router.patch(route('orders.update.status', orderId), {
        'field': field,
        'newValue': newValue
    }, {
        onSuccess: () => {
            showSuccessNotification('The order status change was successful')
        },
        onError: () => {
            showErrorNotification('Order status change failed')
        }
    })
}


</script>
