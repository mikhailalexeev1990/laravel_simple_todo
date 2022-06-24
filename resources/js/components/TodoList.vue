<template>
    <ul>
        <li v-for="item in list" :key="item.id" class="todo-item">
            {{ item.todoValue }}

            <SubButton
                :parent="item"
                @setTodoValue="setTodoValue"
            />

            <TodoList
                v-if="item.children && item.children.length"
                :list="item.children"
                @setTodoValue="setTodoValue"
            />
        </li>
    </ul>
</template>

<script>
    import SubButton from './SubButton.vue'

    export default {
        name: 'TodoList',
        components: {
            SubButton,
        },
        props: {
            list: Array
        },
        data() {
            return {
                openInput: false,
            }
        },
        methods: {
            setTodoValue(todoValue, parent) {
                this.$emit('setTodoValue', todoValue, parent);
            }
        }
    }
</script>

<style lang="scss">
    ul {
        list-style-type: disc;
    }

    .todo-item {
        position: relative;

        .small-btn {
            font-size: 26px;
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            align-content: center;
            align-items: center;
            width: 15px;
            height: 15px;
            cursor: pointer;
        }
    }
</style>
