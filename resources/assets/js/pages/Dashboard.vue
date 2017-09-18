<template>
    <el-row class="table-postman">
        <el-col :span="16" :offset="4">
    <el-table
            :data="tableData"
            border
            style="width: 100%">
        <el-table-column
                fixed
                prop="number"
                label="№"
                width="40">
        </el-table-column>
        <el-table-column
                fixed
                prop="dateStart"
                label="Date start"
                width="170">
        </el-table-column>
        <el-table-column
                prop="theme"
                label="Theme"
                width="180">
        </el-table-column>
        <el-table-column
                prop="text"
                label="Text"
                width="400">
        </el-table-column>
        <el-table-column
                prop="mode"
                label="Mode"
                width="130">
        </el-table-column>
        <el-table-column
                prop="status"
                label="Status"
                width="120">
        </el-table-column>
        <el-table-column
                prop="updateAt"
                label="Update At"
                width="120">
        </el-table-column>
        <el-table-column
                fixed="right"
                label="Operations"
                width="120">
            <template scope="scope">
                <el-button @click="handleClick" type="text" size="small">Detail</el-button>
                <el-button type="text" size="small">Edit</el-button>
            </template>
        </el-table-column>
    </el-table>
        </el-col>
        </el-row>
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
                tableData: [{
                    number: '1',
                    dateStart: '2016-05-03 12:42',
                    theme: 'California',
                    text: 'Los Angeles',
                    mode: 'Every',
                    status: 'Success',
                    updateAt: '2016-05-03'
                }]
            }
        }
    }
</script>
