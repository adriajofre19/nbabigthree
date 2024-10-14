<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';



const form = useForm({
    titular_id: '',
    suplent_id: ''
});

const submit = () => {
    form.post(route('players-titular-suplente.update'), {
        onFinish: () => form.reset('titular_id', 'suplent_id'),
        
    });
    changePlayer.value = false;
};

const props = defineProps({
    players : {
        type: Array,
        required: true
    }
});

console.log(props.players);

function getFirstName(name) {
    return name.split(' ')[0];
}

const changePlayer = ref(false);
let selectedPlayer = ref('');
let suplentOfSelectedPlayer = ref('');

function openChangePlayerModal(playerId) {
    form.titular_id = playerId;

    selectedPlayer = props.players.find(player => player.id === playerId);
    suplentOfSelectedPlayer = props.players.find(player => player.role === 'suplente' && player.position === selectedPlayer.position);
    form.suplent_id = suplentOfSelectedPlayer.id;
    
    changePlayer.value = true;
}

</script>
<template>

<Head title="Mi Equipo" />

<AuthenticatedLayout>
    <div class="flex">
        <div class="sm:w-2/5">
            <div className="bg-gray-100 p-8 flex items-center justify-center ">
                <div className="bg-gray-700 sm:p-4">
                    <div className="border-2 border-white ">
                        <div className="relative w-80 sm:w-96 h-[32rem] bg-gray-700 ">
                            <div className="absolute inset-0 flex items-center justify-center ">
                                <div className="w-20 h-20 border-2 border-white rounded-full"></div>
                            </div>
            
                            <div className="absolute top-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-2 border-white rounded-t-full overflow-hidden rotate-180"></div>
                            <div className="absolute bottom-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-2 border-white rounded-t-full overflow-hidden"></div>

                            <div className="absolute top-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-2 border-white"></div>
                            <div className="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-2 border-white"></div>
            
                            <div className="absolute top-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-2 border-white rounded-full"></div>
                            <div className="absolute bottom-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-2 border-white rounded-full rotate-180"></div>
            
                            <div className="absolute inset-x-0 top-1/2 border-t-2 border-white"></div>
            
                            <div className="absolute inset-x-44 top-2 border-t-2 border-white"></div>
                            <div className="absolute top-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-2 border-white rounded-full"></div>
                            
                            <div className="absolute inset-x-44 bottom-2 border-t-2 border-white rotate-180"></div>
                            <div className="absolute bottom-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-2 border-white rounded-full rotate-180"></div>

                            <div v-for="player in players" :key="player.id">
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Base'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[5rem] right-[3rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Base'" className="absolute bottom-[3rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                <div v-if="player.role === 'titular' && player.position === 'Base'" className="absolute bottom-[8.5rem] right-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center">{{ player.stats }}</div>
                                
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Escolta'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[8rem] left-[2rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Escolta'" className="absolute bottom-[6rem] left-[2rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                <div v-if="player.role === 'titular' && player.position === 'Escolta'" className="absolute bottom-[11.5rem] left-[2rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center">{{ player.stats }}</div>
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Alero'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[14rem] right-[5rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Alero'" className="absolute bottom-[12rem] right-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                <div v-if="player.role === 'titular' && player.position === 'Alero'" className="absolute bottom-[17.5rem] right-[5rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center">{{ player.stats }}</div>
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Ala-Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[10rem] left-[5rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Ala-Pivot'" className="absolute top-[13.6rem] left-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                <div v-if="player.role === 'titular' && player.position === 'Ala-Pivot'" className="absolute top-[8rem] left-[5rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center">{{ player.stats }}</div>
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[5rem] right-[3rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Pivot'" className="absolute top-[8.6rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                <div v-if="player.role === 'titular' && player.position === 'Pivot'" className="absolute top-[3rem] right-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center">{{ player.stats }}</div>
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>




            
            <div class="flex justify-center bg-gray-100">
                <div v-for="player in players" :key="player.id" >
                    <div v-if="player.role === 'suplente'" class="text-center w-10 bg-red-400 py-1">{{ player.stats }}</div>
                    <img v-if="player.role === 'suplente'" :src="player.avatar" class="w-20 h-auto mx-auto "  />
                    <div v-if="player.role === 'suplente'" class="text-center bg-gray-400 py-1">{{ getFirstName(player.name) }}</div>
                </div>
            </div>
        </div>
        <div class="sm:w-3/5 w-full justify-center">


            <section class="antialiased bg-gray-100 text-gray-600 px-4">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200 mt-8">
                        <header class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Jugadores</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Nombre</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Posicion</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">T/S</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Team</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-center">Puntos</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        <tr v-for="player in players" :key="player.id">
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    
                                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img :src="player.avatar" width="40" height="40" alt="Alex Shatov"></div>
                                                        <div class="font-medium text-gray-800"><a :href="'/player/'+player.id">{{ player.name }}</a></div>
                                                    
                                                </div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ player.position }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div v-if="player.role === 'titular'" class="text-left font-medium text-green-500">TITULAR</div>
                                                <div v-else class="text-left font-medium text-red-500">SUPLENTE</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ player.team }}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{ player.stats }}</div>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



        </div>
    </div>
</AuthenticatedLayout>

<Modal :show="changePlayer" @close="changePlayer = false">
    <form @submit.prevent="submit">
    
    <div class="p-8">
        
        <div class="flex justify-around items-center">
        
        <div>
        <img :src="selectedPlayer.avatar" class="w-20 h-auto mx-auto" />
        <div class="text-center bg-gray-400 py-1">{{ getFirstName(selectedPlayer.name) }}</div>
        </div>

        <div>
        <svg class="w-8 h-8 text-gray-800 text-center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3"/>
        </svg>
        </div>

        <div>
        <img :src="suplentOfSelectedPlayer.avatar" class="w-20 h-auto mx-auto" />
        <div class="text-center bg-gray-400 py-1">{{ getFirstName(suplentOfSelectedPlayer.name) }}</div>
        </div>

        </div>
        
        <div class="flex justify-center mt-4">
            <PrimaryButton @click="submit" :disabled="form.processing">
                Cambiar jugador
            </PrimaryButton>
        </div>
        
    </div>
</form>
</Modal>


</template>