<template>
    <AdminLayout>
        <nav class="flex items-center justify-end p-1 bm-3">
            <SecondaryButton v-if="showUsersRaport" @click.prevent="showUsersRaport = false">
                User raport
            </SecondaryButton>
            <SecondaryButton v-else @click.prevent="showUsersRaport = true">
                Order raport
            </SecondaryButton>
        </nav>
        <h3 class="ml-14 text-2xl font-bold">{{ showUsersRaport ? 'Order raport' : 'User raport' }} </h3>
        <div class="flex justify-center w-full">
            <div class="mt-3 w-[90%] ">
                <BarChart v-show="showUsersRaport" :chartData="dataOrders" :chartOptions="optionsOrders"
                    class=" p-10 bg-gray-100" />
                <BarChart v-show="!showUsersRaport" :chartData="dataUsers" :chartOptions="optionsUsers" class=" p-10 bg-gray-100" />
            </div>
        </div>

    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import BarChart from '@/Components/App/BarChart.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';

const props = defineProps({
    ordersDates: Object,
    usersData: Object
})

const showUsersRaport = ref(false);
const dataToOrders = [];
const dataToUsers = [];
const dataOrders = ref({});
const optionsOrders = ref({})
const dataUsers = ref({});
const optionsUsers = ref({})

const getDates = (count) => {
    const dates = []
    const today = new Date();
    for (let i = count; i >= 0; i--) {
        let pastDate = new Date();
        pastDate.setDate(today.getDate() - i)
        pastDate = pastDate.toISOString().slice(0, 10)
        dates.push(pastDate)

        if (props.ordersDates.hasOwnProperty(pastDate)) {
            dataToOrders.push(props.ordersDates[pastDate])
        } else {
            dataToOrders.push(0)
        }

        if (props.usersData.hasOwnProperty(pastDate)) {
            dataToUsers.push(props.usersData[pastDate])
        } else {
            dataToUsers.push(0)
        }
    }
    return dates
}

// Orders raport
dataOrders.value = {
    labels: getDates(30),
    datasets: [{

        label: 'Number of orders',
        data: dataToOrders
    }]
}

optionsOrders.value = {
    responsive: true,
    backgroundColor: ['rgb(60, 120, 50)'],
    scales: {
        y: {
            suggestedMin: 0,
            suggestedMax: Math.max(...dataToOrders) + 1,
            ticks: { stepSize: 1 }
        }
    },
    plugins: {
        title: {
            display: true,
            text: 'Number of orders completed in the last 30 days.',
            padding: { bottom: 5 },
        }
    }
}

// Users raport
dataUsers.value = {
    labels: getDates(30),
    datasets: [{

        label: 'Number of users',
        data: dataToUsers
    }]
}

optionsUsers.value = {
    responsive: true,
    backgroundColor: ['rgb(255, 99, 132)'],
    scales: {
        y: {
            suggestedMin: 0,
            suggestedMax: Math.max(...dataToUsers) + 1,
            ticks: { stepSize: 1 }
        }
    },
    plugins: {
        title: {
            display: true,
            text: 'Number of registered users in the last 30 days.',
            padding: { bottom: 5 },
        }
    }
}




</script>




<style scoped></style>
