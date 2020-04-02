<template>
  <section class="flex flex-wrap">
    <div
      class="flex flex-col max-w-sm rounded overflow-hidden shadow-2xl bg-gray-200 w-64 h-40 m-12"
    >
      <div class="flex">
        <div
          class="px-4 pt-4 flex flex-col border-r border-b border-gray-900 items-center"
          style="flex-basis: 50%; flex-grow: 0;"
        >
          <p class="text-base mb-2 font-bold">Battle ID:</p>
          <p class="text-base mb-2">{{ battle.id }}</p>
        </div>
        <div
          class="px-4 pt-4 flex flex-col border-b border-gray-900 items-center"
          style="flex-basis: 50%; flex-grow: 0;"
        >
          <p class="text-base mb-2 font-bold">Status:</p>
          <p class="text-base mb-2">{{ status[battle.status] }}</p>
        </div>
      </div>
      <div class="p-6 flex flex-1 justify-center items-center">
        <router-link
          class="btn-card hover:text-white hover:bg-gray-700"
          :to="{ name: 'battle-show', params: { id: battle.id } }"
        >Enter Battle</router-link>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    battle: Object
  },
  data() {
    return {
      status: {
        0: "Ready!",
        1: "In Progress...",
        2: "Finished!"
      }
    };
  }
};
</script>

<style scoped>
</style>