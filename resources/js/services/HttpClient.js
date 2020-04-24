import axios from "axios";
import Vue from 'vue';

const instance = axios.create({
    baseURL: `${process.env.MIX_APP_URL}/api`,
    headers: {
        "Content-type": "application/json"
    }
});

instance.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        Vue.toasted.error(error.response.data.message);
    }
);
export default instance;
