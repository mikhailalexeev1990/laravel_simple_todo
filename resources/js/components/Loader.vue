<template>
    <div class="loader-wrapper">
        <svg v-if="loading" preserveAspectRatio="xMidYMid" style="margin: auto; background: none; display: block; shape-rendering: auto;"
             viewBox="0 0 100 100"
             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <circle cx="50" cy="50" fill="none" r="31" stroke="#239dbf" stroke-dasharray="84.82300164692441 30.274333882308138"
                    stroke-width="4">
                <animateTransform attributeName="transform" dur="1.408450704225352s" keyTimes="0;1"
                                  repeatCount="indefinite" type="rotate" values="0 50 50;360 50 50"></animateTransform>
            </circle>
        </svg>
    </div>
</template>

<script>
    export default {
        props: {
            isLoading: Boolean
        },
        data() {
            return {
                loading: false,
            }
        },
        watch: {
            isLoading(val, oldVal) {
                this.loading = val;
            }
        },
        created() {
            this.loading = this.isLoading
        },
    }
</script>

<style lang="scss" scoped>
    .loader-wrapper {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100px;
        margin: 0 auto;
    }
</style>
