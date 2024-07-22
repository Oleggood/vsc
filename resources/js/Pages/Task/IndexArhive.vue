<template>
    <task-main>
        <div class="flex justify-center">
            <h3 class="text-lg font-semibold">Архив задач</h3>
        </div>
        <div class="flex items-end justify-between mt-4">
            <span class="text-sm text-gray-600">*для удаления записей/внесения изменений в архив, обратитесь к администраторам</span>
        </div>

        <!--index-->
        <div v-if="tasks.length > 0" class="mt-6 min-h-[130px]">
            <table class="border-collapse border border-slate-500 w-full">
                <thead class="bg-gray-200">
                <tr>
                    <th class="border border-slate-600 py-2">
                        <div class="flex justify-center">
                            <div>№</div>
                        </div>
                    </th>
                    <th class="border border-slate-600 py-2">
                        <div class="flex justify-center">
                            <div class="cursor-pointer" title="сортировка" @click="sortNumItems(sortParam = 'id')">ID
                            </div>
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
                            <div class="cursor-pointer" title="сортировка"
                                 @click="sortTextItems(sortParam = 'task_date')">
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
                            <div class="cursor-pointer" title="сортировка"
                                 @click="sortTextItems(sortParam = 'task_name')">
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
                            <div class="cursor-pointer" title="сортировка"
                                 @click="sortTextItems(sortParam = 'deadline')">
                                Крайний срок исполнения
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
                    <th class="border border-slate-600 py-2 pr-2 text-sm">
                        <div class="flex justify-center">
                            <div class="cursor-pointer" title="сортировка"
                                 @click="sortTextItems(sortParam = 'comment')">
                                Комментарии
                            </div>
                            <div class="relative">
                                <div class="absolute" v-show="sortParam === 'comment'">
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
                            <div class="cursor-pointer" title="сортировка"
                                 @click="sortTextItems(sortParam = 'created_at')">
                                Создана
                            </div>
                            <div class="relative">
                                <div class="absolute" v-show="sortParam === 'created_at'">
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
                            <div class="cursor-pointer" title="сортировка"
                                 @click="sortTextItems(sortParam = 'updated_at')">
                                Последнее изменение
                            </div>
                            <div class="relative">
                                <div class="absolute" v-show="sortParam === 'updated_at'">
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
                </tr>
                </thead>
                <tbody>
                <tr v-for="(task, index) in usersFilter" :key="task.id" @dblclick="textMarker">
                    <td class="border border-slate-700 text-center">
                        <span class="">{{ index + 1 }}</span>
                    </td>
                    <td class="border border-slate-700 text-center">
                        <span class="">{{ task.task_id }}</span>
                    </td>
                    <td class="border border-slate-700 text-xs">{{ formatDate(task.task_date) }}</td>
                    <td class="border border-slate-700 text-sm">{{ task.number }}</td>
                    <td class="border border-slate-700 text-sm">{{ task.task_name }}</td>
                    <td class="border border-slate-700 text-sm">{{ task.item }}</td>
                    <td class="border border-slate-700 text-sm">
                        {{ task.task }}
                    </td>
                    <td class="border border-slate-700 text-sm italic">
                        {{ task.note }}

                    </td>
                    <td class="border border-slate-700 text-sm">
                        {{ task.done }}
                    </td>
                    <td class="border border-slate-700 text-xs">
                        {{ formatDate(task.deadline) }}
                    </td>
                    <td class="border border-slate-700 text-sm">
                        <div v-for="status in statuses" :key="status.id">
                            {{ task.task_status_id === status.id ? status.status : '' }}
                        </div>
                    </td>
                    <td class="border border-slate-700 text-sm">
                        {{ task.users_string }}
                    </td>
                    <td class="border border-slate-700 text-sm">
                        {{ task.comment }}
                    </td>
                    <td class="border border-slate-700 text-sm">
                        {{ formatDateExpand(task.created_at) }}
                    </td>
                    <td class="border border-slate-700 text-sm">
                        {{ formatDateExpand(task.updated_at) }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <h3 v-else class="mt-6 text-gray-900">Здесь пока пусто, записи создадутся автоматически при удалении
            задач...</h3>
        <div class="mt-4">
            <p>Всего задач в архиве: {{ tasks.length }}</p>
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
        'roles',
        'tasks',
        'statuses',
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
            // Проверяем на null
            if (!dateStr) {
                return 'Задача не удалена';
            }
            const dateParts = dateStr.split('-');
            if (dateParts.length !== 3) {
                return 'Invalid Date';
            }
            const year = dateParts[0];
            const month = dateParts[1];
            const day = dateParts[2];

            return `${day}.${month}.${year}`;
        },
        formatDateExpand(dateTime) {
            // Создаем объект Date из строки dateTime
            let dateObj = new Date(dateTime);

            // Получаем часы, минуты и секунды
            let hours = dateObj.getHours().toString().padStart(2, '0');
            let minutes = dateObj.getMinutes().toString().padStart(2, '0');
            let seconds = dateObj.getSeconds().toString().padStart(2, '0');
            // Получаем день, месяц и год
            let day = dateObj.getDate().toString().padStart(2, '0');
            let month = (dateObj.getMonth() + 1).toString().padStart(2, '0'); // Месяц начинается с 0
            let year = dateObj.getFullYear();

            return `${day}.${month}.${year} (${hours}:${minutes}:${seconds})`;
        },
        // sendUsersSelectedIds(data) {
        //     let taskDownloadIds = data.map(item => item.id);
        //     Inertia.post('/task/download', {taskDownloadIds: taskDownloadIds})
        // },

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
