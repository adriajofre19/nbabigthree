<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
  users: {
    type: Array,
    required: true
  },
  id: {
    type: Number,
    required: true
  }
});
</script>

<template>
    <Head>
        <title>Clasificación</title>
    </Head>
  <AuthenticatedLayout>
    <nav class="sm:hidden fixed top-10 left-0 right-0 z-50" style="background-color: #12111F;">
      <div class="flex justify-around py-2">
        <Link
                :href="route('clasification')"
                class="inline-flex items-center px-1 pt-1 border-b-4 text-sm font-bold leading-5 transition duration-150 ease-in-out"
                :class="route().current('clasification') ? 'border-red-400 text-white' : 'border-transparent text-white hover:text-gray-700 hover:border-gray-300'"
              >
                Clasificación Total
        </Link>
        <Link
                :href="route('clasification-for-week')"
                class="inline-flex items-center px-1 pt-1 border-b-4 text-sm font-bold leading-5 transition duration-150 ease-in-out"
                :class="route().current('clasification-for-week') ? 'border-red-400 text-white' : 'border-transparent text-white hover:text-gray-700 hover:border-gray-300'"
              >
                Clasificación Semanal
        </Link>
      </div>
    </nav>
  <section class="antialiased text-gray-600 mt-12">
                <div class="hidden sm:flex flex-col">
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
  <div v-for="(user, index) in users" :key="user.id">
    <div :class="{'bg-[#1e2337] text-white': id !== user.id, 
      'bg-gray-200 text-black': id === user.id}" class="p-4 sm:max-w-xl">
      <div className="flex items-center justify-between">
        <div className="flex items-center gap-4">
          <div className="flex items-center gap-2">
            <span className="text-gray-400">{{ index + 1 }}</span>
            <div className="relative">
              <div className="w-12 h-12 rounded-full flex items-center justify-center text-xl font-semibold">
                <img :src="user.avatar" alt="avatar" className="w-12 h-12 rounded-full" />
              </div>
              <div v-if="index === 0" className="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full" />
              <div v-if="index === 1" className="absolute -top-1 -right-1 w-3 h-3 bg-gray-400 rounded-full" />
              <div v-if="index === 2" className="absolute -top-1 -right-1 w-3 h-3 bg-orange-600 rounded-full" />
            </div>
          </div>
          <div>
            <a :href="'/get-team/'+user.id">
            <h3 className="font-medium">{{ user.name }}</h3>
          </a>
            <p className="text-sm text-gray-400">{{ user.team_name }}</p>
          </div>
        </div>
        <div className="text-right">
          <span className="text-gray-400 text-sm">PFSY</span>
          <p className="text-xl font-semibold">{{ user.total_points }}</p>
        </div>
      </div>
    </div>
  </div>
  </AuthenticatedLayout>
</template>