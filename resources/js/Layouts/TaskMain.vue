<template>
    <Head title="Словарь статусов" />

    <TaskLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Раздел задач и контроля</h2>
        </template>

        <div class="pt-8">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </TaskLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import TaskLayout from "@/Layouts/TaskLayout.vue";
</script>


