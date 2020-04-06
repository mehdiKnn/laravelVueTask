<template>
    <div class="d-flex flex-column w-100">
        <router-link class="align-self-start" to="/">Back</router-link>
        <h4 class="align-self-center">Update task</h4>
        <div v-if="state.status === 0" class="alert alert-danger" role="alert">
            {{state.content}}
        </div>
        <div v-if="state.status === 1" class="alert alert-success" role="alert">
            {{state.content}}
        </div>
        <div class="align-self-start input-group mb-3 mt-3">
            <textarea type="text" v-model.trim="$v.content.$model"
                      class="form-control"></textarea>
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"
                        @click="updateTask">Update
                </button>
            </div>
        </div>
        <div class="align-self-start card w-100" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">#Your Task</h5>
                <p class="card-text">{{content}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import {required} from 'vuelidate/lib/validators'

    export default {
        name: "UpTask",
        data: function () {
            return {
                task: "",
                content : "",
                state: {status: null, content: null}
            }
        },
        validations: {
            content: {
                required,
            },
        },
        methods: {

            notifications(state, value) {
                this.state.status = state
                this.state.content = value
                setTimeout(() => {
                    this.state.status = null
                    this.state.content = null
                }, 3000)
            },

            updateTask() {
                console.log(this.$v)
                if (!this.$v.$invalid) {
                    axios({
                        method: 'put',
                        url: '/api/tasks/' + this.task.id,
                        data: {
                            content: this.content
                        }
                    }).then(() => {
                        this.notifications(1, "success !")
                    })
                } else {
                    this.notifications(0, "Error !")
                }
            },
        },
        mounted() {
            axios.get('/api/tasks/' + this.$route.params.id)
                .then(response => {
                    this.task = response.data
                    this.content = response.data.content
                })

        }

    }
</script>

<style scoped>

</style>
