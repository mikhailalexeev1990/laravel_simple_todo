<template>
    <div>
        <span class="small-btn" @click.prevent="openInput = !openInput">
            <template v-if="openInput">⊖</template>
            <template v-else>⊕</template>
        </span>

        <template v-if="openInput">
            <label class="button-box">
                <input v-model="todoValue">
                <button @click="sendTodoData">Add sublist</button>
            </label>
        </template>
    </div>
</template>

<script>
    export default {
        props: {
            parent: Object
        },
        data() {
            return {
                openInput: false,
                todoValue: null,
            }
        },
        methods: {
            sendTodoData() {
                if (this.todoValue) {
                    this.$emit('setTodoValue', this.todoValue, this.parent);
                    this.todoValue = null;
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .button-box {
        display: block;
    }
</style>
