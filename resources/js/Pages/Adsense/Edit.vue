<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import TextArea from "@/Components/TextArea.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { defineProps } from "vue";

defineProps({
    adsense: { type: Object },
});

const form = useForm(usePage().props.adsense);

const opts = [
    { label: "Ativo", value: 1 },
    { label: "Inativo", value: 0 },
];

const submit = () => {
    form.put(route("adsenses.update", form.id), {});
};
</script>

<template>
    <Head title="Anúncios" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Editar Anúncio
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="px-4 sm:px-6 lg:px-8">
                            <form @submit.prevent="submit">
                                <div>
                                    <InputLabel
                                        for="title"
                                        value="Anúncio Titulo"
                                    />

                                    <TextInput
                                        id="title"
                                        type="text"
                                        class="mt-1 block w-full p-2"
                                        v-model="form.title"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.title"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel
                                        for="description"
                                        value="Descrição"
                                    />

                                    <TextInput
                                        id="description"
                                        type="text"
                                        class="mt-1 block w-full p-2"
                                        v-model="form.description"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.description"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="body" value="Conteúdo" />

                                    <TextArea
                                        id="body"
                                        class="mt-1 block w-full p-2"
                                        v-model="form.body"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.body"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel
                                        for="is_active"
                                        value="Status"
                                    />

                                    <Select
                                        id="is_active"
                                        :payloadOptions="opts"
                                        class="mt-1 block w-full p-2"
                                        v-model="form.is_active"
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.is_active"
                                    />
                                </div>

                                <div class="mt-8">
                                    <PrimaryButton
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Atualizar
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
