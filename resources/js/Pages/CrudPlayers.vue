<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


const props = defineProps({
  players: {
    type: Array,
    required: true
  },
  users : {
    type: Array,
    required: true
  } 
});

function getUserById(id) {
  return props.users.find(user => user.id === id);
}

console.log(props.users);

const playersList = ref(props.players);
const search = ref('');
const showDialog = ref(false);
const editingPlayer = ref(null);

const form = useForm({
  id: '',
  name: '',
  team: '',
  position: '',
  role: '',
  user_id: '',
  avatar: '',
  player_code: ''
});

const filteredPlayers = computed(() => {
  return playersList.value.filter(player => 
    player.name.toLowerCase().includes(search.value.toLowerCase())
  );
});

const openAddDialog = () => {
  editingPlayer.value = null;
  form.reset();
  showDialog.value = true;
};

const openEditDialog = (player) => {
  editingPlayer.value = player;
  form.id = player.id;
  form.name = player.name;
  form.team = player.team;
  form.position = player.position;
  form.role = player.role;
  form.user_id = player.user_id;
  form.avatar = player.avatar;
  form.player_code = player.player_code;
  showDialog.value = true;
};

const closeDialog = () => {
  showDialog.value = false;
  editingPlayer.value = null;
  form.reset();
  form.clearErrors();
};

const submitForm = () => {
  if (editingPlayer.value) {
    form.post(route('crud-players.update'), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        closeDialog();
        // Update the player in the list
        const index = playersList.value.findIndex(p => p.id === form.id);
        if (index !== -1) {
          playersList.value[index] = { ...form };
        }
      },
    });
  } else {
    form.post(route('crud-players.create'), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: (page) => {
        closeDialog();
        // Add the new player to the list
        playersList.value.push(page.props.player);
      },
    });
  }
};

const deletePlayer = (player) => {
  if (confirm('¿Estás seguro de que quieres eliminar este jugador?')) {
    useForm({ id: player.id }).delete(route('crud-players.delete'), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        // Remove the player from the list
        playersList.value = playersList.value.filter(p => p.id !== player.id);
      },
    });
  }
};

const csvForm = useForm({
  file: null  // Change this from 'csv_file' to 'file' to match your backend
})

const handleFileChange = (event) => {
  csvForm.file = event.target.files[0]
}


const submitCsvForm = () => {
  csvForm.post(route('crud-players.createFromCsvFile'), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      // Refresh the players list or show a success message
      // You might want to emit an event or call a method to refresh the players list
      alert('Players imported successfully')
      csvForm.reset()
    },
    onError: () => {
      alert('Error importing players')
    }
  })
}

const exportCsv = () => {
  const headers = ['Nombre', 'Equipo', 'Posición', 'Rol', 'Usuario', 'Avatar', 'Código del Jugador'];
  /*
  const rows = playersList.value.filter(player => player.role === 'titular').map(player => [
    player.name,
    player.team,
    player.position,
    player.role,
    getUserById(player.user_id).name,
    player.avatar,
    player.player_code
  ]); */

  const rows = playersList.value.map(player => [
    player.name,
    player.team,
    player.position,
    player.role,
    getUserById(player.user_id).name,
    player.avatar,
    player.player_code
  ]);

  let csvContent = 'data:text/csv;charset=utf-8,' + [headers, ...rows].map(e => e.join(';')).join('\n');
  const encodedUri = encodeURI(csvContent);
  const link = document.createElement('a');
  link.setAttribute('href', encodedUri);
  link.setAttribute('download', 'players.csv');
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
};

</script>

<template>
  <AuthenticatedLayout>
    <div class="container mx-auto p-4 w-full bg-white">
      <h1 class="text-2xl font-bold mb-4">Gestión de Jugadores</h1>
      
      <div class="flex items-center justify-between mb-4">
        <button @click="openAddDialog" class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded mb-4 flex items-center">
          Añadir Jugador
        </button>
        <input v-model="search" type="text" class="shadow appearance-none border rounded w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Buscar jugador...">
      </div>

<div class="mt-8 mb-8">
  <h2 class="text-xl font-bold mb-4">Import Players from CSV</h2>
  <form @submit.prevent="submitCsvForm" enctype="multipart/form-data">
    <div class="flex items-center space-x-4">
      <input 
        type="file" 
        accept=".csv" 
        @change="handleFileChange"
        class="border p-2 rounded"
      />
      <button 
        type="submit" 
        class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded"
        :disabled="!csvForm.file || csvForm.processing"
      >
        {{ csvForm.processing ? 'Importing...' : 'Import CSV' }}
      </button>

      

    </div>
  </form>
  <button @click="exportCsv" class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded mt-4">
    Exportar CSV
  </button>
</div>

      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b text-left">Nombre</th>
            <th class="py-2 px-4 border-b text-left">Equipo</th>
            <th class="py-2 px-4 border-b text-left">Posición</th>
            
            <th class="py-2 px-4 border-b text-left">Usuario</th>
            <th class="py-2 px-4 border-b text-left">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="player in filteredPlayers" :key="player.id">
            <td class="py-2 px-4 border-b">{{ player.name }}</td>
            <td class="py-2 px-4 border-b">{{ player.team }}</td>
            <td class="py-2 px-4 border-b">{{ player.position }}</td>
            <td class="py-2 px-4 border-b">{{ getUserById(player.user_id).name }}</td>
            
            <td class="py-2 px-4 border-b">
              <button @click="openEditDialog(player)" class="bg-white hover:bg-gray-200 text-black border border-gray-300 py-2 px-3 rounded mr-2">
                Editar
              </button>
              <button @click="deletePlayer(player)" class="bg-red-500 hover:bg-red-700 text-white border py-2 px-3 rounded">
                Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="showDialog" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
        <div class="bg-white p-5 rounded-lg shadow-xl w-full max-w-md">
          <h2 class="text-xl font-bold mb-4">{{ editingPlayer ? 'Editar Jugador' : 'Añadir Jugador' }}</h2>
          <form @submit.prevent="submitForm">
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nombre
              </label>
              <input v-model="form.name" id="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
              <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="team">
                Equipo
              </label>
              <input v-model="form.team" id="team" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
              <div v-if="form.errors.team" class="text-red-500 text-xs mt-1">{{ form.errors.team }}</div>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                Posición
              </label>
              <input v-model="form.position" id="position" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
              <div v-if="form.errors.position" class="text-red-500 text-xs mt-1">{{ form.errors.position }}</div>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                Rol
              </label>
              <select v-model="form.role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="titular">Titular</option>
                <option value="suplente">Suplente</option>
              </select>
              <div v-if="form.errors.role" class="text-red-500 text-xs mt-1">{{ form.errors.role }}</div>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="user_id">
                Usuario
              </label>
              <select v-model="form.user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option v-for="user in props.users" :key="user.id" :value="user.id">{{ user.name }}</option>
              </select>
              <div v-if="form.errors.role" class="text-red-500 text-xs mt-1">{{ form.errors.role }}</div>
            </div>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="avatar">
                URL del Avatar
              </label>
              <input v-model="form.avatar" id="avatar" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
              <div v-if="form.errors.avatar" class="text-red-500 text-xs mt-1">{{ form.errors.avatar }}</div>
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="player_code">
                Código del Jugador
              </label>
              <input v-model="form.player_code" id="player_code" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
              <div v-if="form.errors.player_code" class="text-red-500 text-xs mt-1">{{ form.errors.player_code }}</div>
            </div>
            <div class="flex items-center justify-between">
              <button type="submit" class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :disabled="form.processing">
                {{ form.processing ? 'Guardando...' : 'Guardar' }}
              </button>
              <button @click="closeDialog" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>