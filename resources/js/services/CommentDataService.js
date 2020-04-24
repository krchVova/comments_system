import http from "./HttpClient";

class CommentDataService {

    /**
     *
     * @return {Promise<AxiosResponse<T>>}
     */
    getAll() {
        return http.get("/comment");
    }

    /**
     *
     * @param data
     * @return {Promise<AxiosResponse<T>>}
     */
    create(data) {
        return http.post("/comment", data);
    }

    /**
     *
     * @param id
     * @param data
     * @return {Promise<AxiosResponse<T>>}
     */
    update(id, data) {
        return http.put(`/comment/${id}`, data);
    }

    /**
     *
     * @param id
     * @return {Promise<AxiosResponse<T>>}
     */
    delete(id) {
        return http.delete(`/comment/${id}`);
    }
}

export default new CommentDataService();
