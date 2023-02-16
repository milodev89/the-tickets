<template>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" @click.prevent="changeView('table')">Show Tickets</button>
    </div>
    <br>
    <h3>Create Ticket</h3>
    <hr>
    <form action="">
        <div class="form-group">
            <label for="formTicket">Ticket</label>
            <input type="text" name="" v-model="ticket.name" class="form-control" id="formTicket" placeholder="Insert description of new ticket...">
        </div>
        <br>
        <div class="form-group">
            <button class="btn btn-primary" @click.prevent="saveTicket()">Create</button>
        </div>
    </form>
</template>

<script>
export default {
    name: 'FormCreate',
    props: ['verifyView'],
    data(){
        return { 
            ticket:{'name':''}         
        }
    },    
    created(){

    },
    methods: { 
        changeView(view){
            this.verifyView(view);
        } ,
        async saveTicket(){
            let params = this.ticket;
            let context = this;
            await axios.post('/tickets/store', params)
            .then((response)=>{
                context.$toast.success('Ticket saved successfull !');
                context.changeView('table');
            })
            .catch((error)=>{
                context.$toast.error(error);
            });
        }
    }
}
</script>