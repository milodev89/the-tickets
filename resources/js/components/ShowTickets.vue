<template>
    <div>
        <div class="d-flex justify-content-center">
            <div>
                <label for="">Show</label>
                <select name="" @change="getTicketsByUser()" v-model="limitRows" class="form-control" id="">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="ms-2">
                Search:
                <input type="text" v-model="querySearch" name="" class="form-control" id="">
            </div>            
            <div class="justify-content-end ms-2">
                <br>
                <button class="btn btn-info" @click.prevent="getTicketsByUser()">Search</button>
            </div>
            <div class="justify-content-end ms-2">
                <br>
                <button class="btn btn-primary" @click.prevent="verifyView('create')">Create Ticket</button>
            </div>
        </div>
        <br>
        <div class="table-responsive ">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ticket</th>
                        <th>Created by</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>    
                <tbody>
                    <tr v-for="ticket in tickets">
                        <td v-text="ticket.id"></td>
                        <td v-text="ticket.name"></td>
                        <td v-text="ticket.user_name"></td>
                        <td v-text="ticket.created_at"></td>
                        <td><label :class="'btn '+ getClassStatus(ticket.status) +' text-white'" for="">{{ ticket.status }}</label></td>
                        <td><button @click.prevent="verifyView('edit', ticket.id)" class="btn btn-warning">Edit</button>
                            <button @click.prevent="deleteTicket(ticket.id)" class="btn btn-danger ms-1">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <nav class="Page navigation">
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1"><a href="#" @click.prevent="changePage(pagination.current_page - 1)" class="page-link"><span>Back</span></a></li>
                    <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']"><a @click.prevent="changePage(page)" href="#" class="page-link">{{ page }}</a></li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page"><a href="#" @click.prevent="changePage(pagination.current_page + 1)" class="page-link"><span>Next</span></a></li>
                </ul>
            </nav>
        </div>

    </div>    
</template>

<script>

export default {
    name: 'ShowTickets',
    props: ['verifyView'],
    data(){
        return {            
            tickets: [],
            limitRows: 10,
            querySearch: '',
            pagination:{
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0,
            },
            offset: 3
        }
    },    
    created(){
        this.getTicketsByUser(1);
    },
    methods: {        
        async getTicketsByUser(page){
            let context = this;
            let user_id = document.getElementById('user_id').value;
            let params = {'user_id':user_id, 'limit': context.limitRows, 'q' : context.querySearch, 'page': page};
            await axios.post('/tickets/show_tickets', params)
            .then((response)=>{
                context.tickets = response.data.tickets.data;
                context.pagination = response.data.paginate;
                context.$toast.success('Charging data successfull !');
            })
            .catch((error)=>{
                context.$toast.error(error);
            });
            return;
        },
        getClassStatus(status){
            let decoStatus = status=='abierto' ? 'bg-success' : 'bg-dark';
            return decoStatus;
        },
        async deleteTicket(ticket_id){
            let context = this;
            let params = {'id':ticket_id};
            await axios.post('/tickets/delete', params)
            .then((response)=>{
                context.$toast.success('Ticket deleted successfull !');
                context.getTicketsByUser();
            })
            .catch((error)=>{
                context.$toast.error(error);
            });
        },
        changePage(page){
            this.pagination.current_page = page;
            this.getTicketsByUser(page);
        }
    },
    computed: {
        isActived: function(){
            this.pagination.current_page;
        },
        pagesNumber: function(){
            if(typeof this.pagination == 'undefined' || !this.pagination.to)
                return [];
            
            let from = this.pagination.current_page - this.offset;
            if(from < 1)
                from = 1;
            let to = from + (this.offset * 2);
            if(to > this.pagination.last_page)
                to = this.pagination.last_page;
            
            let pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
}
</script>
