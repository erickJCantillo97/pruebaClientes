<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import AppLayout from '@/Layouts/AppLayout.vue';
import HeaderPage from '@/Components/Customs/headerPage.vue'
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button';
import Dialog from "primevue/dialog";

const props = defineProps(
    {
        clientes: Array
    }
)

</script>

<template>
    <AppLayout>
        <div>
            <HeaderPage title="Clientes">
            </HeaderPage>

            <DataTable :value="props.clientes">
            <Column field="nombre" header="Nombre" sortable></Column>
            <Column sortable field="cedula" header="Cedula"></Column>
            <Column sortable field="correo" header="Correo"></Column>
            <Column sortable field="telefono" header="Telefono"></Column>
            <Column sortable field="id" header="Acciones">
                <template #body="{data}">
                    <div class="flex flex-column md:flex-row md:justiify-content-between">

                  <Link :href="route('clientes.show', data.id)">
                    <Button
                      icon="pi pi-eye"
                      class="p-button-rounded  p-button-text"
                    />
                  </Link>
                  <Link :href="route('clientes.edit', data.id)">
                    <Button
                      icon="pi pi-pencil"
                      class="p-button-rounded p-button-info p-button-text"
                    />
                  </Link>
                  <ConfirmPopup></ConfirmPopup>
                  <Button
                    @click="deleted($event, data.id, data.name)"
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