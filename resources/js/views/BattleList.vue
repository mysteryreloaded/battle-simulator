<template>
  <div>
    <div class="w-full flex justify-start bg-gray-800 px-16 py-4 border-t-2 border-white">
      <button
        @click="create"
        class="btn-nav hover:text-black hover:bg-white focus:outline-none focus:border-blue-300"
      >Create Battle</button>
    </div>
    <div class="flex flex-wrap">
      <BattleCard v-for="battle in battles" :key="battle.id" :battle="battle" />
    </div>
  </div>
</template>

<script>
import BattleCard from "../components/BattleCard.vue";
import BattleService from "../services/BattleService";

export default {
  components: {
    BattleCard
  },
  data() {
    return {
      battles: null
    };
  },
  methods: {
    create() {
      BattleService.createBattle()
        .then(response => {
          this.battles = response;
        })
        .catch(error => {
          console.log("There was an error: " + error);
        });
    }
  },
  created() {
    BattleService.getAllBattles()
      .then(response => {
        this.battles = response;
      })
      .catch(error => {
        console.log("There was an error: " + error);
      });
  }
};
</script>

<style scoped></style>
