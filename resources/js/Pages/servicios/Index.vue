<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import AppLayout from '@/Layouts/AppLayout.vue';
import HeaderPage from '@/Components/Customs/headerPage.vue'
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button';
import { router } from '@inertiajs/vue3';
import ConfirmPopup from "primevue/confirmpopup";
import { useConfirm } from "primevue/useconfirm";

//Variables
const confirm = useConfirm();


const props = defineProps(
    {
        servicios: Array
    }
)

const deleted = (event, id, name) => {
  confirm.require({
    target: event.currentTarget,
    message: "¿Desea Eliminar el Servicio " + name + "?",
    icon: "pi pi-info-circle",
    acceptClass: "p-button-danger",
    accept: () => {
      router.delete(route("servicio.destroy", id), {
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


</script>

<template>
    <AppLayout>
        <div>
            <HeaderPage title="Servicios">
            </HeaderPage>

            <DataTable :value="props.servicios">
            <Column field="nombre" header="Nombre" sortable></Column>
            <Column sortable field="cliente.nombre" header="Cliente"></Column>
            <Column sortable field="tipo_servicio" header="Tipo de Servicio"></Column>
            <Column sortable field="fecha_inicio" header="Fecha de Inicio"></Column>
            <Column sortable field="fecha_fin" header="Fecha de Fin"></Column>
            <Column sortable field="id" header="Acciones">
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
        </div>
    </AppLayout>
</template>