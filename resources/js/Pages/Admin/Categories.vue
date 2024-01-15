<template>
    <AdminLayout>

        <div class=" max-w-4xl mx-auto my-5 bg-gray-100 dark:bg-gray-600 rounded-xl p-6 shadow-md">
            <h2 class="w-1/2 text-2xl font-semibold mb-4 border-b-2 border-gray-300 drop-shadow">Categories</h2>

            <div class="flex ">
                <div class="w-2/3 mt-10 transition duration-900">
                    <div v-for="(category, index) of categories" class="flex justify-between w-2/3 border-b">
                        <CategorySpan :show="true" :active="index == selectedIndex" @click="showSubcategories(index)">
                            {{ category.name }}
                        </CategorySpan>
                        <div>
                            <span @click.prevent="() => modalEditCategory(category.id, category.name, category.description, 'category')"
                                class="mt-2 mx-3 text-sm text-blue-600 cursor-pointer">
                                edit
                            </span>
                            <span @click.prevent="() => removeCategory(category.id)"
                                class="mt-2 text-sm text-red-600 cursor-pointer">
                                remove
                            </span>
                        </div>
                    </div>

                    <CategorySpan v-show="!showCategoryForm && !showSubcategoryForm"
                        @click="() => { showCategoryForm = true; selectedIndex = flase }"
                        class="w-min mx-2 text-xl rounded-2xl hover:bg-gray-200">
                        +
                    </CategorySpan>
                    <div v-if="categories[selectedIndex] && !showSubcategoryForm"
                        class="mx-5 p-5 text-center bg-gray-200 border rounded-xl shadow-md">
                        {{ categories[selectedIndex].description }}
                    </div>
                    <form v-show="showCategoryForm" @submit.prevent="() => addCategory('category')" class="m-4">
                        <label for="name" class="block text-sm font-medium text-gray-600">Category name:</label>
                        <input type="text" v-model="addCategoryForm.name" class="mt-1 p-2 w-2/3 border rounded-md"
                            placeholder="Enter the name of the category" required>
                        <p class="text-red-600 text-xs">{{ $page.props.errors.name }}</p>
                        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                        <textarea rows="3" v-model="addCategoryForm.description" class="mt-1 p-2 w-full border rounded-md"
                            placeholder="Enter destription of the category"></textarea>
                        <p class="text-red-600 text-xs">{{ }}</p>
                        <div class="text-right">
                            <SecondaryButton class="mx-5" @click.prevent="closeInputs">cancel</SecondaryButton>
                            <PrimaryButton>ADD</PrimaryButton>
                        </div>
                    </form>
                </div>

                <div class="w-2/3">
                    <h3 class="text-xl font-bold border-b border-gray-300 drop-shadow">
                        Subcategories
                    </h3>
                    <div class="pt-5 pl-5">
                        <li v-for="(subcategory, subIndex) of selectedSubcategories"
                            class="m-2 flex justify-between w-2/3 border-b">
                            <p :style="(selectedSubcategory === subcategory? 'font-weight: bold' : '')" @click="() => selectedSubcategory = subcategory"
                                class="cursor-pointer">
                                {{ subcategory.name }}
                            </p>
                            <div>
                                <span
                                    @click.prevent="() => modalEditCategory(subcategory.id, subcategory.name, subcategory.description, 'subcategory')"
                                    class="mr-2 text-sm text-blue-600 cursor-pointer">
                                    edit
                                </span>
                                <span @click.prevent="() => removeSubcategory(subcategory.id)"
                                    class="text-sm text-red-600 cursor-pointer">
                                    remove
                                </span>
                            </div>
                        </li>
                    </div>
                    <CategorySpan v-show="!showCategoryForm && !showSubcategoryForm && selectedSubcategories"
                        @click="() => {showSubcategoryForm = true; selectedIndex = flase}"
                        class="w-min ml-4 text-xl rounded-2xl hover:bg-gray-200">
                        +
                    </CategorySpan>
                    <div v-if="selectedSubcategory && !showSubcategoryForm"
                        class="mx-5 p-5 text-center bg-gray-200 border rounded-xl shadow-md">
                        {{ selectedSubcategory.description }}
                    </div>
                    <form v-show="showSubcategoryForm" class="m-4">
                        <label for="name" class="block text-sm font-medium text-gray-600">Subcategory name:</label>
                        <input type="text" v-model="addSubcategoryForm.name" class="mt-1 p-2 w-2/3 border rounded-md"
                            placeholder="Enter the name of the subcategory" required>
                        <p class="text-red-600 text-xs">{{ }}</p>
                        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                        <textarea rows="3" v-model="addSubcategoryForm.description"
                            class="mt-1 p-2 w-full border rounded-md"
                            placeholder="Enter destription of the subcategory"></textarea>
                        <p class="text-red-600 text-xs"></p>
                        <div class="text-right">
                            <SecondaryButton class="mx-5" @click.prevent="closeInputs">cancel</SecondaryButton>
                            <PrimaryButton @click.prevent="addSubcategory">ADD</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Modal :show="showModalEdit" :max-width="'lg'">
            <div class="m-4">
                <h3 class="text-xl font-bold">Edit {{ type }}</h3>
                <label for="name" class="block text-sm font-medium text-gray-600">Name:</label>
                <input type="text" v-model="editContentNameInput" class="mt-1 p-2 w-2/3 border rounded-md" required>
                <p class="text-red-600 text-xs">{{ }}</p>
                <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                <textarea rows="3" v-model="editContentDescriptionInput" class="mt-1 p-2 w-full border rounded-md"
                    placeholder="Enter destription of the category"></textarea>
                <p class="text-red-600 text-xs">{{ }}</p>
                <div class="text-right">
                    <SecondaryButton @click="close" class="mx-5">close</SecondaryButton>
                    <PrimaryButton @click="edit">edit</PrimaryButton>
                </div>
            </div>
        </Modal>


    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import CategorySpan from '@/Components/App/CategorySpan.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import { showSuccessNotification } from '@/event-bus';

const props = defineProps({
    categories: Object,
    subcategories: Object
})

const selectedSubcategories = ref();
const selectedSubcategory = ref();
const selectedIndex = ref();
const showCategoryForm = ref(false);
const showSubcategoryForm = ref(false);

//edit Modal
const showModalEdit = ref(false)
const editContentId = ref()
const editContentNameInput = ref()
const editContentDescriptionInput = ref()
const type = ref('')

const addCategoryForm = useForm({
    type: '',
    name: '',
    description: '',
})

const addSubcategoryForm = useForm({
    name: '',
    description: '',
})

const showSubcategory = subcategory => {

}


const showSubcategories = index => {
    selectedIndex.value = index
    selectedSubcategories.value = props.categories[index].sub_category
}

const closeInputs = () => {
    showCategoryForm.value = false
    showSubcategoryForm.value = false
    addCategoryForm.name = ''
    addCategoryForm.description = ''
    addSubcategoryForm.name = ''
    addSubcategoryForm.description = ''
}

const modalEditCategory = (id, name, description, typeel) => {

    showModalEdit.value = true
    type.value = typeel
    editContentId.value = id
    editContentNameInput.value = name
    editContentDescriptionInput.value = description
}


const close = () => {
    editContentId.value = null
    editContentNameInput.value = null
    editContentDescriptionInput.value = null
    showModalEdit.value = false
}


const edit = () => {
    // przydał by się id z typem 
    console.log(type.value)
    console.log(editContentId.value)
    console.log(editContentNameInput.value)
    console.log(editContentDescriptionInput.value)
    // edytuj w DB sprawdz czy jest to category czy sub cztegory
    close();
}


const removeCategory = (categoryId) => {
    for (const index in props.categories) {
        if (props.categories[index].id === categoryId) {
            props.categories.splice(index, 1)
        }
    }
    // usuń z DB
}

const removeSubcategory = (subcategoryId) => {
    for (const index in selectedSubcategories.value) {
        if (selectedSubcategories.value[index].id === subcategoryId) {
            selectedSubcategories.value.splice(index, 1)
        }
    }
    // usuń z DB
}

const addCategory = (typeEl) => {
    const lastIndex = props.categories.length
    addCategoryForm.type = typeEl
    console.log(addCategoryForm);
    addCategoryForm.post(route('categories.create'), {
        onSuccess: () => { 
            props.categories.push({
                name: addCategoryForm.name,
                description: addCategoryForm.description,
                sub_category: []
            })
            showSubcategories(lastIndex)
            closeInputs()

            showSuccessNotification('udało się!')
        },
        onError: () => {

        }
    })
    // daodań do DB
}

const addSubcategory = () => {
    selectedSubcategories.value.push({
        name: addSubcategoryForm.name,
        description: addSubcategoryForm.description,
    })
    closeInputs()
    console.log('add subcategory')
}


</script>