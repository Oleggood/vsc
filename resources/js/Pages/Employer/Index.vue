<!--образец-->
<template>
    <PublicMain>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Службы <span class="text-sm text-gray-500">(при корректировке каждую строку сохранять отдельно)</span>
            </h3>
        </div>

        <div v-if="employers.length > 0" class="mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        Наименование
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Линия
                    </th>
                    <th scope="col" class="px-4 py-3">
                        № лин. в отч.
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Горрай.
                    </th>
                    <th scope="col" class="py-3">
                        Начальник, звание
                    </th>
                    <th scope="col" class="pl-4 py-3">
                        Начальник, ФИО
                    </th>
                    <th scope="col" class="py-3">
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Последнее изм.
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="value in employers" :key="value.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ value.name }}
                    </td>
                    <td class="px-4 py-4">
                        {{ value.line }}
                    </td>
                    <td class="px-4 py-4">
                        {{ value.report_line }}
                    </td>
                    <td class="px-4 py-4">
                        {{ value.territory ? 'да' : 'нет' }}
                    </td>
                    <td class="py-4">
                        <input type="text"
                               class="rounded-md"
                               v-model="value.director_rank"
                               form="updt">
                    </td>
                    <td class="pl-4 py-4">
                        <input type="text"
                               class="rounded-md w-80"
                               v-model="value.director_name"
                               form="updt">
                    </td>
                    <td class="py-4">
                        <button type="submit"
                                title="править"
                                form="updt"
                                @click.prevent="update(value)"
                                class="px-1 py-2 mx-1 bg-violet-300 rounded-md hover:bg-violet-400 text-gray-700">
                            <span class="font-semibold">сохранить</span>
                        </button>
                    </td>
                    <td class="px-4 py-4">
                        {{ formatDate(value.updated_at) }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div v-else class="text-sm mb-4 mt-16">
            <p>...здесь пока пусто, чтобы добавить записи, обратитесь к администраторам</p>
        </div>


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

    </PublicMain>
</template>

<script>
// import InputError from "@/Components/InputError.vue";
import PublicMain from "@/Layouts/PublicMain.vue";

export default {
    name: 'TaskUserIndex',
    components: {
        PublicMain,
        //InputError,
    },

    data() {
        return {
            isLoading: false,
            direcName: '',
            direcRank: '',
        }
    },

    props: [
        'employers',
    ],

    methods: {
        formatDate(dateTimeString) {
            const date = new Date(dateTimeString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear().toString();
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');

            return `${day}.${month}.${year} (${hours}:${minutes})`;
        },

        update(value) {
            this.isLoading = true;
            this.direcName = value.director_name;
            this.direcRank = value.director_rank;

            this.$inertia.patch(`/employer/${value.id}`, {
                director_name: this.direcName,
                director_rank: this.direcRank,
            }, {
                preserveScroll: true,
                onBefore: (visit) => {
                },
                onStart: (visit) => {
                },
                onProgress: (progress) => {
                },
                onSuccess: (page) => {
                },
                onError: (errors) => {
                    // console.log(this.formErrors);
                },
                onCancel: () => {
                },
                onFinish: () => {
                    this.isLoading = false;
                }
            });
        },


    },

    computed: {},

}

</script>

