<template>
    <div>
        <div class="comment" v-bind:class="{'deleted': isDeleted() }">

            <div v-if="isDeleted() === false">
                <h3>{{comment.created_at}}</h3>
                <p>{{comment.content}}</p>
            </div>

            <div v-if="isDeleted()">
                <p>Comment was deleted</p>
            </div>

            <p v-if="isDeleted() === false">
                <button v-on:click="answerToggle()">answer</button>
                <button v-on:click="editToggle()">edit</button>
                <button v-on:click="destroy()">delete</button>
            </p>

            <div v-if="activeAnswer === true">
                <textarea v-model="answer" rows="7"></textarea>

                <p>
                    <button v-on:click="store()">Answer</button>
                </p>
            </div>

            <div v-if="activeEdit === true">

                <textarea v-model="comment.content" rows="7"></textarea>

                <p>
                    <button v-on:click="update()">SAVE</button>
                </p>
            </div>
        </div>
        <ul v-if="hasChildren()">
            <comment-component
                v-for="child in comment.children"
                v-bind:key="child.id"
                :comment="child">

            </comment-component>
        </ul>
    </div>
</template>

<script>
    import CommentDataService from "../../services/CommentDataService";

    export default {
        name: "comment-component",
        props: ['comment'],
        data() {
            return {
                answer: null,
                deleted: false,
                activeEdit: false,
                activeAnswer: false,
            }
        },
        methods: {
            destroy() {
                CommentDataService.delete(this.comment.id).then(response => {
                    this.deleted = true;
                    this.comment.content = response.data.message;
                })
            },

            editToggle() {
                if (this.activeEdit === true) {
                    return this.activeEdit = false;
                }

                return this.activeEdit = true
            },

            answerToggle() {
                if (this.activeAnswer === true) {
                    return this.activeAnswer = false;
                }

                return this.activeAnswer = true
            },

            update() {
                CommentDataService.update(this.comment.id, {content: this.comment.content}).then(response => {
                    this.activeEdit = false;
                })
            },

            store() {
                let data = {
                    content: this.answer,
                    parent_id: this.comment.id
                };

                CommentDataService.create(data).then(response => {
                    this.activeAnswer = false;
                    this.answer = null;
                    return this.comment.children.unshift(response.data.data);
                })
            },

            isDeleted() {
                return this.deleted === true || this.comment.deleted === true;
            },

            hasChildren() {
                return this.comment.children && this.comment.children.length;
            }
        }
    }
</script>

<style scoped>
    .comment {
        padding: 5px 13px;
        background: #f1fff1;
        margin-bottom: 2px;
    }

    .deleted {
        background: #ff6957 !important;
    }

    textarea {
        width: 100%;
    }
</style>
