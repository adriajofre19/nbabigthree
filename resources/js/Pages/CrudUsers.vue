<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  users : {
    type: Array,
    required: true
  } 
});

function deleteUser(user) {
  if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
    useForm({ id: user.id }).delete(route('crud-users.delete'))
  }
}

console.log(props.users);

</script>

<template>
  <AuthenticatedLayout>
    <div class="container mx-auto p-4 w-full bg-white">
      <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>

      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b text-left">ID</th>
            <th class="py-2 px-4 border-b text-left">Nombre</th>
            <th class="py-2 px-4 border-b text-left">Equipo</th>
            <th class="py-2 px-4 border-b text-left">Posición</th>
            
            <th class="py-2 px-4 border-b text-left">Usuario</th>
            <th class="py-2 px-4 border-b text-left">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="py-2 px-4 border-b">{{ user.id }}</td>
            <td class="py-2 px-4 border-b">{{ user.name }}</td>
            <td class="py-2 px-4 border-b">{{ user.email }}</td>
            <td class="py-2 px-4 border-b">{{ user.role }}</td>
            <td class="py-2 px-4 border-b">{{ user.team_name }}</td>
            
            
            <td class="py-2 px-4 border-b">
              <button @click="openEditDialog(user)" class="bg-white hover:bg-gray-200 text-black border border-gray-300 py-2 px-3 rounded mr-2">
                Editar
              </button>
              <button @click="deleteUser(user)" class="bg-red-500 hover:bg-red-700 text-white border py-2 px-3 rounded">
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