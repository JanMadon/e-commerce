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
                            ID
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Login
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Firstname
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Lastname
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Email
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-left">
                            Phone
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-center">
                            Address
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) of users.data" 
                        @dblclick="showUserLogs(user.id)"
                        class="bg-white border-b transition duration-300 ease-in-out hover:bg-blue-100 cursor-pointer">

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ user.id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ user.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ user.firstname }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ user.lastname }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ user.phone }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                           {{  }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            
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
    users: Object,
})

const onlyActive = ref(true)

function redirectToUserBill(id) {
    router.visit(route('user.bill', id));
}

function redirectToUserEdit(id) {
    router.visit(route('user.edit', id));
}

function showUserLogs(id) {
    router.get(route('user.logs', id));
}

function createNewUser() {
    console.log('create new user')
    router.get(route('user.create'));
}


</script>




<style scoped></style>
