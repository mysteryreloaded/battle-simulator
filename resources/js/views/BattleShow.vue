<template>
  <div>
    <div class="w-full flex justify-start bg-gray-800 px-16 py-4 border-t-2 border-white">
      <router-link
        :to="{ name: 'add-army', params: { id: id }}"
        v-if="isFetched"
        v-show="battle.status != 2"
        class="btn-nav hover:text-black hover:bg-white focus:outline-none focus:border-blue-300"
      >Add Army</router-link>
      <button
        @click="attack"
        v-if="isFetched"
        class="btn-nav ml-8 hover:text-black hover:bg-white focus:outline-none focus:border-blue-300"
      >Attack Once</button>
      <button
        @click="reset"
        v-if="isFetched"
        class="btn-nav ml-8 hover:text-black hover:bg-white focus:outline-none focus:border-blue-300"
      >Reset Battle</button>
      <h1
        class="flex flex-1 items-center justify-center text-white text-3xl font-bold"
      >- Battle #{{ id }} -</h1>
    </div>
    <div class="text-center">
      <FlashMessage></FlashMessage>
    </div>
    <section class="flex flex-col flex-wrap justify-center mt-32 max-w-screen-lg mx-auto">
      <table class="table-auto">
        <thead>
          <tr>
            <th class="border-4 border-black px-4 py-2">ID</th>
            <th class="border-4 border-black px-4 py-2">Army Name</th>
            <th class="border-4 border-black px-4 py-2">Start Units</th>
            <th class="border-4 border-black px-4 py-2">Alive Units</th>
            <th class="border-4 border-black px-4 py-2">Attack Chance</th>
            <th class="border-4 border-black px-4 py-2">Attack Damage</th>
            <th class="border-4 border-black px-4 py-2">Strategy</th>
            <th class="border-4 border-black px-4 py-2">Defeated</th>
          </tr>
        </thead>
        <tbody v-if="isFetched" class="font-semibold">
          <tr
            v-for="army in battle.armies"
            :key="army.id"
            :defeated="army.is_defeated"
            class="text-center"
            :class="{'text-gray-500': army.is_defeated}"
          >
            <td class="border border-black px-4 py-2">{{ army.id }}</td>
            <td class="border border-black px-4 py-2">{{ army.name }}</td>
            <td class="border border-black px-4 py-2">{{ army.start_units }}</td>
            <td class="border border-black px-4 py-2">{{ army.alive_units }}</td>
            <td class="border border-black px-4 py-2">{{ army.attack_chance }}%</td>
            <td class="border border-black px-4 py-2">{{ army.attack_damage }}</td>
            <td class="border border-black px-4 py-2">{{ strategy[army.strategy] }}</td>
            <td class="border border-black px-4 py-2">{{ army.is_defeated ? 'Yes' : '/' }}</td>
          </tr>
        </tbody>
      </table>
    </section>
  </div>
</template>

<script>
import BattleService from "../services/BattleService";

export default {
  props: ["id"],
  data() {
    return {
      status: {
        0: "Ready",
        1: "In Progress",
        2: "Finished"
      },
      strategy: {
        0: "Random",
        1: "Weakest",
        2: "Strongest"
      },
      battle: null,
      isFetched: false
    };
  },
  methods: {
    attack() {
      BattleService.attack(this.battle.id)
        .then(response => {
          if (response.error) {
            this.flashMessage.show({
              status: "error",
              title: "Error!",
              time: 3500,
              message: response.error
            });
          } else {
            this.battle = response.battle;
            console.log(response.loggedInfo);
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    reset() {
      BattleService.reset(this.battle.id)
        .then(response => {
          this.battle = response;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created() {
    BattleService.getBattle(this.$props.id)
      .then(response => {
        this.battle = response;
        this.isFetched = true;
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>

<style scoped>
</style>
