<template>
    <div>
    <el-row class="table-postman">
        <el-col :span="16" :offset="11" v-show="!flagFetchData">
            <i class="el-icon-loading"></i>
        </el-col>

        <el-col :span="16" :offset="4" v-show="flagFetchData">
            <el-table
            :data="tableData"
            border
            style="width: 100%">

       <!--  <el-table-column
        fixed
        prop="number"
        label="№"
        width="40">
        </el-table-column> -->

        <el-table-column v-for="(column, index) in columns"
                         :key="column.prop"
                         :prop="column.prop"
                         :label="column.label"
                         :width="column.size">
        </el-table-column>


        <el-table-column
                fixed="right"
                label="Operations"
                width="120">
            <template scope="scope">
                <el-button @click="handleClick" type="text" size="small">{{buttonEdit}}</el-button>
                <el-button type="text" size="small">{{ buttonRemove }}</el-button>
            </template>
        </el-table-column>
    </el-table>
        </el-col>
        </el-row>
    </div>
</template>

<style>
    .table-postman{
        margin-top: 7%;
    }

</style>

<script>
    export default {
        methods: {
            handleClick() {
                console.log('click');
            }
        },
        data() {
            return {
                flagFetchData:false,
                buttonEdit:'',
                buttonRemove:'',
                columns:[],
                // tableData: [{
                //     number: '1',
                //     date: '2016-05-03 12:42',
                //     theme: 'California',
                //     text: 'Los Angeles',
                //     mode: 'Every',
                //     status: 'Success',
                //     updateAt: '2016-05-03'
                // }],
                tableData:[],
            }
        },
        mounted: function () {
                this.$http.get('/postman/api/dashboard.table.column')
                    .then(response => {
                        this.buttonEdit = response.data.button.edit;
                        this.buttonRemove = response.data.button.remove;
                        this.columns = response.data.columns
                        

                     this.$http.get('/postman/api/dashboard.table.tasks')
                        .then(response => {
                            this.tableData = response.data
                            console.log(response.data)
                            this.flagFetchData = true;
                        })
//                        this.stats = response.data;
//
//                        if (_.values(response.data.wait)[0]) {
//                            this.stats.max_wait_time = _.values(response.data.wait)[0];
//                            this.stats.max_wait_queue = _.keys(response.data.wait)[0].split(':')[1];
//                        }

//                        this.loadingStats = false;
                    });
        }
    }

</script>
