<!--образец-->
<template>
    <admin-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Пользователи</h3>
        </div>

        <Link
            class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            :href="route('user.create')">
            <span class="">добавить</span>
        </Link>

        <!--index-->
        <div v-if="users.length > 0" class="mt-6">
            <table class="border-collapse border border-slate-500 w-full">
                <thead class="bg-gray-200">
                <th class="border border-slate-600 py-2">
                    <div class="flex">
                        <div class="cursor-pointer" title="сортировка" @click="sortNumItems(sortParam = 'id')">ID</div>
                        <div class="relative">
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
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'surname')">Фамилия</div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'surname'">
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
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'name')">Имя</div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'name'">
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
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'patronymic')">Отчество</div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'patronymic'">
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
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'birthday')">Дата рожд.</div>
                        <div class="relative">
                            <div class="absolute right-1" v-show="sortParam === 'birthday'">
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
                        <div class="cursor-pointer" title="сортировка" @click="sortNumItems(sortParam = 'nickname')">Ник</div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'nickname'">
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
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'email')">Логин</div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'email'">
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
                <th class="border border-slate-600 py-2 pr-2 italic text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="сортировка" @click="sortTextItems(sortParam = 'note')">Прим.</div>
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
                        <div class="cursor-pointer" title="группировка" @click="sortNumItems(sortParam = 'department_id')">Подразделение
                        </div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'department_id'">
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
                        <div class="cursor-pointer" title="группировка" @click="sortNumItems(sortParam = 'position_id')">Должность</div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'position_id'">
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
                    <span>Рук.</span>
                </th>
                <th class="border border-slate-600 py-2 pr-2 text-sm">
                    <div class="flex justify-center">
                        <div class="cursor-pointer" title="группировка" @click="sortNumItems(sortParam = 'role_id')">Роль</div>
                        <div class="relative">
                            <div class="absolute left-0" v-show="sortParam === 'role_id'">
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
                </thead>
                <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td class="border border-slate-700 text-center">
                        <Link :href="route('user.show', user.id)">
                            <span class="text-lg text-blue-700">{{ user.id }}</span>
                        </Link>
                    </td>
                    <td class="border border-slate-700 text-sm">{{ user.surname }}</td>
                    <td class="border border-slate-700 text-sm">{{ user.name }}</td>
                    <td class="border border-slate-700 text-sm">{{ user.patronymic }}</td>
                    <td class="border border-slate-700 text-center text-xs">{{ user.birthday }}</td>
                    <td class="border border-slate-700 text-center text-sm">{{ user.nickname }}</td>
                    <td class="border border-slate-700 text-sm">{{ user.email }}</td>
                    <td class="border border-slate-700 text-sm italic">{{ user.note }}</td>
                    <td class="border border-slate-700 text-sm">
                        <div v-for="department in departments">
                            {{ user.department_id === department.id ? department.department : '' }}
                        </div>
                    </td>
                    <td class="border border-slate-700 text-sm">
                        <div v-for="position in positions">
                            {{ user.position_id === position.id ? position.position : '' }}
                        </div>
                    </td>
                    <td class="border border-slate-700 text-sm">
                        <div v-for="position in positions">
                            {{ user.position_id === position.id ? (position.is_director === 1 ? 'да' : '') : '' }}
                        </div>
                    </td>
                    <td class="border border-slate-700 text-sm">
                        <div v-for="role in roles">
                            {{ user.role_id === role.id ? role.role : '' }}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, добавьте запись...</h3>
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
            isLoading: false,
            selectedSort: 'id',
            sortParam: '',
        }
    },

    props: [
        'users',
        'departments',
        'positions',
        'roles',

    ],
    methods: {
        sortTextItems(sortParam) {
            this.users.sort((item1, item2) => {
                return item1[sortParam]?.localeCompare(item2[sortParam]);
            })
        },

        sortNumItems(sortParam) {
            this.users.sort((item1, item2) => {
                return item1[sortParam] - item2[sortParam];
            })
        },

    },
}


</script>

