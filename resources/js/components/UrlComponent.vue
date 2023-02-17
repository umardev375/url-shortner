<template>
    <div class="container">
        <div class="card mb-3">
            <form>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-md-12 my-3">
                            <input
                                type="text"
                                class="form-control"
                                name="url"
                                v-model="url.destination"
                                v-validate="'required|url'"
                                :class="{error: errors.first('url')}"
                                placeholder="https://example.com"
                            />
                            <span class="text-danger">{{ errors.first('url') }}</span>
                            <div class="form-text">
                                Enter the url you want to shorten
                            </div>
                        </div>
                        <div class=" col-sm-2 col-md-2 offset-sm-10 my-3">
                            <button type="button" class="btn btn-primary" @click="saveURL">Create URL</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- url table -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="33%">SLUG</th>
                                    <th width="43%">URL</th>
                                    <th width="33%">CREATED AT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="url in urls" :key="url.id">
                                    <td>{{ url.shortened_url }}</td>
                                    <td>{{ url.destination }}</td>
                                    <td>{{ url.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: {},
            urls: []
        }
    },
    mounted() {
        this.fetchAllUrls();
    },
    methods: {
        fetchAllUrls() {
            this.axios.get('/api/all-urls')
                .then(response => {
                    this.urls = response.data.urls;
                })
        },
        saveURL() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.axios.post('/api/save-urls', this.url)
                        .then(response => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Url shortened successfully!'
                            })
                            this.url = ''
                            this.fetchAllUrls();
                        })
                }
            });
        }
    }
}
</script>

<style scoped>
</style>
