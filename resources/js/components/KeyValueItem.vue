<template>
    <div v-if="isNotObject" class="flex items-center key-value-item">
        <div class="flex flex-grow border-b border-50 key-value-fields">
            <div
                class="w-48 cursor-text"
                :class="{ 'bg-30': readOnlyKeys || !isEditable }"
            >
                <div v-if="!isEditable || configSuggestion.list === null">
                    <textarea
                        :dusk="`key-value-key-${index}`"
                        v-model="item.key"
                        @focus="handleKeyFieldFocus"
                        ref="keyField"
                        type="text"
                        class="font-mono text-sm resize-none block min-h-input w-full form-control form-input form-input-row py-4 text-90"
                        :disabled="!isEditable || readOnlyKeys"
                        style="background-clip: border-box;"
                        :class="{
                        'bg-white': !isEditable || readOnlyKeys,
                        'hover:bg-20 focus:bg-white': isEditable && !readOnlyKeys,
                      }"
                    />
                </div>
                <div v-else>
                    <vue-simple-suggest
                        :dusk="`key-value-key-${index}`"
                        @focus="handleKeyFieldFocus"
                        ref="keyField"
                        v-model="item.key"
                        :list="configSuggestion.list"
                        :styles="autoCompleteStyle"
                        :destyled=true
                        :display-attribute="configSuggestion.showInput"
                        :value-attribute="configSuggestion.showInput"
                        :max-suggestions="configSuggestion.max"
                        :min-length="configSuggestion.length"
                        :filter-by-query="true">
                        <div slot="suggestion-item" slot-scope="{ suggestion, query }">
                            <div>
                                <p class="text-90" v-if="configSuggestion.title">
                                    {{ suggestion[configSuggestion.title] }}
                                </p>
                                <p class="text-90" v-else>{{ suggestion }}</p>
                                <p v-if="configSuggestion.description" class="text-xs mt-1 text-80">
                                    {{ suggestion[configSuggestion.description] }}
                                </p>
                            </div>
                        </div>
                    </vue-simple-suggest>
                </div>
            </div>

            <div @click="handleValueFieldFocus" class="flex-grow border-l border-50">
        <textarea
            :dusk="`key-value-value-${index}`"
            v-model="item.value"
            @focus="handleValueFieldFocus"
            ref="valueField"
            type="text"
            class="font-mono text-sm block min-h-input w-full form-control form-input form-input-row py-4 text-90"
            :disabled="!isEditable"
            :class="{
            'bg-white': !isEditable,
            'hover:bg-20 focus:bg-white': isEditable,
          }"
        />
            </div>
        </div>

        <div
            v-if="isEditable && canDeleteRow"
            class="flex justify-center h-11 w-11 absolute"
            style="right: -50px;"
        >
            <button
                @click="$emit('remove-row', item.id)"
                type="button"
                tabindex="-1"
                class="flex appearance-none cursor-pointer text-70 hover:text-primary active:outline-none active:shadow-outline focus:outline-none focus:shadow-outline"
                title="Delete"
            >
                <icon/>
            </button>
        </div>
    </div>
</template>

<script>
    import autosize from 'autosize'
    import VueSimpleSuggest from 'vue-simple-suggest'

    export default {

        components: {
            VueSimpleSuggest
        },

        props: {
            index: Number,
            item: Object,
            disabled: {
                type: Boolean,
                default: false,
            },
            readOnly: {
                type: Boolean,
                default: false,
            },
            readOnlyKeys: {
                type: Boolean,
                default: false,
            },
            canDeleteRow: {
                type: Boolean,
                default: true,
            },
            configSuggestion: Object
        },

        data() {
            return {
                autoCompleteStyle: {
                    vueSimpleSuggest: "",
                    inputWrapper: "",
                    defaultInput: "font-mono text-sm resize-none block min-h-input w-full form-control form-input form-input-row py-4 text-90 bg-clip-input",
                    suggestions: "overflow-hidden absolute rounded-lg shadow-lg w-full mt-2 max-h-search overflow-y-auto list-reset overflow-hidden absolute rounded-lg shadow-lg w-full mt-2 max-h-search overflow-y-auto z-1000",
                    suggestItem: "cursor-pointer flex items-center hover:bg-20 block py-2 px-3 no-underline font-normal bg-20"
                }
            }
        },

        mounted() {
            autosize(this.$refs.keyField)
            autosize(this.$refs.valueField)

            if (!this.isEditable || this.readOnlyKeys) {
                this.autoCompleteStyle.defaultInput += "bg-white disabled";
            }

            if (!this.isEditable && !this.readOnlyKeys) {
                this.autoCompleteStyle.defaultInput += "hover:bg-20 focus:bg-white";
            }
        },

        methods: {
            handleKeyFieldFocus() {
                this.$refs.keyField.select()
            },

            handleValueFieldFocus() {
                this.$refs.valueField.select()
            },
            onCountryInputChange(query) {
                if (query.trim().length === 0) {
                    return null
                }
                // return the matching countries as an array
                return this.countries.filter((country) => {
                    return country.toLowerCase().includes(query.toLowerCase())
                })
            },
            onCountrySelected(item) {
                this.selectedCountry = item
            },
            onSearchItemSelected(item) {
                this.selectedSearchItem = item
            }
        },

        computed: {
            isNotObject() {
                return !(this.item.value instanceof Object)
            },
            isEditable() {
                return !this.readOnly && !this.disabled
            },
        },
    }
</script>
<style>
    .bg-clip-input {
        background-clip: border-box;
    }

    .z-1000 {
        z-index: 1000;
    }
</style>
