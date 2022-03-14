<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>CRUD SEDERHANA DATA POST</h4>
                        <hr>
                        <router-link :to="{name: 'post.create'}" class="btn btn-md btn-success">TAMBAH POST</router-link>

                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">CONTENT</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(post, index) in posts" :key="index">
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.content }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'post.edit', params:{id: post.id }}" class="btn btn-sm btn-primary mr-1">EDIT</router-link>
                                        <button @click.prevent="postDelete(post.id)" class="btn btn-sm btn-danger ml-1">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {

    setup() {

        //membuat reactive state dengan variabel posts
        let posts = ref([])

        //menggunakan onMounted untuk mengambil/mengirm data dari API
        onMounted(() => {

            //get API dari Laravel Backend menggunakan axios setelah itu promise 
            axios.get('http://localhost:8000/api/post')
            .then(response => {
              
              //masukan respons data ke variabel posts
              posts.value = response.data.data
              // Menggunakan directive v-for pada tabel ditampilan

            }).catch(error => {
                console.log(error.response.data)
            })

        })
        // Membuat Fungsi Delete Data
        function postDelete(id) {
            
   //delete data post berdasarkan ID
   axios.delete(`http://localhost:8000/api/post/${id}`)
   .then(() => {
              
       //splice posts 
       posts.value.splice(posts.value.indexOf(id), 1);

    }).catch(error => {
        console.log(error.response.data)
    })

}


        //return
        return {
            posts,
            postDelete
        }

    }

}
</script>

<style>
    body{
        background: lightgray;
    }
</style>
