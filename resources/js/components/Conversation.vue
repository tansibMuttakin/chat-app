<template>
    <div class="conversation">
        <h1>{{contact ? contact.name : "select a contact"}}</h1>
        <MessageFeed :contact="contact" :messages="messages"/>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import MessageComposer from './MessageComposer';
    import MessageFeed from './MessageFeed';
    export default {
        props:{
            contact:{
                type:Object,
                default:null,
            },
            messages:{
                type:Array,
                default:[]
            }
        },
        methods:{
            sendMessage(text){
                if (!this.contact) {
                    return
                }
                axios.post('/conversation/send',{
                    contact_id: this.contact.id,
                    text:text
                }).then((response)=>{
                    this.$emit('new', response.data)
                })
            }
        },
        components:{
            MessageComposer,
            MessageFeed,
        }
    }
</script>
<style lang="scss">
.conversation{
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1{
        font-size:20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
}
</style>