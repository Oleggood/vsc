<template>
    <admin-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Заказчики</h3>
        </div>
        <hr class="mt-4">
        <!--create-->
        <div class="flex justify-center mt-4">
            <p class="font-bold text-xs uppercase text-gray-700 tracking-widest">Создать нового</p>
        </div>
        <div class="max-w-[90%]">
            <form class="mt-4" @submit.prevent="store">
                <div class="flex justify-between">
                    <div class="">
                        <InputLabel class="mt-2" for="new_crime" value="Наименование (уникальное):"/>
                        <TextInput
                            id="new_crime"
                            type="text"
                            class="mt-1 block min-w-[30rem]"
                            minlength="2"
                            maxlength="100"
                            required
                            v-model="formLocalCreate.name"
                        />

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox name="territory" v-model:checked="formLocalCreate.territory" value=""/>
                                <span class="ml-2 text-sm text-gray-600">Горрайлин</span>
                            </label>
                        </div>
                        <div class="mt-6">
                            <primary-button>
                                Добавить
                            </primary-button>
                        </div>
                    </div>
                    <div class="">
                        <InputLabel class="mt-2" for="new_note" value="Линия:"/>
                        <TextInput
                            id="new_note"
                            type="text"
                            class="mt-1 block w-full"
                            minlength="1"
                            maxlength="10"
                            required
                            v-model="formLocalCreate.line"
                        />

                        <InputLabel class="mt-2" for="new_report_number"
                                    value="Номер линии в отчете (только числа, без знаков):"/>
                        <TextInput
                            id="new_report_number"
                            type="number"
                            min="0"
                            class="mt-1 block w-full"
                            required
                            v-model="formLocalCreate.report_line"
                        />



                    </div>
                </div>
            </form>
        </div>
        <!--/create-->
        <hr class="mt-6">
        <!--index-->
        <div v-if="employers.length > 0" class="mt-6">
            <table class="border-collapse border border-slate-500 w-full">
                <thead class="bg-gray-200">
                <th class="border border-slate-600 py-3">ID</th>
                <th class="border border-slate-600 py-3">Наименование</th>
                <th class="border border-slate-600 py-3">Горрайлин</th>
                <th class="border border-slate-600 py-3">Линия</th>
                <th class="border border-slate-600 py-3">Номер линии в отчете</th>
                <th class="border border-slate-600 py-3">Действия</th>
                </thead>
                <tbody>
                <tr v-for="value in employers" :key="value.id">
                    <td class="border border-slate-700 text-center">{{ value.id }}</td>
                    <td class="border border-slate-700 indent-4">{{ value.name }}</td>
                    <td class="border border-slate-700 indent-4">{{ value.territory ? 'да' : 'нет' }}</td>
                    <td class="border border-slate-700 indent-4">{{ value.line }}</td>
                    <td class="border border-slate-700 indent-4">{{ value.report_line }}</td>


                    <td class="border border-slate-700 text-center py-0.5">
                        <secondary-button @click.prevent="showUpdateDialog(value)" class="mr-2">
                            изменить
                        </secondary-button>
                        <danger-button @click.prevent="showDeleteDialog(value)" class="ml-2">
                            удалить
                        </danger-button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>
        <!--/index-->


        <!--update Modal-->
        <my-modal v-model:show="updateDialogVisible">
            <div class="mx-auto min-w-[80%]">
                <form @submit.prevent="update(value, id)" class="flex flex-col mt-6">
                    <div>
                        <InputLabel class="mt-2" for="current_name" value="Наименование (уникальное):"/>
                        <TextInput
                            id="current_name"
                            type="text"
                            class="mt-1 block w-full"
                            minlength="2"
                            maxlength="100"
                            required
                            v-model="value.name"
                        />

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <Checkbox name="territory" v-model:checked="value.territory" value=""/>
                                <span class="ml-2 text-sm text-gray-600">Горрайлин</span>
                            </label>
                        </div>


                        <InputLabel class="mt-2" for="current_line" value="Линия:"/>
                        <TextInput
                            id="current_line"
                            type="text"
                            class="mt-1 block w-full"
                            minlength="1"
                            maxlength="10"
                            required
                            v-model="value.line"
                        />

                        <InputLabel class="mt-2" for="current_report_line"
                                    value="Номер линии в отчете (только числа, без знаков):"/>
                        <TextInput
                            id="current_report_line"
                            type="number"
                            min="0"
                            class="mt-1 block w-full"
                            required
                            v-model="value.report_line"
                        />

                        <div class="flex justify-around mt-6">
                            <primary-button type="submit">
                                сохранить
                            </primary-button>
                            <secondary-button @click="hiddenUpdateDialog">отмена</secondary-button>
                        </div>
                    </div>
                </form>
            </div>
        </my-modal>
        <!--/update Modal-->

        <!--delete Modal-->
        <my-modal v-model:show="deleteDialogVisible">
            <div class="flex mx-auto flex-col">
                <div class="m-6"><span>Вы уверены, что хотите удалить {{ value.name }}</span></div>
                <text-input autofocus class="w-0"></text-input> <!--нужен для закрытия модалки при нажатии ESC-->
                <div class="flex justify-around mb-4">
                    <secondary-button @click="hiddenDeleteDialog">отмена</secondary-button>
                    <danger-button @click="del(value)">удалить</danger-button>
                </div>
            </div>
        </my-modal>
        <!--/delete Modal-->

        <!--preloader-->
        <div v-if="isLoading" class="inset-0 fixed flex">
            <div class="m-auto text-red-700 text-xl">
                <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="64px" height="64px"
                     viewBox="0 0 128 128" xml:space="preserve"><g><path d="M82.4 32.2a37.52 37.52 0 0 0-55 25.13L16.97 42.97.92 52.44A64.42 64.42 0 0 1 101.07 12.2l-.26 17.93z" fill="#ff8600"/><path
                    d="M82.4 32.2a37.52 37.52 0 0 0-55 25.13L16.97 42.97.92 52.44A64.42 64.42 0 0 1 101.07 12.2l-.26 17.93z"
                    fill="#ff8600" transform="rotate(120 64 64)"/><path
                    d="M82.4 32.2a37.52 37.52 0 0 0-55 25.13L16.97 42.97.92 52.44A64.42 64.42 0 0 1 101.07 12.2l-.26 17.93z"
                    fill="#ff8600" transform="rotate(240 64 64)"/><animateTransform attributeName="transform"
                                                                                    type="rotate" from="0 64 64"
                                                                                    to="120 64 64" dur="720ms"
                                                                                    repeatCount="indefinite"></animateTransform></g></svg>
            </div>
        </div>
        <!--/preloader-->

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
import InputError from "@/Components/InputError.vue";
import MyTextArea from "@/Components/MyTextArea.vue";
// import position from "@/Pages/Admin/Position.vue";
import Checkbox from "@/Components/Checkbox.vue";

export default {
    name: 'Employer',
    components: {
        Checkbox,
        MyTextArea,
        InputError,
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
            updateDialogVisible: false,
            deleteDialogVisible: false,
            isLoading: false,
            form: this.$inertia.form({}),
            formLocalCreate: {'id': '', 'name': '', 'territory': false, 'line': '', 'report_line': ''},
            tempName: '',
            tempTerritory: '',
            tempLine: '',
            tempReportLine: '',
        }
    },

    props: [
        'employers',
    ],

    mounted() {
        this.sort();
    },

    methods: {
        store() {
            this.isLoading = true;
            this.form = this.$inertia.form(this.formLocalCreate);
            this.form.post('/admin/employer', {
                onFinish: () => {
                    this.isLoading = false;
                    this.formLocalCreate = {'id': '', 'name': '', 'territory': false, 'line': '', 'report_line': ''};
                    this.sort();
                }
            });
        },

        sort() {
            return this.employers.sort((a, b) => {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        },

        showUpdateDialog(value) {
            this.tempName = value.name;
            this.tempTerritory = value.territory;
            this.tempLine = value.line;
            this.tempReportLine = value.report_line;

            this.updateDialogVisible = true;
            this.value = value;
            this.id = value.id;
            this.value.territory === 1 ? this.value.territory = true : this.value.territory = false;
        },

        hiddenUpdateDialog() {
            this.updateDialogVisible = false;
            this.value.territory ? this.value.territory = 1 : this.value.territory = 0;
            this.value.name = this.tempName;
            this.value.territory = this.tempTerritory;
            this.value.line = this.tempLine;
            this.value.report_line = this.tempReportLine;
        },

        update(value, id) {
            this.isLoading = true;
            this.form = this.$inertia.form(this.value);
            this.form.patch(`/admin/employer/${id}`, {
                onFinish: () => {
                    this.updateDialogVisible = false;
                    this.isLoading = false;
                    this.sort();
                }
            });
        },

        showDeleteDialog(value) {
            this.deleteDialogVisible = true;
            this.value = value;
        },

        hiddenDeleteDialog() {
            this.deleteDialogVisible = false;
        },

        del(value) {
            this.isLoading = true;
            this.form = this.$inertia.form(this.value);
            this.form.delete(`/admin/employer/${value.id}`, {
                onFinish: () => {
                    this.deleteDialogVisible = false;
                    this.isLoading = false;
                    this.sort();
                }
            });
        },
    }
}


</script>

