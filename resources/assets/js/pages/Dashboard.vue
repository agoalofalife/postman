<template>
    <div>
    <el-row class="table-postman">
        <el-col :span="16" :offset="3" v-show="flagFetchData">
            <i class="el-icon-plus" @click="createTask"> </i>
        </el-col>
        <br>
        <br>
        <el-col :span="16" :offset="11" v-show="!flagFetchData && !flagFetchError">
            <i class="el-icon-loading"></i>
        </el-col>
        <el-col :span="16" :offset="11" v-show="flagFetchError">
            <h3>Error</h3>
            <h4>{{ errorMessage }}</h4>
        </el-col>
        <el-col :span="18" :offset="3" v-show="flagFetchData">
            <el-table
            :data="tableData"
            border
            style="width: 100%"
            :row-class-name="tableRowClassName"
            >
            <el-table-column v-for="(column, index) in columns"
                         :key="column.prop"
                         :prop="column.prop"
                             sortable
                         :label="column.label"
                         :width="column.size"
                         v-if="index !=3"
                >
            </el-table-column>
            <el-table-column
                     fixed="right"
                     :label="columnAction.label"
                     :width="columnAction.size"
                    >
                <template scope="scope">
                    <el-button @click="chooseRowEdit(scope.$index,scope.row)" size="small">{{buttonEdit}}</el-button>
                    <el-button @click="chooseRowRemove(scope.row)" type="danger"  size="small">{{ buttonRemove }}</el-button>
                </template>
            </el-table-column>
            </el-table>
        </el-col>

        <el-dialog :visible.sync="dialogFormVisible">

        <el-col  :span="18" :offset="3"  class="form-edit">
            <ul style="color:#FF4949" v-for="(value, key, index) in errors">
                <li v-for="err in value">{{ err }} </li>
            </ul>
            <el-form :model="form" label-width="120px" v-loading="clickSubmit">
                <el-form-item :label="formText.date.label" prop="date">
                    <el-date-picker type="datetime" v-model="form.date"></el-date-picker>
                </el-form-item>
                <el-form-item :label="formText.theme.label" prop="theme">
                <el-input placeholder="" v-model="form.theme"></el-input>
                </el-form-item>

                <el-form-item :label="formText.text.label" prop="text">
                    <vue-html5-editor :content="form.text" :height="200" @change="updateFormText($event)" :show-module-name="false"></vue-html5-editor>
                </el-form-item>

                <el-form-item :label="formText.statuses.label" prop="text">
                    <el-select
                            v-model="form.statuses"
                            filterable
                            :placeholder="formText.statuses.placeholder">
                        <el-option
                                v-for="status in statuses"
                                :key="status.id"
                                :label="status.name"
                                :value="status.id">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form-item :label="formText.users.label" prop="text">
                <el-select
                        v-model="form.users"
                        multiple
                        filterable
                        :placeholder="formText.users.placeholder">
                    <el-option
                            v-for="user in users"
                            :key="user.id"
                            :label="user.email"
                            :value="user.id">
                    </el-option>
                </el-select>
                </el-form-item>

                <el-form-item :label="formText.type.label" prop="mode">
                    <el-select v-model="form.mode" :placeholder="formText.type.placeholder">
                        <el-tooltip v-for="mode in listMode" :key="mode.id" :content="mode.description" placement="top">
                            <el-option :label="mode.name" :value="mode.id"></el-option>
                        </el-tooltip>
                    </el-select>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="editTask">{{ formText.button.success }} </el-button>
                    <el-button @click="cancelForm">{{ formText.button.cancel }} </el-button>
                </el-form-item>
            </el-form>
        </el-col>
        </el-dialog>
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
    .el-table .info-row {
        background: #c9e5f5;
    }

    .el-table .positive-row {
        background: #e2f0e4;
    }
</style>

<script>
    import moment from 'moment';

    let modeWindow = {
        'edit' : {
            'url' : '/postman/api/dashboard.table.tasks.update',
            'method' : 'put'
        },
        'create' : {
            'url' : '/postman/api/dashboard.table.tasks.create',
            'method': 'post'
        }
    };
    let stubForm = {
        id:'',
        date: '',
        theme: '',
        text: '',
        mode: '',
        users:'',
        statuses:'',
    };
    export default {
        data() {
            return {
                flagFetchData:false,
                flagFetchError:false,
                buttonEdit:'',
                buttonRemove:'',
                columns:[],
                tableData:[],
                listMode:[],
                modeWindow:'',
                сurrentIndex:'',
                errors:{},
                columnAction:{
                    label:'Operations',
                    size: 120,
                },
                errorMessage:'',
                users:[],
                statuses:[],
                clickSubmit:false,
                dialogFormVisible:false,
                formText:{
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
                    users : {
                        placeholder:'Choose',
                        label :'Users'
                    },
                    statuses :{
                        placeholder:'Choose',
                        label :'Statuses'
                    },
                    button : {
                        success : 'Success',
                        cancel:'Cancel',
                    }
                },
                form: {
                    id:'',
                    date: '',
                    theme: '',
                    text: '',
                    mode: '',
                    users:[],
                    statuses:[],
                },
                normalizeDate : function (date) {
                    return moment(this.form.date).format('YYYY-MM-DD HH:mm:ss')
                },
                syncData: function () {
                    return this.$http.get('/postman/api/dashboard.table.tasks')
                        .then(response => {
                            this.tableData = response.data;
                            this.flagFetchData = true;
                        })
                        .catch((response) => {
                            this.errorMessage = response.message;
                            this.flagFetchError = true
                        })
                }
            }
        },
        methods: {
            chooseRowEdit(index, row) {
                this.errors = {};
                this.dialogFormVisible = true;
                this.сurrentIndex = index;
                this.form.id = row.id;
                this.form.date  = row.date;
                this.form.theme = row.email.theme;
                this.form.text  = row.email.text;
                this.form.mode  = row.mode.id;
                this.form.users =  Object.keys(row.email.users).map(function(key) {
                    return row.email.users[key]['id'];
                });
                this.form.statuses =  row.status.id;
                //set in mode "edit"
                this.modeWindow = modeWindow['edit']
            },
            chooseRowRemove(row) {
                this.$confirm(this.formText.popup.question, this.formText.popup.title, {
                    confirmButtonText: this.formText.popup.confirmButtonText,
                    cancelButtonText: this.formText.popup.cancelButtonText,
                    type: 'warning'
                }).then(() => {
                    this.$http.delete('/postman/api/dashboard.table.tasks.remove/' + row.id)
                        .then(() => {
                            this.syncData();
                            this.$message({
                                type: 'success',
                                message: this.formText.popup['success.message']
                            });
                        })
                        .catch((response) => {
                           console.warn( response );
                        })

                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: this.formText.popup['info.message']
                    });
                });
            },
            editTask() {
                this.clickSubmit = true;
                this.errors = {};
                this.$http[this.modeWindow.method](this.modeWindow.url, {
                    id : this.form.id,
                    date : this.normalizeDate(this.form.date),
                    theme : this.form.theme,
                    text : this.form.text,
                    mode : this.form.mode,
                    users:this.form.users,
                    statuses:this.form.statuses,
                }).then(response => {
                        if (response.data.status) {
                            this.syncData().then(() => {
                                this.dialogFormVisible = false;

                            });
                        }
                    }).catch( response => {
                        console.log( response.response.data );
                        this.errors = response.response.data.errors || response.response.data
                });
                this.clickSubmit = false;
            },
            cancelForm() {
                this.dialogFormVisible = false;
            },
            createTask(){
                this.form = Object.assign(this.form, stubForm);
                this.dialogFormVisible = true;
                this.modeWindow = modeWindow['create']
            },
            updateFormText($event){
                this.form.text = $event;
            },
            tableRowClassName(row, index){
                if (row.status_action == 1) {
                    return 'positive-row';
                }
                return '';
            },
        },
        mounted: function () {
                this.$http.get('/postman/api/dashboard.table.column')
                    .then(response => {
                        this.buttonEdit = response.data.button.edit;
                        this.buttonRemove = response.data.button.remove;
                        this.columns = response.data.columns;
                        this.columnAction = this.columns.pop();
                        this.syncData();
                });
             this.$http.get('/postman/api/dashboard.table.users')
                .then(response => {
                    this.users =  response.data;
                });
            this.$http.get('/postman/api/dashboard.table.statuses')
                .then(response => {
                    this.statuses =  response.data;
                });
        },
        created: function () {
            this.$http.get('/postman/api/dashboard.table.formColumn')
                .then(response => {
                    this.formText = response.data
                });

            this.$http.get('/postman/api/dashboard.table.listMode')
                .then(response => {
                    this.listMode = response.data
                })
        },
    }
</script>
