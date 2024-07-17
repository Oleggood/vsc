<!--образец-->
<template>
    <admin-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Пользователь</h3>
        </div>

        <div class="flex justify-center mt-4">
            <div>
                <Link
                    class="mb-6 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                    :href="route('user.index')">
                    <span class="">назад</span>
                </Link>
                <Link
                    class="mb-6 ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('user.edit', user.id)">
                    <span class="">редактировать</span>
                </Link>


                <danger-button class="mb-6 ml-4" @click.prevent="showDeleteDialog">удалить</danger-button>

                <table class="">
                    <tr class="bg-gray-200">
                        <td class="">ID</td>
                        <td class="font-bold">{{ user.id }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Фамилия</td>
                        <td class="font-bold">{{ user.surname }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Имя</td>
                        <td class="font-bold">{{ user.name }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Отчество</td>
                        <td class="font-bold">{{ user.patronymic }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Дата рождения</td>
                        <td class="font-bold">{{ birthday }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Ник</td>
                        <td class="font-bold">{{ user.nickname }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Логин</td>
                        <td class="font-bold">{{ user.email }}</td>
                    </tr>
                    <tr class="">
                        <td class="italic">Примечание</td>
                        <td class="font-bold italic">{{ user.note }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Структурное подразделение</td>
                        <td class="font-bold">{{ department }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Должность</td>
                        <td class="font-bold">{{ position.position }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Статус руководителя</td>
                        <td class="font-bold">{{ position.is_director ? 'Да' : 'Нет' }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Статус заместителя руководителя</td>
                        <td class="font-bold">{{ position.is_deputy_director ? 'Да' : 'Нет' }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Роль</td>
                        <td class="font-bold">{{ role }}</td>
                    </tr>
                    <tr class="">
                        <td class="">Дата, время создания</td>
                        <td class="font-bold">{{ `${createDate} , ${createTime}` }}</td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="">Дата корректировки</td>
                        <td class="font-bold">{{ `${updateDate} , ${updateTime}` }}</td>
                    </tr>
                </table>
            </div>
        </div>


        <!--delete Modal-->
        <my-modal v-model:show="deleteDialogVisible">
            <div class="flex mx-auto flex-col">
                <div class="m-6"><span>Вы уверены, что хотите удалить {{ user.email }}</span></div>
                <text-input autofocus class="w-0"></text-input> <!--нужен для закрытия модалки при нажатии ESC-->
                <div class="flex justify-around mb-4">
                    <secondary-button @click="hiddenDeleteDialog">отмена</secondary-button>
                    <danger-button @click.prevent="del(user)">удалить</danger-button>
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
//import position from "@/Pages/Admin/Position.vue";
import Checkbox from "@/Components/Checkbox.vue";

export default {
    name: 'UserIndex',
    components: {
        Checkbox,
        //MyTextArea,
        //InputError,
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
            // updateDialogVisible: false,
            deleteDialogVisible: false,
            isLoading: false,
            form: this.$inertia.form({}),
        }
    },

    props: [
        'user',
        'birthday',
        'department',
        'position',
        'role',
        'createDate',
        'createTime',
        'updateDate',
        'updateTime',
    ],
    methods: {
        showDeleteDialog() {
            this.deleteDialogVisible = true;
        },

        hiddenDeleteDialog() {
            this.deleteDialogVisible = false;
        },

        del(user) {
            this.isLoading = true;
            this.form.delete(`/admin/user/${user.id}`, {
                onFinish: () => {
                    this.isLoading = false;
                }
            });
        },
    }
}


</script>

