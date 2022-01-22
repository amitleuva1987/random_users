<template>
<div class="col-md-12">
    <button class="btn btn-primary float-end mb-3" @click="get_users();">Fetch users</button>    
    <table class="table table-bordered" v-if="users.length > 0">
        <thead>
            <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>CITY</td>
                <td>COUNTRY</td>
                <td>MINOR / MAJOR</td>
                <td>PHOTO</td>
            </tr>
        </thead>    
        <tbody>
            <tr v-for="user,index in users" :key="user.id">
                <td>{{index+1}}</td>
                <td>{{user.name.title}} {{user.name.first}} {{user.name.last}}</td>
                <td>{{user.location.city}}</td>
                <td>{{user.location.country}}</td>
                <td><span v-if="user.dob.age > 18">Major</span><span v-else>Minor</span> - {{ get_month(user.dob.date) }}</td>
                <td><img :src="user.picture.thumbnail" /></td>
            </tr>    
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    data:function(){
    return{
        users:[],

    }
    },
    watch:{
        users:function(oldusers,newusers){
            if(oldusers){
                axios.post('/store_users',{users:this.users}).then(response => {
                 console.log(response.data);
              });
            }
        }
    },
    methods:{
        get_users(){
            axios.get('https://randomuser.me/api?results=5').then(response=>{
                this.users = response.data['results'];
            });
        },
        get_month(newdate){
            let date = new Date(newdate);
            return date.toLocaleString('en-us', { month: 'long' });
        },
        // store_users(){
        //     axios.post('/store_users',{users:this.users}).then(response => {
        //         console.log(response.data);
        //     });
        // }
    },
}
</script>
