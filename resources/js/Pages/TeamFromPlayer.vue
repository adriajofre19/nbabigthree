<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    players: Object,
    playersofAuthenticatedUser: Object,
    AuthenticatedUser: Object,
});

function getFirstName(name) {
    name = name.split(' ')[1];
    return name.length > 7 ? name.substring(0, 7) + '...' : name; 
}

const players = ref(props.players);

const titulars = ref(players.value.filter(player => player.role === 'titular'));

const changePlayer = ref(false);

const selectedPlayer = ref('');
const sender_id = ref('');
const tradeofSelectedPlayer = ref('');
const receiver_id = ref('');


function openChangePlayerModal(playerId) {
    selectedPlayer.value = players.value.find(player => player.id === playerId);
    form.player_received_id = selectedPlayer.value.id;


    if (selectedPlayer.value.user_id !== props.AuthenticatedUser.id) {
        changePlayer.value = true;
    }
    
}

const form = useForm({
    player_sent_id: '',
    player_received_id: selectedPlayer.value.id,
    sender_id: props.user.id,
    receiver_id: props.AuthenticatedUser.id,
});

const close = () => {
    changePlayer.value = false;
};

const submit = () => {
    form.post(route('create-notification-to-trade.create'), {
        onSuccess: () => {
            changePlayer.value = false;
        },
    });
};


</script>

<template>

    <Head :title="user.team_name" />
    
    <AuthenticatedLayout>
        
    <section>
        <div class="py-16">
            <div class="mx-auto sm:px-6 max-w-full">
                <div class="relative">
                    <div class="relative z-10 grid gap-3 grid-cols-6">
                        <div class="col-span-full sm:col-span-3 lg:col-span-2 overflow-hidden relative sm:p-8">
                            <div class="flex justify-center">
                            
                                <div className=" p-4">
                                        <div className="border-4 border-white" style="border-color: #4C4F60;">
                                            <div className="relative w-80 sm:w-96 h-[32rem] ">
                                                <div className="absolute inset-0 flex items-center justify-center ">
                                                    <div className="w-20 h-20 border-4 border-white rounded-full" style="border-color: #4C4F60;"></div>
                                                </div>
                                
                                                <div className="absolute top-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-4 border-white rounded-t-full overflow-hidden rotate-180" style="border-color: #4C4F60;"></div>
                                                <div className="absolute bottom-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-4 border-white rounded-t-full overflow-hidden" style="border-color: #4C4F60;"></div>
    
                                                <div className="absolute top-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-4 border-white" style="border-color: #4C4F60;"></div>
                                                <div className="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-4 border-white" style="border-color: #4C4F60;"></div>
                                
                                                <div className="absolute top-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-4 border-white rounded-full" style="border-color: #4C4F60;"></div>
                                                <div className="absolute bottom-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-4 border-white rounded-full rotate-180" style="border-color: #4C4F60;"></div>
                                
                                                <div className="absolute inset-x-0 top-1/2 border-t-2 border-white"style="border-color: #4C4F60;"></div>
                                
                                                <div className="absolute inset-x-44 top-2 border-t-2 border-white" style="border-color: #4C4F60;"></div>
                                                <div className="absolute top-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-4 border-white rounded-full" style="border-color: #4C4F60;"></div>
                                                
                                                <div className="absolute inset-x-44 bottom-2 border-t-2 border-white rotate-180" style="border-color: #4C4F60;"></div>
                                                <div className="absolute bottom-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-4 border-white rounded-full rotate-180" style="border-color: #4C4F60;"></div>
    
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
    
                                                    <img @click="openChangePlayerModal(player.id)" v-if="index === 4" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[13.5rem] left-[8rem]" />
                                                    <div v-if="index === 4" className="absolute top-[17rem] left-[8rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                    <div v-if="index === 4" className="absolute top-[12rem] left-[8rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>
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
        <div class="col-span-full sm:col-span-3 lg:col-span-4 overflow-hidden sm:relative rounded-xl px-4 hidden lg:block">
            <div class="w-full max-w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-semibold text-gray-800">{{ props.user.team_name }} </h2><span class="text-sm bg-gray-300 p-1 rounded-md text-black">{{ props.user.name }}</span>
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
                                            <a :href="`/player/${player.id}`" class="flex items-center">
                                            <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" :src="player.avatar" width="40" height="40" alt="Alex Shatov"></div>
                                            <div class="font-medium text-gray-800">{{ player.name }}</div>
                                            </a>
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

    <section class="mt-14 sm:hidden block">
    <div v-for="player in players" :key="player.id" class="py-1 px-2">
    <div class="flex items-center bg-gradient-to-r from-gray-900 to-gray-800 overflow-hidden w-full max-w-xl">
    <div class="w-24 h-32 flex-shrink-0" style="background-color: #12111F;">
      <img 
        :src="player.avatar" 
        alt="Player photo"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- Player Info -->
    <div class="flex-1 p-4">
      <div class="flex items-center justify-between">
        <div>
          <a :href="route('player', player.id)">
            <h2 class="text-xl font-bold text-white">{{ player.name }}</h2>
          </a>
          <p class="text-gray-400 text-sm">{{ player.team }}</p>
        </div>
        <div class="text-right">
          <span class="text-gray-400 text-sm">PFSY</span>
          <span class="text-white text-2xl font-bold ml-1">{{ player.stats }}</span>
        </div>
      </div>

      <!-- Badges -->
      <div class="flex gap-2 mt-2">
        <div v-if="player.role === 'titular'" class="flex items-center bg-green-500 rounded-full px-3 py-1">
          <span class="text-white text-sm ml-1">Titular</span>
        </div>
        <div v-else-if="player.role === 'suplente'" class="flex items-center bg-red-500 rounded-full px-3 py-1">
          <span class="text-white text-sm ml-1">Suplente</span>
        </div>

        <div class="bg-pink-500 rounded-full px-3 py-1">
          <span class="text-white text-sm font-medium">{{player.position}}</span>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
    
    
    </AuthenticatedLayout>

    <Modal :show="changePlayer" @close="changePlayer = false">
    <form @submit.prevent="submit">
        
    
    <div class="">
        
        <div class="flex justify-around items-center flex-col">
            <nav class="sm:hidden fixed top-0 left-0 right-0 z-50" style="background-color: #12111F;">
      <div class="flex justify-center align-center py-4">
        <p class="font-bold text-white">Intercambiar jugador</p> 
      </div>
    </nav>
             
<div class="flex items-center bg-gradient-to-r from-gray-900 to-gray-800 overflow-hidden w-full max-w-xl mt-16">
    <div class="w-24 h-36 flex-shrink-0" style="background-color: #12111F;">
      <img 
        :src="selectedPlayer.avatar" 
        alt="Player photo"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- Player Info -->
    <div class="flex-1 p-4">
      <div class="flex items-center justify-between">
        <div>
          
            <h2 class="text-xl font-bold text-white">{{ selectedPlayer.name }}</h2>
          
          <p class="text-gray-400 text-sm">{{ selectedPlayer.team }}</p>
        </div>
        <div class="text-right">
          <span class="text-gray-400 text-sm">PFSY</span>
          <span class="text-white text-2xl font-bold ml-1">{{ selectedPlayer.stats }}</span>
        </div>
      </div>

      <!-- Badges -->
      <div class="flex gap-2 mt-2">
        <div class="bg-pink-500 rounded-full px-3 py-1">
          <span class="text-white text-sm font-medium">{{selectedPlayer.position}}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4">
        
        <svg width="50" height="30" xmlns="http://www.w3.org/2000/svg">
<!-- Triángulo apuntando hacia abajo (rojo) -->
<polygon points="10,5 20,5 15,15" fill="red" />

<!-- Triángulo apuntando hacia arriba (verde) -->
<polygon points="25,15 30,5 35,15" fill="green" />
</svg>

    </div>

    


        <div class="sm:flex sm:flex-row flex-column flex-wrap w-full">
            <div v-for="player in playersofAuthenticatedUser" :key="player.id" class="flex justify-center w-full sm:px-12">
            
            <input type="radio" :id="player.id" v-model="form.player_sent_id" :value="player.id" class="hidden peer" required>
                <label :for="player.id"
                    class="inline-flex items-center justify-between w-full text-gray-500 cursor-pointer peer-checked:border-blue-600 peer-checked:border peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                    <div class="block w-full">
                        
<div class="flex items-center bg-gradient-to-r from-gray-900 to-gray-800 overflow-hidden w-full max-w-xl min-w-full">
    <div class="w-24 h-36 flex-shrink-0" style="background-color: #12111F;">
      <img 
        :src="player.avatar" 
        alt="Player photo"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- Player Info -->
    <div class="flex-1 p-4">
      <div class="flex items-center justify-between">
        <div>
          
            <h2 class="text-xl font-bold text-white">{{ player.name }}</h2>
          
          <p class="text-gray-400 text-sm">{{ player.team }}</p>
        </div>
        <div class="text-right">
          <span class="text-gray-400 text-sm">PFSY</span>
          <span class="text-white text-2xl font-bold ml-1">{{ player.stats }}</span>
        </div>
      </div>

      <!-- Badges -->
      <div class="flex gap-2 mt-2">
        <div class="bg-pink-500 rounded-full px-3 py-1">
          <span class="text-white text-sm font-medium">{{player.position}}</span>
        </div>
      </div>
    </div>
  </div>
                    </div>
                </label>
        </div>
        </div>

        

        </div>
        
        <div class="flex mt-4 justify-around h-12" >
            <button @click="close" class="rounded-md text-white px-4" style="background-color: #12111F;">Cancelar</button>
            <button @click="submit" :disabled="form.processing" class="rounded-md text-white px-4" style="background-color: #12111F;">
                Cambiar jugador
            </button>
        </div>
        
    </div>
</form>
</Modal>
    
</template>