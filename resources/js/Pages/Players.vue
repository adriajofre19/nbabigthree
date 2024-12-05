<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import { Link, usePage } from '@inertiajs/vue3';

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
});

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
<section class="mt-14">
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

</template>