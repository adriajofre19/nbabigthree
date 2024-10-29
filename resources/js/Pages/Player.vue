<script setup>
import { ref, defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    player: {
        type: Object,
        required: true,
    }
});

const games = ref(props.player.stats);

const formatDate = (date) => {
    return new Date(date).toLocaleDateString();
};


</script>

<template>
  <Head>
    <title>{{ player.name }}</title>
  </Head>
  <AuthenticatedLayout>
    <div class="min-h-screen text-white py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">
        <div class="bg-white/10 backdrop-blur-lg rounded-3xl overflow-hidden shadow-2xl">
          <div class="relative h-80 sm:h-96">
            <img :src="player.avatar" :alt="player.name" class="w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
              <h1 class="text-4xl sm:text-5xl font-bold text-shadow">{{ player.name }}</h1>
              <p class="text-xl sm:text-2xl mt-2 text-shadow">{{ player.team }}</p>
            </div>
          </div>
          
          <div class="p-6 sm:p-8">
            <div class="flex flex-wrap gap-4 mb-8">
              <span class="px-4 py-2 bg-blue-500 rounded-full text-sm font-semibold">{{ player.position }}</span>
              <span class="px-4 py-2 bg-indigo-500 rounded-full text-sm font-semibold">{{ player.role }}</span>
            </div>

            <div class="grid gap-8 sm:grid-cols-2">
              <div>
                <h2 class="text-2xl font-bold mb-4">Estadísticas de la Temporada</h2>
                <div class="bg-black/10 rounded-lg p-4 grid grid-cols-2 gap-4">
                  <div>
                    <div class="text-2xl font-bold">{{ player.totalGames }}</div>
                    <div class="text-sm text-gray-300">Partidos jugados</div>
                  </div>
                  <div>
                    <div class="text-2xl font-bold">{{ player.totalPoints }}</div>
                    <div class="text-sm text-gray-300">Puntos totales</div>
                  </div>
                  <div>
                    <div class="text-2xl font-bold">{{ player.totalWins }}</div>
                    <div class="text-sm text-gray-300">Partidos Ganados</div>
                  </div>
                  <div>
                    <div class="text-2xl font-bold">{{ player.totalDefeats }}</div>
                    <div class="text-sm text-gray-300">Partidos Perdidos</div>
                  </div>
                </div>
              </div>
              
              <div>
                <h2 class="text-2xl font-bold mb-4">Información del Jugador</h2>
                <ul class="space-y-2 text-gray-300">
                  <li><strong class="text-white">Código de Jugador:</strong> {{ player.player_code }}</li>
                  <li><strong class="text-white">Se unió:</strong> {{ formatDate(player.created_at) }}</li>
                  <li><strong class="text-white">Última actualización:</strong> {{ formatDate(player.updated_at) }}</li>
                </ul>
              </div>
            </div>

            <!-- Partidos recientes -->
            <div class="mt-8">
              <h2 class="text-2xl font-bold mb-4">Partidos Recientes</h2>
              <div class="grid gap-4 sm:grid-cols-2">
                <div v-if="game != ''" v-for="game in games" :key="game.date" class="bg-black/20 backdrop-blur-lg rounded-lg overflow-hidden shadow-lg">
                  <div class="p-4">
                    <div class="flex justify-between items-center mb-4">
                      <div class="text-lg font-bold">{{ formatDate(game.date) }}</div>
                      <div class="text-sm font-semibold px-2 py-1 rounded" :class="game.result.startsWith('W') ? 'bg-green-500' : 'bg-red-500'">
                        {{ game.result }}
                      </div>
                    </div>
                    <div class="flex justify-between mb-4">
                      <div>{{ game.team }}</div>
                      <div>vs</div>
                      <div>{{ game.opponent }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <div class="text-2xl font-bold">{{ game.points }}</div>
                        <div class="text-xs text-gray-300">Puntos</div>
                      </div>
                      <div>
                        <div class="text-2xl font-bold">{{ game.total_rebounds }}</div>
                        <div class="text-xs text-gray-300">Rebotes</div>
                      </div>
                      <div>
                        <div class="text-2xl font-bold">{{ game.assists }}</div>
                        <div class="text-xs text-gray-300">Asistencias</div>
                      </div>
                      <div>
                        <div class="text-2xl font-bold">{{ game.steals }}</div>
                        <div class="text-xs text-gray-300">Robos</div>
                      </div>
                    </div>
                  </div>
                  <div class="bg-white/5 p-4">
                    <div class="grid grid-cols-3 gap-2 text-sm">
                      <div>
                        <div class="font-semibold">Tiros de Campo</div>
                        <div>{{ game.field_goals }}/{{ game.field_goals_attempted }}</div>
                      </div>
                      <div>
                        <div class="font-semibold">Triples</div>
                        <div>{{ game.three_point_field_goals }}/{{ game.three_point_field_goals_attempted }}</div>
                      </div>
                      <div>
                        <div class="font-semibold">Tiros Libres</div>
                        <div>{{ game.free_throws }}/{{ game.free_throws_attempted }}</div>
                      </div>
                    </div>
                  </div>
                </div>
                <p v-else class="text-center text-gray-300">No hay estadísticas disponibles para este jugador.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
