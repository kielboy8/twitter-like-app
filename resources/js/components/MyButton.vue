<template>
    <div>
        <button :type="type" class="my-button" v-text="text">My Button</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        props: [
            'text',
            'type'
        ]
    }
</script>

<style>
    .my-button {
        background: #333;
        color: white;
        padding: 10px 15px;
    }
</style>
