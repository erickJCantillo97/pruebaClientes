<script setup>
    import { ref } from "vue";
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { useForm } from "@inertiajs/vue3";;
    import Button from 'primevue/button';
    import TextInput from '@/Components/Customs/TextInput.vue';
    import { usePreValidate } from "@/composable/UsePrevalidate";
    import Header from "@/Components/Customs/Header.vue";
    import { router } from '@inertiajs/vue3'



    var form = useForm({
        nombre: props.cliente != null ? props.cliente.nombre : null,
        cedula: props.cliente != null ? props.cliente.cedula : null,
        telefono: props.cliente != null ? props.cliente.telefono : null,
        correo: props.cliente != null ? props.cliente.correo : null,
        observaciones: props.cliente != null ? props.cliente.observaciones : null,
        imagen: props.cliente != null ? props.cliente.imagen : null,
    });

   
    
    const { validate } = usePreValidate(form, {
        method: "post",
        url: route("clientes.store"),
    });

 

    const props =  defineProps({
        cliente: Object,
    });
 
    const submit = () => {
        if(props.cliente != null){
            router.put(route('clientes.update' , props.cliente.id), form, {
            onSuccess: () => {
                router.get(route('clientes.index'))
            }
        })
        return 
        }
        router.post(route('clientes.store'), form, {
            onSuccess: () => {
                router.get(route('clientes.index'))
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
                  
                    <Header :title="props.cliente == null ? 'Crear Cliente': 'Editar Cliente' ">
                    </Header>
                    <form @focusout="validate" @submit.prevent="submit" class="pb-4">
                        <div class="grid md:grid-cols-3 grid-cols-1 my-2 gap-6 px-6">

                            <TextInput label="Nombre" :error="form.errors.nombre" v-model="form.nombre" sugerencia="Escriba el Nombre del Cliente"></TextInput>

                            <TextInput label="Cedula" v-model="form.cedula" :error="form.errors.cedula" sugerencia="Escriba la Cedula del Cliente"></TextInput>

                            <TextInput label="Telefono" v-model="form.telefono" :error="form.errors.telefono" sugerencia="Escriba la Cedula del Cliente"></TextInput>

                            <TextInput label="Correo" v-model="form.correo" :error="form.errors.correo" sugerencia="Escriba la Cedula del Cliente"></TextInput>

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