<template>
    <panel-item :field="field">
        <template slot="value">
            <KeyValueTable
                v-if="theData.length > 0"
                :edit-mode="false"
                class="overflow-hidden"
            >
                <KeyValueHeader
                    :key-label="field.keyLabel"
                    :value-label="field.valueLabel"
                />

                <div class="bg-white overflow-hidden key-value-items">
                    <KeyValueItem
                        v-for="item in theData"
                        :item="item"
                        :disabled="true"
                        :key="item.key"
                        :configSuggestion="field.configSuggestion"
                    />
                </div>
            </KeyValueTable>
        </template>
    </panel-item>
</template>

<script>
    import KeyValueItem from './KeyValueItem'
    import KeyValueHeader from './KeyValueHeader'
    import KeyValueTable from './KeyValueTable'

    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],

        components: { KeyValueTable, KeyValueHeader, KeyValueItem },

        data: () => ({ theData: [] }),

        created() {
            this.theData = _.map(this.field.value || {}, (value, key) => ({
                key,
                value,
            }))
        },
    }
</script>
