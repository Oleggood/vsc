<template>
    <div>
        <div :class="[(this.errorLocal && this.errorLocal.length) ? 'form-item_select_error': '']">
            <Multiselect v-if="group"
                         v-model="selected"
                         :options="values"
                         :group-select="group"
                         :multiple="multiple"
                         :limit="limit ? limit : 9999"
                         track-by="id"
                         :label="label ? label : 'name'"
                         placeholder=""
                         selectLabel=" "
                         selectGroupLabel=" "
                         deselectLabel=" "
                         deselectGroupLabel=" "
                         selectedLabel=""
                         group-label="name"
                         @update:model-value="changeValue"
                         :limitText="(count) => `+ ${count}`"
                         group-values="items">
                <template v-slot:noResult>Не найдено</template>
                <template v-slot:noOptions>Список пуст</template>
            </Multiselect>
            <Multiselect v-else-if="type == 'simple'"
                         v-model="selected"
                         placeholder=""
                         :multiple="multiple"
                         selectLabel=" "
                         deselectLabel=" "
                         selectedLabel=""
                         @update:model-value="changeValue"
                         :options="values">
                <template v-slot:noResult>Не найдено</template>
                <template v-slot:noOptions>Список пуст</template>
            </Multiselect>
            <Multiselect v-else
                         v-model="selected"
                         :options="values"
                         :multiple="multiple"
                         :limit="limit ? limit : 9999"
                         track-by="id"
                         placeholder=""
                         selectLabel=" "
                         deselectLabel=" "
                         selectedLabel=""
                         @update:model-value="changeValue"
                         :limitText="(count) => `+ ${count}`"
                         :label="label ? label : 'name'">
                <template v-slot:noResult>Не найдено</template>
                <template v-slot:noOptions>Список пуст</template>
            </Multiselect>
        </div>
        <p class="mb-0 mt-2 text-danger lh-1" v-if="this.errorLocal">{{ this.errorLocal }}</p>
    </div>
</template>

<script>
import {Multiselect} from 'vue-multiselect'

export default {
    components: {
        Multiselect
    },
    name: "BlockSelect",
    props: {
        limit: Number,
        label: String,
        values: Array,
        modelValue: [Array, String, Number],
        error: String,
        group: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        },
        noEnterLabel: false,
    },

    data()
    {
        return {
            type: this.checkType(),
            selected_id: this.modelValue,
            label_top: false,
            errorLocal: this.error,
            selected: null
        }
    },
    mounted()
    {
        this.setValue();
    },
    methods: {
        checkType()
        {
            let type = 'simple'
            if (
                this.values !== undefined && this.values[0] !== undefined &&
                (this.values[0]['id'] || this.values[0]['id'] === 0 || this.values[0]['id'] === '0' || this.values[0]['id'] === '')
            ) {
                type = 'multi'
            }
            return type;
        },
        setValue()
        {
            this.selected_id = this.modelValue;
            let search = [];
            if (this.type == 'simple') {
                this.selected = this.selected_id;
            } else {
                if (this.selected_id || this.selected_id === 0 || this.selected_id === '0') {
                    if (this.group) {
                        for (let i in this.values) {
                            search = search.concat(this.values[i].items);
                        }
                    } else {
                        search = this.values;
                    }
                    if (this.multiple) {
                        this.selected = [];
                        for (let i in search) {
                            if (search[i].id && this.selected_id.indexOf(search[i].id) != -1) {
                                this.selected.push(search[i]);
                            }
                        }
                    } else {
                        this.selected = null;
                        for (let i in search) {
                            if (search[i].id == this.selected_id) {
                                this.selected = search[i];
                            }
                        }
                    }
                } else {
                    this.selected = null;
                }
            }
        },
        changeValue()
        {
            this.errorLocal = '';
            if (this.multiple) {
                this.selected_id = [];
                if (this.selected && this.selected.length) {
                    for (let i in this.selected) {
                        if (this.type == 'simple') {
                            this.selected_id.push(this.selected[i]);
                        } else {
                            this.selected_id.push(this.selected[i].id);
                        }
                    }
                }
            } else {
                this.selected_id = null
                if (this.selected && Object.keys(this.selected).length) {
                    if (this.type == 'simple') {
                        this.selected_id = this.selected;
                    } else {
                        this.selected_id = this.selected.id;
                    }
                }
            }
            this.$emit('update:modelValue', this.selected_id);
        },
    },
    watch: {
        modelValue: function ()
        {
            this.setValue();
        },
        values: function ()
        {
            this.type = this.checkType();
            this.setValue();
        },
        error: function ()
        {
            this.errorLocal = this.error;
        },
    }
}
</script>

<style scoped>

</style>
