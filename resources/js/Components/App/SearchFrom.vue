<template>
    <div class="px-10 w-1/3 h-[40px] flex items-center ">
        <TextInput type="text" 
                    class="block w-full h-2/3 mr-2" 
                    v-model="search" 
                    autocomplete 
                    @keyup.enter.prevent="onSearch"
                    placeholder="Search user" />
    </div>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import { emitter } from '@/event-bus';
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { ref } from 'vue';

// Uses:
let params = ''

// ref:
const search = ref('');

function onSearch() {
    
    params.set('search', search.value)
    router.get(window.location.pathname + '?' + params.toString())

    emitter.emit('ON_SEARCH', search.value)
}

onMounted(() => {
    params = new URLSearchParams(window.location.search)
    search.value = params.get('search')
})

</script>