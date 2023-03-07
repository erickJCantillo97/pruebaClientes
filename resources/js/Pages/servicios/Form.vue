<script setup>
    import { ref } from "vue";
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from "@inertiajs/vue3";;
    import Button from 'primevue/button';
    import TextInput from '@/Components/Customs/TextInput.vue';
    import { usePreValidate } from "@/composable/UsePrevalidate";
    import Header from "@/Components/Customs/Header.vue";
    import { router } from '@inertiajs/vue3'
    import Dropdown from 'primevue/dropdown';
    import Calendar from 'primevue/calendar';

    var form = useForm({
        nombre: props.servicio != null ? props.servicio.nombre : null,
        cliente_id: props.servicio != null ? props.servicio.cliente_id : null,
        tipo_servicio: props.servicio != null ? props.servicio.tipo_servicio : null,
        fecha_inicio: props.servicio != null ? props.servicio.fecha_inicio : null,
        fecha_fin: props.servicio != null ? props.servicio.fecha_fin : null,
        observaciones: props.servicio != null ? props.servicio.observaciones : null,
        imagen: props.servicio != null ? props.servicio.imagen : null,
    });

   
    
    const { validate } = usePreValidate(form, {
        method: "post",
        url: route("servicios.store"),
    });

 

    const props =  defineProps({
        clientes: Array,
        servicio: Object,
    });
 
    const submit = () => {
        if(props.servicio != null){
            router.put(route('servicios.update' , props.servicio.id), form, {
            onSuccess: () => {
                router.get(route('servicios.index'))
            }
        })
        return 
        }
        router.post(route('servicios.store'), form, {
            onSuccess: () => {
                router.get(route('servicios.index'))
            }
        })
    }


    /* End functions */ 
</script>

<template>
    <AppLayout>
        <div class="py-6">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-full py-auto">
                  
                    <Header :title="props.cliente == null ? 'Crear Servicio': 'Editar Servicio' ">
                    </Header>
                    <form @focusout="validate" @submit.prevent="submit" class="pb-4">
                        <div class="grid md:grid-cols-3 grid-cols-1 my-2 gap-6 px-6">

                            <TextInput label="Nombre" :error="form.errors.nombre" v-model="form.nombre" sugerencia="Escriba el Nombre del Cliente"></TextInput>

                            <div class="p-fluid p-input-filled border-0 space-y-2">
                                <div class="flex justify-between">
                                    <span>Cliente</span>
                                   
                                </div>
                                <Dropdown v-model="form.cliente_id" :filter="true" :options="props.clientes" optionValue="id" optionLabel="nombre" placeholder="Seleccione un Cliente" />
                            </div>

                            <TextInput label="Tipo de Servicio" v-model="form.tipo_servicio" :error="form.errors.tipo_servicio" sugerencia="Escriba la Cedula del Cliente"></TextInput>

                            <div class="p-fluid p-input-filled border-0 space-y-2">
                                <label for="icon">Fecha de Inicio</label>
                                <Calendar inputId="icon" v-model="form.fecha_inicio" dateFormat="mm-dd-yy" :showIcon="true" placeholder="Seleccione una fecha"/>
                            </div>

                            <div class="p-fluid p-input-filled border-0 space-y-2">
                                <label for="icon">Fecha de fin</label>
                                <Calendar inputId="icon" v-model="form.fecha_fin"  dateFormat="mm-dd-yy" :showIcon="true" placeholder="Seleccione una fecha"/>
                            </div>
                            <TextInput label="Observaciones" v-model="form.observaciones" :error="form.errors.observaciones" sugerencia="Escriba la Cedula del Cliente"></TextInput>
                            
                            <TextInput label="Imagen" v-model="form.imagen" :error="form.errors.imagen" sugerencia="Escriba la Cedula del Cliente"></TextInput>
                           
                            
                        </div>

                            <div class="px-[2%] text-end">
                                <Button
                                label="Guardar"
                                type="submit"
                                icon="pi pi-save"
                                iconPos="left"
                                />
                            </div>
                    </form>
                </div>
            </div>
         
        </div>
       
        
    </AppLayout>
</template>