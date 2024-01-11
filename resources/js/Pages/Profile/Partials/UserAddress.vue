

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Address Information</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Set your address and contact information.
            </p>
        </header>

        <form @submit.prevent="form.post(route('profile.address'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="phone" value="Phone" />
                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                    autofocus
                    autocomplete="phone"
                />
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>
            <div>
                <InputLabel for="street" value="Street" />
                <TextInput
                    id="street"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.street"
                    required
                    autofocus
                    autocomplete="street"
                />
                <InputError class="mt-2" :message="form.errors.street" />
            </div>
            <div>
                <InputLabel for="building" value="Building" />
                <TextInput
                    id="building"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.building"
                    required
                    autofocus
                    autocomplete="billing"
                />
                <InputError class="mt-2" :message="form.errors.building" />
            </div>
            <div>
                <InputLabel for="zipCode" value="Zip code" />
                <TextInput
                    id="zipCode"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.zipCode"
                    required
                    autofocus
                    autocomplete="postal-code"
                />
                {{ errors }}
                <InputError class="mt-2" :message="form.errors.zipCode" />
            </div>
            <div>
                <InputLabel for="city" value="City" />
                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    required
                    autofocus
                    autocomplete="city"
                />
                <InputError class="mt-2" :message="form.errors.city" />
            </div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>

</template>

<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useAttrs } from 'vue';


const attrs = useAttrs()
const user = usePage().props.auth.user;
console.log(user)

const form = useForm({
    phone: user.phone,
    street: user.street,
    building: user.building,
    zipCode: user.zipCode,
    city: user.city
});
</script>
