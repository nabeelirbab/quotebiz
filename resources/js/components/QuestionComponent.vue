<template>
<!-- content @s -->
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Question Lists</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total  questions.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                     
                                          <li class="nk-block-tools-opt"><a :href="hostname+'/questions/add-question'" class="btn btn-primary" ><em class="icon ni ni-plus"></em><span>Add Question</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                <div class="card-title-group">
                <div class="card-tools">
                <div class="form-inline flex-nowrap gx-3">
                <div class="form-wrap" style="width: 300px;">
                <select class="form-select" data-search="off" @change="categoriesbyid($event)" data-placeholder="Bulk Action" style="opacity: 1">
                    <option value="">Select Category</option>
                    <option v-for="category in categorieslist" :value="category.id">{{category.category_name}}</option>
                </select>
                </div>
                </div><!-- .form-inline -->
                </div><!-- .card-tools -->
                <div class="card-tools mr-n1">
                <ul class="btn-toolbar gx-1">
                <!-- <li>
                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                </li>
                <li class="btn-toolbar-sep"></li> --><!-- li -->
                <li>
                
                </li><!-- li -->
                </ul><!-- .btn-toolbar -->
                </div><!-- .card-tools -->
                </div><!-- .card-title-group -->
              
                </div><!-- .card-inner -->
                <div id="appendQuestion">
                    
                 <template v-for="(category, keyIndex) in categoriesData">
                  <div :id="'accordion'+category.id" class="accordion">
                  <div class="accordion-item">
                      <a href="#" class="accordion-head" data-toggle="collapse" :data-target="'#accordion-item-'+category.id">
                          <h6 class="title">{{category.category_name}}</h6>
                          <span class="accordion-icon"></span>
                      </a>
                      <div class="accordion-body collapse" :id="'accordion-item-'+category.id" :data-parent="'#accordion'+category.id">
                          <div class="accordion-inner">
                            <div class="card-inner p-0">
                           <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head" style="background: #253a46e3;">
                          
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">ID</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Question</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Category Name</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Selection</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Action</span></div>
                            
                        </div><!-- .nk-tb-item -->
                         
                        <draggable class="drag-area" :list="category.questions" :options="{animation:200, group:'status'}" :element="'tbody'"  @change="dragCard($event, keyIndex)">
                        <div class="nk-tb-item" v-for="question in category.questions" style="cursor:pointer">
                        
                            <div class="nk-tb-col">
                               <span>{{question.id}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{question.question}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{category.category_name}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{question.choice_selection}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{question.created_at | moment('l')}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-status text-success">Active</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                  
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="triggerBtn dropdown-toggle btn btn-icon btn-trigger " data-toggle="dropdown"><em class=" icon ni ni-more-h"></em></a>
                                            <div class=" dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" data-toggle="modal" :data-target="'#modalZoom'+question.id"><em class="icon ni ni-eye"></em><span>View Options</span></a></li>
                                                    <li><a :href="hostname+'/questions/add-question?category_id='+category.id"><em class="icon ni ni-repeat"></em><span>Edit</span></a></li>
                                                   
                                                    <li class="divider"></li>
                                                   
                                                    <li><a :href="hostname+'/questions/deletequestion/'+question.id"><em class="icon ni ni-na"></em><span>Delete</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                             <!-- Modal Zoom -->
                            <div class="modal fade zoom" tabindex="-1" :id="'modalZoom'+question.id">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> {{category.category_name}}</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                           <div class="card-inner p-0">
                                            <div class="nk-tb-list nk-tb-ulist">
                                                <div class="nk-tb-item nk-tb-head" style="background: #253a46e3;">
                                                  
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">ID</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Option</span></div>
                                                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Icon</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                                                    
                                                </div><!-- .nk-tb-item -->
                                                
                                                <div class="nk-tb-item" v-for="option in question.choices">
                                                
                                                    <div class="nk-tb-col">
                                                       <span>{{option.id}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb">
                                                        <span class="tb-amount">{{option.choice}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb" style="width: 20%;">
                                                        <span v-if="option.icon"><img :src="hostname+'/frontend-assets/images/categories/'+option.icon"></span>
                                                        <span v-else><img :src="hostname+'/frontend-assets/images/icons/option.png'"></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span>{{option.created_at | moment('l')}}</span>
                                                    </div>
                                                    
                                                    
                                                </div><!-- .nk-tb-item -->
                                                
                                              
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card-inner -->
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                      <!-- Mopdal Small -->
                                </div><!-- .nk-tb-item -->
                             </draggable>
                                </div>
                                      </div>
                                  </div>
                              </div>
                            </div>  
                           
 
                            </div>
                        </template>
                            

                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
             
        </div>
    </div>
</div>
</div>
</template>

<script>
// import VueSocketIO from 'vue-socket.io';
// import socketio from 'socket.io-client';
import draggable from 'vuedraggable'
import VueEasyLightbox from 'vue-easy-lightbox';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

export default {
 components: {
    draggable,
    VueEasyLightbox
  },

data() {
    return {
      categorieslist: [],
      categoriesData: [],
      hostname: '',
        };
},


methods: {
       categories(){
           axios.get('questions/categories')
            .then((response) => {
             this.categorieslist = response.data;
             this.categoriesData = response.data;
            })
            .catch((error) => console.log(error));
       },

       categoriesbyid(event){
        var id = event.target.value;
           axios.get('questions/categories/'+id)
            .then((response) => {
             this.categoriesData = response.data;
            })
            .catch((error) => console.log(error));
       },
       
       dragCard(event, columnIndex) {
        this.categorieslist[columnIndex].questions.forEach(function(item, index){
                    item.re_order = index + 1;
                    console.log(item.re_order);
                  });

         axios.post('questions/updateOrder', {
                    questions: this.categorieslist[columnIndex].questions
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error);
                })
       }, 
   },

mounted() {
       this.hostname = this.$hostname;
       this.categories();
    }
};
</script>
<style type="text/css">

    
</style>
