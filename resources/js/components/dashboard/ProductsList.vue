<template>
<span>
    <div class="container ">
        <div class="row wrapper-main-content">
            <div class="has-sidebar col-md-12 col-lg-12">
                <div class="main-left main-content">
                    <div id="home_feature_posts_widget-2" class="widget home_feature_posts_widget">
                        <h4 class="widget-title">Products</h4>
                        <div class="baloo-feature-cat list">
                            <div class="baloo-blog blog-list">
                                <div v-for="post in posts" :key="post.id" class="post-37 post type-post status-publish format-standard has-post-thumbnail hentry category-food-drink category-lifestyle">
                                    <div class="post-inner">
                                        <div class="post-format"> 
                                              <img :src="'/img/post/'+post.photo" alt="Uniform">
                                        </div>
                                        <div class="post-info">
                                            <div class="post-cats">
                                                <a href="#" style="color:white;" >Details</a> 
                                                <a href="#" @click="editPost(post)" style="color:white; background-color:#cfa61d"><strong>Edit</strong></a> 
                                                <a href="#" @click="deletePost(post.id)" style="color:white; background-color:#b6122d">Delete</a> 
                                            </div><h3 class="post-title"><a href="#" rel="bookmark">{{post.title}}</a></h3>
                                            <div class="post-meta">
                                                <div class="ath-post"> <span>by</span> admin</div>
                                                <div class="date-post"> <span class="post-date">May 22, 2019</span></div>
                                                <div class="comment-number"> No Comments</div>
                                            </div>
                                            <div class="post-excerpt"><p>{{post.body | postBody(350)}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                 
        </div>
        <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPost">Add New Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form @submit.prevent="updatePost">
            <div class="modal-body">
                <div class="form-group">  
                  <input v-model="form.title" type="text" name="title"
                    placeholder="Title"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                  <has-error :form="form" field="title"></has-error>
                </div>

                <div class="form-group">  
                  <textarea  v-model="form.body" name="body"
                    placeholder="Post Body"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('body') }">
                  </textarea> 
                  <has-error :form="form" field="body"></has-error>
                </div>

                <div class="form-group">
                        <label for="photo" class="col-sm-4 control-label">Add Photo: </label>

                        <div class="col-sm-10">
                          <input type="file" @change="addPicture" name="photo"
                            placeholder="Choose Photo" class="form-input" :class="{ 'is-invalid': form.errors.has('photo') }">
                            <has-error :form="form" field="photo"></has-error>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>
            </div>
        </div>
      </div>
        
    </div> 
</span>    
</template>


       

<script>
    export default {
        data(){
        
        return{
            posts:[],
            form: new Form({
            id:'',    
            title:'',  
            body: '',
            photo:''
            })
        }
      },
        methods: {
            loadPosts(){
                axios.get('/posts').then(({data})=>(this.posts=data.data));
            },
            editPost(post){
                this.form.reset();
                $('#addPost').modal('show');
                this.form.fill(post);           
            },

            updatePost(){
                this.$Progress.start();
                this.form.put('/posts/'+this.form.id)
                .then(()=>{
                    swal.fire(
                    'Updated!',
                    'The user has been updated.',
                    'success'
                    )
                    Fire.$emit('afterCreate');
                    $('#addPost').modal('hide');
                    this.$Progress.finish();
                })
                .catch(()=>{
                    swal.fire("Failed!", "There was something wrong.", "warning");
                    this.$Progress.fail();
                })
            
            },

            addPicture(e){
                let file=e.target.files[0];
                console.log(file);
                let reader=new FileReader();
                if (file['size']<=2111775) {
                reader.onloadend=(file)=> {
                this.form.photo=reader.result;
                }
                reader.readAsDataURL(file);
                } 
                else {
                    swal.fire(
                    'Oops!',
                    'you are uploading larger file than 2 MB ',
                    'error'
                    )
                }
            },

            deletePost(id){
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                // Send request to the server
                    if (result.value) {
                        //axios.delete('posts/'+id)
                        axios.post('/posts/'+id,{_method: 'delete'}).then(()=>{
                        swal.fire(
                        'Deleted!',
                        'The post has been deleted.',
                        'success'
                        )
                        Fire.$emit('afterCreate');
                    }).catch(()=> {
                        swal.fire("Failed!", "There was something wrong.", "warning");
                    });
                    }
            })
        },
        },

        created() {
            this.loadPosts();
            Fire.$on('afterCreate',()=>{
            this.loadPosts();
          });
        }
    }
</script>



<style scoped>
.widget {
    margin-bottom: 0px;
}

a {
color: #007bff;
text-decoration: none;
}

.widget-title {
    text-transform: uppercase;
    border-bottom: 2px solid;
    line-height: 30px;
    letter-spacing: 1px;
}

.home_feature_posts_widget .baloo-feature-cat {
    margin-bottom: 50px;
}

.blog-list .post {
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}
.blog-list .post-format img {
    vertical-align: middle;
    border-style: none;
    max-width: 314px;
}
.baloo-blog .post .post-inner {
    position: relative;
    margin-top: 22px;
}

.baloo-blog .post .post-format {
    position: relative;
}
.blog-list .post-format {
    width: 380px;
    margin-right: 30px;
    float: left;
}

.blog-list .post-info {
    overflow: hidden;
}

.baloo-blog .post-cats {
    margin-bottom: 20px;
}

.post-cats a {
    background: #8fb59e;
}
.post-cats a {
    background: #8fb59e;
    padding: 0 10px;
    line-height: 20px;
    color: #fff;
}

.baloo-blog .post-title {
    margin-bottom: 10px;
    font-size: 22px;
}

.baloo-blog .post-meta {
    margin-bottom: 15px;
}
.post-meta {
    vertical-align: middle;
}




.baloo-post-widget.list .list-post-thumb .post-item {
    overflow: hidden;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.baloo-post-widget.list .list-post-thumb .post-format {
    float: left;
    width: 120px;
    margin-right: 20px;
}
</style>