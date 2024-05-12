<template>
<!-- content @s -->
<div>
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
                      <div class="accordion-head d-flex justify-content-between" >
                      	<div style="width: 33%;">
                          <h6 class="title">{{category.category_name}}</h6>
                         </div>
                          <div>
                             <div v-if="editIndex === keyIndex">
						      <!-- Check if customtitles exists; if not, bind to a new data property -->
						      <input type="text" name="editableContent" v-model="currentTitle">
						      <em class="icon ni ni-check-thick" @click="saveChanges(keyIndex)"></em>
						      <em class="icon ni ni-cross" @click="cancelEdit"></em>
						    </div>
						    <div v-else>
						      <span v-if="category.customtitles">
						        {{ category.customtitles.title }}
						      </span>
						      <span v-else>Preferred music genres</span>
						      <em class="icon ni ni-edit-alt edit-icon" @click="editContent(keyIndex)" style="display: contents;"></em>
						    </div>
                          </div>
                         <a :href="hostname+'/admin/custom-field/add?category_id='+category.id"> <em class="icon ni ni-edit-alt edit-icon"></em></a>
                          <span data-toggle="collapse" :data-target="'#accordion-item-'+category.id" class="accordion-icon"></span>
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
                          
                      <template v-if="category.subcustoms.length > 0">
                      <draggable class="drag-area" :list="category.subcustoms" :options="{animation:200, group:'status'}" :element="'tbody'"  @change="dragCard($event, keyIndex)">
                        <div class="nk-tb-item" v-for="(question, index) in category.subcustoms" style="cursor:pointer">
                        
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
                                                    <li><a :href="hostname+'/admin/custom-field/add?category_id='+question.category_id+'&sub_category_id='+question.subcategory_id"><em class="icon ni ni-repeat"></em><span>Edit</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a :href="hostname+'/admin/custom-field/deletecustom/'+question.id"><em class="icon ni ni-na"></em><span>Delete</span></a></li>
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
                                                        <span v-if="option.icon_option == 'upload'">
                                                            <img :src="hostname+'/frontend-assets/images/categories/'+option.icon"></span>
                                                        <span v-else-if="option.icon_option == 'library'">
                                                            <img :src="hostname+'/images/icons/'+option.icon"></span>
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
                        <draggable class="drag-area" :list="category.customs" :options="{animation:200, group:'status'}" :element="'tbody'"  @change="dragCard($event, keyIndex)">
                        <div class="nk-tb-item" v-for="(question, indx) in category.customs" style="cursor:pointer">
                        
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
                                                    <li><a :href="hostname+'/admin/custom-field/add?category_id='+category.id"><em class="icon ni ni-repeat"></em><span>Edit</span></a></li>
                                                   
                                                    <li class="divider"></li>
                                                   
                                                    <li><a :href="hostname+'/admin/custom-field/deletecustom/'+question.id"><em class="icon ni ni-na"></em><span>Delete</span></a></li>
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
                                                        <span v-if="option.icon_option == 'upload'">
                                                            <img :src="hostname+'/frontend-assets/images/categories/'+option.icon"></span>
                                                        <span v-else-if="option.icon_option == 'library'">
                                                            <img :src="hostname+'/images/icons/'+option.icon"></span>
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
	      editIndex: null,
	      currentTitle: '',
	      editableContent: 'Hello there'
        };
},
created() {
    // Update eventTitle with the value of the eventtext prop
    if (this.eventtext) {
      this.eventTitle = this.eventtext;
    }
  },

methods: {
		editContent(index) {
	      this.editIndex = index;
	      // Determine whether to use an existing title or set up for a new entry
	      if (this.categoriesData[index].customtitles) {
	        this.currentTitle = this.categoriesData[index].customtitles.title;
	      } else {
	        this.currentTitle = ''; // Set up for new title entry
	      }
	    },
	    saveChanges(index) {
	    	let id = '';
	      this.editIndex = null;  // Exit edit mode
	      if (this.categoriesData[index].customtitles) {
	        id = this.categoriesData[index].customtitles.id;
	      }
	       axios.post('admin/custom-field/custom-text-update', {
                    custom_text: this.currentTitle,
                    id: id,
                    category_id: this.categoriesData[index].id
                }).then((response) => {
                    console.log(response.data);
                    this.categoriesData[index].customtitles = response.data;
                }).catch((error) => {
                    console.log(error);
                })
	      // Save changes, e.g., to a server
	    },
	    cancelEdit() {
	      this.editIndex = null;  // Exit edit mode
	      this.currentTitle = '';
	      // Optionally restore original content
	    },
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
           axios.get('admin/custom-field/categories')
            .then((response) => {
                console.log(response.data);
             this.categorieslist = response.data;
             this.categoriesData = response.data;
            })
            .catch((error) => console.log(error));
       },

       subcategoriesbyid(event){
        var id = event.target.value;
           axios.get('admin/custom-field/subcategories/'+id)
            .then((response) => {
              console.log(response.data);
              if(response.data[0].subquestions.length < 1){
                 this.noData = true;
                 this.noDataMsg = 'This sub category does not have any custom fields';
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
           axios.get('admin/custom-field/categories/'+id)
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
        this.categorieslist[columnIndex].customs.forEach(function(item, index){
                    item.re_order = index + 1;
                    console.log(item.re_order);
                  });

         axios.post('admin/custom-field/updateOrder', {
                    questions: this.categorieslist[columnIndex].customs
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

