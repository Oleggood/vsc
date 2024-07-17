<!--образец-->
<template>
    <task-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Задача</h3>
        </div>

        <div class="flex justify-center mt-4">
            <div>
                <Link
                    class="mb-6 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                    :href="route('task.index')">
                    <span class="">назад</span>
                </Link>
                <Link
                    class="mb-6 ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('task.edit', task.id)">
                    <span class="">редактировать</span>
                </Link>
                <Link
                    class="mb-6 ml-4 inline-flex items-center px-4 py-2 bg-sky-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('task.copy.edit', task.id)">
                    <span class="">копировать</span>
                </Link>


                <danger-button class="mb-6 ml-4" @click.prevent="showDeleteDialog">удалить</danger-button>

                <table class="">
                    <tr class="bg-gray-200">
                        <td class="">ID</td>
                        <td class="font-bold">{{ task.id }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Дата задачи</td>
                        <td class="font-bold">{{ formatDate(task.task_date) }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Номер документа</td>
                        <td class="font-bold">{{ task.number }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Наименование документа</td>
                        <td class="font-bold">{{ task.task_name }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Пункт</td>
                        <td class="font-bold">{{ task.item }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Текст поручения</td>
                        <td class="font-bold">{{ task.task }}</td>
                    </tr>
                    <tr class="bg-gray-100 italic">
                        <td class="">Примечание</td>
                        <td class="font-bold">{{ task.note }}</td>
                    </tr>

                    <tr class="bg-gray-200">
                        <td class="">Отметки об исполнении</td>
                        <td class="font-bold">{{ task.done }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Крайняя дата исполления</td>
                        <td class="font-bold">{{ formatDate(task.deadline) }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Статус задачи</td>
                        <td class="font-bold">
                            <template v-for="status in statuses">
                                {{ status.id === task.task_status_id ? status.status : '' }}
                            </template>
                        </td>
                    </tr>
                    <tr class="">
                        <td class="">Исполнители</td>
                        <td class="font-bold">
                            <template v-for="user in users">
                                <p>{{ `${user.id} (${user.surname} ${user.name} ${user.patronymic})` }}</p>
                            </template>
                        </td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Дата, время создания</td>
                        <td class="font-bold">{{ `${createDate} , ${createTime}` }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Дата корректировки</td>
                        <td class="font-bold">{{ `${updateDate} , ${updateTime}` }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="pr-2">Комментарии исполнителей</td>
                        <td class="font-bold">{{ task.comment }}</td>
                    </tr>
                </table>
            </div>
        </div>


        <!--delete Modal-->
        <my-modal v-model:show="deleteDialogVisible">
            <div class="flex mx-auto flex-col">
                <div class="m-6">
                    <span>
                    Вы уверены, что хотите удалить: {{
                        `${task.task_name} № ${task.number}, п.${task.item}`
                    }}
                        <br><span class="text-sm">*после удаления копия задачи сохранится в архиве</span>
                </span>
                </div>
                <text-input autofocus class="w-0"></text-input> <!--нужен для закрытия модалки при нажатии ESC-->
                <div class="flex justify-around mb-4">
                    <secondary-button @click="hiddenDeleteDialog">отмена</secondary-button>
                    <danger-button @click.prevent="del(task)">удалить</danger-button>
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

export default {
    name: 'TaskShow',
    components: {
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
    },

    data() {
        return {
            isLoading: false,
            selectedSort: 'id',
            sortParam: '',
            deleteDialogVisible: false,
            form: this.$inertia.form({}),
        }
    },

    props: [
        'task',
        'createDate',
        'createTime',
        'updateDate',
        'updateTime',
        'statuses',
        'users',
    ],

    methods: {
        showDeleteDialog() {
            this.deleteDialogVisible = true;
        },

        hiddenDeleteDialog() {
            this.deleteDialogVisible = false;
        },

        del(task) {
            this.isLoading = true;
            this.form.delete(`/task/${task.id}`, {
                onFinish: () => {
                    this.isLoading = false;
                }
            });
        },
        formatDate(dateStr) {
            const dateParts = dateStr.split('-');
            if (dateParts.length !== 3) {
                return 'Invalid Date';
            }
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];
            return `${day}.${month}.${year}`;
        },
    },

}

</script>

