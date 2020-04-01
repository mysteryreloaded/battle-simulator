import ArmyCreate from "./views/ArmyCreate.vue";
import BattleList from "./views/BattleList.vue";
import BattleShow from "./views/BattleShow.vue";

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            name: "battle-list",
            component: BattleList
        },
        {
            path: "/battles/:id",
            name: "battle-show",
            component: BattleShow,
            props: true
        },
        {
            path: "/battles/:id/add-army",
            name: "add-army",
            component: ArmyCreate
        }
    ]
};
