<template>
    <AdminLayout>
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
                    <tr v-for="(order, index) in orders" 
                        @dblclick="showUserLogs(user.id)"
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
        <!-- {{users.data}} -->
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    orders: Object,
})

function calculatePrice(detalsOrder) {

    console.log(detalsOrder)
    let sum = 0;

    for(const detal of detalsOrder) {
        console.log(detal.product_id)
    }

    return 

}
</script>




<style scoped></style>
