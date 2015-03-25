

    <div id="message-box-hide">
        <div class="body-messg">
            <div id="send-mesg-user" class="scrols">
                <div id="img-cove-msg">
                <img src="{{ cover_photo($user) }}" >
                </div>
                <div id="img-pro-msg">
                    <img src="{{ profile_picture($user) }}" >
                </div>
                <h1 class="username-msg">{{ $user->username }}</h1>
                <h1 class="send-msg-user">New Message</h1>
                <textarea class="msg-send"placeholder="Write a message..." ></textarea>
                <input type="submit" class="send" value="Send">
                <input type="submit" class="cancel" value="Cancel" id="clsoems">
            </div>
        </div>
    </div>