<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
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
    },
    user : {
        type: Object,
        required: true
    }
});

console.log(props.user);

console.log(props.players);

function getFirstName(name) {
    // name: split by space and get the second element and limit in 7 characters
    name = name.split(' ')[1];
    return name.length > 7 ? name.substring(0, 7) + '...' : name;
    
}

const changePlayer = ref(false);
let selectedPlayer = ref('');
let suplentOfSelectedPlayer = ref('');

function openChangePlayerModal(playerId) {
    form.titular_id = playerId;

    selectedPlayer = props.players.find(player => player.id === playerId);
    suplentOfSelectedPlayer = props.players.find(player => player.role === 'suplente');
    form.suplent_id = suplentOfSelectedPlayer.id;
    
    changePlayer.value = true;


}

let titulars = ref(props.players.filter(player => player.role === 'titular'));

const suplentes = ref(props.players.filter(player => player.role === 'suplente'));

</script>

<template>

<Head title="Mi Equipo" />

<AuthenticatedLayout>
<section class="bg-gradient-to-br from-orange-400 to-orange-800">
    <div class="py-16">
        <div class="mx-auto sm:px-6 max-w-full text-gray-500">
            <div class="relative">
                <div class="relative z-10 grid gap-3 grid-cols-6">
                    <div class="col-span-full sm:col-span-3 lg:col-span-2 overflow-hidden relative sm:p-8">
                        <div class="flex justify-center">
                        
                            <div className="bg-gray-700 p-4">
                                    <div className="border-2 border-white ">
                                        <div className="relative w-80 sm:w-96 h-[32rem] bg-gray-700">
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

                                            <div v-for="(player, index) in titulars" :key="player.id">
                                                
                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 1" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[7rem] right-[3rem]" />
                                                <div v-if="index === 1" className="absolute bottom-[5rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 1" className="absolute bottom-[10.5rem] right-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>
                                                
                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 0" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[4.5rem] left-[3rem]" />
                                                <div v-if="index === 0" className="absolute top-[8rem] left-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 0" className="absolute top-[3rem] left-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>

                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 2" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[5rem] right-[3rem]" />
                                                <div v-if="index === 2" className="absolute top-[8.5rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 2" className="absolute top-[3.5rem] right-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>

                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 3" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[5rem] left-[3rem]" />
                                                <div v-if="index === 3" className="absolute bottom-[3rem] left-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 3" className="absolute bottom-[8.5rem] left-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>

                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 4" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[13.5rem] left-[10rem]" />
                                                <div v-if="index === 4" className="absolute top-[17rem] left-[10rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 4" className="absolute top-[12rem] left-[10rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
                        </div>
                        <div class="flex justify-center">
                        <div v-for="player in players" :key="player.id" class="mt-4">
                            <div v-if="player.role === 'suplente'" class="text-center w-10 bg-red-400 py-1 text-white rounded-lg">{{ player.stats }}</div>
                            <img v-if="player.role === 'suplente'" :src="player.avatar" class="w-20 h-auto mx-auto"/>
                            <div v-if="player.role === 'suplente'" class="text-center bg-gray-400 etxt-black py-1">{{ getFirstName(player.name) }}</div>
                        </div>
                    </div>
                    </div>
                    <div class="col-span-full sm:col-span-3 lg:col-span-4 overflow-hidden relative rounded-xl px-4">
        <div class="w-full max-w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">{{ props.user.team_name }}</h2>
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
                                    <div class="font-semibold text-left">Posición</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Rol</div>
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
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" :src="player.avatar" width="40" height="40" alt="Alex Shatov"></div>
                                        <div class="font-medium text-gray-800">{{ player.name }}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ player.position }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <span v-if="player.role === 'titular'" class="text-left font-medium bg-green-500 rounded-md p-1 text-white">TITULAR</span>
                                    <span v-else class="text-left font-medium bg-red-500 rounded-md p-1 text-white">SUPLENTE</span>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-lg text-center">{{ player.stats }}</div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</AuthenticatedLayout>

<Modal :show="changePlayer" @close="changePlayer = false">
    <form @submit.prevent="submit">
    
    <div class="p-8">
        
        <div class="flex justify-around items-center flex-column">
        
        <div>
        <img :src="selectedPlayer.avatar" class="w-20 h-auto mx-auto" />
        <div class="text-center bg-gray-400 py-1">{{ getFirstName(selectedPlayer.name) }}</div>
        </div>

        <div>
        <svg class="w-8 h-8 text-gray-800 text-center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16 10 3-3m0 0-3-3m3 3H5v3m3 4-3 3m0 0 3 3m-3-3h14v-3"/>
        </svg>
        </div>

        <div v-for="player in suplentes" :key="player.id">
            <img v-if="player.role === 'suplente'" :src="player.avatar" class="w-20 h-auto mx-auto"/>
            <div v-if="player.role === 'suplente'" class="text-center bg-gray-400 py-1">{{ getFirstName(player.name) }}</div>
            <input type="radio" v-model="form.suplent_id" :value="player.id" class="" />
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