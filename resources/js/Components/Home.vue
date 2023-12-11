<script>
import axios from "axios";

export default {
    name: 'Home',
    data(){
        return{
            users:[],
            page: 1,
            limit: 6,
            completed: true,
            path: 'storage/'
        }
    },
    methods:{
        async getUsers(){
            const { data } = await axios.get("http://127.0.0.1:8000/api/users");
            this.users = data.data;
        },
        async loadMore(){
            this.page++
            const { data } = await axios.get("http://127.0.0.1:8000/api/users?page="+ this.page);
            this.users.push(...data.data);
            if(data.data.length < this.limit){
                this.completed = true
            }
        }
    },
    beforeMount(){
            this.getUsers();
            this.completed = false
    }
}
</script>

<template>
    <div class="container  mt-3">
        <div class="col-9 row d-flex-wrap">
            <div v-for="user in users" :key="user.id" v-if="users.length" class="card m-3" style="width: 18rem; text-align: center">
                <img class="card-img m-auto" :src="path + user.image" style="height: 70px; width: 70px;">
                <div class="card-body d-flex m-auto">
                    <h5 class="card-title p-1 h6 text-center">{{ user.name }}</h5>
                    <h5 class="card-title p-1 h6 text-center">{{ user.lastname }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ user.phone }}</li>
                    <li class="list-group-item">{{ user.email }}</li>
                </ul>
            </div>
            <div v-else>
                <img :src="path + '/preloaders/Spinner-2.gif'" alt="">
            </div>
        </div>
        <button class="btn btn-secondary row col-2 m-3" v-show="!completed"  @click="loadMore">load more</button>
    </div>
</template>

<style scoped>
    .card{
        box-shadow: 2px 3px 3px;
        border-radius: 10px;
        background: rgb(231,237,235);
        background: linear-gradient(90deg, rgba(231,237,235,1) 0%, rgba(254,255,224,1) 11%, rgba(217,217,215,1) 91%);
    }
    .card .list-group .list-group-item{
        background: rgb(231,237,235);
        background: linear-gradient(90deg, rgba(231,237,235,1) 0%, rgba(254,255,224,1) 11%, rgba(217,217,215,1) 91%);
    }
</style>
