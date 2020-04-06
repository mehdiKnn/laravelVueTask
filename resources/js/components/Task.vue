<template>
    <li class="list-group-item">
        <div class="d-flex w-100 justify-content-between align-items-center">
            <div class="w-75">
                <h5 class="card-title"># {{task.id}}</h5>
                <p class="mb-1">{{task.content}}</p>
            </div>
            <div>
                <button type="button" @click="onDelete" class="btn btn-danger">Delete</button>
                <router-link v-bind:to="'/task/'+task.id" >
                    <button type="button" class="btn btn-warning">Update</button>
                </router-link>
            </div>
        </div>
    </li>
</template>
<script>
    export default {
        name: "Task",
        props:['task'],
        methods:{
            onDelete(){
                this.$emit('onDelete', this.task)
            }
        }
    }
</script>

<style scoped>

</style>
