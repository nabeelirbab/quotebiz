<template>
<!-- content @s -->
<div class="nk-content mt-3 pl-0 pr-0">
<div class="container-fluid p-0">
<div class="nk-content-inner">
<div class="nk-content-body">
<div class="nk-msg">
<div class="nk-msg-aside mr-0">
<div class="nk-msg-nav" style="background: white;line-height: 5.6;">
    <ul class="nk-msg-menu nav nav-tabs">
      
        <li id="tabactive" class="nk-msg-menu-item nav-item active">
            <a href="#tabItem0" data-toggle="tab" @click="activetab()" class="nav-link">Active</a>
        </li>
        <li class="nk-msg-menu-item nav-item">
            <a href="#tabItem1" data-toggle="tab" @click="wontab()" class="nav-link">Won</a>
        </li>
        <li class="nk-msg-menu-item nav-item">
            <a href="#tabItem2" data-toggle="tab" @click="donetab()" class="nav-link">Done</a>
        </li>
        <li class="nk-msg-menu-item nav-item">
            <a href="#tabItem3" data-toggle="tab" @click="losetab()" class="nav-link">Loss</a>
        </li>
       
        <li class="nk-msg-menu-item ml-auto"><a href="" class="search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a></li>
    </ul><!-- .nk-msg-menu -->
    <div class="search-wrap" data-search="search">
        <div class="search-content">
            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left" @click="clearSearch"></em></a>
            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user first name or last name" v-model="userSearch">
            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
        </div>
    </div><!-- .search-wrap -->
</div><!-- .nk-msg-nav -->
<div class="nk-msg-list" v-if="userSearch" >
            <template v-for="quote in filteredUserlist" v-if="quote.quote.status == 'pending'" >
            <div class="nk-msg-item " v-bind:class="{current: quote.id == quoteChat.id }" v-on:click="openChat($event,quote)">
                <p style="display:none">{{activeJob + 1}}</p>
                    <div class="nk-msg-media user-avatar" v-if="quote.chatcustomer.user_img">
                      <img :src="hostname+'/frontend-assets/images/users/'+quote.chatcustomer.user_img" alt="">
                    </div>
                    <div class="user-avatar bg-purple" v-else>
                        <span>{{getFirstLetter(quote.chatcustomer.first_name)}}{{getFirstLetter(quote.chatcustomer.last_name)}}</span>
                    </div>
                <div class="nk-msg-info">
                    <div class="nk-msg-from">
                        <div class="nk-msg-sender">
                            <h6 class="name">{{quote.chatcustomer.first_name}} {{quote.chatcustomer.last_name}}</h6>
                            
                        </div>
                        <div class="nk-msg-meta">
                            
                            <div class="date">{{ quote.updated_at | moment("from", "now") }}</div>
                            
                        </div>
                    </div>
                    <div class="nk-msg-context">
                        <div class="nk-msg-text">
                            <div class="title">{{quote.quote.category.category_name}}</div>
                            <p v-if="quote.last_msg">{{quote.last_msg.substring(0,100)+".." }}</p>
                            <p v-else>Start Chat</p>
                        </div>
                        <div class="unreadmsg" v-if="quote.unread_msg_count > 0">
                           {{quote.unread_msg_count}}
                        </div>
                    </div>
                </div>
            </div><!-- .nk-msg-item -->
           </template>
            <p class="text-center mt-5" style="font-size: 16px;" v-if="filteredUserlist.length == 0"> No User Found</p>
        </div><!-- .nk-msg-list -->
<div class="tab-content" style="max-height: 85%;" v-if="userSearch == '' ">
    <div class="tab-pane active" id="tabItem0">
        <div class="nk-msg-list" >
            <template v-for="quote in orderedUsers" v-if="quote.quotestatus == null">
            <div class="nk-msg-item" v-bind:class="{current: quote.id == quoteChat.id }" v-on:click="openChat($event,quote)">
                <!-- <p style="display:none">{{activeJob++}}</p> -->
                  <div class="nk-msg-media user-avatar" v-if="quote.chatcustomer.user_img">
                      <img :src="hostname+'/frontend-assets/images/users/'+quote.chatcustomer.user_img" alt="">
                    </div>
                    <div class="user-avatar bg-purple" v-else>
                        <span>{{getFirstLetter(quote.chatcustomer.first_name)}}{{getFirstLetter(quote.chatcustomer.last_name)}}</span>
                    </div>
                <div class="nk-msg-info">
                    <div class="nk-msg-from">
                        <div class="nk-msg-sender">
                            <h6 class="name">{{quote.chatcustomer.first_name}} {{quote.chatcustomer.last_name}}</h6>
                            
                        </div>
                        <div class="nk-msg-meta">
                           
                            <div class="date">{{ quote.updated_at | moment("from", "now") }}</div>
                        </div>
                    </div>
                    <div class="nk-msg-context">
                        <div class="nk-msg-text">
                            <div class="title">{{quote.quote.category.category_name}}</div>
                             <p v-if="quote.last_msg">{{quote.last_msg.substring(0,100)+".." }}</p>
                            <p v-else>Start Chat</p>
                        </div>
                        <div class="unreadmsg" v-if="quote.unread_msg_count > 0">
                           {{quote.unread_msg_count}}
                        </div>
                    </div>
                </div>
            </div><!-- .nk-msg-item -->
           </template>
            <!-- <p class="text-center mt-5" style="font-size: 17px;" v-if="activeJob == 0"> No Job</p> -->
        </div><!-- .nk-msg-list -->
    </div>
    <div class="tab-pane " id="tabItem1">
         <div class="nk-msg-list" >
            <template v-for="quote in orderedUsers" v-if="quote.quotestatus && quote.quotestatus.status == 'won'"  >
            <div class="nk-msg-item" v-on:click="openChat($event,quote)">
                <!-- <p style="display:none">{{wonJob++}}</p> -->

                <div class="nk-msg-media user-avatar" v-if="quote.chatcustomer.user_img">
                      <img :src="hostname+'/frontend-assets/images/users/'+quote.chatcustomer.user_img" alt="">
                    </div>
                    <div class="user-avatar bg-purple" v-else>
                        <span>{{getFirstLetter(quote.chatcustomer.first_name)}}{{getFirstLetter(quote.chatcustomer.last_name)}}</span>
                    </div>
                <div class="nk-msg-info">
                    <div class="nk-msg-from">
                        <div class="nk-msg-sender">
                            <h6 class="name">{{quote.chatcustomer.first_name}} {{quote.chatcustomer.last_name}}</h6>
                            
                        </div>
                        <div class="nk-msg-meta">
                            <div class="date">{{ quote.updated_at | moment("from", "now") }}</div>
                           
                        </div>
                    </div>
                    <div class="nk-msg-context">
                        <div class="nk-msg-text">
                            <div class="title">{{quote.quote.category.category_name}}</div>
                            <p v-if="quote.last_msg">{{quote.last_msg.substring(0,100)+".." }}</p>
                            <p v-else>Start Chat</p>
                        </div>
                        <div class="unreadmsg" v-if="quote.unread_msg_count > 0">
                           {{quote.unread_msg_count}}
                        </div>
                    </div>
                </div>
            </div><!-- .nk-msg-item -->

           </template>
            <!-- <p class="text-center mt-5" style="font-size: 17px;" v-if="wonJob == 0"> No Job</p> -->
        </div><!-- .nk-msg-list -->
    </div>
     <div class="tab-pane " id="tabItem2">
         <div class="nk-msg-list" >
            <template v-for="quote in orderedUsers" v-if="quote.quotestatus && quote.quotestatus.status == 'done'" >
            <div class="nk-msg-item"  v-on:click="openChat($event,quote)">
                <!-- <p style="display:none">{{doneJob++}}</p> -->

               <div class="nk-msg-media user-avatar" v-if="quote.chatcustomer.user_img">
                      <img :src="hostname+'/frontend-assets/images/users/'+quote.chatcustomer.user_img" alt="">
                    </div>
                    <div class="user-avatar bg-purple" v-else>
                        <span>{{getFirstLetter(quote.chatcustomer.first_name)}}{{getFirstLetter(quote.chatcustomer.last_name)}}</span>
                    </div>
                <div class="nk-msg-info">
                    <div class="nk-msg-from">
                        <div class="nk-msg-sender">
                            <h6 class="name">{{quote.chatcustomer.first_name}} {{quote.chatcustomer.last_name}}</h6>
                            
                        </div>
                        <div class="nk-msg-meta">
                            <div class="date">{{ quote.updated_at | moment("from", "now") }}</div>
                        </div>
                    </div>
                    <div class="nk-msg-context">
                        <div class="nk-msg-text">
                            <div class="title">{{quote.quote.category.category_name}}</div>
                            <p v-if="quote.last_msg">{{quote.last_msg.substring(0,100)+".." }}</p>
                            <p v-else>Start Chat</p>
                        </div>
                        <div class="unreadmsg" v-if="quote.unread_msg_count > 0">
                           {{quote.unread_msg_count}}
                        </div>
                    </div>
                </div>
            </div><!-- .nk-msg-item -->

           </template>
            <!-- <p class="text-center mt-5" style="font-size: 17px;" v-if="doneJob == 0"> No Job</p> -->
        </div><!-- .nk-msg-list -->
    </div>
     <div class="tab-pane " id="tabItem3">
         <div class="nk-msg-list" >
            <template v-for="quote in orderedUsers" v-if="quote.quotestatus && quote.quotestatus.status == 'lose'" >
            <div class="nk-msg-item"  v-on:click="openChat($event,quote)" >
                <!-- <p style="display:none">{{loseJob++}}</p> -->
                <div class="nk-msg-media user-avatar" v-if="quote.chatcustomer.user_img">
                      <img :src="hostname+'/frontend-assets/images/users/'+quote.chatcustomer.user_img" alt="">
                    </div>
                    <div class="user-avatar bg-purple" v-else>
                        <span>{{getFirstLetter(quote.chatcustomer.first_name)}}{{getFirstLetter(quote.chatcustomer.last_name)}}</span>
                    </div>
                <div class="nk-msg-info">
                    <div class="nk-msg-from">
                        <div class="nk-msg-sender">
                            <h6 class="name">{{quote.chatcustomer.first_name}} {{quote.chatcustomer.last_name}}</h6>
                            
                        </div>
                        <div class="nk-msg-meta">
                            <div class="date">{{ quote.updated_at | moment("from", "now") }}</div>
                        </div>
                    </div>
                    <div class="nk-msg-context">
                        <div class="nk-msg-text">
                            <div class="title">{{quote.quote.category.category_name}}</div>
                            <p v-if="quote.last_msg">{{quote.last_msg.substring(0,100)+".." }}</p>
                            <p v-else>Start Chat</p>
                        </div>
                        <div class="unreadmsg" v-if="quote.unread_msg_count > 0">
                           {{quote.unread_msg_count}}
                        </div>
                    </div>
                </div>
            </div><!-- .nk-msg-item -->
           </template>
            <!-- <p class="text-center mt-5" style="font-size: 17px;" v-if="loseJob == 0"> No Job</p> -->
        </div><!-- .nk-msg-list -->
    </div>
</div>
</div><!-- .nk-msg-aside -->
<div class="nk-msg-body bg-white" v-bind:class="{'profile-shown': isProfileshown,'startshowProfile' : isStartshowProfile,'opacity': isActive}">
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
                    Star Chat
                </h4>
                <p class="text-center mt-2 text-light-grey">You haven’t responded to any customers yet. When you do, you’ll be able to contact and access their details here.</p>
            </div>
        </div>

          </div>
          <!--Grid column-->
        </div>
    </div>
</div>
</div>

 <div class="nk-msg-head d-none d-lg-block">
    <div class="nk-msg-head-meta" v-if="quoteChat.chatcustomer">
       <div class=" d-none d-lg-block">
                <a href="" class="d-flex align-items-center">
                     <div class="nk-msg-media user-avatar" v-if="quoteChat.chatcustomer.user_img">
                      <img :src="hostname+'/frontend-assets/images/users/'+quoteChat.chatcustomer.user_img" alt="">
                    </div>
                    <div class="user-avatar sq bg-purple" v-else><span>{{getFirstLetter(quoteChat.chatcustomer.first_name)}}{{getFirstLetter(quoteChat.chatcustomer.last_name)}}</span></div>
                    <div class="ml-3">
                        <h6 class="title mb-1" >{{quoteChat.chatcustomer.first_name}} {{quoteChat.chatcustomer.last_name}}</h6>
                    </div>
                </a>
             
            </div>
        <div class="d-lg-none"><a href="#"  class="btn btn-icon btn-trigger nk-msg-hide ml-n1"><em @click="closeChat()" class="icon ni ni-arrow-left"></em></a></div>
       
    </div>
    <a href="#" @click="msgprofile" class="nk-msg-profile-toggle profile-toggle" v-bind:class="{active: isActive}"><em class="icon ni ni-arrow-left"></em></a>
</div><!-- .nk-msg-head -->

  <div class="nk-chat-body" id="chatbody" style="height: 550px;">
    <div class="nk-chat-panel" id="chatpanelbody" v-if="loginUser" >
       <template v-for="(chatData,index) in quoteChat.chat" >
        <div class="card text-white bg-primary mb-4" v-if="chatData.messageStart == 1">
            <div class="card-header">Quote Sent</div>
            <div class="card-inner row" style="display:flex; justify-content:space-between;">
                <div class="col-md-8">
                <h5 class="card-title">{{ quoteChat.quote.category.category_name }}</h5>
                <p class="card-text">{{ quoteChat.comment | strippedContent}}</p>
            </div>
            <div class="col-md-3">
                <h5 class="card-title">Price</h5>
                 <p class="card-text mb-4"><b>${{ quoteChat.quote_price}}</b></p>
                <p>{{ quoteChat.created_at | moment("from", "now") }}</p>

            </div>
            </div>
        </div>
        <template v-if="chatData.messageStart == 0">
          <div class="chat is-you" v-if="loginUser != chatData.sender_id">
            <div class="chat-avatar">
                <div class="nk-msg-media user-avatar" v-if="quoteChat.chatcustomer.user_img">
                      <img :src="hostname+'/frontend-assets/images/users/'+quoteChat.chatcustomer.user_img" alt="">
                    </div>
                <div class="user-avatar bg-purple" v-else>
                    <span>{{getFirstLetter(quoteChat.chatcustomer.first_name)}}{{getFirstLetter(quoteChat.chatcustomer.last_name)}}</span>
                </div>
            </div>
             <div class="chat-content">
                <div class="chat-bubbles">
                    <div class="chat-bubble">
                        <div class="chat-msg" v-if="chatData.messageType == '0' && chatData.isDeleted == '0'"> {{ chatData.message | strippedContent}} </div>
                        <div class="chat-msg" v-bind:class="{chatImage: chatData.messageType == '1' }" v-else-if="chatData.messageType == '1' && chatData.isDeleted == '0'"> <a :href="hostname+'/frontend-assets/images/chat/'+chatData.message" target="_blank" > <img :src="hostname+'/frontend-assets/images/chat/'+chatData.message"></a> </div>
                        <div class="chat-msg" v-else-if="chatData.messageType == '2' && chatData.isDeleted == '0'">
                         <video width="320" height="240" controls>
                          <source :src="hostname+'/frontend-assets/images/chat/'+chatData.message" type="video/mp4">
                        Your browser does not support the video tag.
                        </video> 
                       </div>
                        <div class="chat-msg" v-else-if="chatData.messageType == '3' && chatData.isDeleted == '0'"> 
                        <a :href="hostname+'/frontend-assets/images/chat/'+chatData.message" target="_blank" >
                            <em class="icon ni ni-file-docs" style="font-size: 30px;"></em> {{chatData.message}}
                        </a>
                         </div>
                         <div class="chat-msg" v-else> Message Delete</div>
                          <ul class="chat-msg-more" v-if="chatData.isDeleted == '0'">
                            
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-sm">
                                        <ul class="link-list-opt no-bdr">
                                             <li><a href="#" v-clipboard:copy="chatData.message" v-clipboard:success="onCopy" v-clipboard:error="onError"><em class="icon ni ni-copy"></em> Copy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <ul class="chat-meta">
                    <li><span> {{ chatData.created_at | moment("from", "now") }}</span> <em class="icon ni ni-check-circle-fill"></em></li>
                </ul>
            </div>
        </div><!-- .chat --> 
       
           <div class="chat is-me" v-else>
            <div class="chat-content">
                <div class="chat-bubbles">
                    <div class="chat-bubble">
                        <div class="chat-msg" v-if="chatData.messageType == '0' && chatData.isDeleted == '0'"> {{ chatData.message | strippedContent}} </div>
                        <div class="chat-msg"  v-bind:class="{chatImage: chatData.messageType == '1' }" v-else-if="chatData.messageType == '1' && chatData.isDeleted == '0'"><a :href="hostname+'/frontend-assets/images/chat/'+chatData.message" target="_blank"><img :src="hostname+'/frontend-assets/images/chat/'+chatData.message"></a></div>
                        <div class="chat-msg" v-else-if="chatData.messageType == '2' && chatData.isDeleted == '0'">
                         <video width="320" height="240" controls>
                          <source :src="hostname+'/frontend-assets/images/chat/'+chatData.message" type="video/mp4">
                        Your browser does not support the video tag.
                        </video> 
                       </div>
                        <div class="chat-msg" v-else-if="chatData.messageType == '3' && chatData.isDeleted == '0'"> 
                        <a :href="hostname+'/frontend-assets/images/chat/'+chatData.message" target="_blank" style="color:white">
                            <em class="icon ni ni-file-docs" style="font-size: 30px;"></em> {{chatData.message}}
                        </a>
                         </div>
                         <div class="chat-msg" v-else> Message Delete</div>
                        <ul class="chat-msg-more" v-if="chatData.isDeleted == '0'">
                            <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-sm btn-trigger"><em class="icon ni ni-reply-fill"></em></a></li>
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-sm">
                                        <ul class="link-list-opt no-bdr">
                                            <!-- <li class="d-sm-none"><a href="#"><em class="icon ni ni-reply-fill"></em> Reply</a></li> -->
                                            <li><a href="#" @click="editMsg(chatData.id,chatData.message)"><em class="icon ni ni-pen-alt-fill"></em> Edit</a></li>
                                            <li><a href="#" v-clipboard:copy="chatData.message" v-clipboard:success="onCopy" v-clipboard:error="onError"><em class="icon ni ni-copy"></em> Copy</a></li>
                                            <li><a href="#" @click="deleteMsg(chatData.id)"><em class="icon ni ni-trash-fill"></em> Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <ul class="chat-meta">
                    <li><span> {{ chatData.created_at | moment("from", "now") }}</span> <em class="icon ni ni-check-circle-fill"></em></li>
                </ul>
            </div>
        </div><!-- .chat --> 
        </template>
        </template>
        
    </div><!-- .nk-chat-panel -->
   <VEmojiPicker @select="selectEmoji" class="" v-bind:class="{activeemoji: isEmoji}" v-if="isEmoji" />
    <div class="nk-chat-editor">
        <div class="nk-chat-editor-upload  ml-n1">
           
            <div class="chat-upload-option expanded p-0" data-content="chat-upload">
                <ul class="">
                 <li><a href="#">
                    <label for="fileupload" class="mb-0"> <em class="icon ni ni-img-fill"></em></label>
                    <input type="file" id="fileupload" ref="myFiles" style="display:none" @change="uploadfile($event)" multiple>
                    </a>
                </li>
                    <!-- <li><a href="#"><em class="icon ni ni-camera-fill"></em></a></li> -->
                    <!-- <li><a href="#"><em class="icon ni ni-mic"></em></a></li> -->
                    <!-- <li><a href="#"><em class="icon ni ni-grid-sq"></em></a></li> -->
                </ul>
            </div>
        </div>
        <div class="nk-chat-editor-form">
            <div class="form-control-wrap" style="margin-left:30px">
                <textarea v-model="message" ref="afterClick" class="form-control form-control-simple no-resize border-0" rows="1" id="default-textarea" @keydown.enter.exact.prevent
              @keyup.enter.exact="chatStart()" placeholder="Type your message..."></textarea>
            </div>
        </div>
        <ul class="nk-chat-editor-tools g-2">
            <li>
                <a href="#" class="btn btn-sm btn-icon btn-trigger text-primary" @click="showEmoji"><em class="icon ni ni-happyf-fill"></em></a>
            </li>
            <li>
                <button class="btn btn-round btn-primary btn-icon" :disabled="isDisable" @click="chatStart()"><em class="icon ni ni-send-alt"></em></button>
            </li>
        </ul>
    </div><!-- .nk-chat-editor -->
   
</div><!-- .nk-chat-body -->

<div class="nk-msg-profile"  id="chatPanel" style="display:none" v-bind:class="{visible: isVisible}" >
  <div class="user-card user-card-s2 my-4"  v-if="quoteChat.chatcustomer">
    <div class="nk-msg-media user-avatar" v-if="quoteChat.chatcustomer.user_img">
        <img :src="hostname+'/frontend-assets/images/users/'+quoteChat.chatcustomer.user_img" alt="">
        </div>
        <div class="user-avatar md bg-purple" v-else>
            <span>{{getFirstLetter(quoteChat.chatcustomer.first_name)}}{{getFirstLetter(quoteChat.chatcustomer.last_name)}}</span>
        </div>
        <div class="user-info">
            <h5>{{quoteChat.chatcustomer.first_name}} {{quoteChat.chatcustomer.last_name}}</h5>
            <p>{{quoteChat.chatcustomer.email}}</p>
            <p>{{quoteChat.chatcustomer.mobileno}}</p>
        </div>
        <div class="user-card-menu dropdown">
            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
            <div class="dropdown-menu dropdown-menu-right">
                <ul class="link-list-opt no-bdr">
                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Profile</span></a></li>
                    <li><a href="#"><em class="icon ni ni-na"></em><span>Block Messages</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="chat-profile">
        <div class="chat-profile-group">
            <a href="#" class="chat-profile-head" data-toggle="collapse" data-target="#chat-options">
                <h6 class="title overline-title">Quote Detail</h6>
                <span class="indicator-icon"><em class="icon ni ni-chevron-down"></em></span>
            </a>
            <div class="chat-profile-body collapse " id="chat-options">
                 <div class="preview-block" style="padding: 24px;height: 250px;overflow: auto;">
                    <div class="row">
                    <h6>{{quote_category.category_name}} :</h6>
                    <br>

                       <div class="col-md-12 mt-1 mb-1" v-for="questionall in getquestions">
                         <h6>{{questionall.questions.question}}</h6>
                         
                         <template v-for="choices in questionall.choice">
                             
                             <p class="fs-2">{{choices.choice_value}}</p>
                         </template>
                         
                     </div>
                     

                     <br>
                      <br>
                    <div class="mt-4">
                     <h6>Additional Information</h6>
                     <p>{{additional_info}}</p>
                     </div>
                 </div>
                </div>
            </div>
        </div><!-- .chat-profile-group -->
        <div class="chat-profile-group">
            <a href="#" class="chat-profile-head" data-toggle="collapse" data-target="#chat-settings">
                <h6 class="title overline-title">Settings</h6>
                <span class="indicator-icon"><em class="icon ni ni-chevron-down"></em></span>
            </a>
            <div class="chat-profile-body collapse " id="chat-settings">
                <div class="chat-profile-body-inner">
                    <ul class="chat-profile-settings">
                        <li>
                            <div class="custom-control custom-control-sm custom-switch">
                                <input type="checkbox" class="custom-control-input" @change="notificationStatus($event)" id="customSwitch2" :checked="notiStatus">
                                <label class="custom-control-label" for="customSwitch2">Notifications</label>
                            </div>
                        </li>
                        <li>
                            <a class="chat-option-link" href="#">
                                <em class="icon icon-circle bg-light ni ni-bell-off-fill"></em>
                                <div>
                                    <span class="lead-text">Ignore Messages</span>
                                    <span class="sub-text">You won’t be notified when message you.</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="chat-option-link" href="#">
                                <em class="icon icon-circle bg-light ni ni-alert-fill"></em>
                                <div>
                                    <span class="lead-text">Something Wrong</span>
                                    <span class="sub-text">Give feedback and report conversion.</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- .chat-profile-group -->
        <div class="chat-profile-group">
            <a href="#" class="chat-profile-head" data-toggle="collapse" data-target="#chat-photos">
                <h6 class="title overline-title">Shared Photos</h6>
                <span class="indicator-icon"><em class="icon ni ni-chevron-down"></em></span>
            </a>
            <div class="chat-profile-body collapse" id="chat-photos">
                <div class="chat-profile-body-inner">
                  
                     <div class="row row-cols-3 row-cols-sm-6 row-cols-md-3 chat-profile-media">
                        <template v-for="(chatImg, index) in imgs">
                          <div class="col mb-3" @click="() => showImg(index)"><img :src="chatImg"></div>
                        </template> 
                   
                    </div>
                   
                </div>
            </div>
        </div><!-- .chat-profile-group -->
    </div> <!-- .chat-profile -->
</div><!-- .nk-msg-profile -->
 <vue-easy-lightbox
    :visible="visible"
    :imgs="imgs"
    :index="index"
    @hide="handleHide"
  ></vue-easy-lightbox>
</div><!-- .nk-msg-body -->
</div><!-- .nk-msg -->
<div class="nk-msg-head d-lg-none chathead" v-if="chatHead">
    <div class="nk-msg-head-meta" v-if="quoteChat.chatcustomer">
       <div class=" d-none d-lg-block">
                <a href="#" class="d-flex align-items-center">
                    <div class="user-avatar sq bg-purple"><span>{{getFirstLetter(quoteChat.chatcustomer.first_name)}}{{getFirstLetter(quoteChat.chatcustomer.last_name)}}</span></div>
                    <div class="ml-3">
                        <h6 class="title mb-1" >{{quoteChat.chatcustomer.first_name}} {{quoteChat.chatcustomer.last_name}}</h6>
                    </div>
                </a>
             
            </div>
        <div class="d-lg-none"><a href="#" @click="closepanel()" class="btn btn-icon ml-n1"><em class="icon ni ni-arrow-left"></em></a></div>
        <ul class="nk-msg-actions">
            <li><h6 class="title mb-1" >{{quoteChat.chatcustomer.first_name}} {{quoteChat.chatcustomer.last_name}}</h6></li>
           
        </ul>
    </div>
    <a href="#" @click="msgprofile" class="nk-msg-profile-toggle profile-toggle" v-bind:class="{active: isActive}"><em class="icon ni ni-arrow-left"></em></a>
</div><!-- .nk-msg-head -->
</div>
</div>
</div>
</div>
<!-- content @e -->
</template>

<script>

import VueEasyLightbox from 'vue-easy-lightbox';
import Toasted from 'vue-toasted';

export default {
 components: {
    VueEasyLightbox
  },
props: [
          'authuser',
          'userdata'
          ],
data() {
    return {
        quotes: [],
        loginUser: this.authuser,
        userDetail: JSON.parse(this.userdata),
        notiStatus: '',
        activeQuotes : [],
        quoteChat: {},
        isActive : false,
        isProfileshown: false,
        isVisible : false,
        isStartshowProfile: true,
        message: '',
        editChatid: '',
        isDisable: true,
        isEmoji: false,
        hostname: '',
        userdec: {},
        imgs: [],  // Img Url , string or Array
        visible: false,
        index: 0,
        activeJob: 0,
        wonJob: 0,
        doneJob: 0,
        loseJob: 0,
        chatHead: false,
        userSearch: '',
        quote_category:'',
        getquestions:{},
        additional_info: ''
        };
},

sockets: {

        connect: function() {
          console.log('socket connected successfully')
        },

        disconnect() {
          console.log('socket disconnected')
        },
        
        receiveMsg(data){
            console.log(data);
               const userdec = this.activeQuotes.filter((obj) => {
                        return data.quotation_id === obj.id;
                      }).pop();

                 userdec.last_msg = data.message;
                 userdec.updated_at = new Date().toISOString();
                  if(data.sender_id == this.quoteChat.customer_id && data.quotation_id == this.quoteChat.id){
                   }else{
                     userdec.unread_msg_count += 1;
                 }
                 userdec.chat.push(data);
               var container = this.$el.querySelector("#chatpanelbody");
               $("#chatpanelbody").animate({ scrollTop: container.scrollHeight + 7020 }, "fast");

            
        },

        receiveDeleteMsg(data){
         
         console.log(data);
         const userdec = this.activeQuotes.filter((obj) => {
                        return data.quotation_id === obj.id;
                      }).pop();
         const post = userdec.chat.filter((obj2) => {
                return data.id === obj2.id;
                }).pop(post);
               console.log(post);
               post.isDeleted = 1;
        },

        receiveUpdateMsg(data){

         console.log(data);
         const userdec = this.activeQuotes.filter((obj) => {
                        return data.quotation_id === obj.id;
                      }).pop();
         const post = userdec.chat.filter((obj2) => {
                return data.id === obj2.id;
                }).pop(post);
               console.log(post);
               post.message = data.message;
        },
        
      },

filters: {
        strippedContent: function(string) {
               return string.replace(/<\/?[^>]+>/ig, " "); 
        }
      },

watch: {

        message() {
                if(this.message.length > 0){
                    this.isDisable = false;
                }else{
                    this.isDisable = true;
                    this.editChatid = '';
                }
            }

    },

computed: {

        orderedUsers: function() {
          return _.orderBy(this.activeQuotes, 'updated_at', 'desc')
        },
        filteredUserlist() {

        return this.orderedUsers.filter(post => {
          return post.chatcustomer.first_name.toLowerCase().includes(this.userSearch.toLowerCase()) || post.chatcustomer.last_name.toLowerCase().includes(this.userSearch.toLowerCase())
          })
        },
    },

methods: {
     showImg (index,img) {
       
          this.index = index;
          this.visible = true;

      },
      handleHide () {
        this.visible = false
      },
        chatStart(){
           
           this.isEmoji = false;
           if (this.editChatid) {
                  var msgObj = {
                    message: this.message,
                    id: this.editChatid,
                    _token : $('meta[name="csrf-token"]').attr('content'),

                  };

                   const post = this.quoteChat.chat.filter((obj2) => {
                    return this.editChatid === obj2.id;
                    }).pop(post);
                   console.log(post);
                   post.message = this.message;

                  axios.post('/updateMsg',msgObj).then(response => {
                      console.log(response.data);
                  this.$socket.emit('updateMsg', response.data);
                  }, function(err) {
                    console.log('err', err);
                  })
                  this.isDisable = true;
                  this.message = '';
                  this.editChatid = '';
                }else{

                   var obj = {
                       'sender_id': this.loginUser,
                       'receiver_id': this.quoteChat.customer_id,
                       'message': this.message,
                       'messageType': '0',
                       'messageStart': '0',
                       'isDeleted': '0',
                       'quote_id': this.quoteChat.quote_id,
                       'quotation_id': this.quoteChat.id,
                       '_token' : $('meta[name="csrf-token"]').attr('content'),
                       'created_at': new Date().toISOString(),
                   };

                    // this.quoteChat.chat.push(obj);
                    var container = this.$el.querySelector("#chatpanelbody");
                      $("#chatpanelbody").animate({ scrollTop: container.scrollHeight + 7020 }, "fast");

                     this.quoteChat.chat.push(obj);

                      this.userdec = this.activeQuotes.filter((obj) => {
                        return this.quoteChat.id === obj.id;
                      }).pop();
                      this.userdec.last_msg = this.message;
                      this.userdec.updated_at = new Date().toISOString();

                    this.message = '';
                    this.isDisable = true;

                    axios.post('/chatstart',obj).then((response) => {
                      this.$set(this.quoteChat.chat[this.quoteChat.chat.length - 1], 'id', response.data.id);

                      this.$socket.emit('sendMsg', response.data);

                      }).catch((error) => {
                          console.log(error);
                      })    
                }
        },


        uploadfile(event) {

            let filesdata = this.$refs.myFiles.files;
            filesdata.forEach((file) => {
            let formDatas = new FormData();
            formDatas.append('file', file);
            formDatas.append('sender_id', this.loginUser);
            formDatas.append('receiver_id', this.quoteChat.customer_id);
            formDatas.append('messageType', 1);
            formDatas.append('messageStart', 0);
            formDatas.append('isDeleted', 0);
            formDatas.append('quote_id', this.quoteChat.quote_id);
            formDatas.append('quotation_id', this.quoteChat.id);
            formDatas.append('_token', $('meta[name="csrf-token"]').attr('content'));

            let config = {
              header: {
                'Content-Type': 'multipart/form-data'
              }
            }
            axios.post('/chatFilesShare', formDatas, config).then((response) => {
                console.log(response);
                this.quoteChat.chat.push(response.data);
                 this.userdec = this.activeQuotes.filter((obj) => {
                        return this.quoteChat.id === obj.id;
                      }).pop();
                      this.userdec.last_msg = response.data.message;
                      this.userdec.updated_at = new Date().toISOString();
                this.$socket.emit('sendMsg', response.data);

                var container = this.$el.querySelector("#chatpanelbody");
                $("#chatpanelbody").animate({ scrollTop: container.scrollHeight + 7020 }, "fast");
                this.imgs = [];
                 for(var i = 0; i <= this.quoteChat.chat.length; i++){
                    if(this.quoteChat.chat[i].messageType == '1' && this.quoteChat.chat[i].isDeleted == '0'){
                       this.imgs.push(this.hostname+'/frontend-assets/images/chat/'+this.quoteChat.chat[i].message);
                        }
                    }

            }, function(err) {
              console.log('err', err);
            })
          })
          
        },


        openChat(e,quote){

            this.quoteChat = quote;
            this.quote_category = this.quoteChat.quote.category;
            this.getquestions = this.quoteChat.quote.questionsget;
            this.additional_info = this.quoteChat.quote.additional_info;
            console.log(this.getquestions);
            this.quoteChat.unread_msg_count = 0;
            this.isStartshowProfile = false;
            this.isProfileshown = true;
            this.isVisible = true;
            this.isActive = true;
            this.isEmoji = false;
            this.chatHead = true;
            this.imgs = [];
            var container = this.$el.querySelector("#chatpanelbody");
            $("#chatpanelbody").animate({ scrollTop: container.scrollHeight + 7020 }, "fast");
            $('#mainView').hide();
            $('#chatPanel').show();
            $("#chatbody").addClass("nkchatbody");
            $(".nk-msg-aside").addClass("hide-aside");
            $(".nk-msg-body").addClass("show-message");
            var msgObj = {
                    id: this.quoteChat.id,
                    user_id: this.quoteChat.customer_id,
                    receiver_id: this.loginUser,
                    _token : $('meta[name="csrf-token"]').attr('content'),
                  };
             this.readMsg(msgObj);
             for(var i = 0; i <= this.quoteChat.chat.length; i++){
                if(this.quoteChat.chat[i]){
                if(this.quoteChat.chat[i].messageType == '1' && this.quoteChat.chat[i].isDeleted == '0'){
                   this.imgs.push(this.hostname+'/frontend-assets/images/chat/'+this.quoteChat.chat[i].message);
                    }
                }
            }
        },

        readMsg(msgObj){

               axios.post('/readmsg',msgObj).then(response => {
                      console.log(response.data);
                      this.$socket.emit('readMsg', {id: this.loginUser});
                  }, function(err) {
                    console.log('err', err);
                  })
        },

        emptyRefId(){

               axios.post('/emptyrefid',{id:this.loginUser}).then(response => {
                      console.log(response.data);
                  }, function(err) {
                    console.log('err', err);
                  })
        },
        
        deleteMsg(id){

               const post = this.quoteChat.chat.filter((obj) => {
                return id === obj.id;
                }).pop(post);
               console.log(post);
               post.isDeleted = 1;
               this.$socket.emit('deleteMsg', post);

               axios.get('/deleteMsg/'+id)
                .then((response) => {
                 console.log(response.data);
                })
                .catch((error) => console.log(error));


            },

        editMsg(id, message) {

                  this.message = message;
                  this.editChatid = id;
                  this.$nextTick(function() {
                  this.$refs.afterClick.focus();
                  });
                 

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

        msgprofile(){

            this.isActive = !this.isActive;
            this.isProfileshown = !this.isProfileshown;
            this.isVisible = !this.isVisible;

        },

        closepanel(){
            // alert('hello');
           this.isActive = false;
           this.chatHead = false;
           $('.nk-chat-body').removeClass('nkchatbody');

        },

        getCustomer() {

               axios.get('/service-provider/getcustomer')
                .then((responce) => {
                  this.activeQuotes = responce.data;
                  $('#tabactive').addClass('active');
                })
                .catch((error) => console.log(error));

              },

        showEmoji() {
           
              this.isEmoji = !this.isEmoji;

            },

        selectEmoji(emoji) {

              this.message += emoji.data;

              this.isDisable = false;

            },

        activetab(){
                this.quoteChat = {};
                $('#mainView').show();
                $('#chatPanel').hide();
         },

         wontab(){
                this.quoteChat = {};
                $('#mainView').show();
                $('#chatPanel').hide();
                $('#tabactive').removeClass('active');
         },

         donetab(){
                this.quoteChat = {};
                $('#mainView').show();
                $('#chatPanel').hide();
                $('#tabactive').removeClass('active');
         },

         losetab(){
                this.quoteChat = {};
                $('#mainView').show();
                $('#chatPanel').hide();
                $('#tabactive').removeClass('active');
         },

         clearSearch(){
           this.userSearch = '';
         },

        closeChat(){
            alert('ddd');
         $('.nk-msg-body').removeClass('opacity');
        },

        onCopy(e) {
          this.$toasted.show("Copy to clipboard !!", { 
             theme: "bubble", 
             position: "top-center", 
             type: "success",
             duration : 5000
             });
          },

        onError(e) {
                alert('Failed to copy the text to the clipboard')
                console.log(e);
         },
         notificationStatus(e){
           if (e.target.checked) {
              axios.post('/notificationstatus',{'status':'yes','_token': $('meta[name="csrf-token"]').attr('content')}).then(response => {
                  console.log(response.data);
                   this.$toasted.show("Notifications Enabled", { 
                     theme: "bubble", 
                     position: "top-center", 
                     type: "success",
                     duration : 5000
                     });
              }, function(err) {
                console.log('err', err);
              })
             }else{
             axios.post('/notificationstatus',{'status':'no','_token': $('meta[name="csrf-token"]').attr('content')}).then(response => {
                      console.log(response.data);
                     this.$toasted.show("Notifications Disabled", { 
                     theme: "bubble", 
                     position: "top-center", 
                     type: "success",
                     duration : 5000
                     });
                  }, function(err) {
                    console.log('err', err);
             })
             }
         }

   },

mounted() {
        this.notiStatus = this.userDetail.notification_status == 'yes' ? true : false;
        console.log(this.notiStatus)
        this.hostname = this.$hostname;
        this.$socket.emit('register',this.loginUser);
        this.getCustomer();
        this.emptyRefId();
    },
};
</script>
<style type="text/css">

.loexp-no-results-container {
display: flex;
align-items: flex-start;
justify-content: center;
height: calc(86vh - 75px);
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
.img-fluid {
  max-width: 100%;
  height: auto;
}
.chatImage{

    max-width: 40%;
}
.loexp-no-results-container .card-block h4 {
  font-size: 1.5em;
}
#mainView{
 position: absolute;
 z-index: 999;
 width: 100%;
}
.text-light-grey {
color: #9da0b6!important;
}
.startshowProfile{
    padding-right: 0px !important; 
}
.activeemoji {
  z-index: 9999;
  position: absolute;
  bottom: 70px;
}
.vel-btns-wrapper .btn__close {
        top: 88px !important;
        right: 10px;
    }
.vel-modal{
    z-index: 9998;
    position: fixed;
    top: 0;
    left: 319px !important;
    right: 0;
    bottom: 0;
    margin: 0;
    background: rgba(0,0,0,.5);
    width: 81%;
}
@media (min-width: 992px){
    .nk-msg-nav {
    padding: 0 0rem;
    }
}
</style>
