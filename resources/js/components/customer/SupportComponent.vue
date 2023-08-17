<template>
<div class="nk-content mt-3 ">
<div class="container-fluid">
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Support / Tickets</h3>
                </div><!-- .nk-block-head-content -->
               
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-msg">
            <div class="nk-msg-aside">
                <div class="nk-msg-nav">
                    <ul class="nk-msg-menu nav nav-tabs">
                        <li id="tabactive" class="nk-msg-menu-item nav-item active">
                        	<a href="#tabItem0" data-toggle="tab" class="nav-link">All</a>
                        </li>
                        <li class="nk-msg-menu-item nav-item">
                        	<a href="#tabItem1" data-toggle="tab" class="nav-link">Active</a>
                        </li>
                        <li class="nk-msg-menu-item nav-item">
                        	<a href="#tabItem2" data-toggle="tab" class="nav-link">Closed</a>
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
			<div class="tab-content">
			  <div class="tab-pane active" id="tabItem0">
               <template v-for="ticket in allTickets">
                <div class="nk-msg-list" :index="ticket.id">
                    <div class="nk-msg-item" v-bind:class="{current: ticket.id == ticketChat.id }" @click="openChat($event,ticket)">
                        <div class="nk-msg-media user-avatar" v-if="ticket.supportuser.user_img">
                        <img :src="hostname+'/frontend-assets/images/users/'+ticket.supportuser.user_img" alt="">
		                </div>
		                <div class="user-avatar bg-purple" v-else>
		                    <span>{{getFirstLetter(ticket.supportuser.first_name)}}{{getFirstLetter(ticket.supportuser.last_name)}}</span>
		                </div>
                        <div class="nk-msg-info">
                            <div class="nk-msg-from">
                                <div class="nk-msg-sender">
                                    <div class="name">Support Admin</div>
                                </div>
                                <div class="nk-msg-meta ">
                                    <div class="date">{{ ticket.updated_at | moment("from", "now") }}</div>
                                </div>
                            </div>
                            <div class="nk-msg-context">
                                <div class="nk-msg-text">
                                    <h6 class="title">{{ticket.subject}}</h6>
                                    <p>Hello team, I am facing problem as i can not select currency on buy order page.</p>
                                </div>
                                <div class="nk-msg-lables">
                                   
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-msg-item -->
                </div><!-- .nk-msg-list -->
               </template>

                </div>
                <div class="tab-pane" id="tabItem1">
                	hello1
                </div>
                <div class="tab-pane" id="tabItem2">
                	hello2
                </div>
            </div>

            </div><!-- .nk-msg-aside -->
            <div class="nk-msg-body bg-white" >
            	<div class="" id="mainView" v-if="chatOpen">
				<div class="nk-chat-body" style="height: 752px;">
				<div class="nk-chat-panel" >
				    <div class="row d-flex justify-content-center">
				          <!--Grid column-->
				          <div class="col-md-12">
				            <div class="loexp-no-results-container">
				            <div class="card-block">
				                <img class="img-fluid" width="156" height="111" src="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj" srcset="https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=PVEswj 1x, https://d18jakcjgoan9.cloudfront.net/s/img/frontend-v2/seller-dashboard/noresults-illustration.png!d=KAYSPp 2x">
				                <h4 class="mt-2">
				                    Start Chat
				                </h4>
				                <p class="text-center mt-2 text-light-grey">You haven't received any quotes yet. When you do, you'll be able to chat with the service provider and access their contact details if you wish to reach out to them.</p>
				            </div>
				        </div>

				          </div>
				          <!--Grid column-->
				        </div>
				    </div>
				</div>
				</div>
                <div class="nk-msg-head">
                    <h4 class="title d-none d-lg-block">{{ticketChat.subject}}</h4>
                    <div class="nk-msg-head-meta">
                        <div class="d-none d-lg-block">
                            <ul class="nk-msg-tags">
                                <li><span class="label-tag"><em class="icon ni ni-flag-fill"></em> <span>{{ticketChat.category}}</span></span></li>
                            </ul>
                        </div>
                        <div class="d-lg-none"><a href="#" class="btn btn-icon btn-trigger nk-msg-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a></div>
                        <ul class="nk-msg-actions">
                            <li><span class="badge badge-dim badge-success badge-sm"><em class="icon ni ni-check"></em><span>{{ticketChat.status}}</span></span></li>
                          
                        </ul>
                    </div>
                    <!-- <a href="#" class="nk-msg-profile-toggle profile-toggle"><em class="icon ni ni-arrow-left"></em></a> -->
                </div><!-- .nk-msg-head -->
                <template v-if="ticketChat.supportuser || ticketChat.supportchat">
                <div class="nk-msg-reply nk-reply">
                    <div class="nk-msg-head py-4 d-lg-none">
                        <h4 class="title">{{ticketChat.subject}}</h4>
                        <ul class="nk-msg-tags">
                            <li><span class="label-tag"><em class="icon ni ni-flag-fill"></em> <span>Technical Problem</span></span></li>
                        </ul>
                    </div>
                   
                    <div class="nk-reply-item"  v-for="(chat, index) in ticketChats">
                        <div class="nk-reply-header" v-if="chat.message_belong == 'customer'">
                            <div class="user-card">
                                <div class="user-avatar sm bg-blue">
                                    <span>AB</span>
                                </div>
                                <div class="user-name">{{ticketChat.supportuser.first_name}} {{ticketChat.supportuser.last_name}} <span>(You)</span></div>
                            </div>
                            <div class="date-time">{{ chat.created_at | moment("MMMM D, YYYY") }}</div>
                        </div>
                        <div class="nk-reply-header" v-else>
                          <div class="user-card">
                                <div class="user-avatar sm bg-pink">
                                    <span>ST</span>
                                </div>
                                <div class="user-name">Support Team </div>
                            </div>
                            <div class="date-time">{{ chat.created_at | moment("MMMM D, YYYY") }}</div>
                        </div>
                        <div class="nk-reply-body">
                            <div class="nk-reply-entry entry">
                                <p> {{chat.message}} </p>
                            </div>
                            <div class="attach-files" v-if="chat.supportchatimg.length > 0">
                                <ul class="attach-list">
                                    <li class="attach-item" v-for="chatimg in chat.supportchatimg">
                                        <a class="download" :href="hostname+'/frontend-assets/images/chat/'+chatimg.file" target="_blank" ><em class="icon ni ni-img"></em><span>{{chatimg.file}}</span></a>
                                    </li>
                                </ul>
                                <div class="attach-foot">
                                    <span class="attach-info">{{chat.supportchatimg.length}} files attached</span>
                                    <a class="attach-download link" href="#" @click="downloadFiles(chat.supportchatimg)"><em class="icon ni ni-download"></em><span>Download All</span></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-reply-item -->
                    <div class="nk-reply-form">
                        <div class="nk-reply-form-header">
                            <ul class="nav nav-tabs-s2 nav-tabs nav-tabs-sm">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#reply-form">Reply</a>
                                </li><!-- 
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#note-form">Private Note</a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="tab-content">
                           <div class="tab-pane active" id="reply-form">
                            <div class="nk-reply-form-editor">
                              <div class="nk-reply-form-field">
                                <textarea v-model="message" class="form-control form-control-simple no-resize" placeholder="Hello"></textarea>
                              </div>
                              <div class="nk-reply-form-tools">
                                <ul class="nk-reply-form-actions g-1">
                                  <li class="mr-2">
                                    <button class="btn btn-primary" @click.prevent="sendMessage">Reply</button>
                                  </li>
                                  <li>
                                    <label class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Attachment">
                                      <em class="icon ni ni-clip-v"></em>
                                      <input type="file" multiple ref="fileInput" @change="handleFileUpload" style="display: none" />
                                    </label>
                                    <!-- Display file names -->
                                    <ul v-if="selectedFileNames.length" class="d-flex">
                                      <li v-for="name in selectedFileNames" :key="name">{{ name }}, </li>
                                    </ul>
                                  </li>
                                </ul>
                              </div><!-- .nk-reply-form-tools -->
                            </div><!-- .nk-reply-form-editor -->
                          </div>

                        </div>
                    </div><!-- .nk-reply-form -->
                </div><!-- .nk-reply -->
               </template>
                <div class="nk-msg-profile" style="display:none">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="user-card user-card-s2 mb-2">
                                    <div class="user-avatar md bg-primary">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <h5>Abu Bin Ishtiyak</h5>
                                        <span class="sub-text">Customer</span>
                                    </div>
                                    <div class="user-card-menu dropdown">
                                        <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Profile</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-na"></em><span>Ban From System</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-repeat"></em><span>View Orders</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center g-1">
                                    <div class="col-4">
                                        <div class="profile-stats">
                                            <span class="amount">23</span>
                                            <span class="sub-text">Total Order</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="profile-stats">
                                            <span class="amount">20</span>
                                            <span class="sub-text">Complete</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="profile-stats">
                                            <span class="amount">3</span>
                                            <span class="sub-text">Progress</span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card-inner -->
                            <div class="card-inner">
                                <div class="aside-wg">
                                    <h6 class="overline-title-alt mb-2">User Information</h6>
                                    <ul class="user-contacts">
                                        <li>
                                            <em class="icon ni ni-mail"></em><span>info@softnio.com</span>
                                        </li>
                                        <li>
                                            <em class="icon ni ni-call"></em><span>+938392939</span>
                                        </li>
                                        <li>
                                            <em class="icon ni ni-map-pin"></em><span>1134 Ridder Park Road <br>San Fransisco, CA 94851</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="aside-wg">
                                    <h6 class="overline-title-alt mb-2">Additional</h6>
                                    <div class="row gx-1 gy-3">
                                        <div class="col-6">
                                            <span class="sub-text">Ref ID: </span>
                                            <span>TID-049583</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="sub-text">Requested:</span>
                                            <span>Abu Bin Ishtiak</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="sub-text">Status:</span>
                                            <span class="lead-text text-success">Open</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="sub-text">Last Reply:</span>
                                            <span>Abu Bin Ishtiak</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="aside-wg">
                                    <h6 class="overline-title-alt mb-2">Assigned Account</h6>
                                    <ul class="align-center g-2">
                                        <li>
                                            <div class="user-avatar bg-purple">
                                                <span>IH</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="user-avatar bg-pink">
                                                <span>ST</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="user-avatar bg-gray">
                                                <span>SI</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .card-inner -->
                        </div>
                    </div>
                </div><!-- .nk-msg-profile -->
            </div><!-- .nk-msg-body -->
        </div><!-- .nk-msg -->
    </div>
</div>
</div>
</div>
<!-- content @e -->
</template>
<script>
export default {
props: [
      'authuser',
      'userdata'
      ],
  data() {
    return {
        'chatOpen' : true,
        'allTickets' : [],
        'ticketChat' : {},
        'ticketChats' : [],
        'message': "",
        'files': [],
    }
},
sockets: {
        connect: function() {
          console.log('socket connected successfully')
        },

        disconnect() {
          console.log('socket disconnected')
        },
},
computed: {
    selectedFileNames() {
      return Array.from(this.files).map(file => file.name);
    }
  },
methods: {

     handleFileUpload() {
      this.files = this.$refs.fileInput.files;
    },
     sendMessage() {

      if (!this.message && !this.files.length) return;

      const formData = new FormData();
      formData.append("message", this.message);
      formData.append("support_id", this.ticketChat.id);
      formData.append("message_belong", 'customer');
      formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
      for (let i = 0; i < this.files.length; i++) {
        formData.append("files[]", this.files[i]);
      }

          axios.post('/support-message',formData).then((response) => {
          console.log(response.data);
          this.ticketChats.push(response.data);
          console.log("Message and files sent successfully!");
          this.message = "";
          this.$refs.fileInput.value = ""; // reset the file input
          this.files = []; // Clear out the file list

          }).catch((error) => {
              console.log(error);
          }) 
         },

    openChat(e,ticket){
        this.ticketChats = []; // clear the chat before opening a new one
        Vue.set(this, 'ticketChat', ticket);
        Vue.set(this, 'ticketChats', ticket.supportchat);
        this.chatOpen = false;
    },
    getChatById() {
    const urlParams = new URLSearchParams(window.location.search);
    const chatId = urlParams.get('id');
    if(chatId) {
        const chat = this.allTickets.find(ticket => ticket.id == chatId);
            if(chat) {
                this.openChat(null, chat);
            }
        }
    },
	getFirstLetter(str){
          if(str){
          //   var acronym = str.replace(/\s/g, '').split(/\s/).reduce((response,word)=> response+=word.slice(0,1),'');
          // return acronym;
            var matchess = str.match(/\b(\w)/g); // ['J','S','O','N']
            var matches = matchess.slice(0, 2);
            var acronym = matches.join(''); // JSON

          return acronym;
          }
    },

    downloadFiles(files) {
     files.forEach(fileing => {
      const link = document.createElement('a');
      link.href = this.hostname+'/frontend-assets/images/chat/'+fileing.file;
      link.download = fileing.file;
      link.target = '_blank'; // To open in a new tab if needed
      link.click();
     });
   },

getTickets() {
    return new Promise((resolve, reject) => {
        axios.get('/customer/get-tickets')
        .then((responce) => {
            Vue.set(this, 'allTickets', responce.data);
            resolve();
        })
        .catch((error) => {
            console.log(error);
            reject(error);
        });
    });
}


},

mounted() { 
    this.hostname = this.$hostname;
    this.getTickets().then(() => {
        this.getChatById();
    });
}


};
	
</script>