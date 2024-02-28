<template>
  <button
    style="border:0.2px  solid #D9D9DB"
    class="uppercase
       shadow-indigo-100 border-gray-700  bg-gray-700 text-white font-semibold rounded-sm px-12 py-2"
    @click="emitEvent"
  >{{ text }}</button>
</template>

<script>
export default {
  props: ['text'],
  methods: {
    emitEvent(event) {
      this.$emit('btnClick', event)
    },
  },
}
</script>
