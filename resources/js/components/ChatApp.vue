<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactList :contacts="contacts" @selected="startConversationWith"/>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';
    export default {
        props:{
            user:{
                type:Object,
                required:true,
            }
        },
        data(){
            return{
                selectedContact:null,
                messages:[],
                contacts:[],
            }
        },
        created() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage',(e)=>{
                    this.handleIncoming(e.message)
                });

            axios.get('/contacts')
            .then((response)=>{
                this.contacts = response.data
            });
        },
        methods:{
            startConversationWith(contact){
                axios.get(`/conversation/${contact.id}`)
                .then((response)=>{
                    this.messages = response.data
                    this.selectedContact = contact
                });
            },
            saveNewMessage(text){
                this.messages.push(text)
            },
            handleIncoming(message){
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message)
                    return  
                }
            }
        },
        components:{
            Conversation,
            ContactList,

        }
    }
</script>
<style lang="scss" scoped>
.chat-app{
    display:flex;
}
</style>