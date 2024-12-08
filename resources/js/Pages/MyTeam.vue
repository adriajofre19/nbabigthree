<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    players : {
        type: Array,
        required: true
    },
    user : {
        type: Object,
        required: true
    },
    titulars: {
        type: Array,
        required: true
    },
    suplents: {
        type: Array,
        required: true
    }
});

const form = useForm({
    titular_id: '',
    suplent_id: '',
    team_name: props.user.team_name,
});

const submit = () => {
    form.post(route('players-titular-suplente.update'), {
        onFinish: () => form.reset('titular_id', 'suplent_id'),
        
    });
    changePlayer.value = false;
};

const close = () => {
    changePlayer.value = false;
};

const updateTeamName = () => {
    form.post(route('team-name.update'), {
        onFinish: () => form.reset('team_name'),
    });
};


function getFirstName(name) {
    name = name.split(' ')[1];
    return name.length > 7 ? name.substring(0, 7) + '...' : name; 
}

const changePlayer = ref(false);
let selectedPlayer = ref('');
let suplentOfSelectedPlayer = ref('');
let today = new Date();
let hour = today.getHours();

function openChangePlayerModal(playerId) {
    
    if (today.getDay() === 1 && hour >= 10 && hour <= 23) {
        form.titular_id = playerId;
        selectedPlayer = props.players.find(player => player.id === playerId);
        suplentOfSelectedPlayer = props.players.find(player => player.role === 'suplente');
        form.suplent_id = suplentOfSelectedPlayer.id;
        changePlayer.value = true;
    } 
}





</script>

<template>

<Head title="Mi Equipo" />

<AuthenticatedLayout>
    <nav class="sm:hidden fixed top-10 left-0 right-0 z-50" style="background-color: #12111F;">
      <div class="flex justify-around py-2">
        <Link
                :href="route('my-team')"
                class="inline-flex items-center px-1 pt-1 border-b-4 text-sm font-bold leading-5 transition duration-150 ease-in-out"
                :class="route().current('my-team') ? 'border-red-400 text-white' : 'border-transparent text-white hover:text-gray-700 hover:border-gray-300'"
              >
                Plantilla
        </Link>
        <Link
                :href="route('players')"
                class="inline-flex items-center px-1 pt-1 border-b-4 text-sm font-bold leading-5 transition duration-150 ease-in-out"
                :class="route().current('players') ? 'border-red-400 text-white' : 'border-transparent text-white hover:text-gray-700 hover:border-gray-300'"
              >
                Jugadores
        </Link>
      </div>
    </nav>
<section>
    <div class="py-16">
        <div class="mx-auto sm:px-6 max-w-full ">
            <div class="relative">
                <div class="relative z-10 grid gap-3 grid-cols-6">
                    <div class="col-span-full sm:col-span-3 lg:col-span-2 overflow-hidden relative sm:p-8">
                        <div class="flex justify-center">
                        
                            <div className="p-4">
                                    <div className="border-4 border-white" style="border-color: #4C4F60;">
                                        <div className="relative w-80 sm:w-96 h-[32rem]">
                                            <div className="absolute inset-0 flex items-center justify-center ">
                                                <div className="w-20 h-20 border-4 border-white rounded-full" style="border-color: #4C4F60;"></div>
                                            </div>
                            
                                            <div className="absolute top-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-4 border-white rounded-t-full overflow-hidden rotate-180" style="border-color: #4C4F60;"></div>
                                            <div className="absolute bottom-[0rem] left-1/2 transform -translate-x-1/2 w-60 h-48 border-4 border-white rounded-t-full overflow-hidden" style="border-color: #4C4F60;"></div>

                                            <div className="absolute top-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-4 border-white" style="border-color: #4C4F60;"></div>
                                            <div className="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-20 h-28 border-4 border-white" style="border-color: #4C4F60;"></div>
                            
                                            <div className="absolute top-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-4 border-white rounded-full" style="border-color: #4C4F60;"></div>
                                            <div className="absolute bottom-[4.4rem] left-1/2 transform -translate-x-1/2 w-20 h-20 border-4 border-white rounded-full rotate-180" style="border-color: #4C4F60;"></div>
                            
                                            <div className="absolute inset-x-0 top-1/2 border-t-4 border-white" style="border-color: #4C4F60;"></div>
                            
                                            <div className="absolute inset-x-44 top-2 border-t-2 border-white" ></div>
                                            <div className="absolute top-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-2 border-white rounded-full" style="border-color: #4C4F60;"></div>
                                            
                                            <div className="absolute inset-x-44 bottom-2 border-t-2 border-white rotate-180"></div>
                                            <div className="absolute bottom-[0.6rem] left-1/2 transform -translate-x-1/2 w-4 h-4 border-2 border-white rounded-full rotate-180" style="border-color: #4C4F60;"></div>

                                            <div v-for="(player, index) in titulars" :key="player.id">
                                                
                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 1 && player.role === 'titular'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[7rem] right-[3rem]" />
                                                <div v-if="index === 1 && player.role === 'titular'" className="absolute bottom-[5rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 1 && player.role === 'titular'" className="absolute bottom-[10.5rem] right-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>
                                                
                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 0 && player.role === 'titular'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[4.5rem] left-[3rem]" />
                                                <div v-if="index === 0 && player.role === 'titular'" className="absolute top-[8rem] left-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 0 && player.role === 'titular'" className="absolute top-[3rem] left-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>

                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 2 && player.role === 'titular'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[5rem] right-[3rem]" />
                                                <div v-if="index === 2 && player.role === 'titular'" className="absolute top-[8.5rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 2 && player.role === 'titular'" className="absolute top-[3.5rem] right-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>

                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 3 && player.role === 'titular'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[5rem] left-[3rem]" />
                                                <div v-if="index === 3 && player.role === 'titular'" className="absolute bottom-[3rem] left-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 3 && player.role === 'titular'" className="absolute bottom-[8.5rem] left-[3rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>

                                                <img @click="openChangePlayerModal(player.id)" v-if="index === 4 && player.role === 'titular'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[13.5rem] left-[8rem]" />
                                                <div v-if="index === 4 && player.role === 'titular'" className="absolute top-[17rem] left-[8rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                                <div v-if="index === 4 && player.role === 'titular'" className="absolute top-[12rem] left-[8rem] transform w-10 h-8 border-2 border-red-400 bg-red-400 text-center text-white rounded-lg">{{ player.stats }}</div>
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
                        </div>
                        <div class="flex justify-center" >
                        <div v-for="player in players" :key="player.id" class="mt-4" >
                            <div v-if="player.role === 'suplente'" class="text-center w-10 bg-red-400 py-1 text-white rounded-lg">{{ player.stats }}</div>
                            <img v-if="player.role === 'suplente'" :src="player.avatar" class="w-20 h-auto mx-auto"/>
                            <div v-if="player.role === 'suplente'" class="text-center bg-gray-400 etxt-black py-1">{{ getFirstName(player.name) }}</div>
                        </div>
                    </div>
                    </div>
    <div class="col-span-full sm:col-span-3 lg:col-span-4 overflow-hidden sm:relative rounded-xl px-4 hidden lg:block">
        <div class="w-full max-w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
                <form @submit.prevent="updateTeamName">
                <input type="text" v-model="form.team_name" class="border border-gray-300 rounded-lg" placeholder="Nombre de tu equipo">
                <PrimaryButton @click="updateTeamName" :disabled="form.processing" class="ml-4">
                    Actualizar
                </PrimaryButton>
                </form>
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
              <div v-for="player in suplents" :key="player.id" class="flex justify-center w-full sm:px-12">
              
              <input type="radio" :id="player.id" v-model="form.suplent_id" :value="player.id" class="hidden peer" required>
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