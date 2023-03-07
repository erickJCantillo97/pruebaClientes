<script setup>
const props = defineProps({
    title: String,
})
</script>

<template>
     <div class="w-full px-4 py-5 md:px-6 lg:px-8 border-slate-500 border-b rounded-xl mb-4 shadow-sm shadow-blue-500 bg-sky-500/[0.1]">
            <div class="flex align-items-start justify-start">
             
                <div class="font-extrabold text-3xl text-900">{{ props.title }}</div>
              
             
            </div>
          </div>
</template>