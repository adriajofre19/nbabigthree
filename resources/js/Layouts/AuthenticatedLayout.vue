<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const showingNavigationDropdown = ref(false);
const page = usePage();

</script>

<template>
  <div class="min-h-screen flex flex-col" style="background-color: #00000A;">



    <nav class="sm:hidden fixed top-0 left-0 right-0 z-50" style="background-color: #12111F;">
      <div class="flex justify-center align-center py-4">
        <p class="font-bold text-white">NBA</p><p class="font-bold text-red-500">TheBigThree</p> 
      </div>
    </nav>



    <!-- Desktop Navigation (hidden on mobile) -->
    <nav class="bg-white border-b border-gray-100 hidden sm:block">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
              <Link :href="route('my-team')">
                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
              </Link>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
              <Link
                :href="route('my-team')"
                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                :class="route().current('my-team') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              >
                Mi Equipo
              </Link>
              <Link
                :href="route('clasification')"
                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                :class="route().current('clasification') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              >
                Clasificación total
              </Link>
              <Link
                :href="route('clasification-for-week')"
                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                :class="route().current('clasification-for-week') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              >
                Clasificación semanal
              </Link>
              <Link
                :href="route('notifications')"
                class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out"
                :class="route().current('notifications') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
              >
                Notificaciones
              </Link>
            </div>
          </div>

          <!-- User Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ms-6">
            <div class="ms-3 relative">
              <Dropdown align="right" width="48">
                  <template #trigger>
                      <span class="inline-flex rounded-md">
                          <button
                              type="button"
                              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                          > <img class="h-8 w-8 rounded-full" :src="$page.props.auth.user.avatar" :alt="$page.props.auth.user.name" />
                              

                              <svg
                                  class="ms-2 -me-0.5 h-4 w-4"
                                  xmlns="http://www.w3.org/2000/svg"
                                  viewBox="0 0 20 20"
                                  fill="currentColor"
                              >
                                  <path
                                      fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"
                                  />
                              </svg>
                          </button>
                      </span>
                  </template>

                  <template #content>
                      <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                      <DropdownLink :href="route('logout')" method="post" as="button">
                          Log Out
                      </DropdownLink>
                  </template>
              </Dropdown>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Heading -->
    <header class="bg-white shadow" v-if="$slots.header">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="header" />
      </div>
    </header>

    <!-- Page Content -->
    <main class="flex-grow pb-16 sm:pb-0 mt-8">
      <slot />
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="sm:hidden fixed bottom-0 left-0 right-0 z-50" style="background-color: #00000A;">
      <div class="flex justify-around">
        
        <Link
          :href="route('notifications')"
          class="flex flex-col items-center py-2 px-3 text-xs font-medium"
          :class="route().current('notifications') ? 'text-red-600' : 'text-gray-500 hover:text-red-600'"
        >
          <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
          </svg>
          Notificaciones
        </Link>
        <Link
          :href="route('clasification')"
          class="flex flex-col items-center py-2 px-3 text-xs font-medium"
          :class="route().current('clasification') ? 'text-red-600' : 'text-gray-500 hover:text-red-600'"
        >
          <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
          </svg>
          Clasificación
        </Link>
        <Link
          :href="route('my-team')"
          class="flex flex-col items-center py-2 px-3 text-xs font-medium"
          :class="route().current('my-team') ? 'text-red-600' : 'text-gray-500 hover:text-red-600'"
        >
          <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
          </svg>
          Mi Equipo
        </Link>
      </div>
    </nav>
  </div>
</template>