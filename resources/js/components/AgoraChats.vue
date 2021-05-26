<template>
<main>
    <div class="Vcall">
        <div class="row rows">
            <section id="video-container" v-if="callPlaced">
                        <div id="local-video"></div>
                        <div id="remote-video"></div>

                        <div class="action-btns">
                            <button type="button" class="btn btn-info" @click="handleAudioToggle">
                            {{ mutedAudio ? "Unmute" : "Mute" }}
                            </button>
                            <button
                            type="button"
                            class="btn btn-primary mx-4"
                            @click="handleVideoToggle"
                            >
                            {{ mutedVideo ? "ShowVideo" : "HideVideo" }}
                            </button>
                            <button type="button" class="btn btn-danger" @click="endCall">
                            EndCall
                            </button>
                        </div>
                    </section>
            <div class="col-sm contact-list">
                <div class="col-md-6 cl-fr">
                    <li class="d-flex flex-row rounded bg-card" v-for="user in allusers" :key="user.id">
                        <div class="p-0 w-20">
                            <span class="badge badge-light">
                                {{getUserOnlineStatus(user.id)}}
                            </span>
                            <img :src="'images/profile/'+user.profile_image" alt="user.name" class=" prof border-0" />
                        </div>
                        <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left">
                                <h6 class="text-primary">{{ user.name }}</h6>
                                <ul class="m-0 float-left" style="list-style: none; margin:0; padding: 0">

                                    <p class="text-info">{{ user.email}}</p>
                                </ul>
                                <p class="text-right m-0">
                                    <a @click="placeCall(user.id, user.name)" class="btn btn-danger btn-sm v-btn">
                                        <i class="bi bi-camera-video-fill"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary btn-sm v-btn">
                                        <i class="bi bi-person-fill"></i>
                                    </a>

                                </p>
                        </div>
                    </li>
                </div>
            </div>

            <div class="col-sm d-none d-lg-block">
                <div class="col-sm vc-place  ">
                    <div class="svg-fm">
                        <div class="svg filter-green"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                    <!-- <img src="img/agora-logo.png" alt="Agora Logo" class="img-fuild" /> -->
                    </div>
                </div>
            </div>
            <div class="container my-5">
            <div class="row">
                <!-- <div class="col">
                    <div class="btn-group" role="group">
                        <button
                            type="button"
                            class="btn btn-primary mr-2"
                            v-for="user in allusers"
                            :key="user.id"
                            @click="placeCall(user.id, user.name)"
                            >
                            Call {{ user.name }}
                            <span class="badge badge-light">{{
                                getUserOnlineStatus(user.id)
                            }}</span>
                        </button>
                    </div>
                </div> -->
            </div>

      <!-- Incoming Call  -->
      <div class="row my-5 incoming" v-if="incomingCall">
        <div class="col-12 incoming-frame">
          <p>
            Calling from : <strong>{{ incomingCaller }}</strong>
          </p>
          <div class="btn-group" role="group">
            <button
              type="button"
              class="btn btn-danger decline"
              data-dismiss="modal"
              @click="declineCall"
            >
              Decline
            </button>
            <button
              type="button"
              class="btn btn-success ml-5 accept"
              @click="acceptCall"
            >
              Accept
            </button>
          </div>
        </div>
      </div>
      <!-- End of Incoming Call  -->
    </div>


  </main>
</template>

<script>
export default {
  name: "AgoraChat",
  props: {
      authuser: String,
      authuserid: String,
      allusers: {
          type: Array,
          default: [],
      },
      agora_id: String
  },
//   ["authuser", "authuserid", "allusers", "agora_id"],

  data() {
    return {
      callPlaced: false,
      client: null,
      localStream: null,
      mutedAudio: false,
      mutedVideo: false,
      userOnlineChannel: null,
      onlineUsers: [],
      incomingCall: false,
      incomingCaller: "",
      agoraChannel: null,
    };
  },
  mounted() {
    this.initUserOnlineChannel();
    this.initUserOnlineListeners();
  },
  methods: {
    /**
     * Presence Broadcast Channel Listeners and Methods
     * Provided by Laravel.
     * Websockets with Pusher
     */
    initUserOnlineChannel() {
      this.userOnlineChannel = window.Echo.join("agora-online-channel");
    },
    initUserOnlineListeners() {
      this.userOnlineChannel.here((users) => {
        this.onlineUsers = users;
      });
      this.userOnlineChannel.joining((user) => {
        // check user availability
        const joiningUserIndex = this.onlineUsers.findIndex(
          (data) => data.id === user.id
        );
        if (joiningUserIndex < 0) {
          this.onlineUsers.push(user);
        }
      });
      this.userOnlineChannel.leaving((user) => {
        const leavingUserIndex = this.onlineUsers.findIndex(
          (data) => data.id === user.id
        );
        this.onlineUsers.splice(leavingUserIndex, 1);
      });
      // listen to incomming call
      this.userOnlineChannel.listen("MakeAgoraCall", ({ data }) => {
        if (parseInt(data.userToCall) === parseInt(this.authuserid)) {
          const callerIndex = this.onlineUsers.findIndex(
            (user) => user.id === data.from
          );
          this.incomingCaller = this.onlineUsers[callerIndex]["name"];
          this.incomingCall = true;
          // the channel that was sent over to the user being called is what
          // the receiver will use to join the call when accepting the call.
          this.agoraChannel = data.channelName;
        }
      });
    },
    getUserOnlineStatus(id) {
      const onlineUserIndex = this.onlineUsers.findIndex(
        (data) => data.id === id
      );
      if (onlineUserIndex < 0) {
        return "Offline";
      }
      return "Online";
    },
    async placeCall(id, calleeName) {
      try {
        // channelName = the caller's and the callee's id. you can use anything. tho.
        const channelName = `${this.authuser}_${calleeName}`;
        const tokenRes = await this.generateToken(channelName);
        // Broadcasts a call event to the callee and also gets back the token
        await axios.post("/agora/call-user", {
          user_to_call: id,
          username: this.authuser,
          channel_name: channelName,
        });
        this.initializeAgora();
        this.joinRoom(tokenRes.data, channelName);
      } catch (error) {
        console.log(error);
      }
    },
    async acceptCall() {
      this.initializeAgora();
      const tokenRes = await this.generateToken(this.agoraChannel);
      this.joinRoom(tokenRes.data, this.agoraChannel);
      this.incomingCall = false;
      this.callPlaced = true;
    },
    declineCall() {
      // You can send a request to the caller to
      // alert them of rejected call
      this.incomingCall = false;
    },
    generateToken(channelName) {
      return axios.post("/agora/token", {
        channelName,
      });
    },
    /**
     * Agora Events and Listeners
     */
    initializeAgora() {
      this.client = AgoraRTC.createClient({ mode: "rtc", codec: "h264" });
      this.client.init(
        this.agora_id,
        () => {
          console.log("AgoraRTC client initialized");
        },
        (err) => {
          console.log("AgoraRTC client init failed", err);
        }
      );
    },
    async joinRoom(token, channel) {
      this.client.join(
        token,
        channel,
        this.authuser,
        (uid) => {
          console.log("User " + uid + " join channel successfully");
          this.callPlaced = true;
          this.createLocalStream();
          this.initializedAgoraListeners();
        },
        (err) => {
          console.log("Join channel failed", err);
        }
      );
    },
    initializedAgoraListeners() {
      //   Register event listeners
      this.client.on("stream-published", function (evt) {
        console.log("Publish local stream successfully");
        console.log(evt);
      });
      //subscribe remote stream
      this.client.on("stream-added", ({ stream }) => {
        console.log("New stream added: " + stream.getId());
        this.client.subscribe(stream, function (err) {
          console.log("Subscribe stream failed", err);
        });
      });
      this.client.on("stream-subscribed", (evt) => {
        // Attach remote stream to the remote-video div
        evt.stream.play("remote-video");
        this.client.publish(evt.stream);
      });
      this.client.on("stream-removed", ({ stream }) => {
        console.log(String(stream.getId()));
        stream.close();
      });
      this.client.on("peer-online", (evt) => {
        console.log("peer-online", evt.uid);
      });
      this.client.on("peer-leave", (evt) => {
        var uid = evt.uid;
        var reason = evt.reason;
        console.log("remote user left ", uid, "reason: ", reason);
      });
      this.client.on("stream-unpublished", (evt) => {
        console.log(evt);
      });
    },
    createLocalStream() {
      this.localStream = AgoraRTC.createStream({
        audio: true,
        video: true,
      });
      // Initialize the local stream
      this.localStream.init(
        () => {
          // Play the local stream
          this.localStream.play("local-video");
          // Publish the local stream
          this.client.publish(this.localStream, (err) => {
            console.log("publish local stream", err);
          });
        },
        (err) => {
          console.log(err);
        }
      );
    },
    endCall() {
      this.localStream.close();
      this.client.leave(
        () => {
          console.log("Leave channel successfully");
          this.callPlaced = false;
        },
        (err) => {
          console.log("Leave channel failed");
        }
      );
    },
    handleAudioToggle() {
      if (this.mutedAudio) {
        this.localStream.unmuteAudio();
        this.mutedAudio = false;
      } else {
        this.localStream.muteAudio();
        this.mutedAudio = true;
      }
    },
    handleVideoToggle() {
      if (this.mutedVideo) {
        this.localStream.unmuteVideo();
        this.mutedVideo = false;
      } else {
        this.localStream.muteVideo();
        this.mutedVideo = true;
      }
    },
  },
};
</script>

<style scoped>
main {
    margin-top: 1vw;
}

.vcall {
    min-width: 100%;
    height: 100%;
    min-height: 100vh;
    padding: 0 0;
    margin: 0 0;
    display: flex;
}

.rows {
    border-top: solid 2px #b6aeae;
    width:100%;
    height:100vw;
    padding:10px 20px;
    position: relative;
}

/* contact list */
.cl-fr {
    flex: 0 0 30vw;
    max-width: 100%;
    height: auto;
}

.bg-card {
    background: #f0f2f5b0;
}

.prof {
    border-radius: 50%;
    min-height: 40px;
    min-width: 40px;
}

.text-primary {
    margin: 0 !important;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 80%;
}

.text-info {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  width: 80%;
  color: black !important;
}

.scroll {
    max-height: 500px;
    overflow-y: auto;
}

.bi {
    /* font-size: 2px; */
}

/* contack list end */

.vc {
    border-radius: 5px;
    height: 600px;
    background: #f0f2f5b0;
    box-shadow: -1px 4px 28px 0px rgb(0 0 0 / 95%);
}

.vc-frame {
    max-width: 100%;
}

.vc-place {
    max-width: 80%;
}

.vc-place .svg-fm {
    width: 100%;
    position: relative;
}
.svg {
    width: 13vw;
    height: 11.9vw;
    position: absolute;
    margin: 200px 20px 10px 50px;
    top: 40%;
    left: 50%;
    background-size: cover;
    background-image: url(/images/play.png);
}

.filter-green{
        filter: opacity(40%);;
}

.col-sm-12{
    padding: 8px;
}
.head{
    display: inline-block;
    text-align: center;
    width: 100%;
    font-weight: bold;

}

.contact-list {
    flex: 2;
    max-height: 100%;
    width: 30%;
    max-width: 300px;
    height: 550px;
    overflow-y: auto;
    padding: 1px;
    border-right: solid 2px #b6aeae;
}

ul {
    list-style-type: none;
    padding-left: 0;
}

li {
    display: flex;
    padding: 2px;
    border-bottom: 1px solid #aaaaaa;
    height: 80px;
    position: relative;
    cursor: pointer;
}

.user-info {
    flex: 3;
    font-size: 1vw;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: 1vw;
}

p {
    margin: 0;
}

p .name {
    display: inline-block;
    font-weight: bold;
    color: #fff;
}

p .email {
    font-size: 12px;
    color: #f8fafc;
}

.call {
    position: relative;
    display: inline-block;
    margin-right: -4px;
}

.call:before {
    content: "";
    display: block;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #fff;
    width: 100%;
    height: 1px;
    position: absolute;
    top: 50%;
    z-index: -1;
}

.vcall {
    display: block;
    background-color: #3490dc;
    background-image: -o-linear-gradient(top, #f7f7f7, #e7e7e7);
    color: #fff;
    margin-left: 2vw;
    width: 30px;
    height: 30px;
    position: relative;
    text-align: center;
    line-height: 30px;
    border-radius: 50%;
    box-shadow: 0px 3px 8px #aaa, inset 0px 2px 3px #fff;
}

.badge {
    font-size: 70%;
    border-radius: 50%;
}

.vcal:after {
    content: "\27f3";
}
.avatar {
    flex: 1;
    display: flex;
    align-items: center;
}

img {
    height: 5vw;
    width: 5vw;
    /* border: 1.5px solid #f5f6fa; */
}
.rounded-circle {
    border-radius: 50%!important;
}

.badge-light {
    color: #212529;
    background-color: #f8f9fa;
    position: absolute;
}


#video-container {
    height: 550px;
    width: 100%;
    height: 100vh;
    margin: 0 auto;
    border: 1px solid #099dfd;
    position: absolute;
    box-shadow: 1px 1px 11px #9e9e9e;
    background-color: #fff;
    border-radius: 20px;
    box-shadow: -1px 4px 28px 0px rgb(0 0 0 / 75%);
    z-index: 3;
}
#local-video {
  width: 30%;
  height: 30%;
  position: absolute;
  left: 10px;
  bottom: 10px;
  border: 1px solid #fff;
  border-radius: 6px;
  z-index: 2;
  cursor: pointer;
  border-radius: 20px;
}
#remote-video {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    z-index: 1;
    margin: 0;
    padding: 0;
    cursor: pointer;
    border-radius: 20px;
}
.action-btns {
  position: absolute;
  bottom: 20px;
  left: 50%;
  margin-left: -50px;
  z-index: 3;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}
#login-form {
  margin-top: 100px;
}

#videoundefined {
    border-radius: 20%;
}

.incoming {
    position: absolute;
    top: 6vh;
    z-index: 3;
    @media screen (max-width: 500px;) {
        width: 100%;
    }
}

.incoming .incoming-frame p {
    margin: 10px;

}

.incoming .incoming-frame {
    border-radius: 20px;
    padding: 10px;
    margin-left: 3vw;
    margin-top: 3vw;
    background: rgb(255 240 0 / 57%);
    box-shadow: -1px 4px 28px 0px rgb(131 124 17)
}

.decline {
    border-radius: 20px;
    margin-left: 3vw;
}

.accept {
    border-radius: 20px;
}
</style>
