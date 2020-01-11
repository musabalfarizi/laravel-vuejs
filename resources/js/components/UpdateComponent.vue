<template>

<div class="container">

<div class="card card-default">
<div class="card-header"> Update New Post</div>

<div class="card-body">
<form v-on:submit="submitPostEdit()">
<div class="form-group">
<label for="title">Post Title</label>
	<input type="text" v-model="posts.title" id="title" placeholder="title" class="form-control" >
	</div>
	<div class="form-group">
  <label for="posts.description">Post Desription</label>
	<textarea rows="5" type="text" id="description" v-model="posts.description" placeholder="Description" class="form-control" > </textarea>
	</div>
	<div class="foorm-group">
	<router-link to="/" class="btn btn-warning">Cancel</router-link>
	<button class="btn btn-success" > Update </button>
	</div>
	</form>
</div>

</div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  data:function() {
    return {
      posts: {
      title:'',
      description:'',
      },
      errors: []
    }
  },
 created() {

     let id = this.$route.params.id;
          axios.get('/posts/' + id + '/edit')
            .then(response => {
              this.posts = response.data
        })
        .catch(e => {
          this.errors.push(e)
        })
  },
  
  methods:{

   submitPostEdit() {

    let id = this.$route.params.id;
    axios.patch('/posts/' + id, this.posts)
    .then(response => {
    console.log(response)
    this.$router.push({path: '/'})
      this.posts = response.data
    })
    .catch(e => {
      this.errors.push(e)
    })

  }

 }
}
</script>