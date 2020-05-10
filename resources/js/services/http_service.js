import Axios from "axios";
import store from "../store/index";

export function http() {
    return Axios.create({
        baseURL: store.state.apiUrl
    });
}

export function httpFile() {
    return Axios.create({
        baseURL: store.state.apiUrl,
        headers: {'Content-Type': 'multipart/form-data'}
    });
}

