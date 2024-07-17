<template>
    <task-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Задачи</h3>
        </div>


        <div class="flex items-end justify-between mt-4">
            <div class="">
                <Link
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    :href="route('task.create')">
                    <span class="">добавить</span>
                </Link>
            </div>

            <div class="flex items-end justify-between">
                <div class="mr-5">
                    <Link
                        href="#"
                        class="inline-flex items-center px-4 py-2 bg-sky-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        @click="sendUsersSelectedIds(this.taskSelUsers)"
                    >
                        <span class="">выгрузить Excel</span>
                    </Link>
                </div>


                <div class="w-[29rem]">
                    <p>Фильтр по исполнителям:</p>
                    <multiselect
                        :custom-label="customLabel"
                        v-model="usersSelected"
                        :options="users"
                        :multiple="true"
                        :close-on-select="true"
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
                            class=""
                            slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single" v-if="values.length" v-show="!isOpen">
                                        {{ values.length }} options selected
                                    </span>
                        </template>
                    </multiselect>
                </div>
            </div>
        </div>


        <!--index-->
        <div v-if="tasks.length > 0" class="mt-6 min-h-[130px]">
            <table class="border-collapse border border-slate-500 w-full">
                <thead class="bg-gray-200">
                <th class="border border-slate-600 py-2">
                    <div class="flex justify-center">
                        <div>№</div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortNumItems(sortParam = 'id')">ID</div>
                        <div class="relative pr-2">
                            <div class="absolute left-0" v-show="sortParam === 'id'">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12" enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                       AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                       cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                       CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                       W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                       +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                       zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                       4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                       dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                                    </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'task_date')">
                            Дата задачи
                        </div>
                        <div class="relative">
                            <div class="absolute right-1" v-show="sortParam === 'task_date'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                           AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                           cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                           CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                           W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                           +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                           zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                           4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                           dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                                                        </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'number')">
                            Номер
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'number'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                                               AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                                               cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                                               CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                                               W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                                               +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                                               zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                                               4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                                               dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'task_name')">
                            Наименование
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'task_name'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                                                                   AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                                                                   cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                                                                   CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                                                                   W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                                                                   +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                                                                   zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                                                                   4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                                                                   dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                    </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'item')">
                            Пункт
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'item'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                                                                   AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                                                                   cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                                                                   CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                                                                   W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                                                                   +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                                                                   zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                                                                   4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                                                                   dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                    </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'task')">
                            Текст поручения
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'task'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                                                                   AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                                                                   cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                                                                   CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                                                                   W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                                                                   +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                                                                   zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                                                                   4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                                                                   dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                    </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'note')">
                            Примечание
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'note'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                                                                   AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                                                                   cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                                                                   CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                                                                   W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                                                                   +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                                                                   zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                                                                   4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                                                                   dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                    </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'done')">
                            Отметки об исполнении
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'done'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                                                                   AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                                                                   cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                                                                   CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                                                                   W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                                                                   +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                                                                   zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                                                                   4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                                                                   dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                    </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'deadline')">
                            Дата исполнения
                        </div>
                        <div class="relative">
                            <div class="absolute right-1" v-show="sortParam === 'deadline'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                           AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                           cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                           CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                           W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                           +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                           zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                           4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                           dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                                                        </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="группировка"
                             @click="sortNumItems(sortParam = 'task_status_id')">
                            Статус задачи
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'task_status_id'">
                                <svg version="1.1" id="Layer_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" width="8px"
                                     height="8px"
                                     viewBox="0 0 12 12"
                                     enable-background="new 0 0 12 12"
                                     xml:space="preserve">  <image
                                    id="image0" width="12" height="12" x="0" y="0"
                                    href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                                                                                           AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                                                                                           cwAAALEAAACxAcYtSY0AAAAHdElNRQfnBBELMTLYb65zAAAAw0lEQVQ4y+3QP0tCcRjF8Y8Ft+Q6
                                                                                           CEHkFLi4C45OEtwlEBp6CUE0OQu9CjcXJ5c7NfgKylVw6g9N0QvQoU1+bYF4b967Rmd8zvnyPM8h
                                                                                           W3UNpTQxzzYOcoBYrRyQq3/gTwBttzuJK718oGsk2Zq0TPXz91W9e3OE1BLMfDn/7cREMPgBLgX3
                                                                                           +756sNaQWoq8+BBv24c7wJM7p46diF27sdjf3NDGq09rjypFqo48C4KNTpE4XAiCcdE4pFbOygA1
                                                                                           zWzjG3hbJQMF69rwAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIzLTA0LTE3VDExOjQ5OjUwKzAwOjAw
                                                                                           4mabuQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMy0wNC0xN1QxMTo0OTo1MCswMDowMJM7IwUAAAAZ
                                                                                           dEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC"/>
                                                                                        </svg>
                            </div>
                        </div>
                    </div>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        Исполнители
                    </div>
                </th>
                </thead>
                <tbody>
                <tr v-for="(task, index) in usersFilter" :key="task.id" @dblclick="textMarker">
                    <td class="border border-slate-700 text-center">
                        <Link :href="route('task.show', task.id)">
                            <span class="text-lg text-blue-700">{{ index + 1 }}</span>
                        </Link>
                    </td>
                    <td class="border border-slate-700 text-center">
                        <Link :href="route('task.show', task.id)">
                            <span class="text-lg text-blue-700">{{ task.id }}</span>
                        </Link>
                    </td>
                    <td class="border border-slate-700 text-xs">{{ formatDate(task.task_date) }}</td>
                    <td class="border border-slate-700 text-sm">{{ task.number }}</td>
                    <td class="border border-slate-700 text-sm">{{ task.task_name }}</td>
                    <td class="border border-slate-700 text-sm">{{ task.item }}</td>
                    <td class="border border-slate-700 text-sm">
                        {{ task.task }}
                    </td>
                    <td class="border border-slate-700 text-sm italic">
                        <div class="flex justify-between">
                            <div class="">
                                {{ task.note }}
                            </div>
                            <div title="Имеются комментарии исполнителя" class="px-0.5">
                                <div v-show="task.comment" class="">
                                    <svg width="16px" height="16px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Icon-Set-Filled" transform="translate(-207.000000, -257.000000)" fill="blue">
                                                <path d="M231,273 C229.896,273 229,272.104 229,271 C229,269.896 229.896,269 231,269 C232.104,269 233,269.896 233,271 C233,272.104 232.104,273 231,273 L231,273 Z M223,273 C221.896,273 221,272.104 221,271 C221,269.896 221.896,269 223,269 C224.104,269 225,269.896 225,271 C225,272.104 224.104,273 223,273 L223,273 Z M215,273 C213.896,273 213,272.104 213,271 C213,269.896 213.896,269 215,269 C216.104,269 217,269.896 217,271 C217,272.104 216.104,273 215,273 L215,273 Z M223,257 C214.164,257 207,263.269 207,271 C207,275.419 209.345,279.354 213,281.919 L213,289 L220.009,284.747 C220.979,284.907 221.977,285 223,285 C231.836,285 239,278.732 239,271 C239,263.269 231.836,257 223,257 L223,257 Z" id="comment-3">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border border-slate-700 text-sm">
                        {{ task.done }}
                    </td>
                    <td class="border border-slate-700 text-xs">
                        <div class="flex justify-between">
                            <div>{{ formatDate(task.deadline) }}</div>
                            <div title="СРОК!" class="px-0.5">
                                <div v-if="showDeadlineIcon(task.deadline)" class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" class="deadline_icon"
                                         :fill="computeDeadlineIconColor(task.deadline)">
                                        <path d="M23.08,15.33L15,2.57c-.68-.98-1.81-1.57-3-1.57s-2.32,.58-3.03,1.6L.93,15.31c-1.02,1.46-1.21,3.21-.5,4.56,.7,1.35,2.17,2.12,4.01,2.12h15.12c1.85,0,3.31-.77,4.01-2.12,.7-1.35,.51-3.09-.49-4.54ZM11,7c0-.55,.45-1,1-1s1,.45,1,1v6c0,.55-.45,1-1,1s-1-.45-1-1V7Zm1,12c-.83,0-1.5-.67-1.5-1.5s.67-1.5,1.5-1.5,1.5,.67,1.5,1.5-.67,1.5-1.5,1.5Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border border-slate-700 text-sm">
                        <div v-for="status in statuses" :key="status.id">
                            {{ task.task_status_id === status.id ? status.status : '' }}
                        </div>
                    </td>
                    <td class="border border-slate-700 text-sm">
                        <div v-for="user in task.users" :key="user.id">
                            {{ user.nickname }} ({{ user.surname }})
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>
        <div class="mt-4">
            <p>Количество задач (всего)</p>

            <div class="flex text-sm">
                <div>
                    <div v-for="(status, index) in statuses" :key="status.id">
                        <p>{{ status.status }}:</p>
                    </div>
                    <p>ВСЕХ</p>
                </div>
                <div class="ml-2">
                    <p class="font-bold">{{ taskStat1.length }}</p>
                    <p class="font-bold">{{ taskStat2.length }}</p>
                    <p class="font-bold">{{ taskStat3.length }}</p>
                    <p class="font-bold">{{ taskStat4.length }}</p>
                    <p class="font-bold">{{ tasks.length }}</p>
                </div>
            </div>
        </div>
        <!--/index-->


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
import InputError from "@/Components/InputError.vue";
import MyTextArea from "@/Components/MyTextArea.vue";
import position from "@/Pages/Admin/Position.vue";
import Checkbox from "@/Components/Checkbox.vue";
import TaskMain from "@/Layouts/TaskMain.vue";
import Multiselect from 'vue-multiselect';
import {Inertia} from "@inertiajs/inertia";

export default {
    name: 'TaskIndex',
    components: {
        TaskMain,
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
        Multiselect,
    },

    data() {
        return {
            isLoading: false,
            selectedSort: 'id',
            sortParam: '',
            usersSelected: [], //массив выбранных пользователей
            usersSelectedIds: [], //ID выбранных пользователей
            taskSelUsers: this.tasks, //отображаемый список задач
            allUsersIds: [], //ID всех пользователей
            userSelected: [], //выбранные пользователи (полностью - со всеми полями)
        }
    },

    props: [
        'users',
        'departments',
        'positions',
        'roles',
        'tasks',
        'statuses',
        'taskStat1',
        'taskStat2',
        'taskStat3',
        'taskStat4',
    ],

    methods: {
        status() {
            return status
        },
        sortTextItems(sortParam) {
            this.tasks.sort((item1, item2) => {
                return item1[sortParam]?.localeCompare(item2[sortParam]);
            })
        },
        sortNumItems(sortParam) {
            this.tasks.sort((item1, item2) => {
                return item1[sortParam] - item2[sortParam];
            })
        },
        textMarker(event) {
            (event.currentTarget.className === 'bg-green-100') ? (event.currentTarget.className = 'bg-inherit') : (event.currentTarget.className = 'bg-green-100');
        },
        customLabel({nickname, surname, name}) {
            return `${nickname} (${surname} ${name})`;
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
        sendUsersSelectedIds(data) {
            let taskDownloadIds = data.map(item => item.id);
            Inertia.post('/task/download', {taskDownloadIds: taskDownloadIds})
        },

        showDeadlineIcon(deadline) {
            const currentDate = new Date();
            const taskDeadline = new Date(deadline);

            const timeDiff = taskDeadline.getTime() - currentDate.getTime();
            const diffInDays = timeDiff / (1000 * 3600 * 24); // Перевод миллисекунд в дни

            return diffInDays <= 5;
        },

        computeDeadlineIconColor(deadline) {
            const currentDate = new Date();
            const taskDeadline = new Date(deadline);

            if (taskDeadline <= currentDate) {
                return "red"; // Если дата прошла или равна текущей дате
            } else if (this.showDeadlineIcon(deadline)) {
                return "#F4A900"; // Если осталось 5 или менее дней
            } else {
                return "none"; // Скрыть значок
            }
        },
    },


    computed: {
        usersFilter() {
            this.usersSelectedIds = this.usersSelected.map(user => user.id); // то, что выбрано в мультиселекте (только ID поль-ей, представлены в виде массива)

            if (this.usersSelectedIds.length === 0) {
                this.taskSelUsers = this.tasks;

            } else {
                const filteredTasks = this.tasks.filter(task => {
                    if (task.users) {
                        // Фильтрация пользователей привязанных к задаче на основе usersSelectedIds
                        const filteredUsers = task.users.filter(user => this.usersSelectedIds.includes(user.id));
                        if (filteredUsers.length > 0) {
                            // Создание нового объекта задачи с отфильтрованными пользователями
                            return {...task, users: filteredUsers};
                        }
                    }
                    return false;
                });

                this.taskSelUsers = filteredTasks;

            }
            return this.taskSelUsers;
        },




    }

}


</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
