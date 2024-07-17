<template>
    <admin-main>

        <!--index-->
        <div class="flex justify-around mt-4">
            <div v-if="statuses.length > 0" class="w-[40%]">
                <div class="flex justify-center mb-4 w-full">
                    <h3 class="text-lg font-semibold">Статусы задач</h3>
                </div>
                <table class="border-collapse border border-slate-500 w-full">
                    <thead class="bg-gray-200">
                    <th class="border border-slate-600 py-3">ID</th>
                    <th class="border border-slate-600 py-3">Статус</th>
                    </thead>
                    <tbody>
                    <tr v-for="stat in statuses" :key="stat.id">
                        <td class="border border-slate-700 text-center">{{ stat.id }}</td>
                        <td class="border border-slate-700 text-center">{{ stat.status }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>

            <div v-if="roles.length > 0" class="w-[40%]">
                <div class="flex justify-center mb-4 w-full">
                    <h3 class="text-lg font-semibold">Роли пользователей</h3>
                </div>
                <table class="border-collapse border border-slate-500 w-full">
                    <thead class="bg-gray-200">
                    <th class="border border-slate-600 py-3">ID</th>
                    <th class="border border-slate-600 py-3">Роль</th>
                    </thead>
                    <tbody>
                    <tr v-for="role in roles" :key="role.id">
                        <td class="border border-slate-700 text-center">{{ role.id }}</td>
                        <td class="border border-slate-700 text-center">{{ role.role }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>
        </div>

        <div class="flex justify-around mt-10">
            <div v-if="object_types.length > 0" class="w-[40%]">
                <div class="flex justify-center mb-4 w-full">
                    <h3 class="text-lg font-semibold">Типы объ.</h3>
                </div>
                <table class="border-collapse border border-slate-500 w-full">
                    <thead class="bg-gray-200">
                    <th class="border border-slate-600 py-3">ID</th>
                    <th class="border border-slate-600 py-3">Тип</th>
                    </thead>
                    <tbody>
                    <tr v-for="object_type in object_types" :key="object_type.id">
                        <td class="border border-slate-700 text-center">{{ object_type.id }}</td>
                        <td class="border border-slate-700 text-center">{{ object_type.name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>

            <div v-if="number_indexes.length > 0" class="w-[40%]">
                <div class="flex justify-center mb-4 w-full">
                    <h3 class="text-lg font-semibold">Индексы заявок</h3>
                </div>
                <table class="border-collapse border border-slate-500 w-full">
                    <thead class="bg-gray-200">
                    <th class="border border-slate-600 py-3">ID</th>
                    <th class="border border-slate-600 py-3">Индекс</th>
                    </thead>
                    <tbody>
                    <tr v-for="number_index in number_indexes" :key="number_index.id">
                        <td class="border border-slate-700 text-center">{{ number_index.id }}</td>
                        <td class="border border-slate-700 text-center">{{ number_index.name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>
        </div>

        <div class="flex justify-around mt-10">
            <div v-if="basics.length > 0" class="w-[40%]">
                <div class="flex justify-center mb-4 w-full">
                    <h3 class="text-lg font-semibold">Основания проведения</h3>
                </div>
                <table class="border-collapse border border-slate-500 w-full">
                    <thead class="bg-gray-200">
                    <th class="border border-slate-600 py-3">ID</th>
                    <th class="border border-slate-600 py-3">Основание</th>
                    </thead>
                    <tbody>
                    <tr v-for="basic in basics" :key="basic.id">
                        <td class="border border-slate-700 text-center">{{ basic.id }}</td>
                        <td class="border border-slate-700 text-center">{{ basic.name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>

        </div>
        <!--/index-->

    </admin-main>
</template>

<script>
import AdminMain from "@/Layouts/AdminMain.vue";
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import NavLink from "@/Components/NavLink.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Modal from "@/Components/Modal.vue";
import MyModal from "@/Components/MyModal.vue";

export default {
    name: 'Status',
    components: {
        MyModal,
        Modal,
        DangerButton,
        SecondaryButton,
        AdminMain,
        Link,
        PrimaryButton,
        InputLabel,
        NavLink,
        TextInput,
    },

    data() {
        return {

        }
    },

    props: [
        'statuses',
        'roles',
        'basics',
        'number_indexes',
        'object_types',
    ],

    methods: {

    },
}


</script>

