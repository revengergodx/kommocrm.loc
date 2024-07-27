<template>
    <div>
        <router-link :to="{name: 'task.index'}">Back</router-link>
    </div>
    <div>

    </div>

</template>

<script>
export default {
    name: "Index",

    data() {
        return {
            task: null,
        }
    },

    mounted() {
        this.getTasks()
    },

    methods: {
        getTasks() {
            axios.get(`/api/tasks/${this.$route.params.id}`)
                .then(res => {
                    console.log(res.data.tasks);
                    this.task = res.data.tasks;
                })
        },
    }
}

</script>

<style scoped>

</style>
