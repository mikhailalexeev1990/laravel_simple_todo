<template>
    <form class="form" @submit.prevent="addTodo">
        <h1 class="title">Todo</h1>
        <div class="todo-container">
            <TodoList v-if="todo.length"
                      :list="todo"
                      class="list"
                      @setTodoValue="setTodoValue"
            />
            <h2 v-else class="empty-todo">Here you todo...</h2>
            <Loader :isLoading="loading"/>
        </div>
        <label class="button-box">
            <input v-model="todoValue" placeholder="Example: Clean house">
            <button>Add list</button>
        </label>
    </form>
</template>

<script>
    import axios from "axios";
    import Loader from "./Loader.vue";
    import TodoList from "./TodoList.vue";

    export default {
        components: {
            Loader,
            TodoList,
        },
        data() {
            return {
                todo: [],
                todoValue: null,
                parent: null,
                loading: false,
            }
        },
        created() {
            this.getTodo();
        },
        methods: {
            getTodo() {
                this.loading = true;
                axios.get('/api/v1/todo').then((res) => {
                    this.todo = res.data.todo
                }).finally(() => {
                    this.loading = false;
                })
            },
            addTodo() {
                const {todoValue, parent = null} = this;
                const parentId = parent?.id ?? null;

                if (todoValue) {
                    this.loading = true;
                    axios.post('/api/v1/todo', {todoValue, parentId}).then((res) => {
                        const todoData = res.data;
                        todoData.children = [];

                        (parent === null)
                            ? this.todo.push(todoData)
                            : parent.children.push(todoData);

                        this.setTodoValue(null, null);
                    }).finally(() => {
                        this.loading = false;
                    })
                }
            },
            setTodoValue(todoValue, parent) {
                this.todoValue = todoValue;
                this.parent = parent;
            },
        }
    }
</script>

<style lang="scss">
    .form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 5px 5px 15px #444;

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 0;
            padding-bottom: 10px;
            text-align: center;
            border-bottom: 1px solid;
        }

        .empty-todo {
            font-size: 16px;
            align-self: center;
            width: 100%;
            text-align: center;
        }

        .list {
            width: 100%;
            list-style-type: decimal;
        }

        .todo-container {
            position: relative;
            display: flex;
            min-height: 100px;
        }

        .button-box {
            display: flex;
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;

            input {
                font-size: 14px;
                font-weight: 500;
                line-height: 22px;
                width: 100%;
                margin-right: 10px;
                padding: 10px 20px;
                transition: all 200ms linear;
                letter-spacing: 0.5px;
                color: #c4c3ca;
                border: none;
                border-radius: 4px;
                outline: none;
                background-color: #1f2029;
                box-shadow: 0 4px 8px 0 rgb(21 21 21 / 20%);
            }

            button {
                font-weight: bold;
                min-width: 100px;
                cursor: pointer;
                transition: all 200ms linear;
                border: none;
                border-radius: 4px;
                background-color: #ffeba7;
                box-shadow: 0 4px 8px 0 rgb(21 21 21 / 20%);

                &:hover {
                    background-color: darken(#ffeba7, 7%)
                }

                &:active {
                    background-color: darken(#ffeba7, 15%)
                }
            }
        }
    }
</style>
