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
                    <!--<el-button @click="chooseRowEdit(scope.$index,scope.row)" type="text" size="small">{{buttonEdit}}</el-button>-->
                    <el-button @click="chooseRowEdit(scope.$index,scope.row)" type="text" size="small">{{buttonEdit}}</el-button>
                    <el-button @click="chooseRowRemove(scope.$index, scope.row)" type="text" size="small">{{ buttonRemove }}</el-button>
                </template>
            </el-table-column>
            </el-table>
        </el-col>

        <el-dialog :visible.sync="dialogFormVisible">
        <el-col  :span="18" :offset="3"  class="form-edit">
            <el-form :model="form" label-width="120px">
                <el-form-item :label="formText.date.label" prop="date">
                    <el-date-picker type="datetime"  v-model="form.date"></el-date-picker>
                </el-form-item>
                <el-form-item :label="formText.theme.label" prop="theme">
                <el-input placeholder="" v-model="form.theme"></el-input>
                </el-form-item>

                <el-form-item :label="formText.text.label" prop="text">
                    <el-input type="textarea" v-model="form.text"></el-input>
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
    export default {
        methods: {
            chooseRowEdit(index, row) {
                this.dialogFormVisible = true;
                this.сurrentIndex = index;
                this.form.id = row.id;
                this.form.date  = row.date;
                this.form.theme = row.email.theme;
                this.form.text  = row.email.text;
                this.form.mode  = row.mode.id;
                //set in mode "edit"
                this.modeWindow = modeWindow['edit']
            },
            chooseRowRemove(index, row) {
                this.$confirm(this.formText.popup.question, this.formText.popup.title, {
                    confirmButtonText: this.formText.popup.confirmButtonText,
                    cancelButtonText: this.formText.popup.cancelButtonText,
                    type: 'warning'
                }).then(() => {
                    console.log( index, row );
                    this.$http.delete('/postman/api/dashboard.table.tasks.remove/' + row.id)
                        .then(() => {
                            this.tableData.splice(index, 1);
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
                this.$http[this.modeWindow.method](this.modeWindow.url, {
                    id : this.form.id,
                    date : this.form.date,
                    theme : this.form.theme,
                    text : this.form.text,
                    mode : this.form.mode,
                })
                    .then(response => {
                        if (response.data.status) {
                            this.tableData[this.сurrentIndex]['email']['text'] = this.form.text;
                            this.tableData[this.сurrentIndex]['date'] = this.normalizeDate(this.form.date);
                            this.tableData[this.сurrentIndex]['email']['theme'] = this.form.theme;
                            this.tableData[this.сurrentIndex]['mode_id'] = this.form.mode;
                            this.dialogFormVisible = false;
                        }
                    });
            },
            cancelForm() {
                this.dialogFormVisible = false;
            }
        },
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
                },
                normalizeDate : function (date) {
                    return moment(this.form.date).format('YYYY-MM-DD HH:mm:ss')
                }
            }
        },
        mounted: function () {
                this.$http.get('/postman/api/dashboard.table.column')
                    .then(response => {
                        this.buttonEdit = response.data.button.edit;
                        this.buttonRemove = response.data.button.remove;
                        this.columns = response.data.columns;
                        

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
                    this.formText = response.data
                });

            this.$http.get('/postman/api/dashboard.table.listMode')
                .then(response => {
                    this.listMode = response.data
                })
        },
        directives: {
            'date-format': function (el, binding) {
                            el.querySelector('input').value =  binding.value;
                            console.dir( el.querySelector('input').value , binding);
//                            this.form.date = el.querySelector('input').value
                        }
        },
    }


</script>
