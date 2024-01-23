<template>
    <AdminLayout>
        <nav class="flex items-center justify-between p-1 bm-3">
            
        </nav>
       
        <div class="mx-8 border ">
            <h2 class="text-2xl font-bold">Dashboard</h2>
            <div class="grid grid-cols-5 gap-5 h-32">
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Logged in users now</h4>
                    <p class="m-3 text-2xl font-bold">2</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Registered users</h4>
                    <p class="m-3 text-2xl font-bold">10</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Active products</h4>
                    <p class="m-3 text-2xl font-bold">15</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Paid orders</h4>
                    <p class="m-3 text-2xl font-bold">3</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Total Income</h4>
                    <p class="m-3 text-2xl font-bold">PLN 158,33</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-5 h-80 mt-5">
                <div class="col-span-2 row-span-2 p-5 rounded-xl bg-gray-100">
                    <h4 class="text-lg font-bold">Latest orders</h4>
                    <div class="p-3 border-b">
                        <div class="flex">
                            <p class=" mr-2 font-bold text-blue-700">Order #1 </p> 
                            <p>created 2 weeks ago, 3 items</p>
                        </div>
                        <div class="flex justify-between">
                            <p>Marian Kowalski</p>
                            <p>PLN 350,37</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center pt-8 bg-gray-100 rounded-xl">
                    <h4 class="text-lg font-bold">Orders by categories</h4>
                    jakiś koło
                </div>
                <div class="flex flex-col items-center pt-8 bg-gray-100 rounded-xl">
                    <h4 class="text-lg font-bold">Latest Customers</h4>
                   info
                </div>
                
            </div>
            
        </div>


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




</script>




<style scoped></style>
