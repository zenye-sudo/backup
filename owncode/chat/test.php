<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/fontawesome-free-5.0.11/fontawesome-free-5.0.11/web-fonts-with-css/css/fontawesome-all.css">
    <style>
       .contact-profile {
            width: 100%;
            height: 60px;
            line-height: 60px;
            background: #f5f5f5;
            position:fixed;
        }
        .contact-profile img {
            width: 40px;
            border-radius: 50%;
            float: left;
            margin: 9px 12px 0 9px;
        }
        .contact-profile p {
            float: left;
        }
         .contact-profile .social-media {
            float: right;
        }
        .contact-profile .social-media i {
            margin-left: 14px;
            cursor: pointer;
        }
       .contact-profile .social-media i:nth-last-child(1) {
            margin-right: 20px;
        }
        .contact-profile .social-media i:hover {
            color: #435f7a;
        }















        .messages {
            height: auto;
            min-height: calc(100% - 93px);
            max-height: calc(100% - 93px);
            overflow-x: hidden;
            overflow-y:scroll;
        }
       .messages ul li {
            display: inline-block;
           width: calc(100% - 25px);
           clear: both;
            float: right;
            margin: 15px 15px 5px 15px;
            font-size: 0.9em;
        }
        .messages ul li img {
        width: 22px;
        border-radius: 50%;
        float: right;
        }
        .messages ul li p {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 20px;
        max-width: 205px;
        line-height: 130%;
        }
       /*.messages ul li:nth-last-child(1) {*/
            /*margin-bottom: 20px;*/
        /*}*/
        .messages ul li.sent img {
            margin: 6px 8px 0 0;
        }
        .messages ul li.sent p {
            float:right;
            background: #435f7a;
            color: #f5f5f5;
        }
        .messages ul li.replies img {
            float: left;
            margin: 6px 0 0 8px;
        }
        .messages ul li.replies p {
            background: #f5f5f5;
            float: left;
        }




















       .message-input {
           position: fixed;
           bottom: 0;
           width: 100%;
           z-index: 99;
       }
       .message-input  textarea{
           font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
           float: left;
           border: none;
           width: calc(100% - 90px);
           padding: 11px 32px 10px 8px;
           font-size: 0.8em;
           color: #32465a;
       }
       .message-input input:focus {
           outline: none;
       }
      .message-input  .attachment {
           position: absolute;
           right: 60px;
           z-index: 4;
           margin-top: 10px;
           font-size: 1.1em;
           color: #435f7a;
           opacity: .5;
           cursor: pointer;
       }
       .message-input  .attachment:hover {
           opacity: 1;
       }
       .message-input  button {
           float: right;
           border: none;
           width: 50px;
           padding: 12px 0;
           cursor: pointer;
           background: #32465a;
           color: #f5f5f5;
       }
      .message-input  button:hover {
           background: #435f7a;
       }
       .message-input  button:focus {
           outline: none;
       }

    </style>
</head>
<body>
<div class="contact-profile">
    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
    <p>Harvey Specter</p>
    <div class="social-media">
        <i class="fab fa-facebook" aria-hidden="true"></i>
        <i class="fab fa-twitter" aria-hidden="true"></i>
        <i class="fab fa-instagram" aria-hidden="true"></i>
    </div>
</div>
<div style="width:100%;height:60px;"></div>
<div class="messages">
    <ul>
        <li class="sent">
            <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
            <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
        </li>
        <li class="replies">
            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
            <p>When you're backed against the wall, break the god damn thing down.</p>
        </li>
        <li class="replies">
            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
            <p>Excuses don't win championships.</p>
        </li>
        <li class="sent">
            <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
            <p>Oh yeah, did Michael Jordan tell you that?</p>
        </li>
        <li class="replies">
            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
            <p>No, I told him that.</p>
        </li>
        <li class="replies">
            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
            <p>What are your choices when someone puts a gun to your head?</p>
        </li>
        <li class="sent">
            <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
            <p>What are you talking about? You do what they say or they shoot you.</p>
        </li>
        <li class="replies">
            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
            <p>Wrong. You t things.</p>
        </li>
    </ul>
</div>
    <div style="width:100%;height:54px;"></div>

<div class="message-input">
    <textarea type="text" placeholder="Write your message..." ></textarea>
    <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
</div>
</body>
</html>