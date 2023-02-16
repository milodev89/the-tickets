<template>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" @click.prevent="verifyView('table')">Show Tickets</button>
    </div>
    <br>
    <h3>Edit Ticket</h3>
    <hr>
    <form action="">
        <div class="form-group">
            <label for="formTicket">Ticket</label>
            <input type="text" name="" v-model="ticket.name" class="form-control" id="formTicket" placeholder="Insert description of new ticket...">
        </div>
        <div class="form-group">
            <label for="formStatus">Status</label>
            <select class="form-control" name="" id="formStatus" v-model="ticket.status">
                <option value="abierto">Abierto</option>
                <option value="cerrado">Cerrado</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-primary" @click.prevent="saveTicket()">Update</button>
        </div>
    </form>
</template>

<script>
export default {
    name: 'FormEdit',
    props: ['verifyView', 'ticket_id'],
    data(){
        return {        
            ticket: {}
        }
    },    
    created(){
        this.getTicketById();
    },
    methods: {        
        async getTicketById(){
            let context = this;
            let params = {'ticket_id':context.ticket_id};
            await axios.post('/tickets/show_ticket', params)
            .then((response)=>{
                context.ticket = response.data;
                context.$toast.success('Charging data successfull !');
            })
            .catch((error)=>{
                context.$toast.error(error);
            });
            return;
        },
        async saveTicket(){
            let params = this.ticket;
            let context = this;
            await axios.patch('/tickets/update', params)
            .then((response)=>{
                context.$toast.success('Ticket saved successfull !');
                context.verifyView('table');
            })
            .catch((error)=>{
                context.$toast.error(error);
            });
        }
    }
}
</script>