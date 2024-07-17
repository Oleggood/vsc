<template>
    <admin-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Статьи УК</h3>
        </div>

        <!--create-->
        <div class="max-w-[40%]">
            <hr class="mt-4">
            <form class="flex flex-col mt-4" @submit.prevent="store">

                <div class="flex justify-center">
                    <p class="font-bold text-xs uppercase text-gray-700 tracking-widest">Создать новую</p>
                </div>
                <InputLabel class="mt-2"  for="new_crime" value="Статья, часть, пункт:"/>
                <TextInput
                    id="new_crime"
                    type="text"
                    class="mt-1 block w-full"
                    minlength="2"
                    maxlength="30"
                    required
                    v-model="formLocalCreate.name"
                />

                <InputLabel class="mt-2" for="new_report_number" value="Номер строки отчета (только числа, без знаков):"/>
                <TextInput
                    id="new_report_number"
                    type="number"
                    min="0"
                    class="mt-1 block w-full"
                    minlength="1"
                    maxlength="10"
                    required
                    v-model="formLocalCreate.report_number"
                />

                <InputLabel class="mt-2" for="new_note" value="Примечание:"/>
                <TextInput
                    id="new_note"
                    type="text"
                    class="mt-1 block w-full"
                    minlength="1"
                    maxlength="500"
                    v-model="formLocalCreate.note"
                />


                <div class="mt-6">
                    <primary-button>
                        Добавить
                    </primary-button>
                </div>
            </form>
        </div>
        <!--/create-->
        <hr class="mt-6">
        <!--index-->
        <div v-if="crimes.length > 0" class="mt-6">
            <table class="border-collapse border border-slate-500 w-full">
                <thead class="bg-gray-200">
                <th class="border border-slate-600 py-3">ID</th>
                <th class="border border-slate-600 py-3">Статья, часть, пункт</th>
                <th class="border border-slate-600 py-3">Номер стоки отчета</th>
                <th class="border border-slate-600 py-3">Примечание</th>
                <th class="border border-slate-600 py-3">Действия</th>
                </thead>
                <tbody>
                <tr v-for="value in crimes" :key="value.id">
                    <td class="border border-slate-700 text-center">{{ value.id }}</td>
                    <td class="border border-slate-700 indent-4">{{ value.name }}</td>
                    <td class="border border-slate-700 indent-4">{{ value.report_number }}</td>
                    <td class="border border-slate-700 indent-4">{{ value.note }}</td>


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
                        <InputLabel for="current_name" value="Статья, часть, пункт:"/>
                        <TextInput
                            id="current_name"
                            type="text"
                            class="mt-1 mb-4 block w-full"
                            autofocus
                            minlength="2"
                            maxlength="30"
                            required
                            v-model="value.name"
                        />

                        <InputLabel class="mt-2" for="new_report_number" value="Номер строки отчета (только числа, без знаков):"/>
                        <TextInput
                            id="new_report_number"
                            type="number"
                            min="0"
                            class="mt-1 block w-full"
                            minlength="1"
                            maxlength="10"
                            required
                            v-model="value.report_number"
                        />

                        <InputLabel class="mt-2" for="new_note" value="Примечание:"/>
                        <TextInput
                            id="new_note"
                            type="text"
                            class="mt-1 block w-full"
                            minlength="1"
                            maxlength="500"
                            v-model="value.note"
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
    name: 'Crime',
    components: {
        // Checkbox,
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
            formLocalCreate: {'id': '', 'name': '', 'note': '', 'report_number': ''},
            tempName: '',
            tempNote: '',
            tempReportNumber: '',
        }
    },

    props: [
        'crimes',
    ],

    mounted() {
        this.sort();
    },

    methods: {
        store() {
            this.isLoading = true;
            this.form = this.$inertia.form(this.formLocalCreate);
            this.form.post('/admin/crime', {
                onFinish: () => {
                    this.isLoading = false;
                    this.formLocalCreate = {'id': '', 'name': '', 'note': '', 'report_number': ''};
                    this.sort();
                }
            });
        },

        sort() {
            return this.crimes.sort((a, b) => {
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
            this.tempNote = value.note;
            this.tempReportNumber = value.report_number;

            this.updateDialogVisible = true;
            this.value = value;
            this.id = value.id;
        },

        hiddenUpdateDialog() {
            this.updateDialogVisible = false;

            this.value.name = this.tempName;
            this.value.note = this.tempNote;
            this.value.report_number = this.tempReportNumber;
        },

        update(value, id) {
            this.isLoading = true;
            this.form = this.$inertia.form(this.value);
            this.form.patch(`/admin/crime/${id}`, {
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
            this.form.delete(`/admin/crime/${value.id}`, {
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

