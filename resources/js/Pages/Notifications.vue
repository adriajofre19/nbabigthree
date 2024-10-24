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
    <div v-for="notificacion in notifications" class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto mt-8">
      <div class="text-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Propuesta de Intercambio de {{ notificacion.receiver.name }}</h2>
      </div>
      
      <div class="flex items-center justify-between mb-8">
        <!-- Jugador enviado -->
        <div class="flex flex-col items-center w-1/3">
          <img :src="notificacion.player_sent.avatar" class="w-24 h-auto mx-auto" />
          <h3 class="font-semibold text-base text-center">{{ notificacion.player_sent.name }}</h3>
          <p class="text-sm text-gray-600 text-center">{{ notificacion.player_sent.team }}</p>
          <p class="text-sm text-gray-600 text-center">{{ capitalizeFirstLetter(notificacion.player_sent.position) }}</p>
          <span class="text-sm bg-gray-300 p-1 rounded-lg text-gray-600 text-center">{{ notificacion.receiver.name }}</span>

        </div>
        
        <!-- SVG de intercambio -->
        <div class="w-1/3 flex justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
          </svg>
        </div>
        
        <!-- Jugador recibido -->
        <div class="flex flex-col items-center w-1/3">
          <img :src="notificacion.player_received.avatar" class="w-24 h-auto mx-auto" />
          <h3 class="font-semibold text-base text-center">{{ notificacion.player_received.name }}</h3>
          <p class="text-sm text-gray-600 text-center">{{ notificacion.player_received.team }}</p>
          <p class="text-sm text-gray-600 text-center">{{ capitalizeFirstLetter(notificacion.player_received.position) }}</p>
          <span class="text-sm bg-gray-300 p-1 px-2 rounded-lg text-gray-600 text-center">Tu</span>
        </div>
      </div>
      
      <div class="border-t border-gray-200 pt-6">
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
