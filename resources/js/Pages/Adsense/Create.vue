<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Select from "@/Components/Select.vue";
import TextArea from "@/Components/TextArea.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import AutheticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    title: "",
    description: "",
    body: "",
    is_active: "",
    photos: [],
});

const opts = [
    { label: "Ativo", value: 1 },
    { label: "Inativo", value: 0 },
];

const submit = () => {
    form.post(route("adsenses.store"), {
        onFinish: () => form.reset(),
    });
};

const filesFront = ref([]);
const isDragged = ref(false);

const resetFilesProp = () => {
    form.photos = [];
    filesFront.value = [];
};

const mainHandleImages = (target) => {
    let images = target;

    form.photos = images;

    mountFilesFront(images);
};

const imagesHandle = (e) => {
    resetFilesProp();
    mainHandleImages(e.target.files);
};

const handleDragEve = (e) => {
    resetFilesProp();
    mainHandleImages(e.dataTransfer.files);
    isDragged = false;
};

const mountFilesFront = (images) => {
    Array.from(images).forEach((image) => {
        const reader = new FileReader();
        reader.readAsDataURL(image);

        reader.onload = (e) => {
            filesFront.value.push(e.target.result);
        };
    });
};
</script>

<template>
    <Head title="Criar Anúncio" />

    <AutheticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Criar Anúncio
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

                                <div class="mt-4">
                                    <InputLabel
                                        @dragover.prevent="isDragged = true"
                                        @dragleave.prevent="isDragged = false"
                                        @drop.prevent="handleDragEve"
                                        for="photos"
                                        value="Clique ou arraste as fotos aqui para escolher as imagens do anúncio"
                                        class="h-28 border-2 border-dashed border-gray-500 bg-gray-700 rounded flex items-center justify-center"
                                        :class="{
                                            'bg-gray-900': isDragged,
                                        }"
                                    />

                                    <TextInput
                                        id="photos"
                                        type="file"
                                        class="sr-only"
                                        @change="imagesHandle"
                                        multiple
                                    />

                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.photos"
                                    />

                                    <div
                                        class="w-full border-t border-gray-900 mt-10 pt-10 px-10 grid grid-cols-4"
                                        v-if="filesFront.length"
                                    >
                                        <div
                                            v-for="(img, key) of filesFront"
                                            :key="key"
                                        >
                                            <img
                                                :src="img"
                                                class="w-48 h-48 p-1 bg-white shadow rounded"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <PrimaryButton
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Criar
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AutheticatedLayout>
</template>
