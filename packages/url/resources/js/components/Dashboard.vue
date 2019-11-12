<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create short URL</div>
            <div class="card-body">
                <b-form @submit="onSubmit">
                    <b-form-group
                        id="input-group-1"
                        label="Origin URL"
                        label-for="input-1"
                    >
                        <b-form-input
                            id="input-1"
                            v-model="form.origin_url"
                            type="text"
                            required
                            placeholder="Enter the origin URL..."
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group>
                        <b-button type="submit" variant="primary">Submit</b-button>
                    </b-form-group>
                </b-form>

                <b-alert variant="success" :show="isSuccess"><strong>{{ backend.domain }}/{{ result }}</strong></b-alert>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        props: ['backend'],
        data() {
            return {
                form: {
                    origin_url: null
                },
                result: null,
                isSuccess: false
            }
        },
        methods: {
            onSubmit(e) {
                e.preventDefault();
                axios.post('/urls', this.form)
                    .then(response => {
                        this.isSuccess = response.data.success;
                        this.result = response.data.data.slug;
                    })
                    .catch(error => {
                        // TODO: validate on textbox
                        console.log(error.response)
                    });
            }
        }
    }
</script>

<style scoped>

</style>
