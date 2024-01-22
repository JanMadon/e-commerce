<template>
    <AdminLayout>
        <div class="flex justify-center overflow-auto">
            <div>
                <div class="m-5 p-5 w-60  bg-gray-100 border border-gray-300 shadow-2xl">
                    <h3 class="text-lg font-bold">Personal data</h3>
                    <div class="flex justify-between">
                        <p>User ID number: </p>
                        <p> {{ user.id }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Name: </p>
                        <p> {{ user.name }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Firstname:</p>
                        <p> {{ user.firstname }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Lastname: </p>
                        <p> {{ user.lastname }} </p>
                    </div>
                </div>
                <div class="m-5 p-5 w-60  bg-gray-100 border border-gray-300 shadow-2xl">
                    <h3 class="text-lg font-bold">Contact details</h3>
                    <div class="flex justify-between">
                        <p>Email: </p>
                        <p> {{ user.email }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Phone: </p>
                        <p> {{ user.address.phone }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Additional: </p>
                        <p> {{ }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="m-5 p-5 w-60  bg-gray-100 border border-gray-300 shadow-2xl">
                    <h3 class="text-lg font-bold">Address</h3>
                    <div class="flex justify-between">
                        <p>Building: </p>
                        <p> {{ user.address.building }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Street: </p>
                        <p> {{ user.address.street }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Zip-code: </p>
                        <p> {{ user.address.zipCode }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>City: </p>
                        <p> {{ user.address.city }}</p>
                    </div>
                </div>

                <div class="m-5 p-5 w-60  bg-gray-100 border border-gray-300 shadow-2xl">
                    <h3 class="text-lg font-bold">More info</h3>
                    <div class="flex justify-between">
                        <p>Number of orders: </p>
                        <p> {{ user.numOfOrder }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Last order: </p>
                        <p> {{ user.lastOrder.payd_at }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Joined: </p>
                        <p> {{ (user.created_at).slice(0, 10) }}</p>
                    </div>
                </div>
            </div>

        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref } from 'vue';

const props = defineProps({
    user: Object,
})

const showDetals = ref(false)
const selectedOrder = ref()


</script>
