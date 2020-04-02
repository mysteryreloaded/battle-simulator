import axios from "axios";

const apiClient = axios.create();

export default {
    createBattle() {
        return apiClient.post("/api/battles")
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                throw error;
            });
    },
    getAllBattles() {
        return apiClient.get("/api/battles")
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                throw error;
            });
    },
    getBattle(id) {
        return apiClient.get("/api/battles/" + id)
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                throw error;
            });
    },
    addArmy(id, army) {
        return apiClient.post("/api/battles/" + id + "/add-army", army)
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                throw error;
            });
    },
    attack(id) {
        return apiClient.post("/api/battles/" + id + "/attack")
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                throw error;
            });
    },
    reset(id) {
        return apiClient.post("/api/battles/" + id + "/reset")
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                throw error;
            });
    }
};
