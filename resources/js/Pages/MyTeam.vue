<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref } from 'vue';
import { initFlowbite } from 'flowbite';
import { onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    titular_id: '1',
    suplent_id: '6'
});
    
onMounted(() => {
  initFlowbite();
});

const props = defineProps({
    players : {
        type: Array,
        required: true
    }
});

function getFirstName(name) {
    return name.split(' ')[0];
}

function updateplayer(first_id, second_id) {
    console.log(first_id, second_id);
}


const suplents = props.players.filter(player => player.role === 'SUPLENTE');







</script>
<template>
    <AuthenticatedLayout>

    <!-- component -->
<div class="bg-gray-100">
        <div class="flex flex-col mx-3 mt-6 lg:flex-row ">
            <div class="w-full lg:w-1/3 m-1 ">
                <div className="bg-white p-8 flex items-center justify-center ">
      <div className="bg-gray-700 p-4 ">
        <div className="border-2 border-white ">
          <div className="relative w-80 sm:w-96 h-[32rem] bg-gray-700 ">
            
            <div className="absolute inset-0 flex items-center justify-center ">
              <div className="w-20 h-20 border-2 border-white rounded-full"></div>
            </div>
            
            <!-- Redonda de area seuperior -->
            <div className="absolute top-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-2 border-white rounded-t-full overflow-hidden rotate-180"></div>
            <div className="absolute bottom-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-2 border-white rounded-t-full overflow-hidden"></div>


            <div className="absolute top-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-2 border-white"></div>
            <div className="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-2 border-white"></div>

            
            <!-- Redonda de area seuperior -->
            <div className="absolute top-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-2 border-white rounded-full"></div>
            <div className="absolute bottom-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-2 border-white rounded-full rotate-180"></div>
            
            
            <!-- Medio campo -->
            <div className="absolute inset-x-0 top-1/2 border-t-2 border-white"></div>
            
            <!-- Canasta de arriba -->
            <div className="absolute inset-x-44 top-2 border-t-2 border-white"></div>
            <div className="absolute top-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-2 border-white rounded-full"></div>
            <!-- Canasta de abajo -->
            <div className="absolute inset-x-44 bottom-2 border-t-2 border-white rotate-180"></div>
            <div className="absolute bottom-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-2 border-white rounded-full rotate-180"></div>

            <div v-for="player in players" :key="player.id">
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Base'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[5rem] right-[3rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Base'" className="absolute bottom-[3rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Escolta'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[8rem] left-[2rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Escolta'" className="absolute bottom-[6rem] left-[2rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Alero'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[12rem] right-[5rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Alero'" className="absolute bottom-[10rem] right-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Ala-Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[11rem] left-[5rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Ala-Pivot'" className="absolute top-[14.6rem] left-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[8rem] right-[3rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'TITULAR' && player.position === 'Pivot'" className="absolute top-[11.6rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
            </div> 
          </div>

        </div>
      </div>
    </div>
    <div class="flex items-center justify-center space-between mt-4">
    <div v-for="player in players" :player.id >
    <img v-if="player.role === 'SUPLENTE' && player.position === 'Base'" :src="player.avatar" class="w-20 h-auto mx-auto mr-4 " />
    <div v-if="player.role === 'SUPLENTE' && player.position === 'Base'" class="text-center bg-gray-400 py-1 mr-4">{{ getFirstName(player.name) }}</div>

    <img v-if="player.role === 'SUPLENTE' && player.position === 'Alero'" :src="player.avatar" class="w-20 h-auto mx-auto mr-4" />
    <div v-if="player.role === 'SUPLENTE' && player.position === 'Alero'" class="text-center bg-gray-400 py-1 mr-4">{{ getFirstName(player.name) }}</div>

    <img v-if="player.role === 'SUPLENTE' && player.position === 'Escolta'" :src="player.avatar" class="w-20 h-auto mx-auto mr-4" />
    <div v-if="player.role === 'SUPLENTE' && player.position === 'Escolta'" class="text-center bg-gray-400 py-1 mr-4">{{ getFirstName(player.name) }}</div>

    <img v-if="player.role === 'SUPLENTE' && player.position === 'Ala-Pivot'" :src="player.avatar" class="w-20 h-auto mx-auto mr-4" />
    <div v-if="player.role === 'SUPLENTE' && player.position === 'Ala-Pivot'" class="text-center bg-gray-400 py-1 mr-4">{{ getFirstName(player.name) }}</div>

    <img v-if="player.role === 'SUPLENTE' && player.position === 'Pivot'" :src="player.avatar" class="w-20 h-auto mx-auto mr-4" />
    <div v-if="player.role === 'SUPLENTE' && player.position === 'Pivot'" class="text-center bg-gray-400 py-1 mr-4">{{ getFirstName(player.name) }}</div>
        </div>
    </div>
            </div>
            <div class="w-full lg:w-2/3 m-1 bg-white text-lg rounded-sm border border-gray-200">
                <div class="overflow-x-auto rounded-lg p-3">
                    <table class="table-auto w-full">
                        <thead class="text-sm font-semibold uppercase text-gray-800 bg-gray-50 mx-auto">
                            <tr>
                                <th></th>
                                <th><svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 h-5 mx-auto"><path d="M6 22h12a2 2 0 0 0 2-2V8l-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm7-18 5 5h-5V4zm-4.5 7a1.5 1.5 0 1 1-.001 3.001A1.5 1.5 0 0 1 8.5 11zm.5 5 1.597 1.363L13 13l4 6H7l2-3z"></path></svg></th>
                                <th class="p-2">
                                    <div class="font-semibold">Category</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Description</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Action</div>
                                </th>
                            </tr>
                            <tr v-for="player in players" :key="player.id">
                                <td>1</td>
                                <td><img :src="player.avatar" class="h-auto w-16 mx-auto" /></td>
                                <td>{{ player.name }}</td>
                                <td>{{ player.role }}</td>
                                <td>{{ player.position }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            
        </div>
        
    </div>

    </AuthenticatedLayout>



<div v-for="player in players" :key="player.id" :id="'default-modal'+player.id" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900 ">
                    Cambiar jugador
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" :data-modal-hide="'default-modal'+player.id">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form @submit.prevent="form.patch(route('players-titular-suplente.update'))">
            <div class="p-4 md:p-5 space-y-4">
                <div class="text-center">
                    <img :src="player.avatar" class="w-20 h-auto mx-auto" />
                    <div>{{ player.name }}</div>
                </div>


                
                

                <div v-for="suplent in suplents" :key="suplent.id" class="">
                    <div v-if="suplent.position === player.position" class="text-center">
                    <img :src="suplent.avatar" class="w-20 h-auto mx-auto" />
                    <div>{{ suplent.name }}</div>
                    <input type="text" v-model="suplent.id" />
                    

                </div>
                

                    
                </div>

                <input type="text" v-model="player.id" />
                
            </div>

            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                <button :disabled="form.processing" :data-modal-hide="'default-modal'+player.id" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cambiar jugador</button>
            </div>

            </form>


            <!-- Modal footer -->
            
        </div>
    </div>
</div>


</template>