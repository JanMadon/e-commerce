<template>
    <div>
        <PrimaryButton class="btn-primary" @click="addToCart()">
            Add to Cart
        </PrimaryButton>
    </div>
</template>

<script setup>
import PrimaryButton from '../PrimaryButton.vue';
import { router } from '@inertiajs/vue3';
import {showSuccessNotification} from '@/event-bus.js';

const props = defineProps({
    product: Object,
    quantity: Number
})


function addToCart() {
   
   router.post(route('addToCart'), 
       { //data
           id: props.product.id,
           quantity: props.quantity
       },
       { // optins
           onSuccess: ()=> {
               showSuccessNotification(`The product:  <strong> ${props.product.name} </strong> has been added to the cart`)    
           } 
       }
   );
}

</script>