<template>
  <div>
    <div class="w-full flex justify-start bg-gray-800 px-16 py-4 border-t-2 border-white">
      <button
        @click="create"
        class="border-2 border-white text-white px-6 py-2 rounded-full hover:text-black hover:bg-white focus:outline-none focus:border-blue-300"
      >Create Battle</button>
    </div>
    <section class="flex flex-wrap">
      <div
        v-for="battle in battles"
        :key="battle.id"
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
            class="inline-block rounded-full border border-gray-900 px-3 py-1 text-sm font-semibold text-gray-700 hover:text-white hover:bg-gray-700"
            :to="{ name: 'battle-show', params: { id: battle.id } }"
          >Enter Battle</router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import BattleService from "../services/BattleService";

export default {
  data() {
    return {
      battles: null,
      status: {
        0: "Ready!",
        1: "In Progress...",
        2: "Finished!"
      }
    };
  },
  methods: {
    create() {
      BattleService.createBattle()
        .then(response => {
          this.battles = response.data;
        })
        .catch(error => {
          console.log("There was an error: " + error);
        });
    }
  },
  mounted() {
    BattleService.getAllBattles()
      .then(response => {
        this.battles = response.data;
      })
      .catch(error => {
        console.log("There was an error: " + error);
      });
  }
};
</script>

<style scoped>
</style>