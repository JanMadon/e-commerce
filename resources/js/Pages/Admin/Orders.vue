<template>
    <AdminLayout>
        <nav class="flex items-center justify-between bg-slate-100 mb-3 text-gray-600">
            <SearchFrom />
            <PaginateSelector/>
            <div class="px-10">
                <input type="checkbox" v-model="showOnlyAccepted">
                Only accepted
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  text-center" :class="order.status == 'accepted' ? 'text-green-600' : 'text-gray-900',
                            order.status == 'rejected' ? 'text-red-600' : 'text-gray-900'">
                            {{ order.status }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 text-center ">
                            <SecondaryButton @click="(event) => select(event, order)" class="scale-75">more
                            </SecondaryButton>
                            <PrimaryButton v-show="order.status == 'accepted'" class="scale-75">sent</PrimaryButton>
                            <DangerButton v-show="order.status == 'accepted'" class="px-4 py-2 scale-75">cancel
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
import { ref } from 'vue';
import { computed } from 'vue';


const props = defineProps({
    orders: Object,
})

const showDetals = ref(false)
const selectedOrder = ref()
const showOnlyAccepted = ref(true);

const showOlders = computed(() => {
    if (showOnlyAccepted.value) {
        return props.orders.data.filter(order => order.status === 'accepted');
    } else {
        return props.orders.data;
    }
})

function select(event, order) {
    selectedOrder.value = order
    showDetals.value = true
}


</script>
