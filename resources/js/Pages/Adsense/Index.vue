<script setup>
import AutheticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { defineProps } from "vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    adsenses: {},
});

const form = useForm({});

const removeAdsense = (adsense) => {
    if (confirm("Têm certeza que deseja remover este anúncio?")) {
        form.delete(route("adsenses.destroy", adsense));
    }
};
</script>

<template>
    <Head title="Anúncios" />

    <AutheticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Anúncios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="w-full block sm:flex sm:justify-end">
                            <div class="mt-4 sm:ml-16 sm:mt-0">
                                <NavLink
                                    :href="route('adsenses.create')"
                                    class="block rounded-md bg-green-600 hover:bg-green-900 px-3 py-2 text-center text-sm font-semibold !text-white shadow-sm !hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                                >
                                    Criar Anúncio
                                </NavLink>
                            </div>
                        </div>
                        <div class="mt-8 flow-root">
                            <div
                                class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"
                            >
                                <div
                                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                                >
                                    <div v-if="adsenses.length">
                                        <table
                                            class="min-w-full divide-y divide-gray-300"
                                        >
                                            <thead>
                                                <tr
                                                    class="border-t dark:border-white"
                                                >
                                                    <th
                                                        scope="col"
                                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold dark:text-white sm:pl-0"
                                                    >
                                                        #
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="w-[71%] py-3.5 pl-4 pr-3 text-left text-sm font-semibold dark:text-white sm:pl-0"
                                                    >
                                                        Título
                                                    </th>

                                                    <th
                                                        scope="col"
                                                        class="w-[10%]px-3 py-3.5 text-left text-sm font-semibold dark:text-white"
                                                    >
                                                        Criado em
                                                    </th>
                                                    <th
                                                        scope="col"
                                                        class="w-[10%] py-3.5 pl-3 pr-4 sm:pr-0"
                                                    >
                                                        Ação
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="divide-y divide-gray-200"
                                            >
                                                <tr
                                                    v-for="adsense of adsenses"
                                                    :key="adsense.id"
                                                >
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium dark:text-white sm:pl-0"
                                                    >
                                                        {{ adsense.id }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium dark:text-white sm:pl-0"
                                                    >
                                                        {{ adsense.title }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm dark:text-white"
                                                    >
                                                        {{ adsense.created_at }}
                                                    </td>

                                                    <td
                                                        class="whitespace-nowrap py-4 p-4 text-right text-sm font-medium flex justify-around"
                                                    >
                                                        <NavLink
                                                            :href="
                                                                route(
                                                                    'adsenses.edit',
                                                                    adsense.id
                                                                )
                                                            "
                                                            class="!text-white px-4 py-2 border border-blue-900 rounded bg-blue-500 hover:bg-blue-900 transition duration-300 ease-in-out"
                                                            >Editar</NavLink
                                                        >

                                                        <button
                                                            @click="
                                                                removeAdsense(
                                                                    adsense.id
                                                                )
                                                            "
                                                            class="text-sm font-medium leading-5 px-3 pt-1 py-2 rounded border border-red-900 bg-red-500 hover:bg-red-900 transition duration-300 ease-in-out"
                                                        >
                                                            Apagar
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div v-else>
                                        <h2
                                            class="text-xl font-bold dark:text-white"
                                        >
                                            Nenhum anúncio cadastrado...
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AutheticatedLayout>
</template>
