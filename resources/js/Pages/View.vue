<template>
    
        <div class="justify-center w-full
        ">
        <h1 class="text-center text-2xl font-extrabold mb-8">Información del Cliente</h1>
        <div class="flex space-x-2 w-full">
             <div class="rounded-lg p-2 text-md font-semibold shadow-xl">
                Nombre: {{ cliente.nombre }}
            </div>
             <div class="rounded-lg p-2 text-md font-semibold shadow-xl">
                Cedula: {{ cliente.cedula }}
            </div>
             <div class="rounded-lg p-2 text-md font-semibold shadow-xl">
                Telefono: {{ cliente.telefono }}
            </div>
             <div class="rounded-lg p-2 text-md font-semibold shadow-xl">
                Correo: {{ cliente.correo }}
            </div>
             <div class="rounded-lg p-2 text-md font-semibold shadow-xl">
                Observaciones: {{ cliente.observaciones }}
            </div>
        </div>
        <div class="block mt-10 ">
        <h1 class="text-2xl font-bold text-center mb-2">Lista de Servicios</h1>
         <DataTableServicios :servicios="props.servicios" :action="false" :cliente="false">
    
         </DataTableServicios>
        </div>
    
        </div>
    </template>
    
    
    <script setup>
    import DataTableServicios from '@/Components/Customs/DataTableServicios.vue'
    
    const props = defineProps({
        cliente: Object,
        servicios: Array
    })
    </script>
    
    