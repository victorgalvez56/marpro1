<template>
    <el-dialog
        title="Links"
        :visible="showDialog"
        @close="close"
        @open="create"
    >
        <div class="card mb-0">
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Link</th>
                                <th class="text-center">Style</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(row, index) in links"
                                v-bind:key="index"
                            >
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <a :href="row.href" target="_blank">Ir a</a>
                                </td>
                                <td class="text-center">
                                    <code>
                                        {{ row.style }}
                                    </code>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </el-dialog>
</template>

<script>
export default {
    props: ["showDialog", "links"],
    data() {
        return {};
    },
    created() {},
    methods: {
        create() {},
        close() {
            this.$emit("update:showDialog", false);
        }
    }
};
</script>

<style scoped>
.pt-0 {
    padding-top: 0;
}
</style>
