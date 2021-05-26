<template>
    <div class="furnite">
        <div class="container" >
        <div class="tabs">
            <div class="tab-header">
                <h1>Add Friend</h1>
                <div class="active">
                <i class="fas fa-qrcode"></i> QR Code
                </div>
                <div>
                <i class="fa fa-barcode"></i> Scan
                </div>
                <div>
                <i class="fa fa-user-plus"></i> Send invite
                </div>
            </div>
            <div class="tab-indicator"></div>
            <div class="tab-content">

                <div class="active qrcode">
                <i class="fa fa-qrcode"></i>
                <h2>QR Code</h2>
                    <!-- <div class="qrcode"> -->
                    <img src="images/grcode/qrcode.png" alt="">
                    <!-- </div> -->
                </div>

                <div>
                <i class="fa fa-barcode"></i>
                <h2>Scanner</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis eum similique quisquam officiis neque, cumque dignissimos architecto nisi totam sapiente eos et illum laborum atque vero ea perferendis consectetur veritatis.</p>
                </div>

                <div>
                <i class="fa fa-user-plus"></i>
                <h2>Send Invite</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis eum similique quisquam officiis neque, cumque dignissimos architecto nisi totam sapiente eos et illum laborum atque vero ea perferendis consectetur veritatis.</p>
                </div>

            </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            function _class(name){
            return document.getElementsByClassName(name);
            }

            let tabPanes = _class("tab-header")[0].getElementsByTagName("div");

            for(let i=0;i<tabPanes.length;i++){
            tabPanes[i].addEventListener("click",function(){
                _class("tab-header")[0].getElementsByClassName("active")[0].classList.remove("active");
                tabPanes[i].classList.add("active");

                _class("tab-indicator")[0].style.top = `calc(80px + ${i*50}px)`;

                _class("tab-content")[0].getElementsByClassName("active")[0].classList.remove("active");
                _class("tab-content")[0].getElementsByTagName("div")[i].classList.add("active");

            });
            }
        }
    }
</script>

<style lang="scss" scoped>

* {
  box-sizing:border-box;
  background:#f5f5f5;
}

body {
  background:#ddd;
  font-family:"Raleway";
}

.container {
  min-width: 100%;
  height: 100%;
  min-height: 100vh;
  padding: 0 0;
  margin: 0 0;
  display: flex;

  @media screen and (max-width: 768px) {
    height: auto;
    min-height: 100vh;
    // padding-top: 100px;
  }

}

.tabs {
  position:relative;
//   top:50%;
//   left:50%;
//   transform:translate(-50%,-50%);
  width:100%;
  height:100vw;
  padding:30px 20px;
  background:#f5f5f5;
//   box-shadow:5px 5px 10px 5px #ccc;
  overflow:hidden;
}

.tabs .tab-header {
  float:left;
  width: 25%;
  height:100%;
  border-right:1px solid #ccc;
  h1 {
    font-size: 26px;
    margin-left: 20px;
    font-weight: 700;
  }

  @media (max-width: 767.98px) {
      width: 40%;
      h1 {
        font-size: 20px;
        margin-left: 10px;
      }
  }
}

.tabs .tab-header > div {
  height:50px;
  line-height:50px;
  font-size:16px;
  font-weight:600;
  color:#888;
  cursor:pointer;
  padding-left:10px;
  @media screen and(max-width: 700px) {
      font-size: 10px;
      padding-left: 0;
      margin-left: -20px;
  }
}

.tabs .tab-header > div:hover,
.tabs .tab-header > div.active {
  color:#00acee;
}

.qrcode {
    left: 30%;
     @media (max-width: 500.98px)  {
        i, h2 {
            font-size: 12px;
        }
        i {
            width: 30px !important;
            height: 30px !important;
            line-height: 35px !important;
        }
        img {
            width: 50px;
            height: 50px;
        }

        i::before {
            line-height: 0 !important;
        }
    }
}

.tabs .tab-header div i {
  display:inline-block;
  margin-left:10px;
  margin-right:5px;
}
.tabs .tab-content {
  position:relative;
  height:100%;
  overflow:hidden;
  @media screen and(max-width: 700px) {
      h2 {
          font-size: 16px;
      }
      p {
          font-size: 10px;
      }
  }
}
.tabs .tab-content > div > i {
  display:inline-block;
  width:50px;
  height:50px;
  background:#555;
  color:#f5f5f5;
  font-size:25px;
  font-weight:600;
  text-align:center;
  line-height:50px;
  border-radius:50%;
  @media screen and(max-width: 700px) {
      font-size: 18px;
      width: 30px;
      height: 30px;
      line-height: 1.5;
  }
}
.tabs .tab-content > div {
  position:absolute;
  text-align:center;
  padding:40px 20px;
  top:-200%;
  transition:all 500ms ease-in-out;
}
.tabs .tab-content > div.active {
  top:0px;
}

.tabs .tab-indicator {
  position:absolute;
  width:4px;
  height:50px;
  background:#00acee;
  left: 25.5%;
  top:80px;
  transition:all 500ms ease-in-out;
  @media (max-width: 767.98px) {
      left: 40%;
  }
}
</style>
