<template>
    <AdminLayout>
        <nav class="flex items-center justify-between bg-slate-100 mb-3 text-gray-600">
            <SearchFrom :placeholder="'Search user by login or email'"/>
            <PaginateSelector/>
            <div class="px-10">
                <input type="checkbox" v-model="showOnlyActive">
                Only active
            </div>
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
                        <th class="text-gray-900 px-6 py-4 text-center">
                            Level
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-center">
                            Status
                        </th>
                        <th class="text-gray-900 px-6 py-4 text-center">
                            Options
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) of showActive" 
                        @dblclick="userInfo(user.id)"
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
                            {{ user.level }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            {{ user.status }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                            <SecondaryButton v-if="user.status === 'active'" 
                                @click="changeStatus(user.id, 'status', 'notActive')" class="scale-75">
                                deactivate
                            </SecondaryButton>
                            <SecondaryButton v-else @click="changeStatus(user.id, 'status', 'active')" class="scale-75">
                                activist
                            </SecondaryButton>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Paginator v-if="users.last_page > 1" :items="users.links"/>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Paginator from '@/Components/App/Paginator.vue';
import SearchFrom from '@/Components/App/SearchFrom.vue';
import PaginateSelector from '@/Components/App/PaginateSelector.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { showSuccessNotification, showErrorNotification} from '@/event-bus';


const props = defineProps({
    users: Object,
})

const showOnlyActive = ref(true)

const showActive = computed(() => {
    if (showOnlyActive.value) {
        return props.users.data.filter(order => order.status === 'active');
    } else {
        return props.users.data;
    }
})

const userInfo = (id) => {
    console.log('id')
    router.get(route('admin.userInfo', id));
}

const changeStatus = (userID, field, newValue) => {
    router.patch(route('admin.userInfo', userID), {
        'field': field,
        'newValue': newValue
    },{
        onSuccess: () => {
            showSuccessNotification('The user status change was successful')
        },
        onError: () => {
            showErrorNotification('user status change failed')
        }
    })
}





</script>

<style scoped></style>
