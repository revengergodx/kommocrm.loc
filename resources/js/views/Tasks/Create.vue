<template>
    <div class="w-25">
        <div class="mb-3">
            <label>Creating new Task</label>
            <input type="text" v-model="task_text" class="form-control" placeholder="Task Name">
            <!--            <div class="text-danger" v-if="v$.deal_name.$invalid">{{ v$.deal_name.$silentErrors[0].$message }}</div>-->
        </div>
        <div class="mb-3">
            <label>Assign User for task</label>
            <div>
                <select v-model="assigned_user" class="form-control">
                    <option v-for="user in users_for_assign" :value="user.id">
                        {{ user.name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label>Assign day for Task</label>
            <div>
                <input type="date" v-model="task_day">
            </div>
            <label>Assign time for Task</label>
            <div>
                <span style="margin-right: 4px">Start time</span><input :disabled="!task_day" type="time"
                                                                        v-model="task_start_time"
                                                                        style="margin-right: 10px"> <span
                style="margin-right: 4px">End time</span><input type="time" :disabled="!task_day"
                                                                v-model="task_end_time">
            </div>
        </div>
        <div>
            <input @click.prevent="store" type="submit" value="Submit" class="btn btn-primary">
        </div>
    </div>
</template>

<script>

export default {
    name: "Create",

    data() {
        return {
            task_text: null,
            users_for_assign: [],
            assigned_user: {
                id: null,
                name: null,
            },
            task_day: null,
            task_start_time: null,
            task_end_time: null,
            tasks: [],
            assignedUserTasks: [],
            duration: null,

        }
    },
    mounted() {
        this.getAllTasks()
        this.getAllUsers()
    },

    methods: {
        store() {
            if (this.task_start_time == null) {
                alert('Choose time!')
            } else {
                this.assignedUserTasks = []
                if (this.task_end_time == null || (Date.parse(this.task_day + ' ' + this.task_end_time) / 1000) < (Date.parse(this.task_day + ' ' + this.task_start_time) / 1000)) {
                    this.task_end_time = this.task_start_time
                }
                this.duration = this.task_end_time - this.task_start_time
                this.tasks.forEach((el) => {
                    if (el.responsible_user_id === this.assigned_user) {
                        this.assignedUserTasks.push(el);
                    }
                })

                if (this.assignedUserTasks.some(time => (Date.parse(this.task_day + ' ' + this.task_start_time) / 1000) >= time.complete_till && (Date.parse(this.task_day + ' ' + this.task_start_time) / 1000) <= time.complete_till + time.duration || ((Date.parse(this.task_day + ' ' + this.task_start_time) / 1000) + this.duration) >= time.complete_till && ((Date.parse(this.task_day + ' ' + this.task_start_time) / 1000) + this.duration) <= time.complete_till + time.duration)) {
                     alert('Chosen time is already been taken, please choose another time range')
                } else {
                    axios.post('/api/tasks/create', {
                        text: this.task_text,
                        complete_till: Date.parse(this.task_day + ' ' + this.task_start_time) / 1000,
                        duration: (Date.parse(this.task_day + ' ' + this.task_end_time) / 1000 - Date.parse(this.task_day + ' ' + this.task_start_time) / 1000),
                        responsible_user_id: this.assigned_user
                    })
                        .then(res => {
                            alert('You\'ve successfully added task!');
                            this.getAllTasks()
                        })
                        .catch(err => {
                            if (err.response.status === 400) {
                                alert('Chosen time is already been taken, please choose another time range')
                            }
                        })
                }
            }

        },

        getAllTasks() {
            axios.get('/api/tasks')
                .then(res => {
                    if (res.data != 'There is no tasks yet') {
                    this.tasks = []
                    res.data.forEach((el) => this.tasks.push({
                        id: el.id,
                        complete_till: el.complete_till + el.duration,
                        responsible_user_id: el.responsible_user_id,
                        duration: el.duration
                    }));
                    }
                })
        },

        getAllUsers() {
            axios.get('/api/tasks/create')
                .then(res => {
                    res.data.users.users.forEach((el) => this.users_for_assign.push({id: el.id, name: el.name}))
                    console.log(this.tasks)
                })
        },
    }
}
</script>

<style scoped>

</style>
