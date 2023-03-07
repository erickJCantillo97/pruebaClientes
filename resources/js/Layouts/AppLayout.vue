<script setup>
import { ref } from 'vue';
import Banner from '@/Components/Banner.vue';
import SplitButton from 'primevue/splitbutton';
import Toast from 'primevue/toast';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Menubar from 'primevue/menubar';
import { router } from '@inertiajs/vue3'

const logout = () => {
		router.post(route('logout'));
	};


	const items =  [
			{
				label: 'Inicio',
				command:	()=> {
                    router.get(route('dashboard'))
                }
			},
			
			{
				label:'Clientes',
				icon: 'pi pi-users',
				
				items: [
					{
						label: 'Lista de Clientes',
						icon: 'pi pi-book',
						
						command:	()=> {
							router.get(route('clientes.index'))
						}
					},
					{
						label: 'Agregar Cliente',
						icon: 'pi pi-user-plus',
						
						command:	()=> {
							router.get(route('clientes.create'))
						}
					},
				
					
				]
			},		
			{
				label:'Servicios',
				icon: 'pi pi-inbox',
				
				items: [
					{
						label: 'Lista de Servicios',
						icon: 'pi pi-book',
						
						command:	()=> {
							router.get(route('servicios.index'))
						}
					},
					{
						label: 'Agregar Servicio',
						icon: 'pi pi-file-edit',
						
						command:	()=> {
							router.get(route('servicios.create'))
						}
					},
				]
			},		
	]
	const userOptions = [
	
		{
			label:'Salir',
			icon:'pi pi-fw pi-power-off',
			command: () => logout()
		}
	]

</script>

<template>
    <div class="">
        
        <Banner />
		<Toast />
        <div class="min-h-max  ">
			<div class="bg-white fixed w-full top-0 z-50">
				<Menubar :model="items" >
			
				<template #end>
					<SplitButton :label="$page.props.auth.user.name" :model="userOptions" class="p-button-text mb-2"></SplitButton>
				</template>
			</Menubar>
			</div>
			<div class="mt-24 p-4">
			
				<main>
					<slot />
				</main>
				
			</div>
          
        </div>
    </div>
</template>
