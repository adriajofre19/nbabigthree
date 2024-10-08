<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref } from 'vue';
import { initFlowbite } from 'flowbite';
import { onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';


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




let suplents = props.players.filter(player => player.role === 'suplente');

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
<!--
    <AuthenticatedLayout>

<div >
        <div class="flex flex-col mx-3 mt-6 lg:flex-row ">
            <div class="w-full lg:w-1/3 m-1 ">
                <div className="bg-white p-8 flex items-center justify-center ">
      <div className="bg-gray-700 p-4 ">
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
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Base'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[5rem] right-[3rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Base'" className="absolute bottom-[3rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Escolta'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[8rem] left-[2rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Escolta'" className="absolute bottom-[6rem] left-[2rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Alero'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[12rem] right-[5rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Alero'" className="absolute bottom-[10rem] right-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Ala-Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[11rem] left-[5rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Ala-Pivot'" className="absolute top-[14.6rem] left-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
                
                <img :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[8rem] right-[3rem]" />
                <div :data-modal-target="'default-modal'+player.id" :data-modal-toggle="'default-modal'+player.id" v-if="player.role === 'titular' && player.position === 'Pivot'" className="absolute top-[11.6rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                
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

    </AuthenticatedLayout>-->



<AuthenticatedLayout>
    <div class="flex">
        <div class="sm:w-2/5 h-screen">
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
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Escolta'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[8rem] left-[2rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Escolta'" className="absolute bottom-[6rem] left-[2rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Alero'" :src="player.avatar" class="absolute w-20 h-auto mx-auto bottom-[12rem] right-[5rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Alero'" className="absolute bottom-[10rem] right-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Ala-Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[11rem] left-[5rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Ala-Pivot'" className="absolute top-[14.6rem] left-[5rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                
                                
                                <img @click="openChangePlayerModal(player.id)" v-if="player.role === 'titular' && player.position === 'Pivot'" :src="player.avatar" class="absolute w-20 h-auto mx-auto top-[8rem] right-[3rem]" />
                                <div v-if="player.role === 'titular' && player.position === 'Pivot'" className="absolute top-[11.6rem] right-[3rem] transform w-20 h-8 border-2 border-gray-400 bg-gray-400 text-center">{{ getFirstName(player.name) }}</div>
                                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>




            
            <div class="flex justify-center bg-gray-100">
                <div v-for="player in players" :key="player.id">
                    <img v-if="player.role === 'suplente'" :src="player.avatar" class="w-20 h-auto mx-auto "  />
                    <div v-if="player.role === 'suplente'" class="text-center bg-gray-400 py-1">{{ getFirstName(player.name) }}</div>
                </div>
            </div>
        </div>
        <div class="sm:w-3/5 h-screen bg-gray-800"></div>
    </div>
</AuthenticatedLayout>

<Modal :show="changePlayer" @close="changePlayer = false">
    <form @submit.prevent="submit">
    <div class="p-8">

    <div class="flex justify-around">
        <div>
            <img :src="selectedPlayer.avatar" class="w-20 h-auto mx-auto" />
            <div class="text-center bg-gray-400 py-1">{{ getFirstName(selectedPlayer.name) }}</div>
        </div>
    </div>

    <div class="flex justify-center">
        <div v-for="player in players" :key="player.id">
            <img v-if="player.role === 'suplente' && player.position === selectedPlayer.position" :src="player.avatar" class="w-20 h-auto mx-auto" />
            <div v-if="player.role === 'suplente' && player.position === selectedPlayer.position" class="text-center bg-gray-400 py-1">{{ getFirstName(player.name) }}</div>
        </div>
    </div>

    <button @click="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>

    </div>
</form>
</Modal>


</template>