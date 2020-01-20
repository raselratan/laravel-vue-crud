<template>
    <div class="container ">
         <div class="row justify-content-center">
           <div class="col-md-10">
                
                <div class="jumbotron mt-3 text-center">
                    <h1 class="display-4 text-blue">Add Products</h1>
                    
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="/" role="button">❮  Back Home</a>
                         <button class="btn btn-success btn-lg" @click="postModal()" role="button">Create Post
                             <i class="fas fa-sticky-note"></i>
                         </button>
                    </p>
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

            <form @submit.prevent="createPost()">
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
                          <input  type="file" @change="addPicture" name="photo"
                            placeholder="Choose Photo" class="form-input" :class="{ 'is-invalid': form.errors.has('photo') }">
                            <has-error :form="form" field="photo"></has-error>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
            </form>
            </div>
        </div>
    </div>
          
    </div>
</template>


       

<script>
    export default {
        data(){
        
        return{
          
          form: new Form({
          title:'',  
          body: '',
          photo:''
         })
        }
      },
        methods: {
            postModal(){
            this.form.reset();
            $('#addPost').modal('show');
            },
            createPost(){
                this.$Progress.start();
                
                this.form.post('/posts')
                .then(()=>{
                    Fire.$emit('afterCreate');
                    $('#addPost').modal('hide');
                    toast.fire({
                    type: 'success',
                    title: 'Post created successfully'
                    })
                    this.$Progress.finish();
                    })
                .catch(()=>{
                    
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>