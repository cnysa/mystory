<template>
    <div class="col-md-8">
        <div class="card">
            <b-table responsive striped hover :items="items.data" :fields="fields">
                <template slot="[ip]" slot-scope="data">
                    <strong>{{ data.item.params.ip }}</strong>
                </template>

                <template slot="[user_agent]" slot-scope="data">
                    <small>{{ data.item.params.user_agent }}</small>
                </template>

                <template slot="[isp]" slot-scope="data" v-if="data.item.params.ip_tracking">
                    {{ data.item.params.ip_tracking.isp }}
                </template>

                <template slot="[location]" slot-scope="data" v-if="data.item.params.ip_tracking">
                    <small>{{ data.item.params.ip_tracking.country_name }}</small>&nbsp;
                    <img :src="'https://ipgeolocation.io/static/flags/' + data.item.params.ip_tracking.country_code2.toLowerCase() + '_64.png'" width="25px"/><br/>
                    <small>{{ data.item.params.ip_tracking.city }}</small><br/>
                    <small>{{ data.item.params.ip_tracking.district }}</small>
                </template>
            </b-table>

            <pagination :data="items" @pagination-change-page="getResults" align="center"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UrlDetail",
        data() {
            return {
                fields: [
                    {key: 'ip', label: 'IP'},
                    {key: 'user_agent', thStyle: {width: '40%'}},
                    {key: 'isp', label: 'ISP'},
                    'location',
                    'created_at'
                ],
                items: {
                    'params': {}
                }
            }
        },
        mounted() {
            this.getResults();
        },
        methods: {
            getResults(page = 1) {
                axios.get('/urls/' + this.$route.params.urlId + '/details?page=' + page)
                    .then(response => {
                        this.items = response.data.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
