
<template>
    <AdminLayout>

        <nav class="flex items-center justify-between bg-slate-100 mb-3 text-gray-600">
            <SearchFrom :placeholder="'Search product by name'" />
            <PaginateSelector/>
            <div class="pl-10 w-48">
                <button @click="() => i++">
                    Show {{ showOption }}
                </button>
            </div>
        </nav>

        <div class="flex flex-col items-center" >
            <div v-for="(product, index) in productsToShow" :class=" product.status == 'deleted' ? 'brightness-50' : '' "
            class="flex justify-between  w-2/3 h-2/3 m-2 p-5
            bg-gray-100 border border-gray-300 shadow-2xl">
                <div class="flex">
                    <div class="w-[90px] h-[90px] mx-3 bg-gray-200 overflow-hidden">
                        <img :src="'data:image/pag;base64,' + product.photo" alt="next-photo"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col ml-5">
                        <p>Name: {{ product.name }}</p>
                        <p>Status: {{ product.status }}</p>
                        <p>Price PLN: {{ product.price }}</p>
                    </div>
                    <div class="flex flex-col ml-10">
                        <p>created at: {{ product.created_at ? product.created_at.slice(0, 10) : '' }}</p>
                        <p>In stock: {{ product.quantity }}</p>
                        <p>Pieces sold:</p>
                    </div>
                </div>
                <div v-if="product.status !== 'deleted'" class="flex flex-col justify-between items-end">
                    <div>
                         <svg v-if="product.status === 'active'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </div>
                    <div class="flex">
                        <PrimaryButton @click="() => stock(product)">
                            stock
                        </PrimaryButton>
                        <SecondaryButton v-if="product.status === 'active'" 
                        @click="() => status(product, 'hidden')" class="mx-2">
                            hide
                        </SecondaryButton>
                        <SecondaryButton v-else @click="() => status(product, 'active')" class="mx-2">
                            activ
                        </SecondaryButton>
                        <DangerButton @click="() => status(product, 'deleted')" class=" px-5 py-2">
                            trash
                        </DangerButton>
                    </div>
                </div>
                <div v-else>
                    <DangerButton @click="() => status(product, 'hidden')" class="bg-gray-500 px-5 py-2">
                            re-trash
                    </DangerButton>
                </div>
            </div>
        </div>

        <Paginator v-if="products.last_page > 1" :items="products.links"/>

        <Modal :show="showModal">
            <div class="flex text-xl">
                <div class="flex flex-col ml-10 w-1/2">
                    <div class="my-2">
                        <p class="font-bold">Name: </p>
                        <p>{{ selectedProduct.name }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Description: </p>
                        <p>{{ selectedProduct.description }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Status: </p>
                        <p>{{ selectedProduct.status }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Price PLN: </p>
                        <p>{{ selectedProduct.price }}</p>
                    </div>
                </div>
                <div class="flex flex-col ml-16">
                    <div class="my-2">
                        <p class="font-bold">Created at: </p>
                        <p>{{selectedProduct.created_at ? selectedProduct.created_at.slice(0,10) : 'unknow'}}</p>
                        <p>{{selectedProduct.created_at ? selectedProduct.created_at.slice(11,19) : 'unknow'}}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Updated at: </p>
                        <p>{{selectedProduct.updated_at ? selectedProduct.updated_at.slice(0,10)  : 'unknow'}}</p>
                        <p>{{selectedProduct.updated_at ? selectedProduct.updated_at.slice(11,19) : 'unknow' }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">Pieces sold: </p>
                        <p>{{ selectedProduct.sold ?? 0 }}</p>
                    </div>
                    <div class="my-2">
                        <p class="font-bold">In stock: </p>
                        <p>{{ selectedProduct.quantity }}</p>
                    </div>
                </div>
            </div>
            <label class="ml-28"  for="">Change quantity in stock</label>
            <div class="flex">
                <input v-model="toUpdate" product min="1" class="ml-16 h-8 text-center">
                <div class="flex justify-between mb-4 px-5 w-full ">
                    <PrimaryButton @click="updateStock('quantity')">
                        change
                    </PrimaryButton>
                    <SecondaryButton @click="closeModal">
                        close
                    </SecondaryButton>
                </div>
            </div>
        </Modal>

    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Paginator from '@/Components/App/Paginator.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import SearchFrom from '@/Components/App/SearchFrom.vue';
import PaginateSelector from '@/Components/App/PaginateSelector.vue';
import axios from 'axios';
import { ref, computed } from 'vue';
import { showSuccessNotification, showErrorNotification } from '@/event-bus';

const props = defineProps({
    products: Object,
})

const showModal = ref(false)
const selectedProduct = ref()
const toUpdate = ref()
const show = ref(['all','active', 'hidden', 'deleted'])
let i = ref(0)

const showOption = computed(()=>{
    show.value[i.value] ? '' : i.value = 0    
    return show.value[i.value]
})

const productsToShow = computed(() => {
    if (showOption.value === 'active') {
        return props.products.data.filter(product => product.status === 'active');
    } else if(showOption.value === 'hidden') {
        return props.products.data.filter(product => product.status === 'hidden');
    } else if(showOption.value === 'deleted') {
        return props.products.data.filter(product => product.status === 'deleted');
    } else {
        return props.products.data.filter(product => product.status !== 'deleted');
    }
})

const status = (product, toValue) => {
    selectedProduct.value = product
    toUpdate.value = toValue
    updateStock('status')
}

const stock = product => {
    selectedProduct.value = product
    toUpdate.value = product.quantity
    showModal.value = true
}

const closeModal = () => {
    showModal.value = false
    selectedProduct.value = null
    toUpdate.value = 0
}

const updateStock = (type) => {
    axios.patch(route('product.update', selectedProduct.value.id), 
    {
        'type': type,
        'newValue': toUpdate.value
    }).then((respone)=>{
        updateProps(selectedProduct.value.id, type, toUpdate.value)
        showSuccessNotification(`The ${selectedProduct.value.name} product, field ${type} has been updated to ${toUpdate.value}`);
        closeModal()
    }).catch((error)=>{
        showErrorNotification(`Something went wrong, please try again later.`)
    })
}

const updateProps = (productId, type, newValue) => {
    for(const product of props.products.data){
        if(product.id == productId) {
            product[type] = newValue
            console.log(product[type])
        }
    }
}

</script>