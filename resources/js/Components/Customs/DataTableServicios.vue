<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button';
import { router } from '@inertiajs/vue3';
import ConfirmPopup from "primevue/confirmpopup";
import { useConfirm } from "primevue/useconfirm"
//Variables
const confirm = useConfirm();




const deleted = (event, id, name) => {
  confirm.require({
    target: event.currentTarget,
    message: "¿Desea Eliminar el cliente " + name + "?",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    accept: () => {
      router.delete(route("clientes.destroy", id), {
        onSuccess: () => {
          //   toast.add({
          //     severity: "info",
          //     summary: "Contratistas",
          //     detail: "Contratista Eliminado Exitosamente",
          //     life: 3000,
          //   });
        },
      });
    },
  });
};

const props = defineProps(
    {
        servicios: Array,
        cliente: {
            type: Boolean,
            default: true
        },
        acciones: {
          type: Boolean,
          default: true
        }
    }
)

</script>

<template>

    
    <DataTable :value="props.servicios">
    <Column field="nombre" header="Nombre" sortable></Column>
    <Column sortable field="cliente.nombre" header="Cliente" v-if="cliente
    "></Column>
    <Column sortable field="tipo_servicio" header="Tipo de Servicio"></Column>
    <Column sortable field="fecha_inicio" header="Fecha de Inicio"></Column>
    <Column sortable field="fecha_fin" header="Fecha de Fin"></Column>
    <Column sortable field="id" header="Acciones" v-if="action">
        <template #body="{data}">
            <div class="flex flex-column md:flex-row md:justiify-content-between">
                
            <Link :href="route('servicios.edit', data.id)">
            <Button
                icon="pi pi-pencil"
                class="p-button-rounded p-button-info p-button-text"
            />
            </Link>
            <ConfirmPopup></ConfirmPopup>
            <Button
            @click="deleted($event, data.id, data.nombre)"
            icon="pi pi-trash"
            class="p-button-rounded p-button-danger p-button-text"
            ></Button>
        </div>
        </template>
    </Column>
    </DataTable>

</template>