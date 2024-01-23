<template>
    <AdminLayout>
        <nav class="flex items-center justify-between p-1 bm-3">
            
        </nav>
       
        <div class="mx-8  ">
            <h2 class="text-2xl font-bold">Dashboard</h2>
            <div class="grid grid-cols-5 gap-5 h-32">
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Logged in users now</h4>
                    <p class="m-3 text-2xl font-bold">{{loggedInUsers}}</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Registered users</h4>
                    <p class="m-3 text-2xl font-bold">{{registeredUsers}}</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Active products</h4>
                    <p class="m-3 text-2xl font-bold">{{activeProducts}}</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Paid orders</h4>
                    <p class="m-3 text-2xl font-bold">{{paidOrders}}</p>
                </div>
                <div class=" flex flex-col justify-center items-center bg-gray-100 rounded-xl">
                    <h4 class="font-bold">Total Income</h4>
                    <p class="m-3 text-2xl font-bold">PLN {{ totalIncome }}</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-5 h-fit my-5">
                <div class="col-span-2 row-span-2 p-5 rounded-xl bg-gray-100">
                    <h4 class="text-lg font-bold">Latest orders</h4>
                    <div v-for="order of latestOrders" class="p-3 border-b">
                        <div class="flex">
                            <p class=" mr-2 font-bold text-blue-700">Order #{{ order.id }} </p> 
                            <p>{{order.latest}}, {{order.detals_order.length}} items</p>
                        </div>
                        <div class="flex justify-between">
                            <p>{{ order.user.firstname }} {{ order.user.lastname }}</p>
                            <p>PLN {{ order.amount_paid }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center p-2 pt-5 bg-gray-100 rounded-xl">
                    <h4 class="text-lg font-bold">Orders by categories</h4>
                    <BarChart :chartData="data"/>
                </div>
                <div class="flex flex-col items-center p-2 pt-5 bg-gray-100 rounded-xl">
                    <h4 class="text-lg font-bold">Latest Customers</h4>
                   <div v-for="user of latestUsers" class="flex justify-between w-full">
                    <p>{{ user.firstname }} {{ user.lastname }}</p>
                    <p>{{user.lastTime}}</p>
                   </div>
                </div>
                
            </div>
            
        </div>
        <div >
            
        </div>


    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import BarChart from '@/Components/App/BarChart.vue'
import { ref } from 'vue';

import { onBeforeMount } from 'vue';

const props = defineProps({
    loggedInUsers: Number,
    registeredUsers: Number,
    activeProducts: Number,
    paidOrders: Number,
    totalIncome: Number,
    mostPopularCategory: Object,
    latestUsers: Object,
    latestOrders: Object
})

const data = ref({})

const setdata = () => {
    const category = []
    const categoryCount = []
    
    for(const key in props.mostPopularCategory){
        const value = props.mostPopularCategory[key]
        category.push(key)
        categoryCount.push(value)
    }

    data.value = {
    labels: category, 
    datasets: [ { data: categoryCount }]
    }
}

onBeforeMount(() => {
    setdata();
})

</script>




<style scoped></style>
