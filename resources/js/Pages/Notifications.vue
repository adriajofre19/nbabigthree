<script setup>
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    notifications: Array,
});

console.log(props.notifications);

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' }
  return new Date(dateString).toLocaleDateString('es-ES', options)
}

const capitalizeFirstLetter = (string) => {
  return string.charAt(0).toUpperCase() + string.slice(1)
}

const handleAction = (action, notification) => {
  form.notification_id = notification.id
  form.player_sent_id = notification.player_sent.id
  form.player_received_id = notification.player_received.id
  form.sender_id = notification.sender_id
  form.receiver_id = notification.receiver.id
  form.action = action

  form.post(route('notifications.handle-exchange'), {
    preserveScroll: true,
    onSuccess: () => {
      // Actualizar el estado de la notificación localmente
      notification.status = action === 'accept' ? 'accepted' : 'rejected'
    },
    onError: () => {
      // Manejar errores aquí
      console.error('Error al procesar la solicitud de intercambio')
    }
  })
}

const form = useForm({
    notification_id: '',
    player_sent_id: '',
    player_received_id: '',
    sender_id: '',
    receiver_id: '',
    action: '',
});


</script>

<template>
  <AuthenticatedLayout>

    <div v-for="notificacion in notifications">
      <div class="bg-white shadow-md p-6 max-w-2xl mx-auto mt-8" style="background-color: #12111F;">
        <div class="text-center flex justify-center">
          <h2 class="font-semibold text-white">Intercambio de </h2>-<h2 class="text-red-500"> {{ notificacion.receiver.name }}</h2>
        </div>
      </div>
        
        
      <div class="flex items-center mx-auto bg-gradient-to-r from-gray-900 to-gray-800 overflow-hidden w-full max-w-2xl ">
      <div class="w-24 h-36 flex-shrink-0" style="background-color: #12111F;">
        <img 
          :src="notificacion.player_sent.avatar" 
          alt="Player photo"
          class="w-full h-full object-cover"
        />
      </div>
  
      <!-- Player Info -->
      <div class="flex-1 p-4">
        <div class="flex items-center justify-between">
          <div>
            <a :href="`/player/${notificacion.player_sent.id}`">
              <h2 class="text-xl font-bold text-white">{{ notificacion.player_sent.name }}</h2>
            </a>
            
            <p class="text-gray-400 text-sm">{{ notificacion.player_sent.team }}</p>
          </div>
          <div class="text-right">
            <span class="text-gray-400 text-sm">PFSY</span>
            <span class="text-white text-2xl font-bold ml-1">{{ notificacion.player_sent.stats }}</span>
          </div>
        </div>
  
        <!-- Badges -->
        <div class="flex gap-2 mt-2">
          <div class="bg-pink-500 rounded-full px-3 py-1">
            <span class="text-white text-sm font-medium">{{notificacion.player_sent.position}}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4 flex justify-center">
          
          <svg width="50" height="30" xmlns="http://www.w3.org/2000/svg">
  <!-- Triángulo apuntando hacia abajo (rojo) -->
  <polygon points="10,5 20,5 15,15" fill="red" />
  
  <!-- Triángulo apuntando hacia arriba (verde) -->
  <polygon points="25,15 30,5 35,15" fill="green" />
  </svg>
  
      </div>


      <div class="flex items-center mx-auto bg-gradient-to-r from-gray-900 to-gray-800 overflow-hidden w-full max-w-2xl ">
      <div class="w-24 h-36 flex-shrink-0" style="background-color: #12111F;">
        <img 
          :src="notificacion.player_received.avatar" 
          alt="Player photo"
          class="w-full h-full object-cover"
        />
      </div>
  
      <!-- Player Info -->
      <div class="flex-1 p-4">
        <div class="flex items-center justify-between">
          <div>
              <a :href="`/player/${notificacion.player_received.id}`">
              <h2 class="text-xl font-bold text-white">{{ notificacion.player_received.name }}</h2>
              </a>
            
            <p class="text-gray-400 text-sm">{{ notificacion.player_received.team }}</p>
          </div>
          <div class="text-right">
            <span class="text-gray-400 text-sm">PFSY</span>
            <span class="text-white text-2xl font-bold ml-1">{{ notificacion.player_received.stats }}</span>
          </div>
        </div>
  
        <!-- Badges -->
        <div class="flex gap-2 mt-2">
          <div class="bg-pink-500 rounded-full px-3 py-1">
            <span class="text-white text-sm font-medium">{{notificacion.player_received.position}}</span>
          </div>
        </div>
      </div>
    </div>

    <div class=" pt-6">
        <div class="flex justify-center space-x-4">
          <button @click="handleAction('reject', notificacion)" class="px-6 py-2 bg-black text-white text-sm font-medium rounded hover:bg-gray-800 transition duration-300 ease-in-out">
            Rechazar
          </button>
          <button @click="handleAction('accept', notificacion)" class="px-6 py-2 bg-black text-white text-sm font-medium rounded hover:bg-gray-800 transition duration-300 ease-in-out">
            Aceptar
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
  </template>
