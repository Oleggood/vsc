<!--образец-->
<template>
    <task-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Копировать задачу</h3>
        </div>

        <!--edit-->
        <div class="flex justify-center mt-4">
            <form class="mt-4 w-full" @submit.prevent="copy(task)">
                <div class="">
                    <Link
                        class="mb-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                        :href="route('task.show', task.id)">
                        <span>отмена</span>
                    </Link>
                </div>
                <div class="">


                    <InputLabel class="mt-2" for="new_task_task_date" value="Дата задачи (документа):"/>
                    <TextInput
                        id="new_task_task_date"
                        type="date"
                        class="block"
                        required
                        v-model="formLocalCreate.task_date"
                    />
                    <InputLabel class="mt-2" for="new_task_number" value="Номер документа:"/>
                    <TextInput
                        id="new_task_number"
                        type="text"
                        class="block"
                        minlength="1"
                        maxlength="30"
                        v-model="formLocalCreate.number"
                    />
                    <InputLabel class="mt-2" for="new_task_task_name" value="Наименование документа/поручения:"/>
                    <TextInput
                        id="new_task_task_name"
                        type="text"
                        class="block"
                        minlength="1"
                        maxlength="700"
                        required
                        v-model="formLocalCreate.task_name"
                    />
                    <InputLabel class="mt-2" for="new_task_item" value="Пункт:"/>
                    <TextInput
                        id="new_task_item"
                        type="text"
                        class="block"
                        v-model="formLocalCreate.item"
                    />
                    <InputLabel class="mt-2" for="new_task_task" value="Текст поручения:"/>
                    <MyTextArea
                        id="new_task_task"
                        class="block w-full"
                        minlength="2"
                        rows="5"
                        required
                        v-model="formLocalCreate.task"
                    />
                    <InputLabel class="mt-2 italic" for="new_task_note" value="Примечание:"/>
                    <MyTextArea
                        id="new_task_note"
                        class="block w-3/4 italic"
                        v-model="formLocalCreate.note"
                    />
                    <InputLabel class="mt-2" for="new_task_deadline" value="Крайняя дата исполнения:"/>
                    <TextInput
                        id="new_task_deadline"
                        type="date"
                        class="block"
                        required
                        v-model="formLocalCreate.deadline"
                    />


                    <div class="mt-2 w-3/4">
                        <label class="typo__label font-medium text-sm text-gray-700 mt-2">Исполнители:</label>
                        <div class="">

                            <multiselect
                                :custom-label="customLabel"
                                v-model="formLocalCreate.users"
                                :options="users"
                                :multiple="true"
                                :close-on-select="false"
                                :clear-on-select="true"
                                :preserve-search="false"
                                placeholder="Поиск"
                                track-by="id"
                                :preselect-first="false"

                                selectLabel="Нажмите для добавления"
                                selectedLabel="Выбрано"
                                deselectLabel="Нажмите для отмены выбора"
                            >

                                <template
                                    slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single" v-if="values.length" v-show="!isOpen">
                                        {{ values.length }} options selected
                                    </span>
                                </template>
                            </multiselect>
                            <pre class="language-json"><code>{{ value }}</code></pre>
                        </div>
                    </div>


                    <div class="mt-8 mb-10">
                        <Link
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            :href="route('task.show', task.id)">
                            <span class="">отмена</span>
                        </Link>
                        <primary-button type="submit" class="ml-4">
                            копировать
                        </primary-button>
                    </div>
                </div>
            </form>
        </div>
        <!--/edit-->

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
    </task-main>
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
import Checkbox from "@/Components/Checkbox.vue";
import TaskMain from "@/Layouts/TaskMain.vue";
import MyTextArea from "@/Components/MyTextArea.vue";
// import VueMultiselect from "vue-multiselect";
import Multiselect from "vue-multiselect";

export default {
    name: 'TaskCopy',
    components: {
        MyTextArea,
        TaskMain,
        Checkbox,
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
        // VueMultiselect,
        Multiselect,
    },

    data() {
        return {
            isLoading: false,
            selectedSort: 'id',
            sortParam: '',
            deleteDialogVisible: false,
            form: this.$inertia.form({}),
            formLocalCreate: {
                'id': '',
                'task_date': this.task.task_date,
                'number': this.task.number,
                'task_name': this.task.task_name,
                'item': this.task.item,
                'task': this.task.task,
                'note': this.task.note,
                'deadline': this.task.deadline,
                'task_status_id': this.task.task_status_id,
                'users': this.task.users,
            },
            errors: {},
            usersList: [],
            usersOnly: [],
        }
    },

    props: [
        'task',
        'users',
    ],

    mounted() {

    },

    methods: {
        customLabel({nickname, surname, name}) {
            return `${nickname} (${surname} ${name})`;
        },

        copy() {
            this.isLoading = true;
            this.usersList = this.formLocalCreate.users.map(function (value, index) {
                return value['id'];
            });
            delete this.formLocalCreate.users;
            this.formLocalCreate.users = this.usersList;
            delete this.formLocalCreate.id;
            this.form = this.$inertia.form(this.formLocalCreate);
            this.form.post('/task', {
                onFinish: () => {
                    this.isLoading = false;
                    window.location = '/task';
                }
            });
        },


    },
}

</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
