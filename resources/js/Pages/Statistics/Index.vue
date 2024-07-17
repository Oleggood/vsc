<template>
    <stat-main>
        <div class="">
            <!--форма отображения форм - начало-->
            <div class="flex absolute top-[4rem] right-5">
                <div class="mt-1 ml-4">
                    <label class="flex items-center">
                        <Checkbox name="on_create_update" v-model:checked="onCreateUpdate"/>
                        <span class="ml-2 text-sm text-gray-600">Показывать форму редактирования</span>
                    </label>
                </div>
                <div class="mt-1 ml-6">
                    <label class="flex items-center">
                        <Checkbox name="on_filter" v-model:checked="onFilter"/>
                        <span class="ml-2 text-sm text-gray-600">Показывать форму фильтрации</span>
                    </label>
                </div>
                <div class="mt-1 ml-6">
                    <label class="flex items-center">
                        <Checkbox name="on_detail" v-model:checked="onDetail"/>
                        <span class="ml-2 text-sm text-gray-600">Подробно</span>
                    </label>
                </div>
            </div>
            <!--форма отображения форм - конец-->


            <!--форма фильтрации - начало-->
            <div v-if="onFilter" class="">
                <br>
                <h3>Фильтр</h3>
                <br>
            </div>
            <!--форма фильтрации - конец-->

            <!--таблица статистики - начало-->
            <div id="stat_content" class="overflow-scroll flex flex-col max-h-screen">
                <table class="text-sm relative flex-1">
                    <thead class="px-0.5 sticky top-0 z-10">
                    <tr class="bg-sky-700 text-gray-50 h-28">
                        <th class="cursor-pointer min-w-8" title="сортировка" @click.prevent="sortNumItems(sortParam = 'id')">
                            <div class="flex flex-col items-center">
                                <div>
                                    ID
                                </div>
                                <div v-show="sortParam === 'id'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="min-w-52">
                            Действия
                        </th>
                        <th class="cursor-pointer min-w-36" title="сортировка"
                            @click.prevent="sortNumItems(sortParam = 'number')">
                            <div class="flex flex-col items-center">
                                <div>
                                    Номер<br>заявки
                                </div>
                                <div v-show="sortParam === 'number'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                            <div class="relative">
                                <div
                                    class="rounded-md text-white text-xs absolute top-6 left-6 font-semibold bg-red-700 max-w-20">
                                    {{ this.formErrorsNumber() }}
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-44" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'number_note')">
                            <div class="flex flex-col items-center">
                                <div>Примечание к<br>№ заявки</div>
                                <div v-show="sortParam === 'number_note'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-32" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'in_date')">
                            <div class="flex flex-col items-center">
                                <div>Дата<br>поступления</div>
                                <div v-show="sortParam === 'in_date'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                            <div class="relative">
                                <div
                                    class="rounded-md text-white text-xs absolute top-6 left-3 font-semibold bg-red-700 max-w-20">
                                    {{ this.formErrors.in_date }}
                                </div>
                            </div>
                        </th>
                        <th class="min-w-56">
                            <div class="flex justify-center">
                                <div class="flex flex-col items-center">
                                    <span class="cursor-pointer" title="сортировка"
                                          @click.prevent="sortNumItems(sortParam = 'base_id')">Основание</span>
                                    <div v-show="sortParam === 'base_id'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                                <div class="">,&nbsp;</div>
                                <div class="flex flex-col items-center">
                                    <span class="cursor-pointer" title="сортировка"
                                          @click.prevent="sortTextItems(sortParam = 'base_number')">№</span>
                                    <div v-show="sortParam === 'base_number'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>

                                </div>
                            </div>
                            <div class="relative">
                                <div
                                    class="rounded-md text-white text-xs absolute top-[2.15rem] left-6 font-semibold bg-red-700 max-w-20">
                                    {{ this.formErrors.base_id }}
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-32" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'base_date')">
                            <div class="flex flex-col items-center">
                                <div>Дата завед-я<br>основания</div>
                                <div v-show="sortParam === 'base_date'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="min-w-32" title="для сортировки воспользуйтесь фильтром">
                            <div>Осн. статья<br>(№ в отч.)<br>(примеч.)</div>
                            <div class="relative">
                                <div
                                    class="rounded-md text-white text-xs absolute top-[0.95rem] left-6 font-semibold bg-red-700 max-w-20">
                                    {{ this.formErrors.main_crime_id }}
                                </div>
                            </div>
                        </th>
                        <th class="min-w-32" title="для сортировки воспользуйтесь фильтром">
                            <div class="">
                                Дополнит. статьи
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-96" title="сортировка"
                            @click.prevent="sortNumItems(sortParam = 'employer_id')">
                            <div class="flex flex-col items-center">
                                <div>Заказчик</div>
                                <div v-show="sortParam === 'employer_id'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                            <div class="relative">
                                <div
                                    class="rounded-md text-white text-xs absolute top-[2rem] left-[9rem] font-semibold bg-red-700 max-w-20">
                                    {{ this.formErrors.employer_id }}
                                </div>
                            </div>
                        </th>
                        <th class="min-w-24" title="для сортировки воспользуйтесь фильтром">
                            <div class="">
                                Заказч., линия<br>(№ линии в отч.)
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-40" title="сортировка"
                            @click.prevent="sortNumItems(sortParam = 'object_type_id')">
                            <div class="flex flex-col items-center">
                                <div>Тип</div>
                                <div v-show="sortParam === 'object_type_id'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                            <div class="relative">
                                <div
                                    class="rounded-md text-white text-xs absolute top-[2.15rem] left-[2.15rem] font-semibold bg-red-700 max-w-20">
                                    {{ this.formErrors.object_type_id }}
                                </div>
                            </div>
                        </th>
                        <th v-if="onDetail" class="min-w-80 cursor-pointer" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'object')">
                            <div class="flex flex-col items-center">
                                <div>Описание</div>
                                <div v-show="sortParam === 'object'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th v-if="onDetail" class="min-w-32 cursor-pointer" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'object_birthday')">
                            <div class="flex flex-col items-center">
                                <div>Дата<br>описание</div>
                                <div v-show="sortParam === 'object_birthday'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th v-if="onDetail" class="min-w-28 cursor-pointer" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'citizenship')">
                            <div class="flex flex-col items-center">
                                <div>Без гр.</div>
                                <div v-show="sortParam === 'citizenship'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th v-if="onDetail" class="min-w-14 cursor-pointer" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'ethnicity')">
                            <div class="flex flex-col items-center">
                                <div>Этн.</div>
                                <div v-show="sortParam === 'ethnicity'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th v-if="onDetail" class="min-w-14 cursor-pointer" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'judging')">
                            <div class="flex flex-col items-center">
                                <div>Суд</div>
                                <div v-show="sortParam === 'judging'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-14" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'itt')">
                            <div class="flex flex-col items-center">
                                <div>ИТТ</div>
                                <div v-show="sortParam === 'itt'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-14" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'budget')">
                            <div class="flex flex-col items-center">
                                <div>Бюдж.</div>
                                <div v-show="sortParam === 'budget'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <!--исполн:-->
                        <th class="cursor-pointer min-w-14" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'bdsm')">
                            <div class="flex flex-col items-center">
                                <div>Вз-ие<br>БМСМ</div>
                                <div v-show="sortParam === 'bdsm'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-14" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'ptsm')">
                            <div class="flex flex-col items-center">
                                <div>Вз-ие<br>ПМСМ</div>
                                <div v-show="sortParam === 'ptsm'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-14" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'quickly')">
                            <div class="flex flex-col items-center">
                                <div>Срочн.</div>
                                <div v-show="sortParam === 'quickly'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-14" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'transit')">
                            <div class="flex flex-col items-center">
                                <div>Транз.</div>
                                <div v-show="sortParam === 'transit'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-14" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'outside_zone')">
                            <div class="flex flex-col items-center">
                                <div>Вне зоны</div>
                                <div v-show="sortParam === 'outside_zone'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-14" title="сортировка" @click.prevent="sortBoolItems(sortParam = 'og')">
                            <div class="flex flex-col items-center">
                                <div>ОПС</div>
                                <div v-show="sortParam === 'og'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-24" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'series')">
                            <div class="flex flex-col items-center">
                                <div>Одно из серии</div>
                                <div v-show="sortParam === 'series'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-20" title="сортировка"
                            @click.prevent="sortBoolItems(sortParam = 'without_execution')">
                            <div class="flex flex-col items-center">
                                <div>Спис. без исп.</div>
                                <div v-show="sortParam === 'without_execution'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-72" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'employer_defect')">
                            <div class="flex flex-col items-center">
                                <div>Брак зак-ка</div>
                                <div v-show="sortParam === 'employer_defect'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <th class="cursor-pointer min-w-72" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'note')">
                            <div class="flex flex-col items-center">
                                <div>Примечание</div>
                                <div v-show="sortParam === 'note'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <!--исполнение:-->
                        <th class="cursor-pointer min-w-32" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'executed_date')">
                            <div class="flex flex-col items-center">
                                <div>Дата исп.</div>
                                <div v-show="sortParam === 'executed_date'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <!--параметры исполнения:-->
                        <template v-if="this.newAssignment.executedDate">
                            <th class="cursor-pointer min-w-16" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'page')">
                                <div class="flex flex-col items-center">
                                    <div>Листов</div>
                                    <div v-show="sortParam === 'page'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-16" title="сортировка"
                                @click.prevent="sortBoolItems(sortParam = 'doc_control')">
                                <div class="flex flex-col items-center">
                                    <div>Док. кон-ль</div>
                                    <div v-show="sortParam === 'doc_control'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-16" title="сортировка"
                                @click.prevent="sortBoolItems(sortParam = 'audio_control')">
                                <div class="flex flex-col items-center">
                                    <div>Ауд. кон-ль</div>
                                    <div v-show="sortParam === 'audio_control'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-16" title="сортировка"
                                @click.prevent="sortBoolItems(sortParam = 'track_control')">
                                <div class="flex flex-col items-center">
                                    <div>Тр. кон-ль</div>
                                    <div v-show="sortParam === 'track_control'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-16" title="сортировка"
                                @click.prevent="sortBoolItems(sortParam = 'together_control')">
                                <div class="flex flex-col items-center">
                                    <div>Доп. кон-ль</div>
                                    <div v-show="sortParam === 'together_control'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-28" title="группировка"
                                @click.prevent="sortNumItems(sortParam = 'execut_id')">
                                <div class="flex flex-col items-center">
                                    <div>Исполнитель</div>
                                    <div v-show="sortParam === 'execut_id'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>

                            <!--исп.2я:-->
                            <!--02:-->
                            <template v-if="this.newAssignment.numberIndexId === 2">
                                <th class="cursor-pointer min-w-20" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'use_video')">
                                    <div class="flex flex-col items-center">
                                        <div>Использ. вид.</div>
                                        <div v-show="sortParam === 'use_video'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'video_device')">
                                    <div class="flex flex-col items-center">
                                        <div>Кол-во исп-х вид.</div>
                                        <div v-show="sortParam === 'video_device'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'video_device_photo')">
                                    <div class="flex flex-col items-center">
                                        <div>Получ. фото с вид.</div>
                                        <div v-show="sortParam === 'video_device_photo'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'video_device_video')">
                                    <div class="flex flex-col items-center">
                                        <div>Получ. вид. с вид.</div>
                                        <div v-show="sortParam === 'video_device_video'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'video_device_audio')">
                                    <div class="flex flex-col items-center">
                                        <div>Получ. аудио с вид.</div>
                                        <div v-show="sortParam === 'video_device_audio'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'use_photo')">
                                    <div class="flex flex-col items-center">
                                        <div>Использ. фото</div>
                                        <div v-show="sortParam === 'use_photo'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'photo_device')">
                                    <div class="flex flex-col items-center">
                                        <div>Кол-во исп-х фото</div>
                                        <div v-show="sortParam === 'photo_device'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'photo_device_photo')">
                                    <div class="flex flex-col items-center">
                                        <div>Получ. фото с фото</div>
                                        <div v-show="sortParam === 'photo_device_photo'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'photo_device_video')">
                                    <div class="flex flex-col items-center">
                                        <div>Получ. видео с фото</div>
                                        <div v-show="sortParam === 'photo_device_video'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'photo_device_audio')">
                                    <div class="flex flex-col items-center">
                                        <div>Получ. аудио с фото</div>
                                        <div v-show="sortParam === 'photo_device_audio'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'use_audio')">
                                    <div class="flex flex-col items-center">
                                        <div>Использ. аудио</div>
                                        <div v-show="sortParam === 'use_audio'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'audio_device')">
                                    <div class="flex flex-col items-center">
                                        <div>Кол-во исп-х аудио</div>
                                        <div v-show="sortParam === 'audio_device'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'audio_device_audio')">
                                    <div class="flex flex-col items-center">
                                        <div>Получ. аудио с аудио</div>
                                        <div v-show="sortParam === 'audio_device_audio'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-20" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'for_us')">
                                    <div class="flex flex-col items-center">
                                        <div>Для нас (в рамках обесп. мер-ий)</div>
                                        <div v-show="sortParam === 'for_us'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'place_work')">
                                    <div class="flex flex-col items-center">
                                        <div>По м/р</div>
                                        <div v-show="sortParam === 'place_work'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'relation')">
                                    <div class="flex flex-col items-center">
                                        <div>Выявл. св.</div>
                                        <div v-show="sortParam === 'relation'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'ident_relation')">
                                    <div class="flex flex-col items-center">
                                        <div>Устан. св.</div>
                                        <div v-show="sortParam === 'ident_relation'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'is_fail')">
                                    <div class="flex flex-col items-center">
                                        <div>Успешно</div>
                                        <div v-show="sortParam === 'is_fail'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'region')">
                                    <div class="flex flex-col items-center">
                                        <div>Выезд в р-н</div>
                                        <div v-show="sortParam === 'region'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-20" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'bio')">
                                    <div class="flex flex-col items-center">
                                        <div>Образцы</div>
                                        <div v-show="sortParam === 'bio'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'copy')">
                                    <div class="flex flex-col items-center">
                                        <div>Копия</div>
                                        <div v-show="sortParam === 'copy'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-20" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'spravka')">
                                    <div class="flex flex-col items-center">
                                        <div>Спр-кой</div>
                                        <div v-show="sortParam === 'spravka'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                            </template>
                            <!--03:-->
                            <template v-if="this.newAssignment.numberIndexId === 3">
                                <th class="cursor-pointer min-w-20" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'input_data')">
                                    <div class="flex flex-col items-center">
                                        <div>Первич. инф.</div>
                                        <div v-show="sortParam === 'input_data'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'persons')">
                                    <div class="flex flex-col items-center">
                                        <div>Уст. лиц</div>
                                        <div v-show="sortParam === 'persons'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'firms')">
                                    <div class="flex flex-col items-center">
                                        <div>Уст. лиц</div>
                                        <div v-show="sortParam === 'firms'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'transport')">
                                    <div class="flex flex-col items-center">
                                        <div>Уст. т/с</div>
                                        <div v-show="sortParam === 'transport'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'address')">
                                    <div class="flex flex-col items-center">
                                        <div>Уст. адр.</div>
                                        <div v-show="sortParam === 'address'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortNumItems(sortParam = 'photo')">
                                    <div class="flex flex-col items-center">
                                        <div>Фото</div>
                                        <div v-show="sortParam === 'photo'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                                <th class="cursor-pointer min-w-16" title="сортировка"
                                    @click.prevent="sortBoolItems(sortParam = 'scheme')">
                                    <div class="flex flex-col items-center">
                                        <div>Схема</div>
                                        <div v-show="sortParam === 'scheme'" class="relative">
                                            <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                        </div>
                                    </div>
                                </th>
                            </template>
                        </template>

                        <!--отзыв (с/о)-->
                        <th class="cursor-pointer min-w-32" title="сортировка"
                            @click.prevent="sortTextItems(sortParam = 'spr_return')">
                            <div class="flex flex-col items-center">
                                <div>Дата возврата спр.</div>
                                <div v-show="sortParam === 'spr_return'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>
                        <!--параметры с/о:-->
                        <template v-if="this.newAssignment.sprReturn">
                            <th class="cursor-pointer min-w-52" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_prevent_crime')">
                                <div class="flex flex-col items-center">
                                    <div>Пр., ст.</div>
                                    <div v-show="sortParam === 'spr_prevent_crime'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_prevent')">
                                <div class="flex flex-col items-center">
                                    <div>Пр., кол-во</div>
                                    <div v-show="sortParam === 'spr_prevent'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>

                            <th class="cursor-pointer min-w-52" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_solved_crime')">
                                <div class="flex flex-col items-center">
                                    <div>Рас., ст.</div>
                                    <div v-show="sortParam === 'spr_solved_crime'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_solved')">
                                <div class="flex flex-col items-center">
                                    <div>Рас., кол-во</div>
                                    <div v-show="sortParam === 'spr_solved'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-52" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_search_crime')">
                                <div class="flex flex-col items-center">
                                    <div>Роз., ст.</div>
                                    <div v-show="sortParam === 'spr_search_crime'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_search')">
                                <div class="flex flex-col items-center">
                                    <div>Роз., кол-во</div>
                                    <div v-show="sortParam === 'spr_search'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-80" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_search_person')">
                                <div class="flex flex-col items-center">
                                    <div>Данные</div>
                                    <div v-show="sortParam === 'spr_search_person'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-32" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_search_date')">
                                <div class="flex flex-col items-center">
                                    <div>Дата</div>
                                    <div v-show="sortParam === 'spr_search_date'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-44" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_dou')">
                                <div class="flex flex-col items-center">
                                    <div>Реал. ДУ</div>
                                    <div v-show="sortParam === 'spr_dou'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-32" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_dou_date')">
                                <div class="flex flex-col items-center">
                                    <div>Дата реал. ДУ</div>
                                    <div v-show="sortParam === 'spr_dou_date'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_crim_liability')">
                                <div class="flex flex-col items-center">
                                    <div>Привл. к отв.</div>
                                    <div v-show="sortParam === 'spr_crim_liability'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_adm_liability')">
                                <div class="flex flex-col items-center">
                                    <div>Привл. к адм. отв.</div>
                                    <div v-show="sortParam === 'spr_adm_liability'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_identity_established')">
                                <div class="flex flex-col items-center">
                                    <div>Спос. устан. личн.</div>
                                    <div v-show="sortParam === 'spr_identity_established'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_connection')">
                                <div class="flex flex-col items-center">
                                    <div>Спос. устан. общ.</div>
                                    <div v-show="sortParam === 'spr_connection'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_live_place')">
                                <div class="flex flex-col items-center">
                                    <div>Спос. устан. мест</div>
                                    <div v-show="sortParam === 'spr_live_place'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_work_place')">
                                <div class="flex flex-col items-center">
                                    <div>Спос. устан. нахожд.</div>
                                    <div v-show="sortParam === 'spr_work_place'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_crim_groups')">
                                <div class="flex flex-col items-center">
                                    <div>Выявл.гр.</div>
                                    <div v-show="sortParam === 'spr_crim_groups'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_crim_groups_count')">
                                <div class="flex flex-col items-center">
                                    <div>Кол-во гр.</div>
                                    <div v-show="sortParam === 'spr_crim_groups_count'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'spr_oper_accounting')">
                                <div class="flex flex-col items-center">
                                    <div>Пост. на уч.</div>
                                    <div v-show="sortParam === 'spr_oper_accounting'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-52" title="сортировка"
                                @click.prevent="sortTextItems(sortParam = 'spr_result_another')">
                                <div class="flex flex-col items-center">
                                    <div>Прочие результаты</div>
                                    <div v-show="sortParam === 'spr_result_another'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'gun')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято о., ед.</div>
                                    <div v-show="sortParam === 'gun'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'bullet')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято б., ед.</div>
                                    <div v-show="sortParam === 'bullet'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-44" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'bang')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято в.,<br>кг.</div>
                                    <div v-show="sortParam === 'bang'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div
                                        class="rounded-md text-white text-xs absolute top-[1.5rem] left-[2.5rem] font-semibold bg-red-700 max-w-20">
                                        {{ this.formErrors.bang }}
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-44" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'drug')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято н.,<br>кг.</div>
                                    <div v-show="sortParam === 'drug'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div
                                        class="rounded-md text-white text-xs absolute top-[1.5rem] left-[2.5rem] font-semibold bg-red-700 max-w-20">
                                        {{ this.formErrors.drug }}
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-44" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'money')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято д.,<br>т.р.</div>
                                    <div v-show="sortParam === 'money'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div
                                        class="rounded-md text-white text-xs absolute top-[1.5rem] left-[2.5rem] font-semibold bg-red-700 max-w-20">
                                        {{ this.formErrors.money }}
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'car')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято т., ед.</div>
                                    <div v-show="sortParam === 'car'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'form')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято ф., ед.</div>
                                    <div v-show="sortParam === 'form'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                            <th class="cursor-pointer min-w-20" title="сортировка"
                                @click.prevent="sortNumItems(sortParam = 'tehn')">
                                <div class="flex flex-col items-center">
                                    <div>Изъято тех., ед.</div>
                                    <div v-show="sortParam === 'tehn'" class="relative">
                                        <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                    </div>
                                </div>
                            </th>
                        </template>
                        <!--/параметры с/о-->

                        <th v-if="onDetail" class="cursor-pointer min-w-20" title="сортировка"
                            @click.prevent="sortNumItems(sortParam = 'autor_id')">
                            <div class="flex flex-col items-center">
                                <div>Заявку внес</div>
                                <div v-show="sortParam === 'autor_id'" class="relative">
                                    <div class="absolute right-[-4px] top-[-4px]">&darr;</div>
                                </div>
                            </div>
                        </th>

                    </tr>
                    </thead>

                    <tbody>
                    <tr class="h-[7rem] bg-purple-400" v-if="onCreateUpdate">
                        <td class="text-xs">{{ newAssignment.id ? newAssignment.id : '-' }}</td>
                        <td>
                            <div>
                                <form id="create_update" @submit.prevent="store">
                                    <div class="">

                                        <div>
                                            <div v-if="!this.buttonBlockVisible" class="flex justify-center">
                                                <button title="очистить" type="button"
                                                        @click.prevent="formClear()"
                                                        class="px-2 ml-1 bg-gray-200 rounded-md hover:bg-gray-400 border border-2 border-red-100">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                         width="15px" height="15px" viewBox="0 0 512 512" fill="red"
                                                         enable-background="new 0 0 512 512" xml:space="preserve">
                                            <g></g>
                                                        <polygon
                                                            points="479.996,95.997 416.004,32.003 256,192.007 95.997,32.003 32.004,95.997 192.008,256 32.004,416.004	95.997,479.996 256,319.992 416.004,479.996 479.996,416.004 319.992,256 "/>
                                            </svg>
                                                </button>
                                                <div class="ml-2"></div>
                                                <button title="создать новое" type="submit"
                                                        class="px-2 py-2 mr-1 bg-gray-300 rounded-md hover:bg-gray-400 border border-2 border-[#cdeddf]">
                                                    <div class="flex">
                                                        <svg fill="green" height="20px" width="16px" version="1.1"
                                                             id="Capa_1"
                                                             xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             viewBox="0 0 128.411 128.411" xml:space="preserve">
                                                <g>
                                                    <g><polygon points="127.526,15.294 45.665,78.216 0.863,42.861 0,59.255 44.479,113.117 128.411,31.666"/></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                    <g></g>
                                                </g>
                                            </svg>
                                                        <span class="ml-2 font-semibold">Добавить</span>
                                                    </div>
                                                </button>
                                            </div>
                                            <div v-if="this.buttonBlockVisible" class="flex justify-center">
                                                <button type="button"
                                                        title="отмена"
                                                        @click.prevent="formClear()"
                                                        class="px-2 ml-1 bg-gray-200 rounded-md hover:bg-gray-400 border border-2 border-red-100">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                         width="15px" height="15px" viewBox="0 0 512 512" fill="red"
                                                         enable-background="new 0 0 512 512" xml:space="preserve">
                                            <g></g>
                                                        <polygon
                                                            points="479.996,95.997 416.004,32.003 256,192.007 95.997,32.003 32.004,95.997 192.008,256 32.004,416.004	95.997,479.996 256,319.992 416.004,479.996 479.996,416.004 319.992,256 "/>
                                            </svg>
                                                </button>
                                                <div class="ml-2"></div>
                                                <button type="submit"
                                                        title="создать копию"
                                                        class="px-2 py-2 mr-1 bg-gray-300 rounded-md hover:bg-gray-400 border border-2 border-[#cdeddf]">
                                                    <div class="flex">

                                                        <span class="font-semibold">копия</span>
                                                    </div>
                                                </button>
                                                <button type="button"
                                                        title="править выбранное"
                                                        @click.prevent="update(this.newAssignment)"
                                                        class="px-2 py-2 mx-1 bg-gray-300 rounded-md hover:bg-gray-400 border border-2 border-[#bbeeff]">
                                                    <div class="flex">

                                                        <span class="font-semibold">правка</span>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="flex items-end">
                                <BlockSelect v-model="newAssignment.numberIndexId"
                                             v-if="!isUserOu"
                                             :values="numberIndexes"
                                             form="create_update"
                                             id="block_select_number_index">
                                </BlockSelect>
                                <span v-if="isUserOu" class="pb-0.5 text-sm">02</span>

                                <span class="pb-0.5">.</span>
                                <input type="text" pattern="\d*" minlength="4" maxlength="4"
                                       v-model="newAssignment.number"
                                       class="max-w-[38px]"
                                       placeholder="9999"
                                       form="create_update">
                                <span class="pb-0.5">.</span>
                                <input type="number" min="0" max="99"
                                       v-model="newAssignment.numberPrefix"
                                       class="max-w-[19px]"
                                       placeholder="24"
                                       form="create_update">
                            </div>
                        </td>
                        <td>
                            <input type="text"
                                   v-model="newAssignment.numberNote"
                                   form="create_update">
                        </td>
                        <td>
                            <input type="date"
                                   v-model="newAssignment.inDate"
                                   form="create_update">
                        </td>
                        <td>
                            <div class="flex items-end">
                                <BlockSelect v-model="newAssignment.baseId"
                                             :values="basics"
                                             form="create_update"
                                             id="block_select_basics">
                                </BlockSelect>
                                <span>№</span>
                                <input type="text"
                                       v-model="newAssignment.baseNumber"
                                       class="max-w-[70px]"
                                       form="create_update">
                            </div>
                        </td>
                        <td>
                            <input type="date"
                                   v-model="newAssignment.baseDate"
                                   form="create_update">
                        </td>
                        <td>
                            <BlockSelect v-model="newAssignment.mainCrimeId"
                                         :values="crimeIds"
                                         form="create_update"
                                         id="block_select_crime_id">
                            </BlockSelect>
                        </td>
                        <td>
                            <div v-if="!this.newAssignment.mainCrimeId" class="w-[125px]">
                                <span>выберите<br>основную<br>ст.</span>
                            </div>
                            <div v-if="this.newAssignment.mainCrimeId" class="">
                                <BlockSelect v-model="newAssignment.additionalCrimeIds"
                                             :values="removeItemById()"
                                             :multiple="true"
                                             form="create_update"
                                             id="block_select_additional_crimes_ids">
                                </BlockSelect>
                            </div>

                        </td>
                        <td>
                            <BlockSelect v-model="newAssignment.employerId"
                                         :values="employerIds"
                                         form="create_update"
                                         id="block_select_employer_id">
                            </BlockSelect>
                        </td>
                        <td>
                            <div v-if="newAssignment.employerId" class="">
                                <span class="">{{ this.foundEmployer.line }}</span><br>
                                <span class="text-gray-400">(№ {{ this.foundEmployer.report_line }})</span>
                            </div>
                            <div v-else class="">н/в</div>
                        </td>
                        <td>
                            <BlockSelect v-model="newAssignment.objectTypeId"
                                         :values="objectTypeIds"
                                         form="create_update"
                                         id="block_select_object_type_id">
                            </BlockSelect>
                        </td>
                        <td v-if="onDetail">
                            <input type="text"
                                   v-model="newAssignment.object"
                                   form="create_update"
                                   class="min-w-[315px]">
                        </td>
                        <td v-if="onDetail">
                            <input type="date"
                                   v-model="newAssignment.objectBirthday"
                                   form="create_update">
                        </td>
                        <td v-if="onDetail">
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.citizenship"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td v-if="onDetail">
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.ethnicity"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td v-if="onDetail">
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.judging"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.itt"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.budget"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.bdsm"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.ptsm"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.quickly"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.transit"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.outsideZone"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.og"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.series"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <div class="block">
                                <checkbox
                                    v-model:checked="newAssignment.withoutExecution"
                                    form="create_update"
                                ></checkbox>
                            </div>
                        </td>
                        <td>
                            <input type="text"
                                   v-model="newAssignment.employerDefect"
                                   form="create_update"
                                   class="min-w-[284px]">
                        </td>
                        <td>
                            <input type="text"
                                   v-model="newAssignment.note"
                                   form="create_update"
                                   class="min-w-[284px]">
                        </td>
                        <td>
                            <input type="date"
                                   v-model="newAssignment.executedDate"
                                   form="create_update">
                        </td>
                        <!--параметры исполнения:-->
                        <template v-if="this.newAssignment.executedDate">
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.page"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <div class="block">
                                    <checkbox
                                        v-model:checked="newAssignment.docControl"
                                        form="create_update"
                                    ></checkbox>
                                </div>
                            </td>
                            <td>
                                <div class="block">
                                    <checkbox
                                        v-model:checked="newAssignment.audioControl"
                                        form="create_update"
                                    ></checkbox>
                                </div>
                            </td>
                            <td>
                                <div class="block">
                                    <checkbox
                                        v-model:checked="newAssignment.trackControl"
                                        form="create_update"
                                    ></checkbox>
                                </div>
                            </td>
                            <td>
                                <div class="block">
                                    <checkbox
                                        v-model:checked="newAssignment.togetherControl"
                                        form="create_update"
                                    ></checkbox>
                                </div>
                            </td>

                            <td>
                                <BlockSelect v-model="newAssignment.executId"
                                             :values="usersForSelect"
                                             form="create_update"
                                             id="block_select_execut_id">
                                </BlockSelect>
                            </td>
                            <!--02:-->
                            <template v-if="this.newAssignment.numberIndexId === 2">
                                <td>
                                    {{ useVideoCheck(newAssignment.videoDevice) ? 'да' : 'нет' }}
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.videoDevice"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.videoDevicePhoto"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.videoDeviceVideo"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.videoDeviceAudio"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    {{ usePhotoCheck(newAssignment.photoDevice) ? 'да' : 'нет' }}
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.photoDevice"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.photoDevicePhoto"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.photoDeviceVideo"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.photoDeviceAudio"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    {{ useAudioCheck(newAssignment.audioDevice) ? 'да' : 'нет' }}
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.audioDevice"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.audioDeviceAudio"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.forUs"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.placeWork"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.relation"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.identRelation"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.isFail"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.region"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.bio"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.copy"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.spravka"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                            </template>
                            <!--/02-->
                            <!--03:-->
                            <template v-if="this.newAssignment.numberIndexId === 3">
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.inputData"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.persons"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.firms"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.transport"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.address"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <input type="number" min="0" max="999"
                                           v-model="newAssignment.photo"
                                           class="max-w-[27px] text-center"
                                           form="create_update"
                                    >
                                </td>
                                <td>
                                    <div class="block">
                                        <checkbox
                                            v-model:checked="newAssignment.scheme"
                                            form="create_update"
                                        ></checkbox>
                                    </div>
                                </td>
                            </template>
                            <!--/03-->

                        </template>
                        <!--/исполнение-->
                        <td>
                            <input type="date"
                                   v-model="newAssignment.sprReturn"
                                   form="create_update">
                        </td>
                        <!--параметры с/о:-->
                        <template v-if="this.newAssignment.sprReturn">
                            <td>
                                <input type="text"
                                       v-model="newAssignment.sprPreventCrime"
                                       form="create_update"
                                       class="min-w-[205px]">
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprPrevent"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.sprSolvedCrime"
                                       form="create_update"
                                       class="min-w-[205px]">
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprSolved"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.sprSearchCrime"
                                       form="create_update"
                                       class="min-w-[205px]">
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprSearch"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.sprSearchPerson"
                                       form="create_update"
                                       class="min-w-[316px]">
                            </td>
                            <td>
                                <input type="date"
                                       v-model="newAssignment.sprSearchDate"
                                       form="create_update">
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.sprDou"
                                       form="create_update"
                                       class="min-w-[172px]">
                            </td>
                            <td>
                                <input type="date"
                                       v-model="newAssignment.sprDouDate"
                                       form="create_update">
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprCrimLiability"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprAdmLiability"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprIdentityEstablished"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprConnection"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprLivePlace"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprWorkPlace"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprCrimGroups"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprCrimGroupsCount"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.sprOperAccounting"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.sprResultAnother"
                                       form="create_update"
                                       class="min-w-[202px]">
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.gun"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="99999"
                                       v-model="newAssignment.bullet"
                                       class="max-w-[40px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.bang"
                                       class="min-w-[150px]"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.drug"
                                       class="min-w-[150px]"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="text"
                                       v-model="newAssignment.money"
                                       class="min-w-[150px]"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.car"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.form"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <td>
                                <input type="number" min="0" max="999"
                                       v-model="newAssignment.tehn"
                                       class="max-w-[27px] text-center"
                                       form="create_update"
                                >
                            </td>
                            <!--/параметры с/о-->
                        </template>
                        <td v-if="onDetail">
                            <span>-</span>
                        </td>


                    </tr>
                    <tr v-for="assignment in assignments" :key="assignment.id" @dblclick="textMarker">
                        <td class="text-xs text-gray-500">{{ assignment.id }}</td>
                        <td>
                            <div class="flex justify-center ">
                                <button type="button"
                                        title="удалить"
                                        @click.prevent="showDeleteDialog(assignment)"
                                        class="px-2 mr-1 bg-gray-200 rounded-md hover:bg-gray-400 border border-2 border-red-100">
                                    <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17"
                                            stroke="red" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button type="button"
                                        title="копия/редактировать"
                                        @click.prevent="dataInForm(assignment)"
                                        class="px-2 py-2 mx-1 bg-gray-300 rounded-md hover:bg-gray-400 border border-2 border-[#cdeddf]">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 6V18M12 6L7 11M12 6L17 11" stroke="green" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button type="button"
                                        title="добавить результаты работы"
                                        @click.prevent="dataInForm(assignment)"
                                        class="px-2 py-2 ml-1 bg-gray-300 rounded-md hover:bg-gray-400 border border-2 border-[#bbeeff]">
                                    +rez
                                </button>
                            </div>

                        </td>
                        <td class="font-semibold">{{ assignment.number_index.name }}.{{
                                assignment.number
                            }}.{{ assignment.number_prefix }}
                        </td>
                        <td>{{ assignment.number_note }}</td>
                        <td class="font-semibold">{{ formatDate(assignment.in_date) }}</td>
                        <td class="font-semibold">{{ assignment.basis.name }} № {{ assignment.base_number }}</td>
                        <td>{{ formatDate(assignment.base_date) }}</td>
                        <td>
                            <div v-for="crime in assignment.crimes" class="">
                                <div v-if="crime.pivot.main" :key="crime.id">
                                    <span class="font-semibold">{{ crime.name }}</span><br>
                                    <hr>
                                    <span class="text-gray-400">(№ {{ crime.report_number }})</span>
                                    <br>
                                    <span class="text-gray-400">{{ crime.note }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div v-for="crime in assignment.crimes" :key="crime.id">
                                <div v-if="!crime.pivot.main" class="">
                                    {{ crime.name }}<br>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-semibold">{{ assignment.employer.name }}</span>
                            <br>
                            <span class="text-gray-400">{{ assignment.employer.territory ? '(тер.орг)' : '' }}</span>
                        </td>
                        <td>
                            <span class="font-semibold">{{ assignment.employer.line }}</span><br>
                            <span class="text-gray-400">(№ {{ assignment.employer.report_line }})</span>
                        </td>
                        <td>{{ assignment.object_type.name }}</td>
                        <td v-if="onDetail">{{ assignment.object }}</td>
                        <td v-if="onDetail">{{ formatDate(assignment.object_birthday) }}</td>
                        <td v-if="onDetail">{{ assignment.citizenship ? 'да' : '' }}</td>
                        <td v-if="onDetail">{{ assignment.ethnicity ? 'да' : '' }}</td>
                        <td v-if="onDetail">{{ assignment.judging ? 'да' : '' }}</td>
                        <td>{{ assignment.itt ? 'да' : '' }}</td>
                        <td>{{ assignment.budget ? 'да' : '' }}</td>
                        <td>{{ assignment.bdsm ? 'да' : '' }}</td>
                        <td>{{ assignment.ptsm ? 'да' : '' }}</td>
                        <td>{{ assignment.quickly ? 'да' : '' }}</td>
                        <td>{{ assignment.transit ? 'да' : '' }}</td>
                        <td>{{ assignment.outside_zone ? 'да' : '' }}</td>
                        <td>{{ assignment.og ? 'да' : '' }}</td>
                        <td>{{ assignment.series ? 'да' : '' }}</td>
                        <td>{{ assignment.without_execution ? 'да' : '' }}</td>
                        <td>{{ assignment.employer_defect }}</td>
                        <td>{{ assignment.note }}</td>
                        <td class="font-semibold executed_column">{{ formatDate(assignment.executed_date) }}</td>
                        <!--параметры исполнения:-->
                        <template v-if="this.newAssignment.executedDate">
                            <td class="executed_column">{{ assignment.page }}</td>
                            <td class="executed_column">{{ assignment.doc_control ? 'да' : '' }}</td>
                            <td class="executed_column">{{ assignment.audio_control ? 'да' : '' }}</td>
                            <td class="executed_column">{{ assignment.track_control ? 'да' : '' }}</td>
                            <td class="executed_column">{{ assignment.together_control ? 'да' : '' }}</td>
                            <td class="executed_column">{{ assignment.user ? assignment.user.nickname : '' }}</td>
                            <!--02:-->
                            <template v-if="this.newAssignment.numberIndexId === 2">
                                <td class="executed_column">{{ assignment.use_video ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.video_device }}</td>
                                <td class="executed_column">{{ assignment.video_device_photo }}</td>
                                <td class="executed_column">{{ assignment.video_device_video }}</td>
                                <td class="executed_column">{{ assignment.video_device_audio }}</td>
                                <td class="executed_column">{{ assignment.use_photo ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.photo_device }}</td>
                                <td class="executed_column">{{ assignment.photo_device_photo }}</td>
                                <td class="executed_column">{{ assignment.photo_device_video }}</td>
                                <td class="executed_column">{{ assignment.photo_device_audio }}</td>
                                <td class="executed_column">{{ assignment.use_audio ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.audio_device }}</td>
                                <td class="executed_column">{{ assignment.audio_device_audio }}</td>
                                <td class="executed_column">{{ assignment.for_us ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.place_work ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.relation }}</td>
                                <td class="executed_column">{{ assignment.ident_relation }}</td>
                                <td class="executed_column">{{ assignment.is_fail ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.region ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.bio ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.copy ? 'да' : '' }}</td>
                                <td class="executed_column">{{ assignment.spravka ? 'да' : '' }}</td>
                            </template>
                            <!--/02-->
                            <!--03:-->
                            <template v-if="newAssignment.numberIndexId === 3">
                                <td class="executed_column">{{ assignment.input_data }}</td>
                                <td class="executed_column">{{ assignment.persons }}</td>
                                <td class="executed_column">{{ assignment.firms }}</td>
                                <td class="executed_column">{{ assignment.transport }}</td>
                                <td class="executed_column">{{ assignment.address }}</td>
                                <td class="executed_column">{{ assignment.photo }}</td>
                                <td class="executed_column">{{ assignment.scheme ? 'да' : '' }}</td>
                            </template>
                            <!--/03-->
                        </template>
                        <td class="font-semibold so_column">{{ formatDate(assignment.spr_return) }}</td>
                        <!--параметры с/о:-->
                        <template v-if="this.newAssignment.sprReturn">
                            <td class="so_column">{{ assignment.spr_prevent_crime }}</td>
                            <td class="so_column">{{ assignment.spr_prevent }}</td>
                            <td class="so_column">{{ assignment.spr_solved_crime }}</td>
                            <td class="so_column">{{ assignment.spr_solved }}</td>
                            <td class="so_column">{{ assignment.spr_search_crime }}</td>
                            <td class="so_column">{{ assignment.spr_search }}</td>
                            <td class="so_column">{{ assignment.spr_search_person }}</td>
                            <td class="so_column">{{ formatDate(assignment.spr_search_date) }}</td>
                            <td class="so_column">{{ assignment.spr_dou }}</td>
                            <td class="so_column">{{ formatDate(assignment.spr_dou_date) }}</td>
                            <td class="so_column">{{ assignment.spr_crim_liability }}</td>
                            <td class="so_column">{{ assignment.spr_adm_liability }}</td>
                            <td class="so_column">{{ assignment.spr_identity_established }}</td>
                            <td class="so_column">{{ assignment.spr_connection }}</td>
                            <td class="so_column">{{ assignment.spr_live_place }}</td>
                            <td class="so_column">{{ assignment.spr_work_place }}</td>
                            <td class="so_column">{{ assignment.spr_crim_groups }}</td>
                            <td class="so_column">{{ assignment.spr_crim_groups_count }}</td>
                            <td class="so_column">{{ assignment.spr_oper_accounting }}</td>
                            <td class="so_column">{{ assignment.spr_result_another }}</td>
                            <td class="so_column">{{ assignment.gun }}</td>
                            <td class="so_column">{{ assignment.bullet }}</td>
                            <td class="so_column">{{ assignment.bang }}</td>
                            <td class="so_column">{{ assignment.drug }}</td>
                            <td class="so_column">{{ assignment.money }}</td>
                            <td class="so_column">{{ assignment.car }}</td>
                            <td class="so_column">{{ assignment.form }}</td>
                            <td class="so_column">{{ assignment.tehn }}</td>
                            <!--/параметры с/о-->
                        </template>
                        <td v-if="onDetail" class="text-xs text-gray-500">{{ assignment.autor_id }}</td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <!--таблица выдачи статистики - конец-->
        </div>


        <!--delete Modal-->
        <my-modal v-model:show="deleteDialogVisible">
            <div class="flex mx-auto flex-col">
                <div class="m-6"><span>Вы уверены, что хотите удалить {{ assignment.number }}?</span></div>
                <text-input autofocus class="w-0"></text-input> <!--нужен для закрытия модалки при нажатии ESC-->
                <div class="flex justify-around mb-4">
                    <secondary-button @click.prevent="hiddenDeleteDialog">отмена</secondary-button>
                    <danger-button @click.prevent="del(value)">удалить</danger-button>
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
    </stat-main>
</template>

<script>
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
import Multiselect from 'vue-multiselect';
import {Inertia} from '@inertiajs/inertia';
import StatMain from "@/Layouts/StatMain.vue";
import BlockSelect from "@/Components/BlockSelect.vue";
import axios from "axios";

export default {
    name: 'StatIndex',
    components: {
        BlockSelect,
        StatMain,
        Checkbox,
        //MyTextArea,
        //InputError,
        MyModal,
        Modal,
        DangerButton,
        SecondaryButton,
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
            deleteDialogVisible: false,
            form: this.$inertia.form({}),
            onCreateUpdate: true,
            onFilter: true,
            onDetail: true,
            buttonBlockVisible: false,
            formErrors: [],
            tempMainCrimeId: '',
            tempAdditionalCrimeIds: [],
            sortParam: '',
            newAssignment: {
                'number': '',
                'numberPrefix': this.getLastTwoDigitsOfYear(),
                'numberNote': '',
                'inDate': this.getCurrentFormattedDate(),
                'baseNumber': '',
                'baseDate': '',
                'object': '',
                'objectBirthday': '',
                'citizenship': false,
                'judging': false,
                'ethnicity': false,
                'itt': false,
                'budget': false,
                'bdsm': false,
                'ptsm': false,
                'quickly': false,
                'transit': false,
                'outsideZone': false,
                'og': false,
                'series': false,
                'withoutExecution': false,
                'executedDate': '',
                'page': '',
                'docControl': false,
                'audioControl': false,
                'trackControl': false,
                'togetherControl': false,
                'employerDefect': '',
                'note': '',
                'useVideo': false,
                'usePhoto': false,
                'useAudio': false,
                'forUs': false,
                'placeWork': false,
                'relation': '',
                'identRelation': '',
                'isFail': false,
                'region': false,
                'bio': false,
                'copy': false,
                'spravka': false,
                'photoDevice': '',
                'photoDevicePhoto': '',
                'photoDeviceVideo': '',
                'photoDeviceAudio': '',
                'videoDevice': '',
                'videoDevicePhoto': '',
                'videoDeviceVideo': '',
                'videoDeviceAudio': '',
                'audioDevice': '',
                'audioDeviceAudio': '',
                'inputData': '',
                'persons': '',
                'firms': '',
                'transport': '',
                'address': '',
                'photo': '',
                'scheme': false,
                'sprReturn': '',
                'sprPreventCrime': '',
                'sprPrevent': '',
                'sprSolvedCrime': '',
                'sprSolved': '',
                'sprSearchCrime': '',
                'sprSearch': '',
                'sprSearchPerson': '',
                'sprSearchDate': '',
                'sprDou': '',
                'sprDouDate': '',
                'sprCrimLiability': '',
                'sprAdmLiability': '',
                'sprIdentityEstablished': '',
                'sprConnection': '',
                'sprLivePlace': '',
                'sprWorkPlace': '',
                'sprCrimGroups': '',
                'sprCrimGroupsCount': '',
                'sprOperAccounting': '',
                'sprResultAnother': '',
                'gun': '',
                'bullet': '',
                'bang': '',
                'drug': '',
                'money': '',
                'car': '',
                'form': '',
                'tehn': '',
                'autorId': this.$page.props.auth.user.id,
                'numberIndexId': this.getNumberIndexId(),
                'baseId': '',
                'mainCrimeId': '',
                'additionalCrimeIds': [],
                'employerId': '',
                'objectTypeId': 1,
                'executId': '',
            },


        }
    },

    props: [
        'numberIndexes',
        'assignments',
        'basics',
        'isUserOu',
        'objectTypeIds',
        'crimeIds',
        'employerIds',
        'usersForSelect',

    ],

    methods: {
        getLastTwoDigitsOfYear() {
            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const lastTwoDigits = year.toString().slice(-2);
            return lastTwoDigits;
        },

        getCurrentFormattedDate() {
            const currentDate = new Date();

            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, '0');
            const day = String(currentDate.getDate()).padStart(2, '0');

            return `${year}-${month}-${day}`;
        },

        getNumberIndexId() {
            if (this.isUserOu) {
                this.newAssignment = this.newAssignment || {};
                this.newAssignment.numberIndexId = 2;
                return this.newAssignment.numberIndexId;
            } else {
                return null;
            }
        },

        formatDate(dateStr) {
            // Проверяем на null
            if (!dateStr) {
                return '';
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

        removeItemById() {
            const newObj = this.crimeIds.filter(item => item.id !== this.newAssignment.mainCrimeId);
            return newObj;
        },

        formErrorsNumber() {
            if (this.formErrors.number || this.formErrors.number_prefix || this.formErrors.number_index_id) {
                return 'Заполните корректно'
            } else {
                return ''
            }
        },

        parseNumber(inputValue) {
            // Проверка на пустое значение
            if (!inputValue) {
                return null; // Возвращаем null или другое значение для пустого поля
            }

            // Заменяем запятые на точки
            inputValue = inputValue.replace(',', '.');

            // Парсим строку в число
            let floatValue = parseFloat(inputValue);

            // Проверка на корректность числа
            if (!isNaN(floatValue)) {
                return floatValue; // Возвращаем корректное значение
            } else {
                return "текст"; // Возвращаем null или другое значение в случае ошибки
            }
        },

        handleKeyDown(event) {
            // Проверка, находится ли фокус в input
            const inputElements = ['input', 'textarea']; // Типы элементов input, в которых не должна работать прокрутка
            if (inputElements.includes(document.activeElement.tagName.toLowerCase())) {
                return; // Не выполнять прокрутку, если фокус в input
            }

            const content = document.getElementById('stat_content');
            const scrollAmount = 50; // Обычное количество пикселей для прокрутки
            const scrollAmountCtrl = 1700; // Увеличенное количество пикселей для прокрутки при удержании Ctrl

            if (event.key === 'ArrowLeft') {
                if (event.ctrlKey) {
                    content.scrollLeft -= scrollAmountCtrl; // Прокрутка влево при нажатии стрелки влево с удержанием Ctrl
                } else {
                    content.scrollLeft -= scrollAmount; // Прокрутка влево при нажатии стрелки влево
                }
            } else if (event.key === 'ArrowRight') {
                if (event.ctrlKey) {
                    content.scrollLeft += scrollAmountCtrl; // Прокрутка вправо при нажатии стрелки вправо с удержанием Ctrl
                } else {
                    content.scrollLeft += scrollAmount; // Прокрутка вправо при нажатии стрелки вправо
                }
            }
        },

        textMarker(event) {
            (event.currentTarget.className === 'text_shadow') ? (event.currentTarget.className = '') : (event.currentTarget.className = 'text_shadow');
        },

        sortTextItems(sortParam) {
            this.assignments.sort((item1, item2) => {
                const text1 = item1[sortParam] ?? '';
                const text2 = item2[sortParam] ?? '';

                if (text1 === '' && text2 !== '') {
                    return 1;
                }
                if (text1 !== '' && text2 === '') {
                    return -1;
                }

                return text1.localeCompare(text2);
            });
        },

        sortNumItems(sortParam) {
            this.assignments.sort((item1, item2) => {
                if (item1[sortParam] === null || item1[sortParam] === undefined) {
                    return 1;
                }
                if (item2[sortParam] === null || item2[sortParam] === undefined) {
                    return -1;
                }
                return item1[sortParam] - item2[sortParam];
            })
        },


        sortBoolItems(sortParam) {
            this.assignments.sort((item1, item2) => {
                if (item1[sortParam] && !item2[sortParam]) {
                    return -1; // Поместить item1 перед item2
                } else if (!item1[sortParam] && item2[sortParam]) {
                    return 1; // Поместить item2 перед item1
                } else {
                    return 0; // Сохранить текущий порядок
                }
            });
        },


        showDeleteDialog(assignment) {
            this.deleteDialogVisible = true;
            this.assignment = assignment;
        },
        hiddenDeleteDialog() {
            this.deleteDialogVisible = false;
        },
        del(assignment) {
            this.isLoading = true;
            this.form = this.$inertia.form(this.assignment);
            this.form.delete(`/statistics/${this.assignment.id}`, {
                onFinish: () => {
                    this.deleteDialogVisible = false;
                    this.isLoading = false;
                }
            });
        },

        useVideoCheck(devCount) {
            devCount ? this.newAssignment.useVideo = true : this.newAssignment.useVideo = false;
            return this.newAssignment.useVideo;
        },
        usePhotoCheck(devCount) {
            devCount ? this.newAssignment.usePhoto = true : this.newAssignment.usePhoto = false;
            return this.newAssignment.usePhoto;
        },
        useAudioCheck(devCount) {
            devCount ? this.newAssignment.useAudio = true : this.newAssignment.useAudio = false;
            return this.newAssignment.useAudio;
        },

        dataInForm(assignment) {
            this.onCreateUpdate = true;
            this.buttonBlockVisible = true;

            let self = this; // сохраняем контекст в переменной self
            assignment.crimes.forEach(function (item) {
                if (item.pivot.main) {
                    self.tempMainCrimeId = item.id;
                }
                if (!item.pivot.main) {
                    self.tempAdditionalCrimeIds.push(item.id);
                }
            });

            this.newAssignment.id = assignment.id;

            this.newAssignment.number = assignment.number;
            this.newAssignment.numberPrefix = assignment.number_prefix;
            this.newAssignment.numberNote = assignment.number_note;
            this.newAssignment.inDate = assignment.in_date;
            this.newAssignment.baseNumber = assignment.base_number;
            this.newAssignment.baseDate = assignment.base_date;
            this.newAssignment.object = assignment.object;
            this.newAssignment.objectBirthday = assignment.object_birthday;
            this.newAssignment.citizenship = !!assignment.citizenship;
            this.newAssignment.judging = !!assignment.judging;
            this.newAssignment.ethnicity = !!assignment.ethnicity;
            this.newAssignment.itt = !!assignment.itt;
            this.newAssignment.budget = !!assignment.budget;
            this.newAssignment.bdsm = !!assignment.bdsm;
            this.newAssignment.ptsm = !!assignment.ptsm;
            this.newAssignment.quickly = !!assignment.quickly;
            this.newAssignment.transit = !!assignment.transit;
            this.newAssignment.outsideZone = !!assignment.outside_zone;
            this.newAssignment.og = !!assignment.og;
            this.newAssignment.series = !!assignment.series;
            this.newAssignment.withoutExecution = !!assignment.without_execution;
            this.newAssignment.executedDate = assignment.executed_date;
            this.newAssignment.page = assignment.page;
            this.newAssignment.docControl = !!assignment.doc_control;
            this.newAssignment.audioControl = !!assignment.audio_control;
            this.newAssignment.trackControl = !!assignment.track_control;
            this.newAssignment.togetherControl = !!assignment.together_control;
            this.newAssignment.employerDefect = assignment.employer_defect;
            this.newAssignment.note = assignment.note;
            this.newAssignment.useVideo = !!assignment.use_video;
            this.newAssignment.usePhoto = !!assignment.use_photo;
            this.newAssignment.useAudio = !!assignment.use_audio;
            this.newAssignment.forUs = !!assignment.for_us;
            this.newAssignment.placeWork = !!assignment.place_work;
            this.newAssignment.relation = assignment.relation;
            this.newAssignment.identRelation = assignment.ident_relation;
            this.newAssignment.isFail = !!assignment.is_fail;
            this.newAssignment.region = !!assignment.region;
            this.newAssignment.bio = !!assignment.bio;
            this.newAssignment.copy = !!assignment.copy;
            this.newAssignment.spravka = !!assignment.spravka;
            this.newAssignment.photoDevice = assignment.photo_device;
            this.newAssignment.photoDevicePhoto = assignment.photo_device_photo;
            this.newAssignment.photoDeviceVideo = assignment.photo_device_video;
            this.newAssignment.photoDeviceAudio = assignment.photo_device_audio;
            this.newAssignment.videoDevice = assignment.video_device;
            this.newAssignment.videoDevicePhoto = assignment.video_device_photo;
            this.newAssignment.videoDeviceVideo = assignment.video_device_video;
            this.newAssignment.videoDeviceAudio = assignment.video_device_audio;
            this.newAssignment.audioDevice = assignment.audio_device;
            this.newAssignment.audioDeviceAudio = assignment.audio_device_audio;
            this.newAssignment.inputData = assignment.input_data;
            this.newAssignment.persons = assignment.persons;
            this.newAssignment.firms = assignment.firms;
            this.newAssignment.transport = assignment.transport;
            this.newAssignment.address = assignment.address;
            this.newAssignment.photo = assignment.photo;
            this.newAssignment.scheme = !!assignment.scheme;
            this.newAssignment.sprReturn = assignment.spr_return;
            this.newAssignment.sprPreventCrime = assignment.spr_prevent_crime;
            this.newAssignment.sprPrevent = assignment.spr_prevent;
            this.newAssignment.sprSolvedCrime = assignment.spr_solved_crime;
            this.newAssignment.sprSolved = assignment.spr_solved;
            this.newAssignment.sprSearchCrime = assignment.spr_search_crime;
            this.newAssignment.sprSearch = assignment.spr_search;
            this.newAssignment.sprSearchPerson = assignment.spr_search_person;
            this.newAssignment.sprSearchDate = assignment.spr_search_date;
            this.newAssignment.sprDou = assignment.spr_dou;
            this.newAssignment.sprDouDate = assignment.spr_dou_date;
            this.newAssignment.sprCrimLiability = assignment.spr_crim_liability;
            this.newAssignment.sprAdmLiability = assignment.spr_adm_liability;
            this.newAssignment.sprIdentityEstablished = assignment.spr_identity_established;
            this.newAssignment.sprConnection = assignment.spr_connection;
            this.newAssignment.sprLivePlace = assignment.spr_live_place;
            this.newAssignment.sprWorkPlace = assignment.spr_work_place;
            this.newAssignment.sprCrimGroups = assignment.spr_crim_groups;
            this.newAssignment.sprCrimGroupsCount = assignment.spr_crim_groups_count;
            this.newAssignment.sprOperAccounting = assignment.spr_oper_accounting;
            this.newAssignment.sprResultAnother = assignment.spr_result_another;
            this.newAssignment.gun = assignment.gun;
            this.newAssignment.bullet = assignment.bullet;
            this.newAssignment.bang = assignment.bang;
            this.newAssignment.drug = assignment.drug;
            this.newAssignment.money = assignment.money;
            this.newAssignment.car = assignment.car;
            this.newAssignment.form = assignment.form;
            this.newAssignment.tehn = assignment.tehn;
            this.newAssignment.autorId = assignment.autor_id;
            this.newAssignment.numberIndexId = assignment.number_index_id;
            this.newAssignment.baseId = assignment.base_id;
            this.newAssignment.mainCrimeId = this.tempMainCrimeId;
            this.newAssignment.additionalCrimeIds = this.tempAdditionalCrimeIds;
            this.newAssignment.employerId = assignment.employer_id;
            this.newAssignment.objectTypeId = assignment.object_type_id;
            this.newAssignment.executId = assignment.execut_id;

        },


        formClear() {

            this.tempMainCrimeId = '';
            this.tempAdditionalCrimeIds = [];

            this.newAssignment.id = '';
            this.newAssignment.number = '';
            this.newAssignment.numberPrefix = this.getLastTwoDigitsOfYear();
            this.newAssignment.numberNote = '';
            this.newAssignment.inDate = this.getCurrentFormattedDate();
            this.newAssignment.baseNumber = '';
            this.newAssignment.baseDate = '';
            this.newAssignment.object = '';
            this.newAssignment.objectBirthday = '';
            this.newAssignment.citizenship = false;
            this.newAssignment.judging = false;
            this.newAssignment.ethnicity = false;
            this.newAssignment.itt = false;
            this.newAssignment.budget = false;
            this.newAssignment.bdsm = false;
            this.newAssignment.ptsm = false;
            this.newAssignment.quickly = false;
            this.newAssignment.transit = false;
            this.newAssignment.outsideZone = false;
            this.newAssignment.og = false;
            this.newAssignment.series = false;
            this.newAssignment.withoutExecution = false;
            this.newAssignment.executedDate = '';
            this.newAssignment.page = '';
            this.newAssignment.docControl = false;
            this.newAssignment.audioControl = false;
            this.newAssignment.trackControl = false;
            this.newAssignment.togetherControl = false;
            this.newAssignment.employerDefect = '';
            this.newAssignment.note = '';
            this.newAssignment.useVideo = false;
            this.newAssignment.usePhoto = false;
            this.newAssignment.useAudio = false;
            this.newAssignment.forUs = false;
            this.newAssignment.placeWork = false;
            this.newAssignment.relation = '';
            this.newAssignment.identRelation = '';
            this.newAssignment.isFail = false;
            this.newAssignment.region = false;
            this.newAssignment.bio = false;
            this.newAssignment.copy = false;
            this.newAssignment.spravka = false;
            this.newAssignment.photoDevice = '';
            this.newAssignment.photoDevicePhoto = '';
            this.newAssignment.photoDeviceVideo = '';
            this.newAssignment.photoDeviceAudio = '';
            this.newAssignment.videoDevice = '';
            this.newAssignment.videoDevicePhoto = '';
            this.newAssignment.videoDeviceVideo = '';
            this.newAssignment.videoDeviceAudio = '';
            this.newAssignment.audioDevice = '';
            this.newAssignment.audioDeviceAudio = '';
            this.newAssignment.inputData = '';
            this.newAssignment.persons = '';
            this.newAssignment.firms = '';
            this.newAssignment.transport = '';
            this.newAssignment.address = '';
            this.newAssignment.photo = '';
            this.newAssignment.scheme = false;
            this.newAssignment.sprReturn = '';
            this.newAssignment.sprPreventCrime = '';
            this.newAssignment.sprPrevent = '';
            this.newAssignment.sprSolvedCrime = '';
            this.newAssignment.sprSolved = '';
            this.newAssignment.sprSearchCrime = '';
            this.newAssignment.sprSearch = '';
            this.newAssignment.sprSearchPerson = '';
            this.newAssignment.sprSearchDate = '';
            this.newAssignment.sprDou = '';
            this.newAssignment.sprDouDate = '';
            this.newAssignment.sprCrimLiability = '';
            this.newAssignment.sprAdmLiability = '';
            this.newAssignment.sprIdentityEstablished = '';
            this.newAssignment.sprConnection = '';
            this.newAssignment.sprLivePlace = '';
            this.newAssignment.sprWorkPlace = '';
            this.newAssignment.sprCrimGroups = '';
            this.newAssignment.sprCrimGroupsCount = '';
            this.newAssignment.sprOperAccounting = '';
            this.newAssignment.sprResultAnother = '';
            this.newAssignment.gun = '';
            this.newAssignment.bullet = '';
            this.newAssignment.bang = '';
            this.newAssignment.drug = '';
            this.newAssignment.money = '';
            this.newAssignment.car = '';
            this.newAssignment.form = '';
            this.newAssignment.tehn = '';
            this.newAssignment.autorId = this.$page.props.auth.user.id;
            this.newAssignment.numberIndexId = this.getNumberIndexId();
            this.newAssignment.baseId = '';
            this.newAssignment.mainCrimeId = '';
            this.newAssignment.additionalCrimeIds = [];
            this.newAssignment.employerId = '';
            this.newAssignment.objectTypeId = 1;
            this.newAssignment.executId = '';

            this.buttonBlockVisible = false;
        },


        // sort() {
        //     return this.crimes.sort((a, b) => {
        //         if (a.name < b.name) {
        //             return -1;
        //         }
        //         if (a.name > b.name) {
        //             return 1;
        //         }
        //         return 0;
        //     });
        // },

        store() {
            // this.newAssignment.id = '';
            // this.form = this.$inertia.form(this.newAssignment);
            this.$inertia.post('/statistics', {
                number: this.newAssignment.number,
                number_prefix: this.newAssignment.numberPrefix,
                number_note: this.newAssignment.numberNote,
                in_date: this.newAssignment.inDate,
                base_number: this.newAssignment.baseNumber,
                base_date: this.newAssignment.baseDate,
                object: this.newAssignment.object,
                object_birthday: this.newAssignment.objectBirthday,
                citizenship: this.newAssignment.citizenship,
                judging: this.newAssignment.judging,
                ethnicity: this.newAssignment.ethnicity,
                itt: this.newAssignment.itt,
                budget: this.newAssignment.budget,
                bdsm: this.newAssignment.bdsm,
                ptsm: this.newAssignment.ptsm,
                quickly: this.newAssignment.quickly,
                transit: this.newAssignment.transit,
                outside_zone: this.newAssignment.outsideZone,
                og: this.newAssignment.og,
                series: this.newAssignment.series,
                without_execution: this.newAssignment.withoutExecution,
                executed_date: this.newAssignment.executedDate,
                page: this.newAssignment.page,
                doc_control: this.newAssignment.docControl,
                audio_control: this.newAssignment.audioControl,
                track_control: this.newAssignment.trackControl,
                together_control: this.newAssignment.togetherControl,
                employer_defect: this.newAssignment.employerDefect,
                note: this.newAssignment.note,
                use_video: this.newAssignment.useVideo,
                use_photo: this.newAssignment.usePhoto,
                use_audio: this.newAssignment.useAudio,
                for_us: this.newAssignment.forUs,
                place_work: this.newAssignment.placeWork,
                relation: this.newAssignment.relation,
                ident_relation: this.newAssignment.identRelation,
                is_fail: this.newAssignment.isFail,
                region: this.newAssignment.region,
                bio: this.newAssignment.bio,
                copy: this.newAssignment.copy,
                spravka: this.newAssignment.spravka,
                photo_device: this.newAssignment.photoDevice,
                photo_device_photo: this.newAssignment.photoDevicePhoto,
                photo_device_video: this.newAssignment.photoDeviceVideo,
                photo_device_audio: this.newAssignment.photoDeviceAudio,
                video_device: this.newAssignment.videoDevice,
                video_device_photo: this.newAssignment.videoDevicePhoto,
                video_device_video: this.newAssignment.videoDeviceVideo,
                video_device_audio: this.newAssignment.videoDeviceAudio,
                audio_device: this.newAssignment.audioDevice,
                audio_device_audio: this.newAssignment.audioDeviceAudio,
                input_data: this.newAssignment.inputData,
                persons: this.newAssignment.persons,
                firms: this.newAssignment.firms,
                transport: this.newAssignment.transport,
                address: this.newAssignment.address,
                photo: this.newAssignment.photo,
                scheme: this.newAssignment.scheme,
                spr_return: this.newAssignment.sprReturn,
                spr_prevent_crime: this.newAssignment.sprPreventCrime,
                spr_prevent: this.newAssignment.sprPrevent,
                spr_solved_crime: this.newAssignment.sprSolvedCrime,
                spr_solved: this.newAssignment.sprSolved,
                spr_search_crime: this.newAssignment.sprSearchCrime,
                spr_search: this.newAssignment.sprSearch,
                spr_search_person: this.newAssignment.sprSearchPerson,
                spr_search_date: this.newAssignment.sprSearchDate,
                spr_dou: this.newAssignment.sprDou,
                spr_dou_date: this.newAssignment.sprDouDate,
                spr_crim_liability: this.newAssignment.sprCrimLiability,
                spr_adm_liability: this.newAssignment.sprAdmLiability,
                spr_identity_established: this.newAssignment.sprIdentityEstablished,
                spr_connection: this.newAssignment.sprConnection,
                spr_live_place: this.newAssignment.sprLivePlace,
                spr_work_place: this.newAssignment.sprWorkPlace,
                spr_crim_groups: this.newAssignment.sprCrimGroups,
                spr_crim_groups_count: this.newAssignment.sprCrimGroupsCount,
                spr_oper_accounting: this.newAssignment.sprOperAccounting,
                spr_result_another: this.newAssignment.sprResultAnother,
                gun: this.newAssignment.gun,
                bullet: this.newAssignment.bullet,
                bang: this.parseNumber(this.newAssignment.bang),
                drug: this.parseNumber(this.newAssignment.drug),
                money: this.parseNumber(this.newAssignment.money),
                car: this.newAssignment.car,
                form: this.newAssignment.form,
                tehn: this.newAssignment.tehn,
                autor_id: this.newAssignment.autorId,
                number_index_id: this.newAssignment.numberIndexId,
                base_id: this.newAssignment.baseId,
                main_crime_id: this.newAssignment.mainCrimeId,
                additional_crimes_ids: this.newAssignment.additionalCrimeIds,
                employer_id: this.newAssignment.employerId,
                object_type_id: this.newAssignment.objectTypeId,
                execut_id: this.newAssignment.executId,
            }, {
                onBefore: (visit) => {
                },
                onStart: (visit) => {
                },
                onProgress: (progress) => {
                },
                onSuccess: (page) => {
                    this.isLoading = false;
                    this.formErrors = [];
                    this.formClear();
                },
                onError: (errors) => {
                    this.isLoading = false;
                    this.formErrors = errors;
                    // console.log(this.formErrors);
                },
                onCancel: () => {
                },
                onFinish: () => {

                }
            });


        },

        update(assignment) {
            this.isLoading = true;

            this.$inertia.patch(`/statistics/${assignment.id}`, {
                number: this.newAssignment.number,
                number_prefix: this.newAssignment.numberPrefix,
                number_note: this.newAssignment.numberNote,
                in_date: this.newAssignment.inDate,
                base_number: this.newAssignment.baseNumber,
                base_date: this.newAssignment.baseDate,
                object: this.newAssignment.object,
                object_birthday: this.newAssignment.objectBirthday,
                citizenship: this.newAssignment.citizenship,
                judging: this.newAssignment.judging,
                ethnicity: this.newAssignment.ethnicity,
                itt: this.newAssignment.itt,
                budget: this.newAssignment.budget,
                bdsm: this.newAssignment.bdsm,
                ptsm: this.newAssignment.ptsm,
                quickly: this.newAssignment.quickly,
                transit: this.newAssignment.transit,
                outside_zone: this.newAssignment.outsideZone,
                og: this.newAssignment.og,
                series: this.newAssignment.series,
                without_execution: this.newAssignment.withoutExecution,
                executed_date: this.newAssignment.executedDate,
                page: this.newAssignment.page,
                doc_control: this.newAssignment.docControl,
                audio_control: this.newAssignment.audioControl,
                track_control: this.newAssignment.trackControl,
                together_control: this.newAssignment.togetherControl,
                employer_defect: this.newAssignment.employerDefect,
                note: this.newAssignment.note,
                use_video: this.newAssignment.useVideo,
                use_photo: this.newAssignment.usePhoto,
                use_audio: this.newAssignment.useAudio,
                for_us: this.newAssignment.forUs,
                place_work: this.newAssignment.placeWork,
                relation: this.newAssignment.relation,
                ident_relation: this.newAssignment.identRelation,
                is_fail: this.newAssignment.isFail,
                region: this.newAssignment.region,
                bio: this.newAssignment.bio,
                copy: this.newAssignment.copy,
                spravka: this.newAssignment.spravka,
                photo_device: this.newAssignment.photoDevice,
                photo_device_photo: this.newAssignment.photoDevicePhoto,
                photo_device_video: this.newAssignment.photoDeviceVideo,
                photo_device_audio: this.newAssignment.photoDeviceAudio,
                video_device: this.newAssignment.videoDevice,
                video_device_photo: this.newAssignment.videoDevicePhoto,
                video_device_video: this.newAssignment.videoDeviceVideo,
                video_device_audio: this.newAssignment.videoDeviceAudio,
                audio_device: this.newAssignment.audioDevice,
                audio_device_audio: this.newAssignment.audioDeviceAudio,
                input_data: this.newAssignment.inputData,
                persons: this.newAssignment.persons,
                firms: this.newAssignment.firms,
                transport: this.newAssignment.transport,
                address: this.newAssignment.address,
                photo: this.newAssignment.photo,
                scheme: this.newAssignment.scheme,
                spr_return: this.newAssignment.sprReturn,
                spr_prevent_crime: this.newAssignment.sprPreventCrime,
                spr_prevent: this.newAssignment.sprPrevent,
                spr_solved_crime: this.newAssignment.sprSolvedCrime,
                spr_solved: this.newAssignment.sprSolved,
                spr_search_crime: this.newAssignment.sprSearchCrime,
                spr_search: this.newAssignment.sprSearch,
                spr_search_person: this.newAssignment.sprSearchPerson,
                spr_search_date: this.newAssignment.sprSearchDate,
                spr_dou: this.newAssignment.sprDou,
                spr_dou_date: this.newAssignment.sprDouDate,
                spr_crim_liability: this.newAssignment.sprCrimLiability,
                spr_adm_liability: this.newAssignment.sprAdmLiability,
                spr_identity_established: this.newAssignment.sprIdentityEstablished,
                spr_connection: this.newAssignment.sprConnection,
                spr_live_place: this.newAssignment.sprLivePlace,
                spr_work_place: this.newAssignment.sprWorkPlace,
                spr_crim_groups: this.newAssignment.sprCrimGroups,
                spr_crim_groups_count: this.newAssignment.sprCrimGroupsCount,
                spr_oper_accounting: this.newAssignment.sprOperAccounting,
                spr_result_another: this.newAssignment.sprResultAnother,
                gun: this.newAssignment.gun,
                bullet: this.newAssignment.bullet,
                bang: this.parseNumber(this.newAssignment.bang),
                drug: this.parseNumber(this.newAssignment.drug),
                money: this.parseNumber(this.newAssignment.money),
                car: this.newAssignment.car,
                form: this.newAssignment.form,
                tehn: this.newAssignment.tehn,
                autor_id: this.newAssignment.autorId,
                number_index_id: this.newAssignment.numberIndexId,
                base_id: this.newAssignment.baseId,
                main_crime_id: this.newAssignment.mainCrimeId,
                additional_crimes_ids: this.newAssignment.additionalCrimeIds,
                employer_id: this.newAssignment.employerId,
                object_type_id: this.newAssignment.objectTypeId,
                execut_id: this.newAssignment.executId,
            }, {
                onBefore: (visit) => {
                },
                onStart: (visit) => {
                },
                onProgress: (progress) => {
                },
                onSuccess: (page) => {
                    this.isLoading = false;
                    this.formErrors = [];
                    this.formClear();
                    this.buttonBlockVisible = false;
                },
                onError: (errors) => {
                    this.isLoading = false;
                    this.formErrors = errors;
                    // console.log(this.formErrors);
                },
                onCancel: () => {
                },
                onFinish: () => {

                }
            });

        }


    },


    computed: {
        foundEmployer() {
            return this.employerIds.find(employer => employer.id === this.newAssignment.employerId);
        },
    },


    mounted() {
        // console.log(this.newAssignment);

        //горизонт.скролл добавляем прослушивание событий нажатия клавиш
        window.addEventListener('keydown', this.handleKeyDown);
    },

    beforeUnmount() {
        //горизонт.скролл удаляем прослушивание событий перед удалением компонента
        window.removeEventListener('keydown', this.handleKeyDown);
    },

}


</script>

<style scoped>

table td, th {
    border: thin solid #CFCFCF;
    text-align: center;
}

table td:first-child {
    border: thin solid #CFCFCF;
}

table td:last-child {
    border: thin solid #CFCFCF;
}

input {
    border: none;
    border-radius: 0.2rem;
    padding: 0;
    background-color: #cdeddf;
    font-size: 14px;
    color: #000;
}

input::placeholder {
    font-size: 14px;
    color: #B9B9B9;
}

select {
    padding: 2px 4px 2px 0;
    background-color: #E0E0E0;
    border: none;
    color: #000;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    appearance: none;
    margin: 0;
}


#stat_content {
//scrollbar-width: thin; /* Ширина вертикальной скролл-полосы */
}

#stat_content {
    scrollbar-color: #2E8B57 #f1f1f1; /* Цвет скролл-бара и фона скролл-полосы */
}

#stat_content::-webkit-scrollbar-thumb {
    background: #888; /* Цвет скролл-бара */
}

#stat_content::-webkit-scrollbar-thumb:hover {
    background: #555; /* Цвет скролл-бара при наведении */
}

#stat_content::-webkit-scrollbar-button {
    background: #2E8B57; /* Цвет кнопок скролл-полосы */
}

#stat_content::-webkit-scrollbar-button:hover {
    background: #000; /* Цвет кнопок скролл-полосы при наведении */
}

.executed_column {
    background-color: #fefed7;
    box-shadow: inherit;
}

.so_column {
    background-color: #F4EEF8;
    box-shadow: inherit;
}

.text_shadow {
    box-shadow: inset 0 15px 10px -7px rgba(253, 186, 116, 0.5), inset 0 -15px 10px -7px rgba(253, 186, 116, 0.5);
}




</style>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<style lang="scss">
@import "resources/css/syles.scss";
</style>
