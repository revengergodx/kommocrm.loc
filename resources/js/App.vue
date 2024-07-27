<template>
    <div class="m-5">
        <div class="mb-3">
        </div>
<!--        <router-link :to="{name: 'contact.index'}">Contacts</router-link> |-->
        <router-link :to="{name: 'task.index'}">Tasks</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>
