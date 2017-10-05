<template>
    <div>
    <el-row class="table-postman">
        <el-col :span="16" :offset="11" v-show="!flagFetchData && !flagFetchError">
            <i class="el-icon-loading"></i>
        </el-col>
        <el-col :span="16" :offset="11" v-show="flagFetchError">
            <h4>Error</h4>
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
                <el-button @click="chooseRowEdit" type="text" size="small">{{buttonEdit}}</el-button>
                <el-button @click="chooseRowRemove" type="text" size="small">{{ buttonRemove }}</el-button>
            </template>
        </el-table-column></el-table>
        </el-col>

        <el-col  :span="18" :offset="3" v-show="flagChooseRow" class="form-edit">
            <el-form :model="ruleForm" label-width="120px" class="demo-ruleForm">
                <el-form-item :label="form.date.label" prop="date">
                    <el-date-picker type="datetime" v-model="ruleForm.date"></el-date-picker>
                </el-form-item>
                <el-form-item :label="form.theme.label" prop="theme">
                <el-input placeholder="" v-model="ruleForm.theme"></el-input>
                </el-form-item>

                <el-form-item :label="form.text.label" prop="text">
                    <el-input type="textarea" v-model="ruleForm.desc"></el-input>
                </el-form-item>

                <el-form-item :label="form.type.label" prop="mode">
                    <el-select v-model="ruleForm.mode" :placeholder="form.type.placeholder">
                        <el-tooltip v-for="mode in listMode" :key="mode.id" :content="mode.description" placement="top">
                            <el-option :label="mode.name" :value="mode.id"></el-option>
                        </el-tooltip>

                    </el-select>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">{{ form.button.success }} </el-button>
                    <el-button @click="cancelForm">{{ form.button.cancel }} </el-button>
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
            chooseRowEdit() {
                this.flagChooseRow = !this.flagChooseRow;
            },
            chooseRowRemove() {
                this.$confirm(this.form.popup.question, this.form.popup.title, {
                    confirmButtonText: this.form.popup.confirmButtonText,
                    cancelButtonText: this.form.popup.cancelButtonText,
                    type: 'warning'
                }).then(() => {
                    this.$message({
                        type: 'success',
                        message: this.form.popup['success.message']
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: this.form.popup['info.message']
                    });
                });
            },
            cancelForm() {
                this.flagChooseRow = false;
            }
        },
        data() {
            return {
                flagFetchData:false,
                flagFetchError:false,
                flagChooseRow:false,
                buttonEdit:'',
                buttonRemove:'',
                columns:[],
                tableData:[],
                listMode:[],
                form:{
                    date : {
                        label : 'Date of sending email'
                    },
                    theme:{
                        label:'Subject email',
                    },
                    text : {
                        label:'Text email',
                    },
                    type : {
                        placeholder:'Choose',
                        label :'Type of sending'
                    },
                    button : {
                        success : 'Success',
                        cancel:'Cancel',
                    }
                },
                ruleForm: {
                  date: '',
                  theme: '',
                  text: '',
                  mode: '',
                  resource: '',
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
                        this.tableData = response.data;
                        this.flagFetchData = true;
                    })
                     .catch(() => {
                            this.flagFetchError = true
                     })
                });
        },
        created: function () {
            this.$http.get('/postman/api/dashboard.table.formColumn')
                .then(response => {
                    this.form = response.data
                });

            this.$http.get('/postman/api/dashboard.table.listMode')
                .then(response => {
                    this.listMode = response.data
                })
        }
    }

</script>
