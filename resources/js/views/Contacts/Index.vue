<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Account Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Website</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="contact in contacts">
                <td>{{ contact.name }}</td>
                <td>{{ contact.Website }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Index",

    data() {
        return {
            contacts: null
        }
    },

    mounted() {
        this.getPeople()
    },

    methods: {
        getPeople() {
            axios.get('/api/contacts')
                .then(res => {
                    console.log(res.data.contacts);
                    this.contacts = res.data.contacts;
                })
        },
    }
}
</script>

<style scoped>

</style>
