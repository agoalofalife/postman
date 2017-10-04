<template>
    <div>
    <el-row class="table-postman">
        <el-col :span="16" :offset="11" v-show="!flagFetchData">
            <i class="el-icon-loading"></i>
        </el-col>

        <el-col :span="18" :offset="3" v-show="flagFetchData">
            <el-table
            :data="tableData"
            border
            style="width: 100%">

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
                <el-button @click="chooseRow" type="text" size="small">{{buttonEdit}}</el-button>
                <el-button type="text" size="small">{{ buttonRemove }}</el-button>
            </template>
        </el-table-column></el-table>
        </el-col>

        <el-col  :span="18" :offset="3" v-show="flagChooseRow" class="form-edit">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
                <el-form-item label="Activity name" prop="name">
                    <el-input v-model="ruleForm.name"></el-input>
                </el-form-item>
                <el-form-item label="Activity zone" prop="region">
                    <el-select v-model="ruleForm.region" placeholder="Activity zone">
                        <el-option label="Zone one" value="shanghai"></el-option>
                        <el-option label="Zone two" value="beijing"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Activity time" required>
                    <el-col :span="11">
                        <el-form-item prop="date1">
                            <el-date-picker type="date" placeholder="Pick a date" v-model="ruleForm.date1" style="width: 100%;"></el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col class="line" :span="2">-</el-col>
                    <el-col :span="11">
                        <el-form-item prop="date2">
                            <el-time-picker type="fixed-time" placeholder="Pick a time" v-model="ruleForm.date2" style="width: 100%;"></el-time-picker>
                        </el-form-item>
                    </el-col>
                </el-form-item>
                <el-form-item label="Instant delivery" prop="delivery">
                    <el-switch on-text="" off-text="" v-model="ruleForm.delivery"></el-switch>
                </el-form-item>
                <el-form-item label="Activity type" prop="type">
                    <el-checkbox-group v-model="ruleForm.type">
                        <el-checkbox label="Online activities" name="type"></el-checkbox>
                        <el-checkbox label="Promotion activities" name="type"></el-checkbox>
                        <el-checkbox label="Offline activities" name="type"></el-checkbox>
                        <el-checkbox label="Simple brand exposure" name="type"></el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
                <el-form-item label="Resources" prop="resource">
                    <el-radio-group v-model="ruleForm.resource">
                        <el-radio label="Sponsorship"></el-radio>
                        <el-radio label="Venue"></el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="Activity form" prop="desc">
                    <el-input type="textarea" v-model="ruleForm.desc"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">Create</el-button>
                    <el-button @click="resetForm('ruleForm')">Reset</el-button>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>



    </div>
</template>

<style>
    .table-postman{
        margin-top: 7%;
    }
    .form-edit{
        margin-top: 2%
    }
</style>

<script>
    export default {
        methods: {
            chooseRow() {
                this.flagChooseRow = !this.flagChooseRow
            }
        },
        data() {
            return {
                flagFetchData:false,
                flagChooseRow:false,
                buttonEdit:'',
                buttonRemove:'',
                columns:[],
                tableData:[],
               ruleForm: {
                  name: '',
                  region: '',
                  date1: '',
                  date2: '',
                  delivery: false,
                  type: [],
                  resource: '',
                  desc: ''
                },
          rules: {
          name: [
            { required: true, message: 'Please input Activity name', trigger: 'blur' },
            { min: 3, max: 5, message: 'Length should be 3 to 5', trigger: 'blur' }
          ],
          region: [
            { required: true, message: 'Please select Activity zone', trigger: 'change' }
          ],
          date1: [
            { type: 'date', required: true, message: 'Please pick a date', trigger: 'change' }
          ],
          date2: [
            { type: 'date', required: true, message: 'Please pick a time', trigger: 'change' }
          ],
          type: [
            { type: 'array', required: true, message: 'Please select at least one activity type', trigger: 'change' }
          ],
          resource: [
            { required: true, message: 'Please select activity resource', trigger: 'change' }
          ],
          desc: [
            { required: true, message: 'Please input activity form', trigger: 'blur' }
          ]
        },
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
                        this.flagFetchData = true;
                    })
                });
        }
    }

</script>
