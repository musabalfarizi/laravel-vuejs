<template>

<div class="card">
<div class="card-header">
  <router-link to="/create" class="btn btn-info float-right">Create New Post</router-link>
</div>

<div class="card-body">

<table id="myTable" class="table table-bordered table-hover"  cellspacing="0" width="100%">
    <thead>
      <tr>
    
        <th>Title</th>
        <th>Description</th>
        <th>Score</th>
         <th width="100">Show</th>
            <th width="100">Edit</th>
                <th width="100">Delete</th>

      </tr>
    </thead>
    <tbody>
      <tr v-for="post, index in posts">
        
        <td>{{post.title}}</td>
        <td>{{post.description}}</td>
        <td>{{post.score}}</td>

        <td><router-link :to="{name: 'readPost', params:{id:post.id}}" class="btn btn-info"> Show</router-link></td>
        <td><router-link :to="{name: 'editPost', params:{id:post.id}}" class="btn btn-info"> Edit</router-link></td>
        <td><button class="btn btn-danger" v-on:click="submitPostDelete(post.id, index)">Delete </button></td>

      </tr>
     
    </tbody>
  </table>
</div>

</div>
</template>



<script>


export default {
   props: ['current'],
  data() {
    return {
      posts: [],
      errors: []
    }
  },
  created() {
            axios.get('/posts')
                 .then(response => {
                 this.posts = response.data
                })
                 .catch(e => {
                         this.errors.push(e)
             })

            this.listenForChanges();
                     
        },
        methods: {
        
        submitPostDelete(id, index) {
            if (confirm("Click 'Ok' to delete.")){
                axios.delete('/posts/' + id)
                .then(response => {
                 
                        this.posts.splice(index, 1);
        })
                .catch(e => {
                    this.errors.push(e)
            })
            }
        },

            listenForChanges() {
                Echo.channel('postboard')
                .listen('PostPublished', (e) => {
                    var post = this.posts.find((post) => post.id === e.id);
                        
                        if(post){
                            var index = this.posts.indexOf(post);

                            this.posts[index].score = e.score;

                        }
                        // if not, add 'em
                        else {
                            this.posts.push(e)
                        }
                    })
            }
        }
        

 
}
</script>
