<template>
    <div>
        <router-link :to="{name: 'task.create'}">Create Task</router-link>
    </div>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Task id</th>
                <th scope="col">Task text</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in tasks">
                <td>
                    <router-link :to="{name: 'task.show', params: {id: task.id }}">{{ task.id }}</router-link>
                </td>
                <td v-if="task.text != ''">{{ task.text }}</td>
                <td v-else>No text</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
export default {
    name: "Index",

    props: {
        id: String
    },

    data() {
        return {
            tasks: null
        }
    },

    mounted() {
        this.getTasks()
    },

    methods: {
        getTasks() {
            axios.get('/api/tasks')
                .then(res => {
                    this.tasks = res.data;
                    console.log(this.tasks)
                })
        },
    }
}

</script>

<style scoped>

</style>
