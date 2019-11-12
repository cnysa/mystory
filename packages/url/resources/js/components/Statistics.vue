<template>
    <div class="col-md-8">
        <div class="card">
            <b-table responsive striped hover :items="items.data" :fields="fields">
                <template slot="[slug]" slot-scope="data">
                    <strong><a href="#" @click.prevent="goToDetail(data.item.id)">{{ data.item.slug }}</a></strong>
                </template>

                <template slot="[origin_url]" slot-scope="data">
                    <b-link :href="data.item.origin_url" target="_blank">{{ data.item.origin_url.substr(0, 100) }}</b-link>
                </template>
            </b-table>

            <pagination :data="items" @pagination-change-page="getResults" align="center"></pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Statistics",
        data() {
            return {
                fields: [
                    'id',
                    'slug',
                    {key: 'origin_url', thStyle: {width: '50%'}},
                    'count_visitor',
                    'created_at'
                ],
                items: {}
            }
        },
        mounted() {
            // Fetch initial results
            this.getResults();
        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('/urls?page=' + page)
                    .then(response => {
                        this.items = response.data.data;
                    });
            },
            goToDetail(id) {
                this.$router.push({ name: 'UrlDetail', params: { urlId: id } });
            }
        }
    }
</script>

<style scoped>

</style>
