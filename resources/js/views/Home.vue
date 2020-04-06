<template>
    <div>
        <div v-if="state.status === 0" class="alert alert-danger" role="alert">
            {{state.content}}
        </div>
        <div v-if="state.status === 1" class="alert alert-success" role="alert">
            {{state.content}}
        </div>
        <div class="input-group mb-3">
            <input type="text" v-model.trim="$v.task.$model" class="form-control" placeholder="Your Task" >
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" @click="create" >Create</button>
            </div>
        </div>
        <ul class="list-group">
            <task v-for="tasks in tasksList"  v-bind:task="tasks" @onDelete="deleteTask"></task>
        </ul>
    </div>
</template>
<script>
    import Task from "../components/Task.vue";
    import { required } from 'vuelidate/lib/validators'
    export default {
        name: "Home",
        components:{Task},
        data: function(){
            return{
                tasksList : null,
                task : null,
                state : {status : null, content :null}
            }
        },
        validations: {
            task: {
                required,
            },
        },
        methods:{
            notifications(state, value){
                this.state.status = state
                this.state.content = value
                setTimeout(()=>{
                    this.state.status = null
                    this.state.content = null
                }, 3000)
            },
            create(){

                if(!this.$v.$invalid){
                    axios({
                        method: 'post',
                        url: 'http://127.0.0.1:8000/api/tasks',
                        data: {
                            content : this.task
                        }
                    }).then(response => {
                        this.tasksList.push(response.data)
                        this.task = null
                        this.notifications(1,"success !")
                    })

                }else{
                    this.notifications(0,"Error while creating !")
                }
            },
            deleteTask(value){
                try{
                    axios({
                        method: 'delete',
                        url: 'http://127.0.0.1:8000/api/tasks/'+value.id,
                    }).then(response => {
                        this.tasksList.forEach( e =>{
                            if (e === value){
                                this.tasksList.splice(this.tasksList.indexOf(e), 1)
                            }
                        })
                        this.notifications(1,"Success !")
                    })
                }catch (e) {
                    this.notifications(0,"Error while deleting !")
                }

            },
        },
        mounted() {
            axios.get('http://127.0.0.1:8000/api/tasks')
                .then(response=> {
                   this.tasksList = response.data
                })
        }
    }
</script>

<style scoped>

</style>
