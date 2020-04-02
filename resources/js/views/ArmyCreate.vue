<template>
  <div class="flex flex-col items-center">
    <div class="flex mt-10 items-center">
      <h3 class="mr-6 font-semibold">Name:</h3>
      <input
        v-model="name"
        class="px-8 py-2 rounded-full focus:outline-none"
        placeholder="Army Name"
      />
    </div>
    <p v-if="!name" class="mt-4 ml-16 text-red-600">{{ error }}</p>
    <div class="flex mt-10 items-center">
      <h3 class="mr-6 font-semibold">Units:</h3>
      <input v-model="units" class="slider" type="range" min="80" max="100" value="100" />
      <p class="ml-2">{{ units }}</p>
    </div>

    <div class="flex mt-16">
      <h3 class="flex font-semibold items-center">Attack Strategy:</h3>
      <div class="flex flex-col items-center ml-12">
        <button
          class="btn-strategy"
          :class="{'bg-red-700': strategy == 0}"
          @click="strategy = 0"
        >Random</button>
        <button
          class="btn-strategy focus:outline-none hover:bg-gray-400"
          :class="{'bg-red-700': strategy == 1}"
          @click="strategy = 1"
        >Weakest</button>
        <button
          class="btn-strategy focus:outline-none hover:bg-gray-400"
          :class="{'bg-red-700': strategy == 2}"
          @click="strategy = 2"
        >Strongest</button>
      </div>
    </div>

    <button @click="submit" class="bg-gray-800 btn-nav mt-8 focus:outline-none">Create Army</button>
  </div>
</template>

<script>
import BattleService from "../services/BattleService";

export default {
  data() {
    return {
      name: "",
      units: 80,
      strategy: 0,
      error: "Army name is required!"
    };
  },
  methods: {
    selectStrategy(strategy) {
      this.strategy = strategy;
    },
    submit() {
      if (this.name) {
        let formData = {
          name: this.name,
          start_units: this.units,
          alive_units: this.units,
          strategy: this.strategy
        };

        BattleService.addArmy(this.$route.params.id, formData)
          .then(data => {
            this.$router.push("/battles/" + this.$route.params.id);
          })
          .catch(error => {
            console.log(error);
          });
      }
    }
  }
};
</script>

<style scoped>
</style>