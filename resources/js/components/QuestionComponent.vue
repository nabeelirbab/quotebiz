<template>
<!-- content @s -->
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title pb-2">Question Lists</h3>
                            <div class="nk-block-des text-soft">
                              <a href="#" class="mb-1" style="color:#222;" data-toggle="modal" data-target="#howitwork">How it works</a>
                               <br>
                                <span>At QuoteBiz, we understand that every service category and subcategory may have unique requirements..</span>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                          <li class="nk-block-tools-opt">
                                            <div v-if="!eventField">
                                             <em class="icon ni ni-edit" @click="showInput" style="cursor:pointer"></em>
                                             <span>{{eventTitle}}</span>
                                            </div>
                                            <div class="d-flex align-center" v-if="eventField">
                                             <input type="text" name="" class="form-control" v-model="eventTitle">
                                             <em class="icon ni ni-check" style="cursor:pointer;font-size: 20px;padding-right: 5px; padding-left: 5px;" @click="saveText"></em>
                                             <em class="icon ni ni-cross" @click="hideInput" style="cursor:pointer;font-size: 20px;"></em>
                                            </div>
                                          </li>
                                          <li class="nk-block-tools-opt"><a :href="hostname+'/admin/questions/add-question'" class="btn btn-primary" ><em class="icon ni ni-plus"></em><span>Add Question</span></a></li>
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
                    <option value="0">Select Category</option>
                    <option v-for="category in categorieslist" :value="category.id">{{category.category_name}}</option>
                </select>
                </div>
                <div v-if="subCategoriesHtml" class="form-wrap" style="width: 300px;">
                <select class="form-select" data-search="off" @change="subcategoriesbyid($event)" data-placeholder="Bulk Action" style="opacity: 1">
                    <option value="0">Select Sub Category</option>
                    <option v-for="category in subCategories" :value="category.id">{{category.category_name}}</option>
                </select>
                </div>
                <div v-if="noData" class="form-wrap">
                    <p class="text-bold text-warning">{{noDataMsg}}</p>
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
                      <div class="accordion-head" data-toggle="collapse" :data-target="'#accordion-item-'+category.id">
                          <h6 class="title">{{category.category_name}}</h6>
                         <a :href="hostname+'/admin/questions/add-question?category_id='+category.id"> <em class="icon ni ni-edit-alt edit-icon"></em></a>
                          <span class="accordion-icon"></span>
                      </div>
                      <div class="accordion-body collapse" :id="'accordion-item-'+category.id" :data-parent="'#accordion'+category.id">
                          <div class="accordion-inner">
                            <div class="card-inner p-0">
                           <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head" style="background: #253a46e3;">
                          
                            <div class="nk-tb-col"><span class="sub-text">#</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Question</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Category Name</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Selection</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Action</span></div>
                            
                        </div><!-- .nk-tb-item -->
                          
                      <template v-if="category.subquestions.length > 0">
                      <draggable class="drag-area" :list="category.subquestions" :options="{animation:200, group:'status'}" :element="'tbody'"  @change="dragCard($event, keyIndex)">
                        <div class="nk-tb-item" v-for="(question, index) in category.subquestions" style="cursor:pointer">
                        
                            <div class="nk-tb-col">
                               <span>{{index + 1}}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-amount">{{question.question}}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{category.category_name}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{question.choice_selection}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{dateFormat(question.created_at)}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-status text-success">Active</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="gx-1">
                                  
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="triggerBtn dropdown-toggle btn btn-icon btn-trigger " data-toggle="dropdown"><em class=" icon ni ni-more-h"></em></a>
                                            <div class=" dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" data-toggle="modal" :data-target="'#modalZoom'+question.id"><em class="icon ni ni-eye"></em><span>View Options</span></a></li>
                                                    <li><a :href="hostname+'/admin/questions/add-question?category_id='+question.category_id+'&sub_category_id='+question.subcategory_id"><em class="icon ni ni-repeat"></em><span>Edit</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a :href="hostname+'/admin/questions/deletequestion/'+question.id"><em class="icon ni ni-na"></em><span>Delete</span></a></li>
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
                                                  
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">#</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Option</span></div>
                                                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Icon</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                                                    
                                                </div><!-- .nk-tb-item -->
                                                
                                                <div class="nk-tb-item" v-for="(option,indexing) in question.choices">
                                                
                                                    <div class="nk-tb-col">
                                                       <span>{{indexing + 1}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb">
                                                        <span class="tb-amount">{{option.choice}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb" style="width: 20%;">
                                                        <span v-if="option.icon"><img :src="hostname+'/frontend-assets/images/categories/'+option.icon"></span>
                                                        <span v-else><img :src="hostname+'/frontend-assets/images/icons/option.png'"></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span>{{dateFormat(option.created_at)}}</span>
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
                      </template>
                        <draggable class="drag-area" :list="category.questions" :options="{animation:200, group:'status'}" :element="'tbody'"  @change="dragCard($event, keyIndex)">
                        <div class="nk-tb-item" v-for="(question, indx) in category.questions" style="cursor:pointer">
                        
                            <div class="nk-tb-col">
                               <span>{{indx+1}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{question.question}}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{category.category_name}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{question.choice_selection}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span>{{dateFormat(question.created_at)}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-status text-success">Active</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="gx-1">
                                  
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="triggerBtn dropdown-toggle btn btn-icon btn-trigger " data-toggle="dropdown"><em class=" icon ni ni-more-h"></em></a>
                                            <div class=" dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#" data-toggle="modal" :data-target="'#modalZoom'+question.id"><em class="icon ni ni-eye"></em><span>View Options</span></a></li>
                                                    <li><a :href="hostname+'/admin/questions/add-question?category_id='+category.id"><em class="icon ni ni-repeat"></em><span>Edit</span></a></li>
                                                   
                                                    <li class="divider"></li>
                                                   
                                                    <li><a :href="hostname+'/admin/questions/deletequestion/'+question.id"><em class="icon ni ni-na"></em><span>Delete</span></a></li>
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
                                                  
                                                    <div class="nk-tb-col "><span class="sub-text">#</span></div>
                                                    <div class="nk-tb-col"><span class="sub-text">Option</span></div>
                                                    <div class="nk-tb-col tb-col-mb"><span class="sub-text">Icon</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created At</span></div>
                                                    
                                                </div><!-- .nk-tb-item -->
                                                
                                                <div class="nk-tb-item" v-for="(option, ind) in question.choices">
                                                
                                                    <div class="nk-tb-col">
                                                       <span>{{ind+1}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb">
                                                        <span class="tb-amount">{{option.choice}}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb" style="width: 20%;">
                                                        <span v-if="option.icon"><img :src="hostname+'/frontend-assets/images/categories/'+option.icon"></span>
                                                        <span v-else><img :src="hostname+'/frontend-assets/images/icons/option.png'"></span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span>{{dateFormat(option.created_at)}}</span>
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

      <div class="modal fade" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" id="howitwork">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> How it works</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                  <p style="font-weight: bold;">Customize Your Question Lists</p>

                    <p >At QuoteBiz, we understand that every service category and subcategory may have unique requirements. That's why we give you the power to create custom lists of questions tailored to each category or subcategory.</p>

                    <p style="font-weight: bold;">How it works:</p>

                  <ul class="howitwork ml-5 mb-2" style="padding: 0;">
                        <li>
                            <strong>Create Custom Questions:</strong> To get started, click the edit pencil icon on the right side of the row you want to edit. This will allow you to add, modify, or delete questions for that specific category or subcategory.
                        </li>
                        <li>
                            <strong>Select Subcategory:</strong> If you want to add questions to a new subcategory, first select that subcategory from the drop-down menu. Then, click the edit pencil icon to customize the questions for that subcategory.
                        </li>
                        <li>
                            <strong>Use Parent Category Questions:</strong> If you don't create custom questions for a specific subcategory, it will automatically use the question list from the parent category. This makes customization easy and efficient.
                        </li>
                    </ul>


                    <p >With the ability to tailor your questions to suit your needs, you can provide a more personalized and effective quoting experience for your customers. Don't hesitate to make your categories and subcategories truly your own.</p>

                    <p>Need assistance or have questions? Feel free to reach out to our support team for help.</p>

                </div>
              
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
import moment from 'moment';

export default {
 components: {
    draggable,
    VueEasyLightbox
  },
props: [
          'dateformat',
          'eventtext'
       ],
data() {
    return {
      categorieslist: [],
      categoriesData: [],
      subCategories: [],
      subCategoriesHtml : false,
      hostname: '',
      noData: false,
      noDataMsg:'',
      eventTitle: 'What is your event date?',
      eventField: false,
        };
},
created() {
    // Update eventTitle with the value of the eventtext prop
    if (this.eventtext) {
      this.eventTitle = this.eventtext;
    }
  },

methods: {
        showInput(){
            this.eventField = true;
        },
        hideInput(){
            this.eventField = false;
        },
        saveText(){
              axios.post('admin/event-text-update', {
                    event_text: this.eventTitle
                }).then((response) => {
                    console.log(response.data);
                    this.eventField = false;
                }).catch((error) => {
                    console.log(error);
                })
        },
        dateFormat(date) {
          return moment(date).format(this.dateformat);
        },
       categories(){
           axios.get('admin/questions/categories')
            .then((response) => {
                console.log(response.data);
             this.categorieslist = response.data;
             this.categoriesData = response.data;
            })
            .catch((error) => console.log(error));
       },

       subcategoriesbyid(event){
        var id = event.target.value;
           axios.get('admin/questions/subcategories/'+id)
            .then((response) => {
              console.log(response.data);
              if(response.data[0].subquestions.length < 1){
                 this.noData = true;
                 this.noDataMsg = 'This sub category does not have any questions';
              }
              else{
                this.noData = false;
                this.categoriesData = response.data;
              }
           
            })
            .catch((error) => console.log(error));
       },

       categoriesbyid(event){
        var id = event.target.value;
           axios.get('admin/questions/categories/'+id)
            .then((response) => {
              console.log(response.data);
             this.categoriesData = response.data.categories;
             this.subCategories = response.data.subcat;
             if(this.subCategories.length > 0 && this.categoriesData.length > 0){
                 this.subCategoriesHtml = true ;
             }
             else{

                 this.subCategoriesHtml = false ;
             }
            })
            .catch((error) => console.log(error));
       },
       
       dragCard(event, columnIndex) {
        this.categorieslist[columnIndex].questions.forEach(function(item, index){
                    item.re_order = index + 1;
                    console.log(item.re_order);
                  });

         axios.post('admin/questions/updateOrder', {
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
.edit-icon{
  position: absolute;
    right: 4rem;
    top: 50%;
    font-size: 1rem;
    color: #364a63;
    transform: translateY(-50%);
    transition: rotate 0.4s;
}
.howitwork li{
    list-style: disc;
}
.howitwork li strong{
    font-weight: bold !important; 
}
</style>
