<template>
       <button class="bg-indigo-800 uppercase 
       shadow-indigo-100 border-0 border-indigo-500 text-white rounded-sm px-12 py-2"
        @click.prevent="emitEvent">{{text}}</button>
</template>


<script>
export default {
    props:['text'],
    methods:{
        emitEvent(event){
           this.$emit('btnClick',event)
       }
    }
}
</script>