<template>
    <admin-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Создать нового пользователя</h3>
        </div>

        <!--create-->
        <div class="flex justify-center mt-4">
            <form class="mt-4" @submit.prevent="store">
                <div class="">
                    <Link
                        class="mb-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                        :href="route('user.index')">
                        <span>отмена</span>
                    </Link>
                </div>
                <div class="">
                    <InputLabel class="mt-2" for="new_user_surname" value="Фамилия:"/>
                    <TextInput
                        id="new_user_surname"
                        type="text"
                        class="block w-full"
                        minlength="1"
                        maxlength="40"
                        v-model="formLocalCreate.surname"
                    />
                    <InputLabel class="mt-2" for="new_user_name" value="Имя:"/>
                    <TextInput
                        id="new_user_name"
                        type="text"
                        class="block w-full"
                        minlength="2"
                        maxlength="150"
                        required
                        v-model="formLocalCreate.name"
                    />
                    <InputLabel class="mt-2" for="new_user_patronymic" value="Отчество:"/>
                    <TextInput
                        id="new_user_patronymic"
                        type="text"
                        class="block w-full"
                        minlength="1"
                        maxlength="40"
                        v-model="formLocalCreate.patronymic"
                    />
                    <InputLabel class="mt-2" for="new_user_birthday" value="Дата рождения:"/>
                    <TextInput
                        id="new_user_birthday"
                        type="date"
                        class=""
                        v-model="formLocalCreate.birthday"
                    />
                    <InputLabel class="mt-2" for="new_user_nickname" value="Ник:"/>
                    <TextInput
                        id="new_user_nickname"
                        type="number"
                        class="block w-full"
                        minlength="1"
                        maxlength="3"
                        required
                        v-model="formLocalCreate.nickname"
                    />
                    <p v-if="this.form.errors['nickname']" class="">
                        <strong class="text-sm text-red-600">{{ this.form.errors['nickname'] }}</strong>
                    </p>

                    <InputLabel class="mt-2" for="new_user_email" value="Логин:"/>
                    <TextInput
                        id="new_user_email"
                        type="text"
                        class="block w-full"
                        maxlength="200"
                        required
                        v-model="formLocalCreate.email"
                    />
                    <p v-if="this.form.errors['email']" class="">
                        <strong class="text-sm text-red-600">{{ this.form.errors['email'] }}</strong>
                    </p>
                    <InputLabel class="mt-2" for="new_user_password" value="Пароль (не менее 6 символов):"/>
                    <TextInput
                        id="new_user_password"
                        type="text"
                        class="block w-full"
                        minlength="6"
                        maxlength="40"
                        required
                        v-model="formLocalCreate.password"
                    />
                    <InputLabel class="mt-2" for="new_user_note" value="Примечание:"/>
                    <MyTextArea
                        id="new_user_note"
                        type="text"
                        class="block w-full italic"
                        minlength="2"
                        maxlength="500"
                        v-model="formLocalCreate.note"
                    />
                    <InputLabel class="mt-2" for="new_user_department_id" value="Подразделение:"/>
                    <select
                        id="new_user_department_id"
                        class="block w-full border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        v-model="formLocalCreate.department_id">
                        <template v-for="department in departments">
                            <option :value="department.id">{{ department.department }}</option>
                        </template>
                    </select>
                    <InputLabel class="mt-2" for="new_user_position_id" value="Должность:"/>
                    <select
                        id="new_user_position_id"
                        class="block w-full border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        v-model="formLocalCreate.position_id">
                        <template v-for="position in positions">
                            <option :value="position.id">{{ position.position }}</option>
                        </template>
                    </select>
                    <InputLabel class="mt-2" for="new_user_role_id" value="Роль:"/>
                    <select
                        id="new_user_role_id"
                        class="block w-full border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        v-model="formLocalCreate.role_id">
                        <template v-for="role in roles">
                            <option :value="role.id">{{ role.role }}</option>
                        </template>
                    </select>

                    <div class="mt-4">
                        <Link
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            :href="route('user.index')">
                            <span class="">отмена</span>
                        </Link>
                        <primary-button type="submit" class="ml-4">
                            сохранить
                        </primary-button>
                    </div>
                </div>
            </form>
        </div>
        <!--/create-->

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
import position from "@/Pages/Admin/Position.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

export default {
    name: 'UserIndex',
    components: {
        DropdownLink,
        Dropdown,
        MyTextArea,
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
            form: this.$inertia.form({}),
            formLocalCreate: {
                'id': '',
                'surname': '',
                'name': '',
                'patronymic': '',
                'birthday': '',
                'nickname': '',
                'email': '',
                'password': '',
                'note': '',
                'department_id': '',
                'position_id': '',
                'role_id': '',
            },
            errors: {},
        }
    },

    props: [
        'departments',
        'positions',
        'roles',
    ],
    methods: {
        store() {
            this.isLoading = true;
            this.form = this.$inertia.form(this.formLocalCreate);
            this.form.post('/admin/user', {
                onFinish: () => {
                    this.isLoading = false;
                    //условие отсутствия ошибок для дальнейших действий:
                    let errNick = String(this.form.errors['nickname']);
                    let errEmail = String(this.form.errors['email']);
                    let errNick1 = 0;
                    let errEmail1 = 0;
                    if (errNick === 'undefined') {
                        errNick1 = 1;
                    }
                    if (errEmail === 'undefined') {
                        errEmail1 = 1;
                    }
                    if (errNick1 === 1 && errEmail1 === 1) {
                        window.location = '/admin/user';
                    }
                }
            });


        },
    },

}


</script>

