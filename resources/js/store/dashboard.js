import { defineStore } from 'pinia'

export const useDashboardStore = defineStore('store', {
    state: () => ({
        posts: [],
        panelSettings: {
            visible: false,
            title: "",
            type: ""
        },
        editedPost: null
    }),
    actions: {
        getPosts(posts) {
            this.posts = posts
        },
        getPanelSettings(visible, title, type) {
            this.panelSettings.visible = visible
            this.panelSettings.title = title
            this.panelSettings.type = type
            if (visible) {
                document.body.style.overflow = 'hidden'
            } else {
                document.body.style.overflow = 'auto'
            }
            if (this.editPost) {
                this.editPost = null
            }
        },
        getEditedPost(post) {
            this.editedPost = post
        },
        addPost(post) {
            this.posts.unshift(post)
        },
        refreshPost(post) {
            const index = this.posts.findIndex(obj => obj.id === post.id);
            if (index !== -1) {
                Object.keys(post).forEach(key => {
                    console.log(key)
                    this.posts[index][key] = post[key]
                })
            }
        },
        deletePost(postId) {
            const index = this.posts.findIndex(obj => obj.id === postId);
            if (index !== -1) {
                this.posts[index].deleted = true;
                setTimeout(() => {
                    this.posts.splice(index, 1)
                }, 500);
            }
        }
    }
})
