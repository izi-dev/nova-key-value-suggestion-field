Nova.booting((Vue, router, store) => {
  Vue.component('detail-KeyValueSuggestion', require('./components/KeyValueFieldDetail'))
  Vue.component('form-KeyValueSuggestion', require('./components/KeyValueFieldForm'))
})
