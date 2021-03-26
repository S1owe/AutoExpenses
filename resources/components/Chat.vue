<template>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <textarea class="form-control" rows="10" readonly="">{{messages.join('\n')}}</textarea>
                <hr>
                <input type="text" class="form-control" v-model="textMessage" @keyup.enter="sendMessage">
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        data(){
            return {
                messages:[],
                textMessage:''
            }
        },
        mounted() {
            window.Echo.channel('')
            .listen('Message',({message})=>{
                alert(message);
            })
        },
        methods:{
            sendMessage(){
                axis.post('messages',{body:"HALO"});

            }

        }
    }
</script>
