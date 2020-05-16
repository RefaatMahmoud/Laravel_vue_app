import {http, httpFile} from "./http_service";
import store from "../store";

export function create(data) {
    let api_url = `${store.state.apiUrl}/products`;
    return httpFile().post(api_url, data).then(response => {
        return response;
    }).catch(error => {
        alert(error)
    })
}


export function get() {
    let api_url = `${store.state.apiUrl}/products`;
    return http().get(api_url).then(response => {
        if (response.data.status === true) {
            return response.data.products;
        }
    }).catch(error => {
        alert(error)
    })
}

export function remove(id) {
    let api_url = `${store.state.apiUrl}/products/${id}`;
    return http().delete(api_url).then(response => {
        if (response.data.status === true) {
            return response;
        }
    }).catch(error => {
        alert(error)
    })
}
