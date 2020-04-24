<template>
    <div>
        <textarea v-model="new_comment.content" rows="7"></textarea>
        <p>
            <button v-on:click="store()">Send</button>
        </p>
        <ul>
            <li v-for="comment in comments" :key="comment.id">
                <comment-component :comment="comment"></comment-component>
            </li>
        </ul>
    </div>
</template>

<script>
    import CommentComponent from "./CommentComponent";
    import CommentDataService from "../../services/CommentDataService";

    export default {
        components: {
            CommentComponent
        },
        name: "ListCommentsComponent",
        data() {
            return {
                comments: null,

                new_comment: {
                    content: null
                }
            };
        },

        created: function () {
            this.fetchAll()
        },

        methods: {

            fetchAll() {
                CommentDataService.getAll().then(response => {
                    this.comments = response.data.data;

                });
            },

            store() {
                CommentDataService.create(this.new_comment).then(response => {
                    this.new_comment.content = null;

                    this.comments.unshift(response.data.data)
                });
            }
        }
    }
</script>

<style scoped>
    ul li {
        list-style: none;
    }
    textarea {
        width: 100%;
    }
</style>
