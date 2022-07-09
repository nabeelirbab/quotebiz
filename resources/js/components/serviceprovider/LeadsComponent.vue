<template>
       <div class="nk-content mt-5">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-msg">

                        <div class="nk-msg-aside">
                           
                            <div class="nk-msg-nav">
                                <ul class="nk-msg-menu nav nav-tabs">
                                   <li class="nk-msg-menu-item  active"><a href="#tabItem0" data-toggle="tab" class="nav-link"> New Jobs</a></li>
                                   
                                    <li class="nk-msg-menu-item nav-item">
                                        <a href="#tabItem1" data-toggle="tab" class="nav-link">Quoted Jobs</a>
                                    </li>
                                    <li class="nk-msg-menu-item ml-auto"><a href="" class="search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a></li>
                                </ul><!-- .nk-msg-menu -->
                                <div class="search-wrap" data-search="search">
                                    <div class="search-content">
                                        <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                        <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or message">
                                        <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                    </div>
                                </div><!-- .search-wrap -->
                            </div><!-- .nk-msg-nav -->
                    <div class="tab-content" style="height:100%">
                        <div class="tab-pane active" id="tabItem0">
                             <div class="nk-msg-list">
                             <template v-for="quote in quotes" v-if="!quote.myquotation">
                                <div class="nk-msg-item"  v-on:click="openQuote($event,quote)" >
                                  <!-- <p style="display:none">{{newJob++}}</p> -->
                                        <div class="nk-msg-media user-avatar">
                                        <img src="/images/avatar/b-sm.jpg" alt="">
                                    </div>
                                    <div class="nk-msg-info">
                                        <div class="nk-msg-from">
                                            <div class="nk-msg-sender">
                                                <div class="name">{{quote.user.first_name}} {{quote.user.last_name}}</div>
                                            </div>
                                            <div class="nk-msg-meta">
                                               
                                                <div class="date">{{ quote.created_at | moment("from", "now") }}</div>
                                            </div>
                                        </div>
                                        <div class="nk-msg-context">
                                            <div class="nk-msg-text">
                                                <h6 class="title">{{quote.category.category_name}}</h6>
                                                
                                            </div>
                                            <div class="nk-msg-lables">
                                                <!-- <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div> -->
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div><!-- .nk-msg-item -->
                              </template>
                              <!-- <p class="text-center mt-5" style="font-size: 17px;" v-if="newJob == 0"> No Job</p> -->
                            </div><!-- .nk-msg-list -->
                                </div>

                           <div class="tab-pane active" id="tabItem1">
                             <div class="nk-msg-list">
                            <template v-for="quote in quotes" v-if="quote.myquotation">
                                <div class="nk-msg-item"  v-on:click="openQuote($event,quote)" >
                                  <!-- <p style="display:none">{{myQuotation++}}</p> -->

                                        <div class="nk-msg-media user-avatar">
                                        <img src="/images/avatar/b-sm.jpg" alt="">
                                    </div>
                                    <div class="nk-msg-info">
                                        <div class="nk-msg-from">
                                            <div class="nk-msg-sender">
                                                <div class="name">{{quote.user.first_name}} {{quote.user.last_name}}</div>
                                            </div>
                                            <div class="nk-msg-meta">
                                               
                                                <div class="date">{{ quote.created_at | moment("from", "now") }}</div>
                                            </div>
                                        </div>
                                        <div class="nk-msg-context">
                                            <div class="nk-msg-text">
                                                <h6 class="title">{{quote.category.category_name}}</h6>
                                                
                                            </div>
                                            <div class="nk-msg-lables">
                                                <!-- <div class="asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .nk-msg-item -->
                                  </template>
                                  <!-- <p class="text-center mt-5" style="font-size: 17px;" v-if="myQuotation == 0"> No Job</p> -->
                                </div><!-- .nk-msg-list -->
                                    </div>
                                                                    
                                </div>
                               
                        </div><!-- .nk-msg-aside -->
                        <div class="nk-msg-body bg-white">
                        <div class="" id="mainView">
                            <div class="nk-chat-body" style="height: 752px;">
                            <div class="nk-chat-panel" >
                                    <div class="row d-flex justify-content-center">
                                          <!--Grid column-->
                                          <div class="col-md-12">
                                           
                                            <div class="loexp-no-results-container">
                                            <div class="card-block">
                                                <img class="img-fluid" width="156" height="111" src="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj" srcset="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj 1x, https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=KAYSPp 2x">
                                                <h4 class="mt-2">
                                                    Welcome
                                                </h4>
                                                <p class="text-center mt-2 text-light-grey">You haven’t responded to any customers yet. When you do, you’ll be able to contact and access their details here.</p>
                                                <a href="/sellers/dashboard/">View leads</a>
                                            </div>
                                        </div>

                                          </div>
                                          <!--Grid column-->
                                        </div>
                                </div>
                            </div>
                          </div>
                          <div id="chatPanel" style="display:none">
                            <div class="nk-msg-head">
                                
                                <div class="nk-msg-head-meta">
                                    <div class="d-none d-lg-block">
                                        <ul class="nk-msg-tags">
                                            <li><h5 v-if="quoteQuestions.user">{{quoteQuestions.user.first_name}} {{quoteQuestions.user.last_name}}</h5></li>
                                        </ul>
                                    </div>
                                    <div class="d-lg-none"><a href="#" class="btn btn-icon btn-trigger nk-msg-hide ml-n1" @click="closePanel()"><em class="icon ni ni-arrow-left"></em></a></div>
                                  
                                </div>
                              
                            </div><!-- .nk-msg-head -->

                          <div class="nk-chat-body" id="chatbody">
                            <div class="nk-chat-panel" style="background: white;">
                                    <div class="row">
                                   <div class="col-md-3">
                                      <div class=" d-none d-lg-block">
                                            <a href="" class="d-flex align-items-center">
                                                <div class="user-avatar sq bg-purple">
                                                    <span>GD</span>
                                                </div>
                                                <div class="ml-3">
                                                    <h6 class="title mb-1" v-if="quoteQuestions.category">
                                                    {{quoteQuestions.category.category_name}}</h6>
                                                    <!-- <span class="sub-text">4 SubCategories</span> -->
                                                    <span class="sub-text"> {{ quoteQuestions.created_at | moment("from", "now") }}</span>
                                                </div>
                                            </a>
                                          <div class="mt-3">
                                                <ul class="chat-profile-options pl-1">
                                                    <li v-if="quoteQuestions.user"><a class="chat-option-link" href="#"><em class="icon icon-circle bg-light ni ni-edit-alt"></em><span class="lead-text text-muted pl-1" >{{quoteQuestions.user.mobileno}}</span></a></li>
                                                    <li><a class="chat-option-link chat-search-toggle" href="#"><em class="icon icon-circle bg-light ni ni-search"></em><span class="lead-text text-muted pl-1" v-if="quoteQuestions.user">{{quoteQuestions.user.email }}</span></a></li>
                                                    <li v-if="quoteQuestions.user"><a class="chat-option-link" href="#"><em class="icon icon-circle bg-light ni ni-circle-fill"></em><span class="lead-text text-muted pl-1">{{quoteQuestions.user.city}}</span></a></li>
                                                </ul>
                                            </div>
                                        </div> 
                                   </div>
                                
                                   <div class="col-md-9 col-sm-2 mt-3">
                                    <div class="row">
                                       <div class="col-md-6 mt-1 mb-1" v-for="questions in quoteQuestions.questionsget">
                                         <h6>{{questions.questions.question}}</h6>
                                         <template v-for="choices in questions.choice">
                                             <span>{{choices.choice_value}},</span>
                                         </template>
                                     </div>
                                 </div>
                                 <div class="row">
                                        <div class="col-md-12 mt-2" v-if="quoteQuestions.additional_info">
                                            <h6 class="title mb-1">Comment</h6>
                                            <span class="sub-text" >{{quoteQuestions.additional_info}}</span>
                                        </div>
                                    </div>
                                        <div class="row">
                                        <div class="col-md-12 mt-2 mb-3">
                                            <p style="font-size: 16px;"><b>Customers appreciate information specific to their job.</b></p>  
                                               
                                                <div class="card-inner p-0">
                                                    <!-- Create the editor container -->
                                                    <wysiwyg v-model="comment" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12 mt-2 mb-5">
                                        <div class="custom-control ">
                                            <input type="checkbox" class="custom-control-input" id="latest-sale">
                                            <label class="custom-control-label" for="latest-sale"><b>Save this comment as a template</b></label>
                                        </div>
                                    </div>
                                   

                                    </div>

                                    <template v-if="quoteQuestions.myquotation">
                                    <div class="row mt-3 justify-content-end" >
                                    
                                       <div class="col-md-4">
                                         <button href="buy-creadits" class="btn btn-success">Already Submit</button>
                                       </div>
                                   </div>
                                   </template>

                                    <template v-else>
                                      
                                    <div class="row mt-3 justify-content-end" v-if="creaditsum >= 10">
                                        <div class="col-md-3 col-xs-3 p-0">
                                          <template v-if="quoteQuestions.category && quoteQuestions.category.credit_cost && quoteQuestions.category.credit_cost">
                                          <h5 class="p-0 mt-3">{{quoteQuestions.category.credit_cost}} Credits</h5>
                                          <input type="hidden" v-model="quoteQuestions.category.credit_cost" >
                                          </template>
                                        <template v-else>
                                        <h5 class="p-0 mt-3">{{quoteprice}} Credits</h5>
                                          <input type="hidden" v-model="quoteprice">

                                        </template>
                                        </div>
                                        <div class="col-md-7 col-xs-8">
                                        <div class="input-group">
                                         <label style="position: absolute;bottom: 41px;">Amount</label>
                                          <input type="text" class="form-control rounded-left" v-bind:class="{redborder: isPrice}" style="height: 50px" v-model="price" placeholder="What is the full amount you'd like to bid for this job?" >
                                          <div class="input-group-append">
                                            <button v-if="isSubmit" class="btn btn-success" @click="sendQuotation"  id="basic-addon2">Send Quote</button>
                                             <button v-if="isLoading" class="btn btn-success" style="background-color: #816bff !important;border-color: #816bff !important">Send Quote <div class="spinner-border text-secondary" role="status"> <span class="sr-only">Loading...</span></div></button>
                                          </div>
                                        </div>
                                    </div>
                                   </div>
                                   <div class="row mt-3 justify-content-end" v-else>
                                    <div class="col-md-7">
                                        <span>Before send quotation you need to buy credits.</span>
                                    </div>
                                       <div class="col-md-4">
                                         <a href="buy-creadits" class="btn btn-success">Buy Credits</a>
                                       </div>
                                   </div>

                                    </template>
                                   </div>
                                   </div>
                                 
                            </div><!-- .nk-chat-body -->

                            </div><!-- .nk-msg-body -->
                            </div>
                    </div><!-- .nk-msg -->
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

    export default {
          props: [
          'creaditsum',
          'quoteprice',
          'authuser'
          ],
          data() {
            return {
             quotes: [],
             quoteQuestions : [],
             price: '',
             comment:'',
             myQuotation: 0,
             newJob: 0,
             isSubmit: true,
             isLoading: false,
             isPrice: false,
             creditcost: ''
            };
          },
  
          created() {
                // let subdomain = location.hostname.split('.').shift();
                // alert('subdomain is ' + subdomain);
              },
    watch: {
            
            price(){
              if(this.price.length > 0){
                  this.isPrice = false;
              }else{
                  this.isPrice = true;
                }
            },

            comment(){
              if(this.comment.length > 0){
                  $('.editr').removeAttr("style")
              }else{
                  $('.editr').css('border-color','red');
              }
            },
    },          
              
    methods: {
           closePanel(){

            $("#chatbody").removeClass("nkchatbody");
            $(".nk-msg-aside").removeClass("hide-aside");
            $(".nk-msg-body").removeClass("show-message");

           },
           openQuote(e,quote){
                this.quoteQuestions = quote;
                console.log(this.quoteQuestions);
                $("#chatbody").addClass("nkchatbody");
                $(".nk-msg-aside").addClass("hide-aside");
                $(".nk-msg-body").addClass("show-message");
                $(".nk-msg-item").removeClass("current");
                e.currentTarget.className = "nk-msg-item ";
                e.currentTarget.className += "current";
                $('#mainView').hide();
                $('#chatPanel').show();
            },

            sendQuotation(){
              if(this.quoteQuestions.category.credit_cost){
                 var credits_cost = this.quoteQuestions.category.credit_cost;
              }else{
                var credits_cost = this.quoteprice;
              }
                if(this.price == '' && this.comment == ''){
                       this.isPrice = true;
                       $('.editr').css('border-color','red');

                       this.$toast.open({
                            message: "Please fill all missing fields",
                            type: "error",
                            position: 'bottom-right',
                            duration: 5000,
                            dismissible: true
                          });
                }else if(this.price == ''){
                    this.isPrice = true;
                    this.$toast.open({
                            message: "Please enter price",
                            type: "error",
                            position: 'bottom-right',
                            duration: 5000,
                            dismissible: true
                          });
                }
                else if(this.comment == ''){
                  $('.editr').css('border-color','red');
                  this.$toast.open({
                            message: "Please enter quote",
                            type: "error",
                            position: 'bottom-right',
                            duration: 5000,
                            dismissible: true
                          });
                }else{

                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                 this.isSubmit = false;
                 this.isLoading = true;
                 axios.post('/service-provider/storequotation', {
                 customer_id : this.quoteQuestions.user_id,
                 quote_id : this.quoteQuestions.id,
                 quote_price : this.price,
                 credit_cost : credits_cost,
                 comment : this.comment,
                 _token : csrf_token
                  }).then((response) => {
                      console.log(response.data);
                      this.$toast.open({
                            message: "Quotation Send Successfully",
                            type: "success",
                            position: 'top',
                            duration: 5000,
                            dismissible: true
                          });
                      this.isLoading = false;
                      this.isSubmit = true;
                      this.quoteQuestions.myquotation = response.data.quote.myquotation;
                      $('#chatPanel').hide();
                      $('#mainView').show();
                      this.comment = '';
                      this.quoteQuestions = {};

                  }).catch((error) => {
                      console.log(error);
                  })
                }
                
            },

            getQuotes() {
                axios.get('/service-provider/leadsquotes')
                .then((responce) => {
                  console.log(responce.data);
                  this.quotes = responce.data;
                })
                .catch((error) => console.log(error));
                   }
           },

    mounted() {

                console.log(this.quoteprice);
                this.getQuotes();
            }
        };
</script>
<style type="text/css">
@import "~vue-wysiwyg/dist/vueWysiwyg.css";
    .loexp-no-results-container {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    height: calc(82vh - 75px);
    background: #f9f9fa;
}
.loexp-no-results-container .card-block {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    min-width: 0;
    top: 25%;
    width: 50%;
}
.redborder{
  border-color: red;
}
.img-fluid {
    max-width: 100%;
    height: auto;
}
.loexp-no-results-container .card-block h4 {
    font-size: 1.5em;
}
.text-light-grey {
    color: #9da0b6!important;
}

</style>
