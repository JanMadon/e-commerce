<template>
    <AdminLayout>

        <!-- <div class=" flex justify-center my-20">
            <form post class=" border-2 border-gray-400 rounded-xl p-5">
                <h3>Add Product:</h3>
                <div class="flex">
                    <div class="flex flex-col p-5 mx-5 bg-blue-200 ">
                        <label for="">Name:</label>
                        <input type="text" name="name">

                        <label for="">Category:</label>
                        <select name="category">
                            <option value="laptops">laptops</option>
                            <option value="smartphone">smartphone</option>
                            <option value="game-console">geme console</option>
                            <option value="accessories">accessories</option>
                        </select>

                        <label for="">Qunatity in stock</label>
                        <input type="number" name="qunatity_in_stock">
                    </div>

                    <div class="flex flex-col mx-5 p-5 bg-blue-300">
                        <label for="">Price:</label>
                        <input type="number" name="price">

                        <label for="">Description:</label>
                        <textarea name="description"></textarea>

                    </div>
                </div>
                <button type="submit">add</button>
            </form>
        </div>
        <PrimaryButton>
            dodaj
        </PrimaryButton> -->

        <div class="max-w-md mx-auto bg-white rounded p-6 shadow-md">

            <h2 class="text-2xl font-semibold mb-4">Dodaj Produkt</h2>

            <form action="route(asc)" method="post">

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Nazwa Produktu</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-600">Kategoria</label>
                    <input type="text" id="category" name="category" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Quantity in Stock -->
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-600">Ilość w magazynie</label>
                    <input type="number" id="quantity" name="quantity" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-600">Cena</label>
                    <input type="text" id="price" name="price" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-600">Opis Produktu</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 p-2 w-full border rounded-md"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        <i class="fas fa-plus mr-2"></i> Dodaj Produkt
                    </button>
                </div>

            </form>

        </div>



    </AdminLayout>
</template>
<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


</script>