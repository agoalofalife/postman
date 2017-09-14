
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="https://unpkg.com/vue@latest"></script>
<!-- use the latest release -->
<script src="https://unpkg.com/vue-select@latest"></script>

<div class="">
    <table class="table table-striped">
        <tr>
            <th>№</th>
            <th>Date Start</th>
            <th>Theme</th>
            <th>Text</th>
            <th>Mode</th>
            <th>Status</th>
            <th>Update At</th>
        </tr>
      @foreach($tasks as $task)
        <td>{{ $task->id }}</td>
        <td>{{ $task->date }}</td>
        <td>{{ $task->email->theme }}</td>
        <td>{{ $task->email->text }}</td>
        <td>{{ $task->mode->name }}</td>
        <td>{{ $task->status_action ? "Done" : 'Not executed' }}</td>
            <td>{{ $task->updated_at }}</td>
      @endforeach
    </table>
</div>

<div class="container">
    <v-select v-model="selected" :options="users"></v-select>

</div>
<script>
    Vue.component('v-select', VueSelect.VueSelect);
    var vue = new Vue({
        el: '.container',
        data: {
            selected: null,

        },
        computed:{
            users : function () {
                var xhr = new XMLHttpRequest()

                xhr.open('GET','/postman/users')
                xhr.onload = function () {

                    JSON.parse(xhr.responseText).each(function(value){
                        console.log(value.name)
                    })

//                    console.log(xhr.responseText)
//                    self.commits = JSON.parse(xhr.responseText)
//                    console.log(self.commits[0].html_url)
                }
                xhr.send()
            }
        }
    })

</script>