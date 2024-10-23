<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  users: {
    type: Array,
    required: true
  }
});

console.log(props.users);

</script>

<template>
    <Head>
        <title>Clasificación</title>
    </Head>
  <AuthenticatedLayout>
  <section class="antialiased text-gray-600 px-4">
                <div class="flex flex-col">
                    <div class="sm:w-2/3 w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-8">
                        <header class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Clasificación por puntos</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        <tr v-for="(user, index) in users" :key="user.id">
                                            
                                          <td class="p-2 whitespace-nowrap">
                                                <div class="text-center text-xl"># {{ index + 1 }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    
                                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3 "><img :src="user.avatar" width="40" height="40" alt="Alex Shatov" class="rounded-full"></div>
                                                        

                                                        <div class="flex flex-col">
                                                            <a :href="'/get-team/'+user.id">
                                                            <div class="font-medium text-gray-800">{{ user.name }}</div>
                                                            <div class="text-md text-gray-500">{{ user.team_name }}</div>
                                                        </a>
                                                        </div>

                                                        
                                                    
                                                </div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-center text-lg sm:text-xl">{{ user.total_points }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ user.stats }}</div>
                                            </td>
                                        
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

  </AuthenticatedLayout>
</template>

<style scoped>
.text-shadow {
  text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}
</style>