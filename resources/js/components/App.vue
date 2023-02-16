<script>
import axios from 'axios';
import FormCreate from './FormCreate.vue'
import FormEdit from './FormEdit.vue'
import ShowTickets from './ShowTickets.vue'

export default {
    data() {
        return {
            visible: 'table',
            ticket_id: 0
        }
    },
    created(){
        
    },
    methods: {
        verifyView(result, ticket_id){
            this.visible = result;
            this.ticket_id = ticket_id;
        }
    },
    components: { FormCreate, FormEdit, ShowTickets }
}
</script>

<template>

    <ShowTickets v-if="visible == 'table'" :verifyView="verifyView"></ShowTickets>
    <FormCreate v-if="visible == 'create'" :verifyView="verifyView"></FormCreate>
    <FormEdit v-if="visible == 'edit'" :verifyView="verifyView" :ticket_id="ticket_id"></FormEdit>
     
</template>