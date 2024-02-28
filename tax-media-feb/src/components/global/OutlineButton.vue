<template>
       <button style="border:0.2px  solid #6366F1" class="bg-white uppercase 
       shadow-indigo-100 border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white font-semibold rounded-sm px-12 py-2" 
       @click="emitEvent">{{text}}</button>
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