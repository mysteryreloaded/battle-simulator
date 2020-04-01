import axios from "axios";

const apiClient = axios.create();

export default {
    createBattle() {
        return apiClient.post("/api/battles");
    },
    getAllBattles() {
        return apiClient.get("/api/battles");
    },
    getBattle(id) {
        return apiClient.get("/api/battles/" + id);
    },
    addArmy(id, army) {
        return apiClient.post("/api/battles/" + id + "/add-army", army);
    },
    attack(id) {
        return apiClient.post("/api/battles/" + id + "/attack");
    },
    reset(id) {
        return apiClient.post("/api/battles/" + id + "/reset");
    }
};
