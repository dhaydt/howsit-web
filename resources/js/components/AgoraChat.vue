<template>
    <main>
        <div class="vcall">
            <div class="call-frame">
                <section id="video-container" v-if="callPlaced" auto-focus>
                    <div id="local-video"></div>
                    <div id="remote-video"></div>

                    <div class="action-btns">
                        <button
                            type="button"
                            class="btn btn-info"
                            @click="handleAudioToggle"
                        >
                            <i
                                v-bind:class="{
                                    'bi bi-volume-up-fill': !mutedAudio,
                                    'bi bi-volume-mute-fill': mutedAudio
                                }"
                            ></i>
                            <!-- {{ mutedAudio ? "Unmute" : "Mute" }} -->
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="handleVideoToggle"
                        >
                            <i
                                v-bind:class="{
                                    'bi bi-camera-video-fill': !mutedVideo,
                                    'bi bi-camera-video-off-fill': mutedVideo
                                }"
                            ></i>
                            <!-- {{ mutedVideo ? "ShowVideo" : "HideVideo" }} -->
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="endCall"
                        >
                            <i class="bi bi-telephone-x-fill"></i>
                        </button>
                    </div>
                </section>

                <div class="row rowss">
                    <div class="contact card col-sm-3 custom-scrollbar-css p-2">
                        <div
                            class="contact-list  custom-scrollbar-js p-2"
                            id="content-2"
                        >
                            <li
                                class=""
                                v-for="user in allusers"
                                :key="user.id"
                            >
                                <div class="status">
                                    <div class="profile-header">
                                        <span class="badge badge-light" style="z-index:1">
                                            {{ getUserOnlineStatus(user.id) }}
                                        </span>
                                        <v-avatar>
                                            <img
                                                :src="
                                                    'images/profile/' +
                                                        user.profile_image
                                                "
                                                alt="user.name"
                                            />
                                        </v-avatar>
                                    </div>
                                    <div class="contact-name">
                                        <h6 class="text-primary">
                                            {{ user.name }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="call-button">
                                    <a
                                        @click="placeCall(user.id, user.name)"
                                        class="v-btn"
                                    >
                                        <i class="bi bi-camera-video-fill"></i>
                                    </a>
                                </div>
                            </li>
                        </div>
                    </div>

                    <div class="landing-vc col-sm d-none d-lg-block d-flex">
                        <div class="landing">
                            <i class="bi bi-camera-video-fill"></i>
                            <h2>Video Call</h2>
                            <p>Select Contact to make video call</p>
                        </div>
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
            <div class="row"></div>

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
            default: []
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
            agoraChannel: null
        };
    },
    mounted() {
        this.initUserOnlineChannel();
        this.initUserOnlineListeners();
    },
    methods: {
        initUserOnlineChannel() {
            this.userOnlineChannel = window.Echo.join("agora-online-channel");
        },
        initUserOnlineListeners() {
            this.userOnlineChannel.here(users => {
                this.onlineUsers = users;
            });
            this.userOnlineChannel.joining(user => {
                // check user availability
                const joiningUserIndex = this.onlineUsers.findIndex(
                    data => data.id === user.id
                );
                if (joiningUserIndex < 0) {
                    this.onlineUsers.push(user);
                }
            });
            this.userOnlineChannel.leaving(user => {
                const leavingUserIndex = this.onlineUsers.findIndex(
                    data => data.id === user.id
                );
                this.onlineUsers.splice(leavingUserIndex, 1);
            });
            // listen to incomming call
            this.userOnlineChannel.listen("MakeAgoraCall", ({ data }) => {
                if (parseInt(data.userToCall) === parseInt(this.authuserid)) {
                    const callerIndex = this.onlineUsers.findIndex(
                        user => user.id === data.from
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
                data => data.id === id
            );

            // console.log("online", id);
            if (onlineUserIndex < 0) {
                return "Off";
            }
            return "On";
        },
        async placeCall(id, calleeName) {
            try {
                // channelName = the caller's and the callee's id. you can use anything. tho.
                const channelName = `${this.authuser}_${calleeName}`;
                const tokenRes = await this.generateToken(channelName);

                console.log('channel', channelName, res);
                // Broadcasts a call event to the callee and also gets back the token
                await axios.post("/agora/call-user", {
                    user_to_call: id,
                    username: this.authuser,
                    channel_name: channelName
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
                channelName
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
                err => {
                    console.log("AgoraRTC client init failed", err);
                }
            );
        },
        async joinRoom(token, channel) {
            this.client.join(
                token,
                channel,
                this.authuser,
                uid => {
                    console.log("User " + uid + " join channel successfully");
                    this.callPlaced = true;
                    this.createLocalStream();
                    this.initializedAgoraListeners();
                },
                err => {
                    console.log("Join channel failed", err);
                }
            );
        },
        initializedAgoraListeners() {
            //   Register event listeners
            this.client.on("stream-published", function(evt) {
                console.log("Publish local stream successfully");
                console.log(evt);
            });
            //subscribe remote stream
            this.client.on("stream-added", ({ stream }) => {
                console.log("New stream added: " + stream.getId());
                this.client.subscribe(stream, function(err) {
                    console.log("Subscribe stream failed", err);
                });
            });
            this.client.on("stream-subscribed", evt => {
                // Attach remote stream to the remote-video div
                evt.stream.play("remote-video");
                this.client.publish(evt.stream);
            });
            this.client.on("stream-removed", ({ stream }) => {
                console.log(String(stream.getId()));
                stream.close();
            });
            this.client.on("peer-online", evt => {
                console.log("peer-online", evt.uid);
            });
            this.client.on("peer-leave", evt => {
                var uid = evt.uid;
                var reason = evt.reason;
                console.log("remote user left ", uid, "reason: ", reason);
            });
            this.client.on("stream-unpublished", evt => {
                console.log(evt);
            });
        },
        createLocalStream() {
            this.localStream = AgoraRTC.createStream({
                audio: true,
                video: true
            });
            // Initialize the local stream
            this.localStream.init(
                () => {
                    // Play the local stream
                    this.localStream.play("local-video");
                    // Publish the local stream
                    this.client.publish(this.localStream, err => {
                        console.log("publish local stream", err);
                    });
                },
                err => {
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
                err => {
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
        }
    }
};
</script>

<style lang="scss" scoped>
* {
    font-size: 20px;
    margin: 0;
    padding: 0;
}

.vcall{
    margin-top: 50px;
}

.rowss {
    border-top: solid 2px #ddd;
}

.contact {
    width: 30vw;
    border-right: solid 2px #ddd;
    padding: 10px;
    max-height: 100vh;
    overflow: scroll;
    @media screen and (max-width: 800px) {
        width: 100vw !important;
        height: 90vh;
    }
}

@media (max-width: 800px) {
    .col-sm-3 {
        max-width: 100%;
        flex: none;
    }
}
.contact-list {
    margin-bottom: 15px;
    li {
        margin-bottom: 15px;
    }
}
.status {
    display: flex;
    justify-content: space-between;
    text-align: center;
    cursor: not-allowed;

    .badge {
        font-size: 0.5em;
        border-radius: 50%;
        padding: 2px;
        margin-bottom: 10px;
    }

    .badge-light {
        color: #16eb28;
        background-color: #0c0d0e;
        position: absolute;
    }

    .contact-name {
        text-align: left;
        width: 100%;
    }

    .text-primary {
        margin-left: 10px;
        font-size: 0.9em;
        max-width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 3;
        font-weight: 700;
    }
}

.profile-header {
    background-color: #fff;
    border-radius: 50%;
    cursor: pointer;
}

img {
    height: 50px;
    width: 50px;
    background-color: #fff;
}

.call-button {
    display: block;
    text-align: center;
    background-color: #ddd;
    border-radius: 10px;
    a {
        display: block;
        cursor: pointer;
        color: grey;
        transition: 0.3s;
        border-radius: 10px;
    }
    a:hover {
        color: red;
    }
    :hover {
        background-color: rgb(172, 169, 169);
    }
}

.landing-vc {
    width: 200%;
}

.landing-vc > div {
    text-align: center;
    padding: 40px 20px;
    top: 30%;
    transition: all 500ms ease-in-out;
}

.landing {
    position: relative;
    height: fit-content;
    width: 100%;
    overflow: hidden;
    i {
        display: inline-block;
        width: 50px;
        height: 50px;
        background: #555;
        color: #f5f5f5;
        font-size: 25px;
        font-weight: 600;
        text-align: center;
        line-height: 50px;
        border-radius: 50%;
        margin-bottom: 20px;
    }
}

//call-frame
#video-container {
    height: 550px;
    width: 100vw;
    height: 100vh;
    margin: 0 auto;
    border: 1px solid #099dfd;
    position: absolute;
    box-shadow: 1px 1px 11px #9e9e9e;
    background-color: #fff;
    border-radius: 20px;
    top: 0;
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
.btn {
    font-size: 0.7em;
    padding: 5px 15px;
    margin: 15px;
    border-radius: 50%;
}

.btn .bi {
    font-size: 40px;
    color: black;
}

.btn #login-form {
    margin-top: 100px;
}

#videoundefined {
    border-radius: 20%;
}

.incoming {
    position: absolute;
    top: 30%;
    z-index: 3;
    @media screen and (max-width: 500px) {
        width: 90%;
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
    background: #645e03;
    box-shadow: -1px 4px 28px 0px rgb(131 124 17);
    p {
        color: white;
    }
}

.decline {
    border-radius: 20px;
    margin-left: 3vw;
}

.accept {
    border-radius: 20px;
}

/*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/
.custom-scrollbar-js,
.custom-scrollbar-css {
    height: 90vh;
}

/* Custom Scrollbar using CSS */
.custom-scrollbar-css {
    overflow-y: scroll;
}

/* scrollbar width */
.custom-scrollbar-css::-webkit-scrollbar {
    width: 5px;
}

/* scrollbar track */
.custom-scrollbar-css::-webkit-scrollbar-track {
    background: #eee;
}

/* scrollbar handle */
.custom-scrollbar-css::-webkit-scrollbar-thumb {
    border-radius: 1rem;
    background-color: #00d2ff;
    background-image: linear-gradient(to top, #00d2ff 0%, #3a7bd5 100%);
}
</style>
