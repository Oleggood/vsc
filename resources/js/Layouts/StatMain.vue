<template>
    <div>
    <Head title="Вятка стастистика контроль" />

    <StatLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Раздел статистики и отчетов</h2>
        </template>

<!--        <div class="pt-1">-->
<!--            <div class="mx-auto sm:px-1 lg:px-2">-->
<!--                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">-->
<!--                    <div class="text-gray-900">-->
                        <slot></slot>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </StatLayout>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import StatLayout from "@/Layouts/StatLayout.vue";
</script>


