<template>
    <AdminLayout>
        <template #header>
            <h1 class="font-semibold text-2xl text-gray-800 leading-tight">Employees list</h1>
        </template>
        <nav class="flex items-center justify-between p-1 bm-3">

        </nav>
        <div class="flex justify-center overflow-auto">
            <table class="bg-gray-200 rounded overflow-hidden">
                <thead class="bg-gray-200 font-bold">
                    <tr>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Order number
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Date
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Final price
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Payment
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Status
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Invoice
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-center">
                            Options
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in orders" @click="() => {
                            
                        return showDetals = true}"
                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-blue-100 cursor-pointer">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ order.id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ order.payd_at }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ calculatePrice(order.detals_order) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            method
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ order.status }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            ---------
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 ">
                            <a class="text-blue-500" href="">datails</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Modal :show="showDetals" @close="() => showDetals = false">
            <div class="min-h-[70vh] flex flex-col justify-between ">
                <div class="mt-5 ml-5 font-bold ">
                    <p>Order by: {{ $page.props.auth.user.name }}</p>
                    <p>Date: </p>
                   <p>Order number: {{  }} </p>
                </div>
                <table class="w-full border bg-gray-100 rounded overflow-hidden">
                    <thead class="bg-gray-100 font-bold">
                        <tr>
                            <th class="text-gray-900 px-1 p-3 text-center">
                                Products
                            </th>
                            <th class="text-gray-900 px-1 p-3 text-center">
                                Quantity
                            </th>
                            <th class="text-gray-900 px-1 p-3 text-center">
                                Unit price
                            </th>
                            <th class="text-gray-900 px-1 p-3 text-center">
                                Final price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(order, index) in orders" @click="() => showDetals = true"
                            class="bg-white border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 text-center">
                                {{ order.id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 text-center ">
                                {{ order.payd_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 text-center ">
                                {{ calculatePrice(order.detals_order) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 text-center ">
                                method
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex flex-col items-end mt-5 ml-5 font-bold">
                    <p>Total price: {{  }}</p>
                    <p>Shipment: {{  }}</p>
                    <p>To address {{  }}</p>
                </div>
                <div>

                </div>
            </div>
        </Modal>

    </AdminLayout>
</template>

<script setup>
import Modal from '@/Components/Modal.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    orders: Object,
})

const showDetals = ref(false)

function close() {
    console.log('close')
}

function calculatePrice(detalsOrder) {

    let sumPriceOrder = 0;
    for (const detal of detalsOrder) {
        sumPriceOrder += detal.product.price
    }
    return sumPriceOrder
}
</script>




<style scoped></style>
