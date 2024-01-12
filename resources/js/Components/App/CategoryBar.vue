<template>
    <div class="flex text-white bg-slate-700 w-full pl-10">
        <NavLink :href="route('home')" >
                HOME
            </NavLink>
        <div v-for="(category, index) in $page.props.flash.view"
        :id="index"
        @mouseover="(event) => showSubCategories(event)" 
        @mouseleave="subCategory = 'false'"
        :class="{ hover: showList }"
        @click="() => visit(category.name)">
            <NavLink :href="route('home')" :active="category.name == $page.props.category">
                {{ category.name }}
            </NavLink>
            <ul v-if="subCategory == index" class="absolute flex flex-col text-white bg-slate-700 w-full w-min z-10">
                <NavLink v-for="(subCategory, index) in category.sub_category" :href="route('home')">
                    {{subCategory.name}}
                </NavLink>
            </ul>
        </div>

    </div>
    {{ $page.category }}
</template>

<script setup>
import { ref } from 'vue';
import NavLink from '../NavLink.vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { watch } from 'vue';
import { onBeforeMount } from 'vue';

const showList = ref(false)
const categories = ref();
const subCategory = ref();

const visit = (name) => {
    router.get(route('home', {'category' : name}))
    console.log(name)
}

const showSubCategories = event => {
    subCategory.value = event.currentTarget.id
}
// spróbujmy dodać zakłatki pobierając je z backendu;

const getCategoryAxsios = () => {
    axios.post(route('category.get'), { data: 'zapytanie o kategorie' })
        .then(response => {
            categories.value = response.data
        })
        .catch(error => console.log(error))
}

const getCategory = () => {
    router.post(route('category.get'), { data: 'zapytanie o kategorie' })
}



getCategory()
onMounted(() => {
    console.log('Funkcja po zmaontowaniu');

})

onBeforeMount(() => {
    getCategory()
    // Ta funkcja zostanie wykonana przed zamontowaniem komponentu
    console.log('Funkcja przedMontowaniem została wywołana');
})



</script>