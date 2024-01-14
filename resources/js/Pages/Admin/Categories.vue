<template>
    <AdminLayout>

        <div class=" max-w-4xl mx-auto my-5 bg-gray-100 dark:bg-gray-600 rounded-xl p-6 shadow-md">
            <h2 class="w-1/2 text-2xl font-semibold mb-4 border-b-2 border-gray-300 drop-shadow">Categories</h2>

            <div class="flex ">
                <div class="w-1/2 mt-10 transition duration-900">
                    <div v-for="(category, index) of categories" class="flex justify-between w-2/3 border-b">
                        <CategorySpan :active="index == selectedIndex" @click="showSubcategories(index)">
                            {{ category.name }}
                        </CategorySpan>
                        <span class="mt-2 text-sm text-red-500 cursor-pointer">
                            remove
                        </span>
                    </div>
                    <CategorySpan v-show="!showCategoryInput && !showSubcategoryInput" @click="() => showCategoryInput = true"
                        class="w-min mx-2 text-xl rounded-3xl hover:bg-gray-200">
                        +
                    </CategorySpan>
                    <form v-show="showCategoryInput" @submit.prevent="addcategory" class="m-4">
                        <label for="name" class="block text-sm font-medium text-gray-600">Category name:</label>
                        <input type="text" class="mt-1 p-2 w-2/3 border rounded-md"
                            placeholder="Enter the name of the category" required>
                        <p class="text-red-600 text-xs">vdv</p>
                        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                        <textarea rows="3" class="mt-1 p-2 w-full border rounded-md"
                            placeholder="Enter destription of the category"></textarea>
                        <p class="text-red-600 text-xs">{{ }}</p>
                        <div class="text-right">
                            <SecondaryButton class="mx-5" @click.prevent="closeInputs">cancel</SecondaryButton>
                            <PrimaryButton >ADD</PrimaryButton>
                        </div>
                    </form>
                </div>
                <div class="w-1/2">
                    <h3 class="text-xl font-bold border-b border-gray-300 drop-shadow">
                        Subcategories
                    </h3>
                    <div class="pt-5 pl-5">
                        <li v-for="(subcategory, index) of selectedCategory"
                            class="m-2 flex justify-between w-1/2 border-b">
                            {{ subcategory.name }}
                            <span class="text-sm text-red-500 cursor-pointer">
                                remove
                            </span>
                        </li>
                    </div>
                    <CategorySpan v-show="!showCategoryInput && !showSubcategoryInput && selectedCategory"
                        @click="() => showSubcategoryInput = true" class="w-min ml-4 text-xl rounded-3xl hover:bg-gray-200">
                        +
                    </CategorySpan>
                    <div v-show="showSubcategoryInput" class="m-4">
                        <label for="name" class="block text-sm font-medium text-gray-600">Subcategory name:</label>
                        <input type="text" class="mt-1 p-2 w-2/3 border rounded-md"
                            placeholder="Enter the name of the subcategory" required>
                        <p class="text-red-600 text-xs">{{ }}</p>
                        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                        <textarea rows="3" class="mt-1 p-2 w-full border rounded-md"
                            placeholder="Enter destription of the subcategory"></textarea>
                        <p class="text-red-600 text-xs"></p>
                        <div class="text-right">
                            <SecondaryButton class="mx-5" @click.prevent="closeInputs">cancel</SecondaryButton>
                            <PrimaryButton @click.prevent="addSubcategory">ADD</PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import CategorySpan from '@/Components/App/CategorySpan.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';

const props = defineProps({
    categories: Object,
    subcategories: Object
})

const selectedCategory = ref();
const selectedIndex = ref();
const showCategoryInput = ref(false);
const showSubcategoryInput = ref(false);

const isChecked = ref(false)


const showSubcategories = index => {
    selectedIndex.value = index
    selectedCategory.value = props.categories[index].sub_category
}

const closeInputs = () => {
    showCategoryInput.value = false
    showSubcategoryInput.value = false
}

const addcategory = () => {
    console.log('add category')

}

const addSubcategory = () => {
    console.log('add subcategory')
}


</script>