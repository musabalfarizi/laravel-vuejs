<template>
 <div class="container">

<div class="card card-default">
<div class="card-header"> Create New Post</div>

<div class="card-body">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input v-model="newPostTitle" id="title" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Post Description</label>
          <textarea v-model="newPostDesc" id="description" rows="8" class="form-control"></textarea>
        </div>
        <div class="col-md-12 col-sm-offset-12">
          <router-link to="/" class="btn btn-warning">Cancel</router-link>
        <button @click="addPost(newPostTitle, newPostDesc)" 
          :class="{disabled: (!newPostTitle || !newPostDesc)}"
          class="btn btn-success">Submit</button>
          </div
      </div>
    </div>
  </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        newPostTitle: "", 
        newPostDesc: "" 
      }
    },
    created() {
      this.listenForChanges();
    },
    methods: {
      addPost(postName, postDesc) {
        // check if entries are not empty
        if(!postName || !postDesc)
          return;

        // make API to save post
        axios.post('/posts', {
          title: postName, description: postDesc
        }).then( response => {
          if(response.data) { 
            this.newPostTitle = this.newPostDesc = "";
          }
        })
      },
      listenForChanges() {
        Echo.channel('postboard')
          .listen('PostPublished', post => {
            if (! ('Notification' in window)) {
              alert('Web Notification is not supported');
              return;
            }

            Notification.requestPermission( permission => {
              let notification = new Notification('New post alert!', {
                body:post.description, // content for the alert
                icon: "https://pusher.com/static_logos/320x320.png" // optional image url
              });

              // link to page on clicking the notification
              notification.onclick = () => {
                window.open(window.location.href);
              };
            });
          })
        }
      } 
    }
</script>