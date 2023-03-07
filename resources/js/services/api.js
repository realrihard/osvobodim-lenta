import axios from "axios";

export default class apiData {
    static async getData() {
        try {
            const data = await axios.get("/sanctum/csrf-cookie").then(resp => {
                return axios.get('api/posts/show')
                    .then((response) => {
                        const data = response.data.data.sort((a, b) => a.showId - b.showId);
                        return data
                    })
            })
            return data
        } catch (err) {
            return err
        }
    }

    static async addPost(formData) {
        try {
            const data = await axios.get("/sanctum/csrf-cookie").then(resp => {
                return axios.post('/api/posts/add', formData)
                    .then((response) => {
                        return response.data
                    })
            })
            return data
        } catch (err) {
            return err
        }
    }

    static async editPost(postId, formData) {
        try {
            const data = await axios.get("/sanctum/csrf-cookie").then(resp => {
                return axios.post('/api/posts/edit/' + postId, formData)
                    .then((response) => {
                        return response.data.post
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            })
            return data
        } catch (err) {
            return err
        }
    }

    static async updatePostOrder(newBlockOrder) {
        try {
            const data = await axios.get("/sanctum/csrf-cookie").then(resp => {
                return axios.post('/api/posts/change-post-order', newBlockOrder)
                    .then((response) => {
                        console.log(response.data)
                        return response
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            })
            return data
        } catch (err) {
            return err
        }
    }

    static async deletePost(postId) {
        try {
            await axios.get("/sanctum/csrf-cookie").then(resp => {
                return axios.delete('/api/posts/delete/' + postId)
                    .then((response) => {
                        return response
                    })
            })
        } catch (err) {
            return err
        }
    }
}
